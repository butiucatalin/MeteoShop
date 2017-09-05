<?php
if(!isset($_REQUEST['id'])){
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>MeteoShop</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    .jumbotron {
        margin-bottom: 0;
    }
    .container_succes{width: 100%; padding: 50px; margin-top:-40px;}
    p{color: #34a853;font-size: 18px;}

  </style>
</head>
<body style="background-color: #fffae6;">

<div class="jumbotron">
    <div style="display:flex;">
      <img src="images/meteo.gif" width="160" height="160" frameBorder="0" >
      <div class="container text-center">
        <h1>Meteo Shop</h1>
        <p style="color: #34a853;font-size: 20px;">Cu cativa pasi inaintea vremii ...</p>
      </div>
    </div>
</div>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#" title="todo">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active" title="Cumparaturi"><a href="eventHandler.php?action=setCantitateZero">Home</a></li>
        <li><a href="#" title="todo">Categorii de produse</a></li>
        <li><a href="#" title="todo">Promotii</a></li>
        <li><a href="#" title="todo">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#" title="todo"><span class="glyphicon glyphicon-user"></span> Cont</a></li>
        <li><a href="cos.php" title="Cos cumparaturi"><span class="glyphicon glyphicon-shopping-cart"></span> Cos</a></li>
      </ul>
    </div>
  </div>
</nav>

<body>
<div class="container_succes">
    <h1>Statut Comanda</h1>
    <p>Comanda dumneavoastra a fost procesata cu succes . ID comanda #<?php echo $_GET['id']; ?></p>
</div>
</body>
</html>
