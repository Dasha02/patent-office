

<?php // Example 05: signup.php
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


  $error = $uname = $upsw = "";
  if (isset($_SESSION['uname'])) destroySession();

  if (isset($_POST['uname']))
  {
    $uname02 = $email02 = $utel02  = $ureg02  = $upsw021 = $upsw022 = $urole02 = "";
    $uname02 = sanitizeString($_POST['uname']);
    $email02 = sanitizeString($_POST['email02']);
    $utel02  = sanitizeString($_POST['tel']);
    $ureg02  = sanitizeString($_POST['reg']);
    $upsw021 = sanitizeString($_POST['psw021']);
    $upsw022 = sanitizeString($_POST['psw022']);
    $urole02 = "4";

    

    $result = $pdo->query("SELECT * FROM users WHERE user_mail='$email02'");

    if ($result->rowCount()) // проверка на повтор почты
    {
      $error = 'Пользователь с таким логином (email) уже зарегистрован в системе';
    }  
    else 
    {
      if ($upsw021 === $upsw022) // проверка паролей - тождественность
      {      
        $upsw = password_hash ($upsw021, PASSWORD_DEFAULT);
        $result = $pdo->query("INSERT INTO users VALUES 
        (NULL, '$urole02','$uname02', '$email02','$utel02', '$ureg02', '$upsw')");
        echo "<h3>Регистрация завершина успешно!<br>Пожалуйста авторизуйтесь</h3>
        <script>
            alert('Регистрация завершина успешно!Пожалуйста авторизуйтесь');
            window.onload = function()
            {
              var element = document.getElementById('id02');
              element.style.display='none';
            }
        </script>";
        //header("Location: index1.php");
      }
      else
      {
        $error = 'Подтверждение пароля не совпало с паролем в форме регистрации!';
      }  
    }
  }



  if ($error!="")
  {
    echo<<<_error
    <div class="header">
    <h3 align="center"> При регистрации выявлена следущая ошибка:</h3>
    <h3 align="center"> "$error"</h3>
    <h3 align="center"> Повторите ввод данных в регистрационную форму</h3>
    </div>
  
    _error;
  } 


echo<<<_END
<script>
function validate(form)
{
    fail  = ""
    fail  = validatePsw(form.psw021.value)
    fail += validatePsw(form.psw022.value)
    fail += validateComparePsw(form.psw021.value, form.psw022.value)

    if (fail == "") 
        return true
    else
    {
        alert(fail); return false
    } 
}

function validatePsw(field)
{
    if (field == "") return "Не введен пароль.\\n"
    else if (filed.lenght < 6) 
            return "В пароле должно быть не менее 6 символов.\\n"
         else if (!/[a-z]/.test(field) || !/[A-Z]/.test(field) || !/[0-9]/.test(field))
                return "В пароле должны входить как минимум по одномй сиволу из каждого набора: a-z, A_Z, 0-9.\\n"
    return ""
}

function validateComparePsw(field1, field2)
{
    if (field1.value === field2.value) return ""
    else return "Подтверждение пароля не совпадет с паролем - обе версии пароля должны быть идентичными"
}



</script>






<div class="row">
 



    <div id="id02">
  
      <form method="post" action="signup02.php?r=$randstr" onSubmit="return validate(this)">
  
       <div class="container">
          <h2>   Форма регистрации</h2>
          <label for="uname"><b>ФИО</b></label>
          <input type="text" placeholder="Введите фамилию и имя" name="uname" required> 

          <label for="email02"><b>E-mail = логин</b></label>
          <input type="email" placeholder="Введите адрес почтового ящика E-mail" name="email02" required>

          <label for="tel"><b>Номер телефона</b></label>
          
          <input type="text" placeholder="Введите номер телефона в формате (XXX) XXX-XX-XX" pattern="\(\d{3}\) \d{3}-\d{2}-\d{2}" name="tel" required>

          <label for="reg"><b>Адрес регистрации</b></label>
          <input type="text" placeholder="Введите адрес регистрации" name="reg" required>

          <label for="psw021"><b>Пароль</b></label>
          <input type="password" placeholder="Введите пароль" name="psw021" required>

          <label for="psw022"><b>Подтвердите пароль</b></label>
          <input type="password" placeholder="Введите пароль еще раз" name="psw022" required>
     
          <button id="but" type="submit"  >Регистрация</button>
      
        </div>

        <div class="container" style="background-color:#f1f1f1">
          <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Отмена</button>
        </div>
      </form>
    </div>

    
</div>



<div class="footer">
_END;
  require_once 'footer02.php';
  echo <<< _END
  
</div>

</body>
</html>
_END;


?>
