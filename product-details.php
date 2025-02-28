
<?php

session_start();
$root = dirname(__FILE__);
include "$root/class.product.php";
include "$root/class.comment.php";

require_once "commentconfig.php";

$product = $commentcontent = $commenter = "";
$comments = [];
$amount = "1";

$token = isset($_SESSION['csrfToken']) ? $_SESSION['csrfToken'] : "";

// Prepare a select statement
$sql = "SELECT * FROM comments";

  $stmt = mysqli_prepare($commentlink, $sql);
  // Attempt to execute the prepared statement
  if(mysqli_stmt_execute($stmt)){
      /* store result */
      $res = mysqli_stmt_get_result($stmt);
      foreach (mysqli_fetch_all($res) as $comment) {
        $comments[] = new Comment($comment[0], $comment[1]);
      }


  }else{
      echo "Oops! Something went wrong. Please try again later.";
}




if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    if(hash_equals($_SESSION['csrfToken'], $_POST['token'])) {
      if(isset($_POST["submit"])){
        if($_POST["submit"] == "toCart"){
          $product = trim($_POST["productname"]);
          $amount = trim($_POST["amount"]);
          for ($i = 0; $i < $amount; $i++){
              if(!isset($_SESSION["cart_items"])){
                $_SESSION["cart_items"] = array($product) ;
              }else{
                $_SESSION["cart_items"][] = $product;
              }
          }
        }elseif($_POST["submit"] == "comment"){
          if(isset($_SESSION["username"])){
            $commenter = $_SESSION["username"];
          }else{
            $commenter = "anonymous";
          }

          if(isset($_POST["commentcontent"])){
            $commentcontent = $_POST["commentcontent"];
          }

        // Prepare a select statement
          $sql = "INSERT INTO comments(commenter, comment) VALUES (?, ?);";
          $stmt = mysqli_prepare($commentlink, $sql);
          mysqli_stmt_bind_param($stmt, "ss", $param_commenter, $param_comment);
          $param_commenter = $commenter;
          $param_comment = $commentcontent;

          // Attempt to execute the prepared statement
          if(mysqli_stmt_execute($stmt)){
              header("location: product-details.php");
          }else{
              echo "Oops! Something went wrong. Please try again later.";
          }
        }
      }
    }
  } else {
    if(isset($_POST["submit"])){
      if($_POST["submit"] == "toCart"){
        $product = trim($_POST["productname"]);
        $amount = trim($_POST["amount"]);
        for ($i = 0; $i < $amount; $i++){
            if(!isset($_SESSION["cart_items"])){
              $_SESSION["cart_items"] = array($product) ;
            }else{
              $_SESSION["cart_items"][] = $product;
            }
        }
      }elseif($_POST["submit"] == "comment"){
        $commenter = "Anonymous";
        if(isset($_POST["commentcontent"])){
        $commentcontent = $_POST["commentcontent"];
        }

      // Prepare a select statement
        $sql = "INSERT INTO comments(commenter, comment) VALUES (?, ?);";
        $stmt = mysqli_prepare($commentlink, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $param_commenter, $param_comment);
        $param_commenter = $commenter;
        $param_comment = $commentcontent;

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            header("location: product-details.php");
        }else{
            echo "Oops! Something went wrong. Please try again later.";
        }
      }
    }
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

    <title>Fåtöljbutiken.se | Prima fåtölj</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- FA Icons -->
    <script src="https://kit.fontawesome.com/215908d2e8.js" crossorigin="anonymous"></script>

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="stylesheet.css">


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
          <a class="navbar-brand" href="index.php"><h2>Fåtöljbutiken.se</h2></a>
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
              <li class="nav-item active">
                <a class="nav-link" href="products.php">Products</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="checkout.php">Checkout</a>
              </li>

              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">About</a>

                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="about.php">About Us</a>
                    <a class="dropdown-item" href="blog.php">Blog</a>
                    <a class="dropdown-item" href="testimonials.php">Testimonials</a>
                    <a class="dropdown-item" href="terms.php">Terms</a>
                  </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact Us</a>
              </li>
              <li class="nav-item">
                <a class = "far fa-user-circle" id="account-button" href="login/welcome.php"></a>
              </li>
              <?php if(isset($_SESSION["loggedin"])) {
                $uname = htmlspecialchars($_SESSION["username"]);
                echo "<li class=\"nav-item row align-items-center\"><p id=\"welcome-message\">Welcome, <b>" . $uname ."</b>!</p></li>";
              }
              ?>
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
                <h4>$150.00 - $300.00</h4>
                <h2>Prima Fåtölj</h2>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    <!-- Banner Ends Here -->

    <section class="blog-posts grid-system">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <div>
              <img src="assets/images/product-1-720x480.jpg" alt="" class="img-fluid wc-image">
            </div>

            <br>

            <div class="row">
              <div class="col-sm-4 col-6">
                <div>
                  <img src="assets/images/product-1-720x480.jpg" alt="" class="img-fluid">
                </div>
                <br>
              </div>
              <div class="col-sm-4 col-6">
                <div>
                  <img src="assets/images/product-2-720x480.jpg" alt="" class="img-fluid">
                </div>
                <br>
              </div>

            </div>

            <br>
          </div>

          <div class="col-md-5">
            <div class="sidebar-item recent-posts">
              <div class="sidebar-heading">
                <h2>Info</h2>
              </div>

              <div class="content">
                <p>Lyxig fåtölj som kan göra den mest kräsna sittaren nöjd.
              </div>
            </div>

            <br>
            <br>
            <div class="contact-us">
              <div class="sidebar-item contact-form">
                <div class="sidebar-heading">
                  <h2>Add to Cart</h2>
                </div>

                <div class="content">
                  <form id="contact" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <input type='hidden' name='token' value='<?php echo($_SESSION['csrfToken']); ?>'>
                    <div class="row">
                      <div class="col-md-6 col-sm-12">
                        <fieldset>
                          <label for="">Extra 1</label>
                          <select name="productname">
                            <option value="f_white">Vit Fåtölj ($150)</option>
                            <option value="f_black">Svart Fåtölj ($200)</option>
                            <option value="f_gray">Grå Fåtölj ($250)</option>
                            <option value="f_pink">Rosa Fåtölj ($300)</option>
                          </select>
                        </fieldset>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 col-sm-12">
                        <fieldset>
                          <label for="">Quantity</label>
                          <input type="text" value="1" required="" name="amount">
                        </fieldset>
                      </div>
                      <div class="col-lg-12">
                        <fieldset>
                            <button name="submit" value="toCart" type="submit" id="form-submit" class="main-button">Add to Cart</button>
                        </fieldset>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <br>
          </div>
        </div>
      </div>
    </section>

    <div class="section contact-us">
      <div class="container">
        <form id="comment" method="post">
          <input type='hidden' name='token' value='<?php echo($_SESSION['csrfToken']); ?>'>
          <div class="sidebar-item recent-posts">
            <div class="sidebar-heading">
              <h2>Comments</h2>
            </div>
            <li class="list-group-item">
              <div class="form-group ">
                  <label><b>Comment</b></label>
                  <input type="text" required name="commentcontent" class="form-control" placeholder="Enter comment here">
                  <br>
                  <div class="col-lg-12">
                    <fieldset>
                        <button name="submit" value="comment" type="submit" id="form-submit" class="main-button pull-right">Publish</button>
                    </fieldset>
                  </div>
              </div>
            </li>

            <br>

            <div class="content">
              <?php foreach ($comments as $comment) {
                echo "<b>" . $comment->getCommenter() . "</b><br>";
                echo filter_var($comment->getComment(), FILTER_SANITIZE_SPECIAL_CHARS);
                echo "<br><br>";
              } ?>
            </div>

            <br>
            <br>
          </div>
        </form>
      </div>
    </div>

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
                Copyright © 2020 Fåtöljbutiken.se
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
          cleared[t.id] = 1;                    // you could use true and false, but that's more typing
          t.value='';               // with more chance of typos
          t.style.color='#fff';
          }
      }
    </script>

  </body>

</html>
