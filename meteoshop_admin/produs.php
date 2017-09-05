<?php

session_start();

class Produs{

    //Constructorul nu se suprascrie , este apelat la fetching
    //de tip clasa , la citirea bazelor de date

    public function init($newid, $newname, $newpret, $newcant) {
        $this->id = $newid;
        $this->pret = $newpret;
        $this->nume = $newname;
        $this->cantitate = $newcant;
    }

    public function getID() {
        return $this->id;
    }

    public function getPret(){
        return $this->pret;
    }

    public function getNume() {
        return $this->nume;
    }

    public function getCantitate(){
        return $this->cantitate;
    }

    public function setPret($newpret) {
        $this->pret = $newpret;
    }

    public function setCantitate($newcant) {
        $this->cantitate = $newcant;
    }

    //ajustare cantitate produs
    public function adjust($variatie){
        if($this->cantitate + $variatie >=0){
            $this->cantitate = $this->cantitate + $variatie;
            return TRUE;
        }
        return FALSE;
    }
} ?>
