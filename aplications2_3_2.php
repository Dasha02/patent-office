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
$randstr_number_patent = substr(md5(rand()), 0, 17);
$id = "ap_ver";
$wr = 1;




if (isset($_POST['begin_registration']))
{
    $aplication_id       = sanitizeString($_POST['aplication_id']);
    $user_id_patent_regs = sanitizeString($_POST['zanyato']);

    try
    {
      $pdo->beginTransaction();
      $query = "SELECT * FROM aplication_form WHERE aplication_id=$aplication_id FOR UPDATE SKIP LOCKED";
      $result = $pdo->query($query);
      $num_rows = $result->rowCount();
        if ($num_rows!=0)
        {
            $query = "SELECT 
                af.aplication_id, 
                af.date_registration,
                af.name_invention, 
                af.description_invention,
                af.formula_invention,
                af.full_description_invention,
                af.bibliograf_invention,
                af.date_finish,
                af.user_id,
                af.status_id,
                af.user_verificator_id,
                af.user_expert_znak_id,
                af.user_expert_plag_id,
                af.user_patent_regs_id,
                u.user_name,
                u.user_mail, 
                u.number_tel, 
                s.status_aplication
                FROM 
                aplication_form af
                JOIN 
                users u ON af.user_id = u.user_id
                JOIN 
                status_ap s ON af.status_id = s.status_id
                WHERE aplication_id=$aplication_id";
            $result = $pdo->query($query);
            $row = $result->fetch();
            //$aplication_id              = stripslashes($row['aplication_id']);
            $date_registration          = stripslashes($row['date_registration']);
            $name_invention             = stripslashes($row['name_invention']);
            $description_invention      = stripslashes($row['description_invention']);
            $formula_invention          = stripslashes($row['formula_invention']);
            $full_description_invention = stripslashes($row['full_description_invention']);
            $bibliograf_invention       = stripslashes($row['bibliograf_invention']);
      
            $date_finish                = stripslashes($row['date_finish']);
            $user_id                    = stripslashes($row['user_id']);
            $status_id                  = stripslashes($row['status_id']);
            $user_verificator_id        = stripslashes($row['user_verificator_id']);
            $user_expert_znak_id        = stripslashes($row['user_expert_znak_id']);
            $user_expert_plag_id        = stripslashes($row['user_expert_plag_id']);
            $user_patent_regs_id        = stripslashes($row['user_patent_regs_id']);

            $tatus                      = stripslashes($row1['status_aplication']);

            $user_name                  = stripslashes($row['user_name']);
            $user_mail                  = stripslashes($row['user_mail']);
            $number_tel                 = stripslashes($row['number_tel']);

            //echo "<script>alert('это задержка трансакции');</script>";

            if ($user_patent_regs_id != 1 and $user_patent_regs_id != $user_id_patent_regs )
              { 
           
                echo "<script>alert('Эта заявка закреплена за другим экспертом!');</script>";
                echo "Эта заявка закреплена за другим экспертом!"; 
                $wr = 0;
                $pdo->rollBack();
                header("Refresh: 0; url= aplications2.php");
              }
            else
              {
                if ($user_patent_regs_id == "1")
                  {
                    $pdo->query ("UPDATE aplication_form SET user_patent_regs_id=$user_id_patent_regs WHERE aplication_id=$aplication_id");
                  }
                $wr = 1;  
                $pdo->commit(); 
              }        
              
        }
        else
        {
            echo "<script>alert('запись заблокирована - операция осуществляется другим пользователем');</script>";
            echo "запись заблокирована - операция осуществляется другим пользователем";
            $pdo->commit();
            header("Refresh: 5; url= aplications2.php");
        }
    }
    catch(PDOException $e)
    {
      echo "<br>" . $e->getMessage();
      $pdo->rollBack();
    }   
}


if (isset($_POST['submit']))
{
    if (isset($_POST['registration']))
    {
        $registration  = sanitizeString($_POST['registration']);
        $aplication_id = sanitizeString($_POST['ap_id']);
        $number_patent = sanitizeString($_POST['number_patent']);
        $user_id_regis = sanitizeString($_POST['zanyato']);
       
        $user_id       = $_SESSION['userid'];

        if ($registration)
        { 
            $status_id = "11"; 
        //    echo"ok";
        }
        else
        {
            $status_id ="12";
        //    echo "Cancel";
        }
        //$pdo->commit(); 
        //change_status_log($status_id, $aplication_id);
       // $pdo->commit();  
        //header("Location: aplications2.php");
        try
        { 
            $pdo->beginTransaction();
            $query = "SELECT * FROM aplication_form WHERE aplication_id=$aplication_id FOR UPDATE SKIP LOCKED";
            $result = $pdo->query($query);
            $num_rows = $result->rowCount();
            if ($num_rows != 0)
            {
                $row = $result->fetch();
                $last_status_id      = stripslashes($row['status_id']);
                $user_patent_regs_id = stripslashes($row['user_patent_regs_id']);
                
                $name_invention             = stripslashes($row['name_invention']);
                $description_invention      = stripslashes($row['description_invention']);
                $formula_invention          = stripslashes($row['formula_invention']);
                $full_description_invention = stripslashes($row['full_description_invention']);
                $bibliograf_invention       = stripslashes($row['bibliograf_invention']);
                $date_registration          = stripslashes($row['date_registration']);

                $present_status_id   = $status_id;
                if ($last_status_id != $present_status_id AND $user_id == $user_patent_regs_id)
                {
                    $err= "";
                    $query = "UPDATE aplication_form SET status_id=$status_id WHERE aplication_id=$aplication_id";
                    $r = $pdo->query($query);
                    
                    queryMysql("LOCK TABLES aplication_log WRITE");     
                    $operation_datatime = date("Y-m-d h:i:s");
                    
                    //$query = "UPDATE aplication_form SET date_finish=$operation_datatime WHERE aplication_id=$aplication_id";
                    //$r = $pdo->query($query);
        
                    $pdo->query ("INSERT INTO aplication_log 
                    VALUES(
                        NULL,
                        '$operation_datatime',
                        '$aplication_id',
                        '$user_id',
                        '$last_status_id',
                        '$present_status_id')");

                    queryMysql("LOCK TABLES patent_list WRITE");
                    $pdo->query ("INSERT INTO patent_list
                    VALUES(
                      NULL, 
                      '$aplication_id',
                      '$name_invention',
                      '$description_invention',
                      '$formula_invention',
                      '$full_description_invention',
                      '$bibliograf_invention',
                      '$number_patent',
                      '$date_registration',
                      '$operation_datatime')");
                }
                else
                {
                    echo "<script>alert('операция осуществляется другим пользователем');</script>";
                    echo "операция осуществляется другим пользователем";
                    $pdo->commit();
                    header("Refresh: 0; url= aplications2.php");
                }
            } 
            else
            {
                echo "<script>alert('запись заблокирована - операция осуществляется другим пользователем');</script>";
            
                echo "запись заблокирована - операция осуществляется другим пользователем";
                $pdo->commit();
                header("Refresh: 10; url= aplications2.php");
            }

            $pdo->commit();
           // registration_patent($aplication_id, $number_patent);

            echo "<script>alert('Изменение статуса заявки поведено успешно!');</script>";
          
            echo "Изменение статуса заявки поведено успешно!";
          
            header("Refresh: 0; url= aplications2.php");
          
        }
        catch(PDOException $e)
        {
          echo "<br>". $e->getMessage();
          $pdo->rollback();
          $err = $e->getMessage();
        }
    }
    else 
    {
        echo "<script>alert('РЕГИСТРАЦИЯ ПАТЕНТА НЕ ЗАВЕРШЕНА!!! ВЕРНИТЕСЬ ПОЗЖЕ К ЗАДАЧЕ ДЛЯ ЗАВЕРШЕНИЯ ПРОЦЕССА!!!');</script>";
        header("Refresh: 0; url= aplications2.php");
    }   
}
  

echo <<< _begin

    <style>
    /* Style inputs with type="text", select elements and textareas */
    input[type=text], select, textarea {
        width: 100%; /* Full width */
        padding: 12px; /* Some padding */  
        border: 1px solid #ccc; /* Gray border */
        border-radius: 4px; /* Rounded borders */
        box-sizing: border-box; /* Make sure that padding and width stays in place */
        margin-top: 6px; /* Add a top margin */
        margin-bottom: 16px; /* Bottom margin */
        resize: vertical /* Allow the user to vertically resize the textarea (not horizontally) */
    }
    /* Add a background color and some padding around the form */
    .container {
      border-radius: 5px;
      background-color: #f2f2f2;
      padding: 20px;
    }
    table {
      border-collapse: collapse;
      border-spacing: 0;
      width: 100%;
      border: 0px solid #ddd;
      
    }
    th, td {
      text-align: left;
      padding: 6px;
    }
    tr:nth-child(even) {
      background-color: #f2f2f2
    }
    
    /* Set a style for all buttons */
    button 
    {
      background-color: #4CAF50;
      color: white;
      padding: 8px 12px;
      margin: 5px 0;
      border: none;
      cursor: pointer;
      width: 100%;
    }
    
    button:hover {
      opacity: 0.7;
    }
    /* The Modal (background) */
    .modal {
        display: block; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        padding-top: 60px;
    }

    /* Modal Content/Box */
    .modal-content {
        background-color: #fefefe;
        margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
        border: 1px solid #888;
        width: 80%; /* Could be more or less, depending on screen size */
    }
    </style>



    
    <div class="toph" align="center">
    <a align="center">РЕГИСТРАЦИЯ ПАТЕНТА</a>
    </div>
    <div id='$id' >
        <div class='container'>
                
              <label for='aplication_id'><b>Номер заявки</b></label>
              <input type='text' name='aplication_id' value='$aplication_id' disabled>
  
              <label for='date_registration'><b>Дата регистрции</b></label>
              <input type='text' name='date_registration' value='$date_registration' disabled>
  
              <label for='user_name'><b>Заявитель</b></label>
              <input type='text' name='user_name' value='$user_name' disabled>
  
              <label for='name_invention'><b>Название изобретения</b></label>
              <input type='text' name='name_invention' value='$name_invention' disabled>
  
              <label for='description_invention'><b>Описание изобретения</b></label>
              <textarea name='description_invention' style='height:100px' placeholder='$description_invention' disabled></textarea>
  
              <label for='formula_invention'><b>Формула изобретения</b></label>
              <textarea name='formula_invention' style='height:100px' placeholder='$formula_invention' disabled></textarea>
  
              <label for='full_description_invention'><b>Полное описание изобретения</b></label>
              <textarea name='full_description_invention' style='height:200px' placeholder='$full_description_invention' disabled></textarea>
  
              <label for='bibliograf_invention'><b>Библиография</b></label>
              <textarea name='bibliograf_invention' style='height:100px' placeholder='$bibliograf_invention' disabled></textarea>
            
              <form action='aplications2_3_2.php' method='post'>

              <fieldset>
              <legend>По результатам анализа пакета документов примите решение:</legend> <br>
              <input type='radio' name='registration' value='1'>ПРОЦЕСС РАССМОТРЕНИЯ ЗАЯВКИ ЗАВЕРШЕН - РЕГИСТРАЦИЯ ПАТЕНТА<br><br>
              <input type='radio' name='registration' value='0'>ОТКАЗ В РЕГИСТРАЦИИ<br><br>
              <input type='hidden' name='ap_id' value='$aplication_id'>
              <input type='hidden' name='zanyato' value='$uid'>
              <input type='hidden' name='number_patent' value='$randstr_number_patent'>
                 
              </fieldset>

              <table>
                <tr>
                  <td width='30%'>
                    
                  </td><td width='40%'></td><td width='30%'>
                    <button type='submit' name='submit'>Отправить</button>
                  </td>
                </tr>
              </table>

                        
              </form>
        </div>
    </div>

_begin;



?>