<?php

include 'Cart.php';
$cart = new Cart;

include 'configDataBase.php';

if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
    if($_REQUEST['action'] == 'adaugaInCos' && !empty($_REQUEST['id'])) {
        //$cart->destroy();
        $query = $db->query("SELECT * FROM produse WHERE id = ".$_REQUEST['id']);
        $row = $query->fetch_assoc();
        $item = array(
            'id' => $row['id'],
            'nume' => $row['nume'],
            'pret' => $row['pret'],
            'cantitate' => 1
        );
        $insertOK = $cart->add($item);
        $redirect = $insertOK ? 'cos.php' : 'index.php';
        header("Location: ".$redirect);
    } elseif($_REQUEST['action'] == 'stergeItem' && !empty($_REQUEST['id'])) {
        $cart->delete($_REQUEST['id']);
        header("Location: cos.php?");
    } elseif($_REQUEST['action'] == 'actualizareItem' && !empty($_REQUEST['id'])) {
        $_SESSION['cantitate_zero'] = 'yes';
        $updateItem = $cart->update(md5($_REQUEST['id']), $_REQUEST['cant']);
        echo $updateItem ? 'ok' : 'eroare';
        die;
    } elseif($_REQUEST['action'] == 'setCantitateZero') {
        $_SESSION['cantitate_zero'] = 'no';
        header("Location: index.php");
    } elseif($_REQUEST['action'] == 'comanda' && $cart->nrItems() > 0 && !empty($_SESSION['clientID'])) {
        $insertComenzi = $db->query("INSERT INTO comenzi (id_client, pret_total, creat, modificat) VALUES ('"
          .$_SESSION['clientID']."', '".$cart->total()."', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."')");
        var_dump($insertComenzi);
        if($insertComenzi) {
            $orderID = $db->insert_id;
            //intoarce ultimul ID modificat in campul autoinrement
            $sql = '';
            $cartItems = $cart->getContent();
            foreach($cartItems as $item){
                $sql .= "INSERT INTO produse_comandate (id_comanda, id_produs, cantitate) VALUES ('".$orderID."', '".$item['id']."', '".$item['cantitate']."');";
            }
            $insertProduse = $db->multi_query($sql);
            var_dump($insertProduse);
            if($insertProduse) {
                $cart->destroy();
                header("Location: succes.php?id=$orderID");
            } else {
                header("Location: checkout.php");
            }
        } else {
            header("Location: checkout.php");
        }
    } else {
        header("Location: index.php");
    }
} else {
    header("Location: index.php");
}
