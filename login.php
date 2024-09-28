

<?php
  $host = 'localhost';    // Change as necessary
  $user = "root";
  $pass = "mysql";
  $data = "patent_lib";
  $chrs = 'utf8mb4';
  $attr = "mysql:host=$host;dbname=$data;charset=$chrs"; // содержит строку подключения к базе данных 
  // опции для PDO
  // PDO будет выбрасывать исключения при возникновении ошибок
  // PDO будет возвращать ассоциативные массивы в результате запросов
  // PDO будет использовать настоящие подготовленные запросы при выполнении запросов.

  $opts =
  [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
  ];
  
?>
