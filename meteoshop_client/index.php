<?php
// config baza de date
include 'configDataBase.php';
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
    .navbar {
      margin-bottom: 50px;
      border-radius: 0;
    }

     .jumbotron {
      margin-bottom: 0;
    }

    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }

  </style>
</head>
<body style="background-color: #fffae6;">

<div class="jumbotron">
    <div style="display:flex;">
      <img src="images/meteo.gif" width="160" height="160" frameBorder="0" >
      <div class="container text-center">
        <h1>Meteo Shop</h1>
        <p style="color: #34a853; font-size: 20px;">Cu cativa pasi inaintea vremii ...</p>
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
        <li class="active" title="Cumparaturi"><a href="#">Home</a></li>
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

<div class="container" style="background-color: #fffae6;">
  <div class="row">
  <?php
  //get rows query
  $query = $db->query("SELECT * FROM produse WHERE cantitate > 0 ORDER BY id ASC LIMIT 100");
  if($query->num_rows > 0){
      while($row = $query->fetch_assoc()){
  ?>
    <div class="col-sm-4">
      <div class="panel panel-primary">
        <div class="panel-heading"><?php echo $row["nume"]; ?></div>
        <div class="panel-body">
            <p><?php echo $row["descriere"]; ?></p>
            <img src="images/<?php echo $row["imagine"] ?>" class="img-responsive" style="width:100%" alt="Image">
            <br>
            <p>Disponibilitate : <?php echo $row["cantitate"].' bucati'; ?></p>
          </div>
        <div class="panel-footer" style="display:flex;">
            <p><strong style="margin:10px; margin-right:25px; padding=10px;"><?php echo '&euro; '.$row["pret"].' EUR'; ?></strong></p>
            <span>
              <a class="btn btn-success" href="eventHandler.php?action=adaugaInCos&id=<?php echo $row["id"]; ?>">Adauga in cos</a>
            </span>
        </div>
      </div>
    </div>
  <?php } }else{ ?>
  <p>Lipsa produse .....</p>
  <?php } ?>
  </div><br>
</div><br>

<footer class="container-fluid text-center" style="display:block;">
  <p>Magazin Meteo Shop</p>
  <form class="form-inline">Primeste promotii:
    <input type="email" class="form-control" size="50" placeholder="Email Address">
    <button type="button" class="btn btn-danger">Sign Up</button>
  </form>
</footer>

</body>
</html>
