<?php // Example 04: index.php
// Обработка данных после отправки формы
if (isset($_POST['name_invention']))
  {
    

    $name_invention                 = sanitizeString($_POST['name_invention']);
    $description_invention          = sanitizeString($_POST['description_invention']);
    $formula_invention              = sanitizeString($_POST['formula_invention']);
    $full_description_invention     = sanitizeString($_POST['full_description_invention']);
    $bibliograf_invention           = sanitizeString($_POST['bibliograf_invention']);

    echo "$descption_invention";

// Проверка существования записи в бд

    $user_id           = $uid;
    $status_id         = "1";
    $date_registration = date("Y/m/d");
    $last_id = NULL;

    $result = queryMysql("SELECT * FROM aplication_form WHERE name_invention='$name_invention' AND user_id='$user_id'");
   
    if (!$result->fetch()) // Если записи не существует, то выполняется цикл для попыток вставки записи

    {
      for ($i=0; $i<=10; $i++)
      {
        $err = "";
        try
        { 
          $pdo->beginTransaction();

          queryMysql("LOCK TABLES aplication_form WRITE");
     
          $pdo->query ("INSERT INTO aplication_form 
              VALUES(
              NULL, 
             '$user_id',
             '$status_id',
             '$name_invention',
             '$description_invention',
             '$formula_invention',
             '$full_description_invention',
             '$bibliograf_invention',
             '$date_registration', 
              NULL,
              '1',
              '1',
              '1',
              '1')");
      
          $last_id = $pdo->lastInsertId();
   
          queryMysql("UNLOCK TABLES");

          queryMysql("LOCK TABLES aplication_log WRITE");     
      
          $operation_datatime = date("Y-m-d h:i:s");
          $aplication_id      = $last_id;
          $last_status_id     = "0";
          $present_status_id  = $status_id;

          queryMysql ("INSERT INTO aplication_log 
            VALUES(
              NULL,
              '$operation_datatime',
              '$aplication_id',
              '$user_id',
              '$last_status_id',
              '$present_status_id')");
          echo "New record created successfully";

          $pdo->commit();
          queryMysql("UNLOCK TABLES");
          break;
          header("Location: aplications2.php");
        }
        catch(PDOException $e)
        {
          echo "<br>" . $e->getMessage();
          $err = $e->getMessage();
          $pdo->rollback();
        }
        queryMysql("UNLOCK TABLES");

      }
      if ($err!="")
        echo "Доступ к базе данных заблокирован - попробуйте повторить запрос позже!";
    }
  }



?>