<?php 
  session_start();
  require_once 'header02.php';
  require_once 'login.php';
  

try
{
  $pdo = new PDO($attr, $user, $pass, $opts);
}
catch (PDOException $e)
{
  throw new PDOException($e->getMessage(), (int)$e->getCode());
  echo "ошибка подключения к базе данных";
}


if (!$loggedin) header("Location: index1.php");



if ($rigid == 4)
{
  require_once 'new_aplication2.php';
  require_once 'aplications2_4.php';
}



if ($rigid == 3)
{
  require_once 'new_status_aplication2_3.php';
  require_once 'aplications2_3.php';
}

if ($rigid == 2)
{
  require_once 'new_status_aplication2_2.php';
  require_once 'aplications2_2.php';
}


?>