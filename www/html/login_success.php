<?php
session_start();
if (!$_SESSION) {
  $no_login_url = "index.php";
	header("Location: {$no_login_url}");
	exit;
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
  </head>
  <body>
    <p>Successed.</p>
    <form action="login_success.php" method="POST">
      お名前を入力してください<input type="text" name="name">
      <input type="submit" value="送信">
    </form>
    <?php 
      echo "名前：".$_POST['name'];
    ?>
  </body>
</html>