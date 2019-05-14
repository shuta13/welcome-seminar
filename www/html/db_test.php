<?php
$pdo = new PDO('mysql:host=mysql;dbname=welcome_seminar;charset=utf8',
  'php_user', 'root');
foreach ($pdo->query('select * from users') as $row) {
  echo "<p>$row[id]:$row[user_name]</p>";
}