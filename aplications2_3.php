<?php 
$randstr_number_patent = substr(md5(rand()), 0, 17);

    echo <<< _begin
    <link rel='stylesheet' href='styles.css' type='text/css'>
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
    </style>
    
    <div class="row">
      <h2 align="center">Заявки на патент</h2>
    </div>
    <div class="row">
          
    <div class="toph" align="center">
      <a align="center">Список задач по вериификации заявок</a>
    </div>
    _begin;
  
    try
    {
      $pdo->beginTransaction();
      $query1 = "SELECT 
        af.aplication_id, 
        af.date_registration,
        af.name_invention, 
        af.description_invention,
        af.formula_invention,
        af.full_description_invention,
        af.bibliograf_invention,
        af.date_finish,
        af.user_id,
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
      WHERE (af.status_id='1' AND (af.user_verificator_id=$uid OR af.user_verificator_id='1'))";
      $result1 = $pdo->query($query1);
      $pdo->commit(); 
    }
    catch(PDOException $e)
    {
      echo "<br>" . $e->getMessage();
      $pdo->rollBack();
    } 
    
    if ($result1->fetch())
    {
      $result1 = $pdo->query($query1);
      echo "<table style='width:100%; font-size: 14px;'>
            <tr>
            <th style='width:5%'>Номер</th>
            <th style='width:10%'>Дата</th>
            <th style='width:45%'>Наименование изобретения</th>
            <th style='width:10%'>Заявитель</th>
            <th style='width:15%'>Статус</th>
            <th style='width:15%'></th>
            </tr>";  
      $i  = 0;
      $idc = "id";     


      while ($row1 = $result1->fetch())
      {
          $i  = $i + 1;
          $id = $idc.$i; 
          
          $aplication_id              = stripslashes($row1['aplication_id']);
          $status_id                  = stripslashes($row1['status_id']);
          $name_invention             = stripslashes($row1['name_invention']);
          $description_invention      = stripslashes($row1['description_invention']);
          $formula_invention          = stripslashes($row1['formula_invention']);
          $full_description_invention = stripslashes($row1['full_description_invention']);
          $bibliograf_invention       = stripslashes($row1['bibliograf_invention']);
          $date_registration          = stripslashes($row1['date_registration']);
          $date_finish                = stripslashes($row1['date_finish']);
          $user_id                    = stripslashes($row1['user_id']);
    
          $tatus                      = stripslashes($row1['status_aplication']);
    
          $user_name                  = stripslashes($row1['user_name']);
          $user_mail                  = stripslashes($row1['user_mail']);
          $number_tel                 = stripslashes($row1['number_tel']);
                 
          echo "<tr> <td>$aplication_id</td> <td> $date_registration</td> <td>$name_invention</td> <td>$user_name</td> <td>$tatus</td> <td>";

          echo "<form action='aplications2_3_1.php' method='post'>
                <input type='hidden' name='begin_verification' value='true'>";
          echo "<button type='submit'style=\"width:auto;\">Начать верификацию</button>";
          echo "<input type='hidden' name='ap_id' value='$aplication_id'>
                <input type='hidden' name='zanyato' value='$uid'>
                <input type='hidden' name='aplication_id' value='$aplication_id'>
                <input type='hidden' name='date_registration' value='$date_registration'>
                <input type='hidden' name='user_name' value='$user_name'>
                <input type='hidden' name='name_invention' value='$name_invention'>
                <input type='hidden' name='description_invention' style='height:100px' value='$description_invention'>
                <input type='hidden' name='formula_invention' style='height:100px' value='$formula_invention'>
                <input type='hidden' name='full_description_invention' value='$full_description_invention'>
                <input type='hidden' name='bibliograf_invention' value='$bibliograf_invention'>
                </form>";
          echo "</td></tr>";
     }
      echo "</table>";
    }
    else
    {
      echo '<p align="center">Список задач на верификацию заявок пуст!</p>';
    }
    
    
    
    echo <<< _begin2
    <p>  </p>    
    <div class="toph" align="center">
      <a align="center">Список задач по регистрации патентов по заявкам</a>
    </div>


    _begin2;
    
    try
    {
      $query2 = "SELECT 
        af.aplication_id, 
        af.date_registration,
        af.name_invention, 
        af.description_invention,
        af.formula_invention,
        af.full_description_invention,
        af.bibliograf_invention,
        af.date_finish,
        af.user_id,
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
      WHERE (af.status_id='6' AND (af.user_patent_regs_id=$uid OR af.user_patent_regs_id='1'))";
      $result2 = $pdo->query($query2);
    }
    catch(PDOException $e)
    {
      echo "<br>" . $e->getMessage();
    } 
    
    if ($result2->fetch())
    {
      $result12 = $pdo->query($query2);
      echo "<table style='width:100%; font-size: 14px;'>
            <tr>
            <th style='width:5%'>Номер</th>
            <th style='width:10%'>Дата</th>
            <th style='width:45%'>Наименование изобретения</th>
            <th style='width:10%'>Заявитель</th>
            <th style='width:15%'>Статус</th>
            <th style='width:15%'></th>
            </tr>";
      $i  = 0;
      $idc = "idc";     

      while ($row1 = $result12->fetch())
      {
          $i  = $i + 1;
          $id = $idc.$i; 
          
          $aplication_id              = stripslashes($row1['aplication_id']);
          $status_id                  = stripslashes($row1['status_id']);
          $name_invention             = stripslashes($row1['name_invention']);
          $description_invention      = stripslashes($row1['description_invention']);
          $formula_invention          = stripslashes($row1['formula_invention']);
          $full_description_invention = stripslashes($row1['full_description_invention']);
          $bibliograf_invention       = stripslashes($row1['bibliograf_invention']);
          $date_registration          = stripslashes($row1['date_registration']);
          $date_finish                = stripslashes($row1['date_finish']);
          $user_id                    = stripslashes($row1['user_id']);
    
          $tatus                      = stripslashes($row1['status_aplication']);
    
          $user_name                  = stripslashes($row1['user_name']);
          $user_mail                  = stripslashes($row1['user_mail']);
          $number_tel                 = stripslashes($row1['number_tel']);
                 
          echo "<tr> <td>$aplication_id</td> <td> $date_registration</td> <td>$name_invention</td> <td>$user_name</td> <td>$tatus</td> <td>";
          echo "<form action='aplications2_3_2.php' method='post'>
            <input type='hidden' name='begin_registration' value='true'>";
          echo "<button type='submit' style=\"width:auto;\">Начать регистрацию патента</button>";
          echo "<input type='hidden' name='ap_id' value='$aplication_id'>
            <input type='hidden' name='zanyato' value='$uid'>
            <input type='hidden' name='aplication_id' value='$aplication_id'>
            <input type='hidden' name='date_registration' value='$date_registration'>
            <input type='hidden' name='user_name' value='$user_name'>
            <input type='hidden' name='name_invention' value='$name_invention'>
            <input type='hidden' name='description_invention' style='height:100px' value='$description_invention'>
            <input type='hidden' name='formula_invention' style='height:100px' value='$formula_invention'>
            <input type='hidden' name='full_description_invention' value='$full_description_invention'>
            <input type='hidden' name='bibliograf_invention' value='$bibliograf_invention'>
            </form>";
          echo "</td></tr>";
      }
      echo "</table>";
    }  
    else
    {
      echo '<p align="center">Список задач на регистрацию патентов по заявкам пуст!</p>';
    }




  echo <<< _begin3
  <p>  </p>    
  <div class="toph" align="center">
    <a href="#" align="center" onclick="document.getElementById('reestr').style.display='block'">Сводный общий реестр заявок</a>
  </div>
  _begin3;
  try
  {
  $query33 = "SELECT 
      af.aplication_id, 
      af.date_registration,
      af.name_invention, 
      af.description_invention,
      af.formula_invention,
      af.full_description_invention,
      af.bibliograf_invention,
      af.date_finish,
      af.user_id,
      u.user_name, 
      u.user_mail,
      u.number_tel,
      s.status_aplication
  FROM 
      aplication_form af
  JOIN 
      users u ON af.user_id = u.user_id
  JOIN 
      status_ap s ON af.status_id = s.status_id";
  
  
  $result33 = $pdo->query("SELECT 
      af.aplication_id, 
      af.date_registration,
      af.name_invention, 
      af.description_invention,
      af.formula_invention,
      af.full_description_invention,
      af.bibliograf_invention,
      af.date_finish,
      af.user_id,
      u.user_name,
      u.user_mail, 
      u.number_tel, 
      s.status_aplication
    FROM 
      aplication_form af
    JOIN 
      users u ON af.user_id = u.user_id
    JOIN 
      status_ap s ON af.status_id = s.status_id");
  
  
  }
  catch(PDOException $e)
  {
    echo "<br>" . $e->getMessage();
  } 
  
  $i  = 0;
  $idc = "id";   
  
  echo <<< _begin3
  <div id='reestr' class='modal'>
    <div class='container'>
    <h3 align='center'>Сводный реестр заяок</h3>
  _begin3;
  
  echo "<table style='width:100%; font-size: 14px;'>
        <tr>
        <th style='width:5%'>Номер</th>
        <th style='width:10%'>Дата</th>
        <th style='width:45%'>Наименование изобретения</th>
        <th style='width:10%'>Заявитель</th>
        <th style='width:15%'>Статус</th>
        <th style='width:15%'></th>
        </tr>";  
  $i  = 0;
  $idr = "idr";     
  
  while ($row1 = $result33->fetch())
  {
      $i  = $i + 1;
      $id = $idr.$i; 
      
      $aplication_id              = stripslashes($row1['aplication_id']);
      $status_id                  = stripslashes($row1['status_id']);
      $name_invention             = stripslashes($row1['name_invention']);
      $description_invention      = stripslashes($row1['description_invention']);
      $formula_invention          = stripslashes($row1['formula_invention']);
      $full_description_invention = stripslashes($row1['full_description_invention']);
      $bibliograf_invention       = stripslashes($row1['bibliograf_invention']);
      $date_registration          = stripslashes($row1['date_registration']);
      $date_finish                = stripslashes($row1['date_finish']);
      $user_id                    = stripslashes($row1['user_id']);
  
      $tatus                      = stripslashes($row1['status_aplication']);
  
      $user_name                  = stripslashes($row1['user_name']);
      $user_mail                  = stripslashes($row1['user_mail']);
      $number_tel                 = stripslashes($row1['number_tel']);
  
  
      echo "<tr> 
            <td>$aplication_id</td>
            <td> $date_registration</td>
            <td>$name_invention</td>
            <td>$user_name</td>
            <td>$tatus</td>
            <td>";
      echo "<button onclick=\"document.getElementById('$id').style.display='block'\" style=\"width:auto;\">Подробно</button>";
      echo "<div id='$id' class='modal'>
            <div class='container'>
            <form enctype='multipart/form-data' action='aplications2.php' method='post'>
  
            <div class='container'>
              <h3 align='center'>Информация и документы по заявке</h3>
  
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
            
            
              <table>
                <tr>
                  <td width='30%'>
                    <button type='buttion' onclick='document.getElementById(\'$id\').style.display=\'none\'' class='cancelbtn'>Отмена</button>
                  </td><td width='40%'></td><td width='30%'>
                  </td>
                </tr>
              </table>           
            </form>
            </div>
            </div>";
           
      echo "</td>
            </tr>";
  }
  echo "</table>";
  
  echo <<< _begin3
      <table>
        <tr>
          <td width='30%'>
            <button type='buttion' onclick="document.getElementById('reestr').style.display='none'" class='cancelbtn'>Отмена</button>
          </td><td width='40%'></td><td width='30%'></td>
        </tr>
      </table>
    </div>
  </div>
  
  
  
  
  _begin3;
  
  
  
  echo <<<_END
  <div class="footer">
    <h3>Footer</h3>
  </div>
  
  </body>
  </html>
  _END;
  
?>
