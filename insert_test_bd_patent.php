

<?php // Example 05: signup.php


require_once 'login.php';
require_once 'functions.php';

try
{
  $pdo = new PDO($attr, $user, $pass, $opts);
  echo " подключениt к базе данных = ok<br>";

}
catch (PDOException $e)
{
  throw new PDOException($e->getMessage(), (int)$e->getCode());
  echo "ошибка подключения к базе данных<br>";
}


$uname = $email = $utel  = $ureg  = $upsw = $urole = "";
$uname = sanitizeString("Иванов Иван");
$email = sanitizeString("ivi@ivi.ru");
$utel  = sanitizeString("+7(910)1231111");
$ureg  = sanitizeString("Васюки");
$upsw  = sanitizeString("ivi");
$urole = sanitizeString("4");
$upswh = password_hash ($upsw, PASSWORD_DEFAULT);


$result1 = $pdo->query("SELECT * FROM users WHERE user_mail='$email'");

if ($row = $result1->fetch())
{
    echo "пользователь " . $uname . " - уже зарегестрирован <br>";
}
else
{      
    $result = $pdo->query("INSERT INTO users VALUES 
    (NULL, '$urole','$uname', '$email','$utel', '$ureg', '$upswh')");
    echo "пользователь Иванов Иван зарегестрирован <br>";
}


$uname = $email = $utel  = $ureg  = $upsw = $urole = "";
$uname = sanitizeString("Григорьев Игорь");
$email = sanitizeString("gvi@gvi.ru");
$utel  = sanitizeString("+7(910)3231111");
$ureg  = sanitizeString("Большие Овраги");
$upsw  = sanitizeString("gvi");
$urole = sanitizeString("4");
$upswh = password_hash ($upsw, PASSWORD_DEFAULT);


$result1 = $pdo->query("SELECT * FROM users WHERE user_mail='$email'");

if ($row = $result1->fetch())
{
    echo "пользователь " . $uname . " - уже зарегестрирован <br>";
}
else
{      
    $result = $pdo->query("INSERT INTO users VALUES 
    (NULL, '$urole','$uname', '$email','$utel', '$ureg', '$upswh')");
    echo "пользователь Григорьев Игорь зарегестрирован <br>";
}


$uname = $email = $utel  = $ureg  = $upsw = $urole = "";
$uname = sanitizeString("Баранов Илья");
$email = sanitizeString("bvi@bvi.ru");
$utel  = sanitizeString("+7(910)4631111");
$ureg  = sanitizeString("Васюки");
$upsw  = sanitizeString("bvi");
$urole = sanitizeString("4");
$upswh = password_hash ($upsw, PASSWORD_DEFAULT);


$result1 = $pdo->query("SELECT * FROM users WHERE user_mail='$email'");

if ($row = $result1->fetch())
{
    echo "пользователь " . $uname . " - уже зарегестрирован <br>";
}
else
{      
    $result = $pdo->query("INSERT INTO users VALUES 
    (NULL, '$urole','$uname', '$email','$utel', '$ureg', '$upswh')");
    echo "пользователь Баранов Илья зарегестрирован <br>";
}
   

$uname = $email = $utel  = $ureg  = $upsw = $urole = "";
$uname = "Петров Иван";
$email = "pvi@pvi.ru";
$utel  = "+7(910)1241111";
$ureg  = "Парасюки";
$upsw  = "pvi";
$urole = "3";
$upswh = password_hash ($upsw, PASSWORD_DEFAULT);  

$result1 = $pdo->query("SELECT * FROM users WHERE user_mail='$email'");
  
if (!$result1->rowCount())
{      
    $upswh = password_hash ($upsw, PASSWORD_DEFAULT);
    $result = $pdo->query("INSERT INTO users VALUES 
    (NULL, '$urole','$uname', '$email','$utel', '$ureg', '$upswh')");
    echo "пользователь Петров Иван зарегестрирован<br>";
}
else
{
  echo "пользователь " . $uname . " - уже зарегестрирован <br>";
}     


$uname = $email = $utel  = $ureg  = $upsw = $urole = "";
$uname = "Простова Фекла";
$email = "fvi@fvi.ru";
$utel  = "+7(910)1282111";
$ureg  = "Гамзюки";
$upsw  = "fvi";
$urole = "2";
$upswh = password_hash ($upsw, PASSWORD_DEFAULT);  

$result1 = $pdo->query("SELECT * FROM users WHERE user_mail='$email'");
  
if (!$result1->rowCount())
{      
    $upswh = password_hash ($upsw, PASSWORD_DEFAULT);
    $result = $pdo->query("INSERT INTO users VALUES 
    (NULL, '$urole','$uname', '$email','$utel', '$ureg', '$upswh')");
    echo "пользователь Простова Фекла зарегестрирована <br>";
}
else
{
  echo "пользователь " . $uname . " - уже зарегестрирована <br>";
}     
    
$uname = $email = $utel  = $ureg  = $upsw = $urole = "";
$uname = "Шухов Александр";
$email = "avi@avi.ru";
$utel  = "+7(910)4445151";
$ureg  = "Кукуево";
$upsw  = "avi";
$urole = "4";
$upswh = password_hash ($upsw, PASSWORD_DEFAULT);  

$result1 = $pdo->query("SELECT * FROM users WHERE user_mail='$email'");
  
if (!$result1->rowCount())
{      
    $upswh = password_hash ($upsw, PASSWORD_DEFAULT);
    $result = $pdo->query("INSERT INTO users VALUES 
    (NULL, '$urole','$uname', '$email','$utel', '$ureg', '$upswh')");
    echo "пользователь Шухов Александр зарегестрирован<br>";
}
else
{
  echo "пользователь " . $uname . " - уже зарегестрирован <br>";
}     
    
    
$uname = $email = $utel  = $ureg  = $upsw = $urole = "";
$uname = "NULL";
$email = "nul@nul.ru";
$utel  = "+70000000000";
$ureg  = "NULL";
$upsw  = "nul";
$urole = "0";
$upswh = password_hash ($upsw, PASSWORD_DEFAULT);  

$result1 = $pdo->query("SELECT * FROM users WHERE user_mail='$email'");
  
if (!$result1->rowCount())
{      
    $upswh = password_hash ($upsw, PASSWORD_DEFAULT);
    $result = $pdo->query("INSERT INTO users VALUES 
    (NULL, '$urole','$uname', '$email','$utel', '$ureg', '$upswh')");
    echo "пользователь NULL зарегестрирован<br>";
}
else
{
  echo "пользователь " . $uname . " - уже зарегестрирован <br>";
}     
    


$uname = $email = $utel  = $ureg  = $upsw = $urole = "";
$uname = sanitizeString("Сложнова Фросья");
$email = sanitizeString("svi@svi.ru");
$utel  = sanitizeString("+7(910)7771111");
$ureg  = sanitizeString("Неизвестно");
$upsw  = sanitizeString("svi");
$urole = sanitizeString("2");
$upswh = password_hash ($upsw, PASSWORD_DEFAULT);


$result1 = $pdo->query("SELECT * FROM users WHERE user_mail='$email'");

if ($row = $result1->fetch())
{
    echo "пользователь " . $uname . " - уже зарегестрирована <br>";
}
else
{      
    $result = $pdo->query("INSERT INTO users VALUES 
    (NULL, '$urole','$uname', '$email','$utel', '$ureg', '$upswh')");
    echo "пользователь Сложнова Фросья зарегестрирована <br>";
}


$uname = $email = $utel  = $ureg  = $upsw = $urole = "";
$uname = "Колонков Федор";
$email = "kvi@kvi.ru";
$utel  = "+7(910)1241111";
$ureg  = "Овражек";
$upsw  = "kvi";
$urole = "3";
$upswh = password_hash ($upsw, PASSWORD_DEFAULT);  

$result1 = $pdo->query("SELECT * FROM users WHERE user_mail='$email'");
  
if (!$result1->rowCount())
{      
    $upswh = password_hash ($upsw, PASSWORD_DEFAULT);
    $result = $pdo->query("INSERT INTO users VALUES 
    (NULL, '$urole','$uname', '$email','$utel', '$ureg', '$upswh')");
    echo "пользователь Колонков Федор зарегестрирован<br>";
}
else
{
  echo "пользователь " . $uname . " - уже зарегестрирован <br>";
}     

?>
