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
    /* Remove the navbar's default margin-bottom and rounded borders */
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }

    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}

    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }

    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }

    /* On small screens, set height to 'auto' for sidenav and grid */
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
        <li class="active"><a href="#">Home</a></li>
        <li><a href="comenziController.php" title="Procesare comenzi">Comenzi</a></li>
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
    </div>
    <div class="col-sm-8 text-left">
      <h1>Bine ati revenit !</h1>
      <hr>
      <p>In aceasta sectiune puteti :</p>
      <ul>
        <li>Vizualiza lista comenzilor plasate de clienti de la ultima dumneavoastra logare</li>
        <li>Modifica bazele de date , adaugand sau retragand stocuri din produsele inregistrate</li>
        <li>Accesa lista cu informatiile clientilor inregistrati</li>
      </ul>
      <hr>
      <h3>Lista optiuni</h3>
      <ul style="list-style-type:circle;">
          <li>Rapoarte despre gradul de satisfactie al clientilor ( todo )</li>
          <li>Istoricul comenzilor / client ( todo )</li>
          <li>Adaugare , stergere produse in bazele de date ( todo )</li>
          <li>Adaugare cot pentru login , administrare cont ( todo )</li>
        </ul>
    </div>
  </div>
</div>

<footer class="container-fluid text-center">
  <p>&copy; MeteoShop 2017</p>
</footer>

</body>
</html>
