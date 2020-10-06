<?php session_start();

$root = dirname(__FILE__);
include "$root/class.product.php";
$totalcost = 0;


if(isset($_SESSION["cart_items"])){
  $serialized = $_SESSION["cart_items"];

  foreach ($serialized as $item) {
    $readable = unserialize($item, ["Product"]);
    $totalcost += strval($readable->getPrice());
    $items[] = $readable;
  }
}else{
  $items = [];
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false){
    $_SESSION["username"] = trim($_POST["name"])
    $_SESSION["address"] = trim($_POST["address"])
  }
}



?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">

    <title>PHPJabbers.com | Free Online Store Website Template</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/owl.css">
  </head>

  <body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <header class="">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="index.php"><h2>Online Store Website<em>.</em></h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="index.php">Home
                  <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="products.php">Products</a>
              </li>

              <li class="nav-item active">
                <a class="nav-link" href="checkout.php">Checkout</a>
              </li>

              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">About</a>

                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="about.php">About Us</a>
                    <a class="dropdown-item" href="testimonials.php">Testimonials</a>
                    <a class="dropdown-item" href="terms.php">Terms</a>
                  </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact Us</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="heading-page header-text">
      <section class="page-heading">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="text-content">
                <h4>Checkout</h4>
                <h2>Lorem ipsum dolor sit amet.</h2>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <!-- Banner Ends Here -->

    <section class="contact-us">
      <div class="container">
        <br>
        <br>
<?php
  echo "<ul style=" . "list-style-type: circle;" . ">";
  foreach ($items as $item) {
    echo '<li>' . $item->getName() . ' : $' . $item->getPrice() . "\n </li>";
  }
  echo "</ul>";
 ?>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <div class="row">
                  <div class="col-6">
                       <em>Sub-total</em>
                  </div>

                  <div class="col-6 text-right">
                       <strong><?php echo "\$" . "$totalcost" ?></strong>
                  </div>
             </div>
          </li>
        </ul>


        <div class="inner-content">
          <div class="contact-us">
            <div class="contact-form">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                <!-- Detta syns bara om man inte är inloggad -->
                  <?php
                  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false){
                  echo  "<div class=\"row\">";
                  echo       "<div class=\"col-sm-6 col-xs-12\">";
                  echo            "<div class=\"form-group\">";
                  echo                 "<label class=\"control-label\">Name:</label>";
                  echo                 "<input required type=\"text\" class=\"form-control\" name=\"name\">";
                  echo            "</div>";
                  echo       "</div>";
                  echo      "<div class=\"col-sm-6 col-xs-12\">";
                  echo            "<div class=\"form-group\">";
                  echo                 "<label class=\"control-label\">Address 1:</label>";
                  echo                 "<input required type=\"text\" class=\"form-control\" name=\"address\">";
                  echo            "</div>";
                  echo       "</div>";
                  echo  "</div>";

                  }
                   ?>


                     <div class="clearfix">
                          <button type="submit" class="filled-button pull-right">Finish</button>
                     </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </section>

    <footer>
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <ul class="social-icons">
              <li><a href="#">Facebook</a></li>
              <li><a href="#">Twitter</a></li>
              <li><a href="#">Behance</a></li>
              <li><a href="#">Linkedin</a></li>
            </ul>
          </div>
          <div class="col-lg-12">
            <div class="copyright-text">
              <p>
                Copyright © 2020 Company Name
                | Template by: <a href="https://www.phpjabbers.com/">PHPJabbers.com</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Additional Scripts -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/isotope.js"></script>
    <script src="assets/js/accordions.js"></script>

    <script language = "text/Javascript">
      cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
      function clearField(t){                   //declaring the array outside of the
      if(! cleared[t.id]){                      // function makes it static and global
          cleared[t.id] = 1;  // you could use true and false, but that's more typing
          t.value='';         // with more chance of typos
          t.style.color='#fff';
          }
      }
    </script>

  </body>
</html>
