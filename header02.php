<?php // Example 02: header.php
session_start();
require_once 'functions.php';
$userstr = '';
$randstr = substr(md5(rand()), 0, 7);
$max_s_time = 60*5; // максимальное время работы
$now_time = time();


if (isset($_SESSION['uname']))
{
  $uname    = $_SESSION['uname'];
  $role     = $_SESSION['role'];
  $umail    = $_SESSION['umail'];
  $rigid    = $_SESSION['rigid']; // права доступа
  $uid      = $_SESSION['userid'];
  $l_s_time = $_SESSION['s_time']; // сохраненное время, когда было последнее открытие в сессии

  // провека 
  if (($l_s_time +$max_s_time) < $now_time )
  {
    
    destroySession();
    header("Location: http://localhost/patent/index1.php?formsubmit=$randstr");
  }
  $loggedin = TRUE;
  $userstr  = $uname . " : "  . $role ."  ";
  $_SESSION['s_time'] = time();  // переписываем на текущее время
}
else 
{
  $loggedin = FALSE;
}

echo <<<_INIT
<!DOCTYPE html>
<html lang="ru">
<head>
<title>CSS Website Layout</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel='stylesheet' href='styles.css' type='text/css'>
<style>

</style>

</head>
<body>
_INIT;


echo <<< _INIT

<div class="header">
  <h1>Патентное бюро</h1>
  
</div>


<div class="topnav">
  <a href="index1.php" >Home</a>
  <a href="patents2.php">Патенты</a> 
  <a href="aplications2.php">Заявки</a>
  <a href="logout.php" style="float:right" >Выход</a>
  <a href="signup02.php?r=$rndstr" style="float:right">Регистрация</a> 
  <a href="log02.php?r=$rndstr" style="float:right">Авторизация</a>'
  
</div>
<p align="right">$userstr</p>
_INIT;
?>