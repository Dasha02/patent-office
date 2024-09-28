

<?php // Example 05: signup.php


//require_once 'login.php';
require_once 'functions.php';


$host = 'localhost';    // Change as necessary
$user = "root";
$pass = "mysql";

$chrs = 'utf8mb4';
$attr = "mysql:host=$host;charset=$chrs";
$opts =
[
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES   => false,
];

try
{
  $pdo = new PDO($attr, $user, $pass, $opts);
  echo "подключидись";
}
catch (PDOException $e)
{
  throw new PDOException($e->getMessage(), (int)$e->getCode());
  echo "ошибка подключения к базе данных";
}

try
{
$pdo = $pdo->query("CREATE DATABASE patent_lib");
echo "база данных создана";
}

catch (PDOException $e)
{
  echo "<br>" . $e->getMessage();
}

?>
