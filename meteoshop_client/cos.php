<?php
include 'Cart.php';
$cart = new Cart;

//unset($_SESSION['continut_cos']);
//var_dump($_SESSION['continut_cos']);
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

  </style>
  <script>
    function actualizareItem(obj,id){
        if(parseInt(obj.value) != obj.value){
          //verifica daca am introdus un numar
          alert('Va rugem sa introduceti o valoare numerica !');
          location.reload();
        }
        $.get("eventHandler.php", {action:"actualizareItem", id:id, cant:obj.value}, function(data){
            if(data == 'ok'){
                location.reload();
            } else{
              alert('Eroare ! Actualizare nereusita .');
            }
        });
    }
  </script>
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
        <li class="active" title="Cumparaturi"><a href="eventHandler.php?action=setCantitateZero">Home</a></li>
        <li><a href="#" title="todo">Categorii de produse</a></li>
        <li><a href="#" title="todo">Promotii</a></li>
        <li><a href="#" title="todo">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#" title="todo"><span class="glyphicon glyphicon-user" ></span> Cont</a></li>
        <li><a href="cos.php" style="color:green;" title="Cos cumparaturi"><span class="glyphicon glyphicon-shopping-cart"></span> Cos</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
    <h1 style="margin-bottom: 30px;">Continut Cos</h1>
    <table class="table">
    <thead>
        <tr>
            <th>Produs</th>
            <th>Pret</th>
            <th>Cantitate</th>
            <th>Subtotal</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if($cart->nrItems() > 0){
            $cartItems = $cart->getContent();
            foreach($cartItems as $item){
              if($item['cantitate'] > 0 OR ( (int)$item['cantitate'] == 0 AND $_SESSION['cantitate_zero'] == 'yes')){
        ?>
        <tr>
            <td><?php echo $item["nume"]; ?></td>
            <td><?php echo '&euro; '.$item["pret"].' EUR'; ?></td>
            <td><input type="number" class="form-control text-center" value="<?php echo $item["cantitate"]; ?>" onchange="actualizareItem(this, '<?php echo $item["id"]; ?>')"></td>
            <td><?php echo '&euro; '.number_format($item["subtotal"],2).' EUR'; ?></td>
            <td>
                <a href="eventHandler.php?action=stergeItem&id=<?php echo $item["id"]; ?>" class="btn btn-danger" onclick="return confirm('Sterg acest produs ?')"><i class="glyphicon glyphicon-trash"></i></a>
            </td>
        </tr>
      <?php } else{$cart->delete($item["id"]);} } }else{ ?>
        <!--produsele cu cantitate 0 sunt scoase la revenirea in cos-->
        <tr><td colspan="5"><p>Cosul dumneavoastra este gol .....</p></td>
          <!--daca nu exista nici un produs in cos , acesta este golit automat-->
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td><a href="eventHandler.php?action=setCantitateZero" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Continua Cumparaturile</a></td>
            <td colspan="2"></td>
            <?php if($cart->nrItems() > 0){ ?>
            <td class="text-center"><strong>Total <?php echo '&euro; '.number_format($cart->total(),2).' EUR'; ?></strong></td>
            <td><a href="checkout.php" class="btn btn-success btn-block">Plateste <i class="glyphicon glyphicon-menu-right"></i></a></td>
            <?php } ?>
        </tr>
    </tfoot>
    </table>
</div>

</body>
</html>
