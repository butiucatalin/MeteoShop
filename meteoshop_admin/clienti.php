<?php

include 'configDataBase.php';

$users = $db->query("SELECT * FROM clienti");

$users->setFetchMode(PDO::FETCH_ASSOC);

$users = $users->fetchAll();

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
        <li><a href="stocuriController.php" title="Actualizare stocuri produse">Stocuri</a></li>
        <li class="active"><a href="clienti.php" title="Lista clienti">Clienti</a></li>
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
        <!--Doar vizualizare date clienti -->
        <thead>
          <tr>
            <th>ID</th>
            <th>Nume</th>
            <th>Email</th>
            <th>Telefon</th>
            <th>Adresa</th>
          </tr>
        </thead>
      <?php
        foreach($users as $user) { ?>
          <tr>
            <td><?php echo $user['id'] ?></td>
            <td><?php echo $user['nume'] ?></td>
            <td><?php echo $user['email'] ?></td>
            <td><?php echo $user['telefon'] ?></td>
            <td><?php echo $user['adresa'] ?></td>
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
