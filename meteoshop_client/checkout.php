<?php
// include database configuration file
include 'configDataBase.php';

// initializ shopping cart class
include 'Cart.php';
$cart = new Cart;

// redirect to home if cart is empty
if($cart->nrItems() <= 0){
    header("Location: index.php");
}

// set customer ID in session
$_SESSION['clientID'] = 1;

// get customer details by session customer ID
$query = $db->query("SELECT * FROM clienti WHERE id = ".$_SESSION['clientID']);
$custRow = $query->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>MeteoShop</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
    .container_checkout{width: 100%;padding: 50px;margin-top: -40px;}
    .table{width: 65%;float: left;}
    .shipAddr{width: 30%;float: left;margin-left: 30px;}
    .footBtn{width: 95%;float: left;}
    .orderBtn {float: right;}
    .jumbotron {
        margin-bottom: 0;
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

<div class="container_checkout">
    <h1>Comanda dumneavoastra</h1>
    <table class="table">
    <thead>
        <tr>
            <th>Produs</th>
            <th>Pret</th>
            <th>Cantitate</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if($cart->nrItems() > 0){
            //get cart items from session
            $cartItems = $cart->getContent();
            $_SESSION['am_comanda'] = 'no';
            $_SESSION['am_depasit'] = 'no';
            $_SESSION['am_scos'] = 'no';
            foreach($cartItems as $item){
              if($item['cantitate'] > 0) {
                $query = $db->query("SELECT cantitate FROM produse WHERE id = '".$item['id']."'");
                $stoc = $query->fetch_assoc();
                ?>
                <?php if((int)$stoc["cantitate"] > 0 AND $item["cantitate"] <= $stoc["cantitate"]) { ?>
                  <tr>
                    <td><?php echo $item["nume"]; ?></td>
                    <td><?php echo '&euro; '.number_format($item["pret"],2); ?> EUR</td>
                    <td><?php echo $item["cantitate"]; ?></td>
                    <td><?php echo '&euro; '.number_format($item["subtotal"],2); ?> EUR</td>
                  </tr>
                <?php $_SESSION['am_comanda'] = 'yes'; } else{
                    if((int)$stoc["cantitate"] > 0) {
                      $_SESSION['am_depasit'] = 'yes';
                      $_SESSION['am_comanda'] = 'yes';
                      $cart->update(md5($item["id"]), $stoc["cantitate"]);
                      $item["cantitate"] = $stoc["cantitate"];?>
                      <tr style="color:red;">
                        <td><?php echo $item["nume"]; ?></td>
                        <td><?php echo '&euro; '.number_format($item["pret"],2); ?> EUR</td>
                        <td><?php echo $item["cantitate"]; ?></td>
                        <td><?php echo '&euro; '.number_format($item["subtotal"],2); ?> EUR</td>
                      </tr>
                    <?php } else { $cart->delete($item['id']); $_SESSION['am_scos'] = 'yes';}
                }
         }else $cart->delete($item['id']); } }else{ ?>
        <tr><td colspan="4"><p>Cosul dumneavoastra este gol .....</p></td>
        <?php }
          if($_SESSION['am_comanda'] == 'no') { ?><tr><td colspan="4"><p>Cosul dumneavoastra este gol .....</p></td><?php
          }?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3"></td>
            <?php if($cart->nrItems() > 0){ ?>
            <td class="text-center"><strong style="font-size:140%; margin-left:10px;">Total <?php echo '&euro; '.number_format($cart->total(),2); ?> EUR</strong></td>
            <?php } ?>
        </tr>
    </tfoot>
    </table>
    <div class="shipAddr">
        <h4>Detalii Livrare :</h4>
        <p><?php echo $custRow['nume']; ?></p>
        <p><?php echo $custRow['email']; ?></p>
        <p><?php echo $custRow['telefon']; ?></p>
        <p><?php echo $custRow['adresa']; ?></p>
    </div>
    <div class="footBtn">
      <?php if($_SESSION['am_comanda'] == 'no') {
          ?><p style="color:red; font-size:18px; margin-bottom:25px;">Produsele dumneavostra nu se mai afla in stoc !</p><?php
        }?>
        <?php if($_SESSION['am_scos'] == 'yes' AND $_SESSION['am_comanda'] == 'yes') {
            ?><p style="color:red; font-size:18px; margin-bottom:25px;">Produsele cu stocuri epuizate au fost eliminate !</p><?php
          }?>
      <?php if($_SESSION['am_depasit'] == 'yes') {
          ?><p style="color:red; font-size:18px">Stocuri insuficiente pentru produsele marcate cu rosu !</p>
          <p style="color:red; font-size:18px; margin-bottom:25px;">Cantitatea comandata a fost redusa la stocul maxim disponibil !</p><?php
        }?>
        <a href="index.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Continua Cumparaturile</a>
        <?php if($cart->nrItems() > 0){ ?>
          <a href="eventHandler.php?action=comanda" class="btn btn-success orderBtn">Finalizare Comanda <i class="glyphicon glyphicon-menu-right"></i></a>
        <?php } ?>
    </div>
</div>
</body>
</html>
