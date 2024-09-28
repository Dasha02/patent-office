<?php
// выход из текущей сессии пользователя

session_start();
require_once 'functions.php';

destroySession();

header("Location: index1.php");

?>
