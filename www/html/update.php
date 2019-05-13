<?php
session_start();
// ログインチェック
if (!$_SESSION) {
  $no_login_url = "index.php";
	header("Location: {$no_login_url}");
	exit;
}

if (isset($_POST["change"])) {
  $user_id = $_SESSION['user_id'];
  $new_password = $_POST['new_password'];

  if (isset($_POST["change"])) {
    $pass_changed_url = "confirm.php";
    header("Location: {$pass_changed_url}");
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
  </head>
  <body>
    <form action="update.php" method=POST >
      新パスワード
      <input name="new_password" type="password">
      <input type="submit" name="change" value="パスワード変更">
    </form>
  </body>
</html>