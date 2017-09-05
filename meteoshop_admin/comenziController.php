<?php

include 'configDataBase.php';

include 'comanda.php';

if(!isset($_SESSION['PRODUSE']))$_SESSION['PRODUSE'] = array();

if(!isset($_SESSION['COMENZI']))$_SESSION['COMENZI'] = array();

if(isset($_REQUEST['action']) && isset($_REQUEST['cid']) && $_REQUEST['action'] == 'trimite') {
    $valid = TRUE;
    $lista = $_SESSION['COMENZI'][$_REQUEST['cid']]->listaProduse();
    //Verificam daca toate produsele din comanda sunt disponibile momentan
    foreach($lista as $produs) {
        if($produs->getCantitate() > $_SESSION['PRODUSE'][$produs->getID()]->getCantitate()) {
            $valid = FALSE;
            break;
        }
    }
    if($valid) {
        $produse = $_SESSION['COMENZI'][$_REQUEST['cid']]->listaProduse();
        //Stergem comanda din tabelul comenzi si actualizam cantitatile in tabelul produse
        foreach($produse as $produs) {
            $_SESSION['PRODUSE'][$produs->getID()]->adjust(-$produs->getCantitate());
            $db->query("UPDATE produse SET cantitate = ".$_SESSION['PRODUSE'][$produs->getID()]->getCantitate()." WHERE id = ".$produs->getID());
        }
        $db->query("DELETE FROM comenzi WHERE id = ".$_REQUEST['cid']);
        unset($_SESSION['COMENZI'][$_REQUEST['cid']]);
        $_SESSION['produseInsuficiente'] = 'nu';
    } else {
        $_SESSION['produseInsuficiente'] = 'da';
    }
    header("Location: comenzi.php");
    die();
} elseif(isset($_REQUEST['action']) && isset($_REQUEST['cid']) && $_REQUEST['action'] == 'anuleaza') {
    //Stergem comanda din tabelul comenzi fara a actualiza cantitatea de produse
    $db->query("DELETE FROM comenzi WHERE id = ".$_REQUEST['cid']);
    unset($_SESSION['COMENZI'][$_REQUEST['cid']]);
    header("Location: comenzi.php");
    die();
}


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

//Tabelul comenzi in citit de fiecare data cand intram pe pagina
//Tabelul se poate modifica intre timp de catre aplicatia clienti
//Functie de update comenzi

$comenzi = $db->query("SELECT * from comenzi");

$comenzi->setFetchMode(PDO::FETCH_CLASS, 'Comanda');

$comenzi = $comenzi->fetchAll();

foreach($comenzi as $comanda){
    $id = $comanda->id;
    $comm_prod = $db->query("SELECT id_produs, cantitate from produse_comandate where id_comanda = ".$id);
    $comm_prod = $comm_prod->fetchAll(PDO::FETCH_ASSOC);
    foreach($comm_prod as $prod) {
        $current_prod = new Produs;
        $current_prod->init($prod['id_produs'],$_SESSION['PRODUSE'][$prod['id_produs']]->getNume(),$_SESSION['PRODUSE'][$prod['id_produs']]->getPret(),$prod['cantitate']);
        $comanda->addProdus($current_prod);
    }
    $_SESSION['COMENZI'][$id] = $comanda;
}

header("Location: comenzi.php");
 ?>
