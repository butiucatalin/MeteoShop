<?php

include 'produs.php';

class Comanda{

    //lista de produse din comanda
    protected $productList;

    public function __construct() {
        //initial lista este goala
        $productList = array();
    }

    public function getID() {
        return $this->id;
    }

    public function addProdus($prod) {
        //adaugam un produs in lista , doar din clasa Produs
        if(! is_a($prod, 'Produs')) {
            return FALSE;
        }

        $this->productList[$prod->getID()] = $prod;
        return TRUE;
    }

    public function printContent() {
        //intoarce numele si cantitatea din fiecre prosul
        //al comenzii intr-un singur string , concatenat
        $continut = "";
        foreach($this->productList as $produs) {
            $continut = $continut.$produs->getNume()."(".$produs->getCantitate().")  ";
        }
        return $continut;
    }

    public function listaProduse() {
        //intoarce lista de produse
        return $this->productList;
    }
} ?>
