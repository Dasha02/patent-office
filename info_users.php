<?php
  require_once 'login.php';
  require_once 'functions.php';

  try
  {
    $pdo = new PDO($attr, $user, $pass, $opts);
  }
  catch (PDOException $e)
  {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
    echo "ошибка подключения к базе данных";
  }

  $result = queryMysql("SELECT * FROM users"); 
  $i = 0;
// user_mail = login 
  while ($row = $result->fetch())
  {
    // Извлечение адреса электронной почты пользователя и сохранение в массиве
    $span_user_mail[$i] = stripslashes($row['user_mail']);
 //   echo $i ." - ".$span_user_mail[$i];
    $i = $i + 1;
    
  }


// Получение значения параметра "q" из URL-адреса

$q = $_REQUEST["q"];

$hint = ""; // строка для подсказки


if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    // Проверка соответствия значения "q" нач. части адреса почты
    foreach($span_user_mail as $mail) {
        if (stristr($q, substr($mail, 0, $len))) {
            if ($hint === "") {
                $hint = $mail;
            } else {
                $hint .= ", $mail";
            }
        }
    }
}

// Output "no suggestion" if no hint was found or output correct values 
echo $hint === "" ? "НЕТ СОВПАДЕНИЙ!!!" : $hint;
?>