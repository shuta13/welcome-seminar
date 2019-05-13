<?php
  session_start();
  $error_message = "";

  if (isset($_POST["login"])) {
    if ($_POST["user_name"] == "hoge" && $_POST["password"] == "password") {
      $_SESSION["user_name"] = $_POST["user_name"];
      $login_success_url = "login_success.php";
      header("Location: {$login_success_url}");
      exit;
    }
    $error_message = "Sorry, error.";
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8'/>
  </head>
  <body>
  <?php
    if($error_message) {
      echo $error_message;
    }
  ?>
    
  <form action="index.php" method="POST">
    <p>ログインID：<input type="text" name="user_name"></p>
    <p>パスワード：<input type="password" name="password"></p>
    <input type="submit" name="login" value="ログイン">
  </form>
  </body>
</html>