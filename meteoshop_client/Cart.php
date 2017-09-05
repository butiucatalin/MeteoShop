<?php

if (!isset ($_SESSION)) session_start();
if (!isset($_SESSION['cantitate_zero'])) $_SESSION['cantitate_zero'] = 'no';
//cantitate_zero : stabileste daca se vor afisa cantitati 0 in cos sau nu ; default = nu

class Cart {
    protected $cartContent = array();
    //cartContent = array mixt ce retine lista produselor din cos
    //o inregistrare din lista va fi formata din urmatoarele campuri :
    //array: md5(id produs) => id produs , nume , pret , cantitate .
    //vectorul va mai cotine pe langa lista si alte 2 variabile:
    //total_cos => costul total al cosului
    //dim_cos => numarul de produse distincte din cos

    public function __construct() {
        if(!empty($_SESSION['continut_cos'])) {
          //fiecare noua instanta de tip Cart este initializata cu
          //datele retinute in sesiune
            $this->cartContent = $_SESSION['continut_cos'];
        } else {
            //daca inca este gol cosul , atunci facem initierea corespunzatoare
            $this->cartContent = array('total_cos' => 0, 'dim_cos' => 0);
        }
    }

    public function getContent(){
        $cart = array_reverse($this->cartContent);

        unset($cart['total_cos']);
        unset($cart['dim_cos']);

        return $cart;
    }

    //functia intoarce o inregistrare din lista de comenzi sau FALSE;
    public function getItem($id) {
        //verifica daca lui "$id" ii corespunde o inregistrare
        if(!isset($this->cartContent[$id]) OR in_array($id, array('total_cos', 'dim_cos'))) {
            return FALSE;
        }
        return $this->cartContent[$id];
    }

    public function nrItems() {
        return $this->cartContent['dim_cos'];
    }

    public function total() {
        return $this->cartContent['total_cos'];
    }

    //adauga o anumita cantitate dintr-un produs
    //si intoarce cheia asociata adaugarii ( sau FALSE in caz de esec )
    public function add($item) {
        if(!is_array($item) OR count($item) === 0){
            return FALSE;
        }

        if(!isset($item['id'], $item['nume'], $item['pret'], $item['cantitate'])){
            return FALSE;
        }

        if($item['cantitate'] === 0) {
            return FALSE;
        }

        //generam cheia unica corespunzatoare ID-ului produsului
        $myid = md5($item['id']);
        $item['cantitate'] += isset($this->cartContent[$myid]['cantitate']) ? (int)$this->cartContent[$myid]['cantitate'] : 0;
        $this->cartContent[$myid] = $item;

        if($this->persistData()) {
            return isset($myid) ? $myid : TRUE;
        } else {
            return FALSE;
        }
    }

    //actualizeaza cantitatea dintr-o inregistrare dupa cheia unica md5
    public function update($key, $bucati) {
        if(!isset($this->cartContent[$key]) OR $bucati < 0) {
            return FALSE;
        }

        $this->cartContent[$key]['cantitate'] = $bucati;

        if($this->persistData()) {
            return isset($myid) ? $myid : TRUE;
        } else {
            return FALSE;
        }
    }

    //sterge o inregistrare din cos dupa id
    public function delete($id) {
        unset($this->cartContent[md5($id)]);
        $this->persistData();
        return TRUE;
    }

    //goleste cosul si inchide sesiunea
    public function destroy() {
        $this->cartContent = array('total_cos' => 0, 'dim_cos' => 0);
        unset($_SESSION['continut_cos']);
        return TRUE;
    }

    protected function persistData() {
        $this->cartContent['total_cos'] = 0;
        $this->cartContent['dim_cos'] = 0;

        foreach($this->cartContent as $key => $value) {
            if(!is_array($value) OR !isset($value['pret'], $value['cantitate'])) {
                continue;
            }
            $this->cartContent[$key]['subtotal'] = $value['pret'] * $value['cantitate'];
            $this->cartContent['total_cos'] += $this->cartContent[$key]['subtotal'];
            $this->cartContent['dim_cos'] += $value['cantitate'];
        }

        if(count($this->cartContent) <= 2) {
            unset($_SESSION['continut_cos']);
            return FALSE;
        }

        $_SESSION['continut_cos'] = $this->cartContent;
        return TRUE;
    }
}
