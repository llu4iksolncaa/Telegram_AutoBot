<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/styles.css" rel="stylesheet" type="text/css">
    <title>Document</title>
</head>
<body>

	<form action="action_page.php">
  <div class="imgcontainer">
    <img src="img/1.jpg" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label for="email"><b>Email</b></label>
    <input type="email" placeholder="Enter Username" name="email" required>

    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    <button type="submit">Login</button>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
  </div>

  <?php
    session_start();
    require('connect_php');
    if (isset($_POST['email']) && isset(($_POST['password'])){
      $email = $_POST['email'];
      $password = $_POST['password'];

      $query = "SELECT * FROM users WHERE email = '$email' and password = '$password'";
      $result = mysqli_query($connection, $query) or die(mysqli_error(connection));
      $count = mysqli_num_rows($result);

      if($count == 1){
        $_SESSION ['email'] = $email
      } else {
        $fmsg = "Ошибка";
      }
    }
    if (isset($_SESSION['email'])){
      $email = $_SESSION['email'];
      echo "Hello" . $email . "";
      echo "Вы вошли";
    }

?>




  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
    <span class="psw">Forgot <a href="#">password?</a></span>
  </div>
</form>

</body>
</html>