<?php
session_start();

if(!isset($_SESSION["user_name"])) {
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
  </body>
</html>
<?php
  echo $_GET["keyword"];
?>