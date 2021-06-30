<?php
$server = "localhost";
$user = "root";
$pass = "";
$db ="cadastro";

$pdo = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/*
if ($conn = mysqli_connect($server, $user, $pass, $db)) {
  echo "conectado";
}else {
  echo "erro!";
}
*/

?>
