<?php 
  session_start();
  if (!empty($_POST['login']))
  {
    if ($_POST['un'] == "admin" && $_POST['pw'] == "123")
    {
      $_SESSION['user'] = $_POST['un'];
      header("Location: index.php");
    }
  }
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Flat HTML5/CSS3 Login Form</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<script>
  setTimeout(function() { alert("username: admin, password: 123"); }, 1000);
</script>
<body>
  <div class="login-page">
  <div class="form">
    <form class="register-form">
      <input type="text" placeholder="name"/>
      <input type="password" placeholder="password"/>
      <input type="text" placeholder="email address"/>
      <button>create</button>
      <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form>
    <form class="login-form" method="post">
      <input type="text" name="un" placeholder="username"/>
      <input type="password" name="pw" placeholder="password"/>
      <button name="login" value="login">login</button>
      <p class="message">Not registered? <a href="#">Create an account</a></p>
    </form>
  </div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  <script  src="js/index.js"></script>

</body>
</html>
