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
