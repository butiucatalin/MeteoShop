<?php

include 'comanda.php';

include 'configDataBase.php';

if(isset($_REQUEST['idProd']) && isset($_REQUEST['sentVal'])) {
    if($_REQUEST['tip'] == 'p') {
        //am selectat o rubrica pret
        //In cazul modificarii pretului , pretul pentru comenzile
        //deja efectuate va ramane acelasi !
        if(!is_numeric($_REQUEST['sentVal']) OR (is_numeric($_REQUEST['sentVal']) && $_REQUEST['sentVal'] < 0) ) {
            echo "<script>alertaDateInvalide()</script>";
        } else {
            $_SESSION['PRODUSE'][$_REQUEST['idProd']]->setPret($_REQUEST['sentVal']);
            $db->query("UPDATE produse SET pret = ".$_REQUEST['sentVal']." WHERE id = ".$_REQUEST['idProd']);
        }
    }
    if($_REQUEST['tip'] == 'c') {
      //am selectat o rubrica cantitate
        if(!is_numeric($_REQUEST['sentVal']) OR (is_numeric($_REQUEST['sentVal']) && $_REQUEST['sentVal'] < 0) ) {
            echo "<script>alertaDateInvalide()</script>";
        } else {
            $_SESSION['PRODUSE'][$_REQUEST['idProd']]->setCantitate($_REQUEST['sentVal']);
            $db->query("UPDATE produse SET cantitate = ".$_REQUEST['sentVal']." WHERE id = ".$_REQUEST['idProd']);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Meteo Shop Admin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }

    .row.content {height: 450px}

    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }

    .btn-success {
        margin-left: 10px;
        background: #0099cc;
        color: #ffffff;
    }

    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }

    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;}
    }
    ul li{
      margin:10px;
    }

  </style>
</head>

<script>
    function getValueFrom(id,tip) {
        //pasare date Javascript -> php
        var pID;
        if(tip == 'p')pID = "ip" + id;
        if(tip == 'c')pID = "ic" + id;
        var valoare = document.getElementById(pID).value;
        window.location.href = "stocuri.php?idProd=" + id + "&sentVal=" + valoare + "&tip=" + tip;
    }

    function alertaDateInvalide() {
        alert("Eroare . Date invalide !");
      }
</script>

<body style="background-color: #fffae6;">

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Home</a></li>
        <li><a href="comenziController.php" title="Procesare comenzi">Comenzi</a></li>
        <li class="active"><a href="stocuriController.php" title="Actualizare stocuri produse">Stocuri</a></li>
        <li><a href="clienti.php" title="Lista clienti">Clienti</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#" title="todo"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid text-center">
  <div class="row content">
    <div class="col-sm-2 sidenav">
      <p style="overflow: hidden;"><a class="btn btn-success" style="width:100%; background-color:navy;" href="#">Rapoarte clienti</a></p>
      <p style="overflow: hidden;"><a class="btn btn-success" style="width:100%; background-color:navy;" href="#">Istoric comenzi</a></p>
      <p style="overflow: hidden;"><a class="btn btn-success" style="width:100%; background-color:navy;" href="#">Management magazin</a></p>
      <p style="overflow: hidden;"><a class="btn btn-success" style="width:100%; background-color:navy;" href="#">Administrare cont</a></p>
    </div>
    <div class="col-sm-8 text-left">
      <table class="table">
        <thead>
          <tr>
            <th>Deumire</th>
            <th>Pret</th>
            <th>Cantitate</th>
          </tr>
        </thead>
      <?php
        foreach($_SESSION['PRODUSE'] as $produs) { ?>
          <tr>
            <td><?php echo $produs->getNume() ?></td>
            <td>
              <div style="display:flex;">
                <!--la click butonul trimite datele din inputul alaturat -->
                <input id="ip<?php echo $produs->getID(); ?>" type="number" class="form-control text-center" style="width: 50%;" min="0" value="<?php echo $produs->getPret(); ?>"</td>
                <a id="bp<?php echo $produs->getID(); ?>" onclick="getValueFrom('<?php echo $produs->getID(); ?>','p')" title="Update" class="btn btn-success" title="Trimite comanda"><i class="glyphicon glyphicon-refresh"></i></a>
              </div>
            <td>
              <div style="display:flex;">
                <!--la click butonul trimite datele din inputul alaturat -->
                <input id="ic<?php echo $produs->getID(); ?>" type="number" class="form-control text-center" style="width: 50%;" min="0" value="<?php echo $produs->getCantitate(); ?>">
                <a id="bc<?php echo $produs->getID(); ?>" onclick="getValueFrom('<?php echo $produs->getID(); ?>','c')" title="Update" class="btn btn-success" title="Trimite comanda"><i class="glyphicon glyphicon-refresh"></i></a>
              </div>
            </td>
          </tr>
        <?php } ?>
        </table>
    </div>
  </div>
</div>

<footer class="container-fluid text-center">
  <p>&copy; MeteoShop 2017</p>
</footer>

</body>
</html>
