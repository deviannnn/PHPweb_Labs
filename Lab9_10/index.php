<?php
  ob_start();
  session_start();
  if (!isset($_SESSION['carousel']) && !isset($_SESSION['purchase']) && !isset($_SESSION['total']) && !isset($_SESSION['user']))
  {
    $_SESSION['carousel'] = '';
    $_SESSION['purchase'] = array();
    $_SESSION['total'] = 0;
    $_SESSION['user'] = 'Login';
  }

  if (!isset($_GET['type']))
  {
    $_SESSION['carousel'] = '';
  }
  else
  {
    $_SESSION['carousel'] = 'hidden';
  }

  if (!empty($_GET['id']))
  {
    array_push($_SESSION['purchase'],$_GET['id']);
    $_SESSION['total'] += 1;
  }
  if (!empty($_GET['go']) && $_SESSION['user'] == 'Login')
  {
    header("Location: login.php");
  }
  else if (!empty($_GET['go']) && $_SESSION['user'] != 'Login')
  {
    header("Location: cart.php");
  }
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shop Homepage - Start Bootstrap Template</title>
    <script src="jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/shop-homepage.css" rel="stylesheet">

  </head>
  <script>
    $(document).ready(function () {

      $.get("/Lab09-10/get-category.php", function(data, status){
          data.data.forEach(element => {
              let cate = $('<a href="?type='+element.id+'" class="list-group-item">'+element.name+'</a>');
              $('.list-group').append(cate);
          });
      },"json");

    });
  </script>
  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
              <li class="nav-item">
                  <a class="nav-link" href="
                    <?php 
                      if($_SESSION['user'] == 'Login')
                      {
                        echo '/Lab09-10/login.php';
                      }
                      else
                      {
                        echo '#';
                      }
                    ?>
                  "><?php echo $_SESSION['user']; ?></a>
              </li>
            <li class="nav-item">
              <a class="nav-link" href="/Lab09-10/index.php?go=gotocart">Cart (<?php echo $_SESSION['total']; ?> items)</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <div class="col-lg-3">

          <h1 class="my-4"><a href="/Lab09-10/" style="text-decoration: none; color: black">Shop Name</a></h1>
          <div class="list-group">

          </div>

        </div>
        <!-- /.col-lg-3 -->
        <div class="col-lg-9">
          <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel" <?php echo $_SESSION['carousel'] ?>>
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox" style="background-color: gray;">
              <div class="carousel-item active">
                <img class="d-block img-fluid" src="images/iphone-6s-128gb-hong-1-400x450.png" alt="First slide" style="margin-left: 200px">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="images/iphone-7-plus-128gb-de-400x460.png" alt="Second slide" style="margin-left: 200px">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="images/oppo-f3-plus-1-1-400x460.png" alt="Third slide" style="margin-left: 200px">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>

          <div class="row">
            <?php
              require_once ('connection.php');
              $sql = "";
              
              if (isset($_GET['type']))
              {
                $current = $_GET['type'];
                $sql = "SELECT * FROM product WHERE type = ".$current;
              }
              else
              {
                $sql = "SELECT * FROM product";
              }

              try{
                $stmt = $dbCon->prepare($sql);
                $stmt->execute();
              }
              catch(PDOException $ex){
                die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
              }

              $data = array();
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
              {
                $data[] = $row;
              }
              
              foreach ($data as $intodata) {
                echo '<div class="col-lg-4 col-md-6 mb-4">';
                echo '<div class="card h-100">';
                echo '<a href="#"><img class="card-img-top" src="'.$intodata['image'].'" alt=""></a>';
                echo '<div class="card-body">';
                echo '<h4 class="card-title">';
                echo '<a href="#">'.$intodata['name'].'</a>';
                echo '</h4>';
                echo '<h5 style="color: #f47442">'.number_format($intodata['price']).'</h5>';
                echo '<p class="card-text">'.$intodata['description'].'</p>';
                echo '<small class="text-muted">';
                for ($i=0; $i<5; $i++)
                {
                  if ($i<$intodata['vote'])
                  {
                    echo '&#9733;';
                  }
                  else
                  {
                    echo '&#9734;';
                  }
                }
                echo '</small>';
                echo '</div>';
                echo '<div class="card-footer">
                      <a href="/Lab09-10/index.php?id='.$intodata['id'].'" class="btn btn-primary">Add to cart</a>
                      </div>
                      </div>
                      </div>';
              }

            ?>

          </div>
          <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2017</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
