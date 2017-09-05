<?php

include 'comanda.php';

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
  function alertaProduseInsuficiente() {
      alert("Comanda nu poate fi trimita . Nu mai exista toate produsele in stoc !");
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
        <li class="active"><a href="comenziController.php" title="Procesare comenzi">Comenzi</a></li>
        <li><a href="stocuriController.php" title="Actualizare stocuri produse">Stocuri</a></li>
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
      <p style="overflow: hidden;"><a href="comenziController.php" class="btn btn-success" title="Actualizeaza lista de comenzi" style="margin-bottom: 10px;" ><i class="glyphicon glyphicon-refresh"></i> UPDATE</a></p>
    </div>
    <div class="col-sm-8 text-left">
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Client</th>
            <th>Pret</th>
            <th>Detalii</th>
            <th>Data</th>
            <th>Actiuni</th>
          </tr>
        </thead>
      <?php
        foreach($_SESSION['COMENZI'] as $comanda) { ?>
          <tr>
            <td><?php echo $comanda->id ?></td>
            <td><?php echo $comanda->id_client ?></td>
            <td><?php echo $comanda->pret_total ?> &euro;</td>
            <td><?php echo $comanda->printContent() ?></td>
            <td><?php echo $comanda->creat ?></td>
            <td>
              <span>
                <!--Trimite comanda -->
                <a href="comenziController.php?action=trimite&cid=<?php echo $comanda->id ?>" class="btn btn-success" title="Trimite comanda" onclick="return confirm('Trimiteti comanda ?')"><i class="glyphicon glyphicon-ok-sign"></i></a>
              </span>
              <span>&nbsp;</span>
              <span>
                <!--Anuleaza comanda -->
                <a href="comenziController.php?action=anuleaza&cid=<?php echo $comanda->id ?>" class="btn btn-danger" title="Anuleaza comanda" onclick="return confirm('Anulati comanda ?')"><i class="glyphicon glyphicon-trash"></i></a>
              </span>
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

<!--Informare in caz de nereusita -->
<?php if(isset($_SESSION['produseInsuficiente']) && $_SESSION['produseInsuficiente'] == 'da') {
   echo '<script>alertaProduseInsuficiente()</script>';
   $_SESSION['produseInsuficiente'] = 'nu';
 } ?>
