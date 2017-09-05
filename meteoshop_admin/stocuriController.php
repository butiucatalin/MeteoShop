<?php

include 'configDataBase.php';

include 'comanda.php';

if(!isset($_SESSION['PRODUSE'])) {
  //Numai daca nu avem setata variabila de sesiune mai citim baza de date
  $produse = $db->query("SELECT id, nume, pret, cantitate from produse");

  $produse->setFetchMode(PDO::FETCH_CLASS, 'Produs');

  $produse = $produse->fetchAll();

  foreach($produse as $produs){
      $id = $produs->getID();
      $_SESSION['PRODUSE'][$id] = $produs;
  }
}

header("Location: stocuri.php");

?>
