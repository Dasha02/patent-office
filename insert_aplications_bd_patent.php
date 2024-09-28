

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


/*!40000 ALTER TABLE `aplication_form` DISABLE KEYS */;
//INSERT INTO `aplication_form` VALUES (1,10,1,'Машина времени на пару',
//'Машина, обеспечивающая перемещение человека во времени (как в прошлое, так и в будущее).',
//'Паровой движетель приводит к действию ТС, которое разгоняется до срехзвуковой скорости, после чего перемешается во времени, за счет использования временного механизма. ',
//'Машина, обеспечивающая перемещение человека во времени (как в прошлое, так и в будущее). \r\nСм. приложение.',
//'время \r\nпар\r\nмашина\r\nбудущее',
//'2024-01-06',
//NULL,1,1,1,1),
//$result = $pdo->query("LOCK TABLES aplication_form WRITE");
// 1 заявка
$aplication_id              = NULL;
$user_id                    = sanitizeString("2");
$status_id                  = sanitizeString("1");
$name_invention             = sanitizeString("Машина времени на пару");
$description_invention      = sanitizeString("Машина, обеспечивающая перемещение человека во времени (как в прошлое, так и в будущее).");
$formula_invention          = sanitizeString("Паровой движетель приводит к действию ТС, которое разгоняется до срехзвуковой скорости, после чего перемешается во времени, за счет использования временного механизма.");
$full_description_invention = sanitizeString("Машина, обеспечивающая перемещение человека во времени (как в прошлое, так и в будущее). \r\nСм. приложение.");
$bibliograf_invention       = sanitizeString("время \r\nпар\r\nмашина\r\nбудущее");
$date_registration          = sanitizeString("2024-01-06");
$date_finish                = NULL;
$user_verificator_id        = sanitizeString("1");
$user_expert_plag_id        = sanitizeString("1");
$user_expert_znak_id        = sanitizeString("1");
$user_patent_regs_id        = sanitizeString("1");

$result1 = $pdo->query("SELECT * FROM aplication_form WHERE (user_id='$user_id' AND name_invention='$name_invention')");

if ($row = $result1->fetch())
{
    echo "заявка на изобретение: " . $name_invention . " от пользователя с user_id =" . $user_id . " - уже зарегестрирована <br>";
}
else
{   
    try 
    {
        $result = $pdo->query("INSERT INTO aplication_form VALUES(
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
        '$user_verificator_id',
        '$user_expert_plag_id',
        '$user_expert_znak_id',
        '$user_patent_regs_id')");

        echo "ЗАЯВКА НА ИЗОБРЕТЕНИЕ : " . $name_invention . " от пользователя с user_id =" . $user_id . " - ЗАРЕГЕСТРИРОВАНА <br>";
    }
    catch (PDOException $e)
    {
        echo "<br>" . $e->getMessage();
    }
  
}


//(2,2,1,'Велосипед 2-х колесный',
//'ТС, приводимое в движение мускульной силой человека. ',
//'2 колеса, рама, руль, педаль, цепной механизм',
//'ТС, приводимое в движение мускульной силой человека. Равновесие достигается засчет движения, в состоянии спокойствия - неустойчиво. ',
//'2 колеса\r\nустройство передвижения ',
//'2024-01-07',NULL,1,1,1,1),
// 2 заявка
$aplication_id              = NULL;
$user_id                    = sanitizeString("3");
$status_id                  = sanitizeString("1");
$name_invention             = sanitizeString("Велосипед 2-х колесный");
$description_invention      = sanitizeString("Транспортное средство, приводимое в движение мускульной силой человека. ");
$formula_invention          = sanitizeString("Состав изделия: 2 колеса, рама, руль, педаль, цепной механизм передачи усилия с педалей и превращаюего его во вращательное движение приводного колеса");
$full_description_invention = sanitizeString("Транспортное средство, приводимое в движение мускульной силой человека. Равновесие достигается за счет движения момент инерции вращающихся колес обеспечивают устойчивость транспортного средства, в состоянии покоя - неустойчиво. ");
$bibliograf_invention       = sanitizeString("2 колеса\r\nустройство передвижения ");
$date_registration          = sanitizeString("2024-01-06");
$date_finish                = NULL;
$user_verificator_id        = sanitizeString("1");
$user_expert_plag_id        = sanitizeString("1");
$user_expert_znak_id        = sanitizeString("1");
$user_patent_regs_id        = sanitizeString("1");

$result1 = $pdo->query("SELECT * FROM aplication_form WHERE (user_id='$user_id' AND name_invention='$name_invention')");

if ($row = $result1->fetch())
{
    echo "заявка на изобретение: " . $name_invention . " от пользователя с user_id =" . $user_id . " - уже зарегестрирована <br>";
}
else
{   
    try 
    {
        $result = $pdo->query("INSERT INTO aplication_form VALUES(
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
        '$user_verificator_id',
        '$user_expert_plag_id',
        '$user_expert_znak_id',
        '$user_patent_regs_id')");

        echo "ЗАЯВКА НА ИЗОБРЕТЕНИЕ : " . $name_invention . " от пользователя с user_id =" . $user_id . " - ЗАРЕГЕСТРИРОВАНА <br>";
    }
    catch (PDOException $e)
    {
        echo "<br>" . $e->getMessage();
    }
  
}


//(3,2,1,
//'Сапоги скороходы - гаджет',
//'Инновационное средство передвижения человека, ускоряющее человека - шагом или бегом. ',
//'используется механизм экзоскелета с автономным двигателем для придания необходимого ускорения. ',
//'Инновационное средство передвижения человека, ускоряющее человека - шагом или бегом. \r\nНеобходимый гаджет - хвостово-перьевое оперение для балансировки на поворотах (чтобы не заносило). ',
//'ботинки\r\nрусские народные сказки','2024-01-07'
//,NULL,1,1,1,1),

// 3 заявка
$aplication_id              = NULL;
$user_id                    = sanitizeString("4");
$status_id                  = sanitizeString("1");
$name_invention             = sanitizeString("Сапоги скороходы - высокотехнологичный и иновационный гаджет");
$description_invention      = sanitizeString("Инновационное технологическое присобление, обеспечивающие экномию сил человека при перемещении в пространстве с высокой скорость бегом или шагом. ");
$formula_invention          = sanitizeString("Работает на принципах аналогичных устройствам экзоскелета - разгружая мышечную систему человека и за счет встроенных источников энергии и движительной системы усливающих мускульную силу человека и ускоряющеих передвижение.");
$full_description_invention = sanitizeString("Инновационное высокотехнологичное средство передвижения человека, значительно ускоряее передвижение человека в пространстве - шагом или бегом. Включает в себя автономный источник питания, движительнуюи приводную систему экзоскелета. Работает на принципах аналогичных устройствам экзоскелета - разгружая мышечную систему человека и за счет встроенных источников энергии и движительной системы усливающих мускульную силу человека и ускоряющеих передвижение шагом (за счет удлинения шага) или бегом (как за счет удлинения шага так и за счет повышения частоты шагов). Необходимое дополнение для безопасности  - дополгительный гаджет - хвостово-перьевое оперение для балансировки и выравнивания траектории движения (если просто то это необходимое условие - чтобы на поворотах не заносило и позволяло поврачивать). ");
$bibliograf_invention       = sanitizeString("ботинки, русские народные сказки ");
$date_registration          = sanitizeString("2024-01-07");
$date_finish                = NULL;
$user_verificator_id        = sanitizeString("1");
$user_expert_plag_id        = sanitizeString("1");
$user_expert_znak_id        = sanitizeString("1");
$user_patent_regs_id        = sanitizeString("1");

$result1 = $pdo->query("SELECT * FROM aplication_form WHERE (user_id='$user_id' AND name_invention='$name_invention')");

if ($row = $result1->fetch())
{
    echo "заявка на изобретение: " . $name_invention . " от пользователя с user_id =" . $user_id . " - уже зарегестрирована <br>";
}
else
{   
    try 
    {
        $result = $pdo->query("INSERT INTO aplication_form VALUES(
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
        '$user_verificator_id',
        '$user_expert_plag_id',
        '$user_expert_znak_id',
        '$user_patent_regs_id')");

        echo "ЗАЯВКА НА ИЗОБРЕТЕНИЕ : " . $name_invention . " от пользователя с user_id =" . $user_id . " - ЗАРЕГЕСТРИРОВАНА <br>";
    }
    catch (PDOException $e)
    {
        echo "<br>" . $e->getMessage();
    }
  
}



//(4,2,1,'Ступа',
//'ТС поднимающееся с помощью антигравитационного двигателя. ',
//'Инициатив происходит с помощью 2-х заклинаний:\r\nЗемля прощай. \r\nВ добрый путь. ',
//'ТС поднимающееся с помощью антигравитационного двигателя и магии. ',
//'Баба яга','2024-01-07',NULL,1,1,1,1);
/*!40000 ALTER TABLE `aplication_form` ENABLE KEYS */;
//UNLOCK TABLES;


// 4 заявка
$aplication_id              = NULL;
$user_id                    = sanitizeString("2");
$status_id                  = sanitizeString("1");
$name_invention             = sanitizeString("Транспортное средство перемещающее человека в воздушном пространстве бесшумно");
$description_invention      = sanitizeString("Транспортное средство, позволяющее перемещаться в воздушном пространстве на принципах левитации или антигравитации - аналог Ступы бабы Яги");
$formula_invention          = sanitizeString("Основа изобретения - использования антигравитационного движителя малой мощности для индивидуального перемещения.");
$full_description_invention = sanitizeString("Для перемещения траспортного средства в пространстве (воздушном пространстве) используются принципы работы антигравитационного двигателя малой мощности, инициация антигравитационной движительной ситемы и управления ей производится с помощью заклинаний. ");
$bibliograf_invention       = sanitizeString("русские наордные сказки, чертеж ступы бабы Яги в разрезе.");
$date_registration          = sanitizeString("2024-01-06");
$date_finish                = NULL;
$user_verificator_id        = sanitizeString("1");
$user_expert_plag_id        = sanitizeString("1");
$user_expert_znak_id        = sanitizeString("1");
$user_patent_regs_id        = sanitizeString("1");

$result1 = $pdo->query("SELECT * FROM aplication_form WHERE (user_id='$user_id' AND name_invention='$name_invention')");

if ($row = $result1->fetch())
{
    echo "заявка на изобретение: " . $name_invention . " от пользователя с user_id =" . $user_id . " - уже зарегестрирована <br>";
}
else
{   
    try 
    {
        $result = $pdo->query("INSERT INTO aplication_form VALUES(
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
        '$user_verificator_id',
        '$user_expert_plag_id',
        '$user_expert_znak_id',
        '$user_patent_regs_id')");

        echo "ЗАЯВКА НА ИЗОБРЕТЕНИЕ : " . $name_invention . " от пользователя с user_id =" . $user_id . " - ЗАРЕГЕСТРИРОВАНА <br>";
    }
    catch (PDOException $e)
    {
        echo "<br>" . $e->getMessage();
    }
  
}



// 5 заявка
$aplication_id              = NULL;
$user_id                    = sanitizeString("3");
$status_id                  = sanitizeString("1");
$name_invention             = sanitizeString("Волшебная палочка - как устройство предоставления социальных и бытовых услуг");
$description_invention      = sanitizeString("Волшебная палочка это инновационный высокотехнологичный экспресс сервис заказа и предоставления соотвествующей услуги или доставки желанного объекта (неживого)");
$formula_invention          = sanitizeString("Высокотехнологичный сервис - обеспечивающий интегральное и мулти модальное использование всех сервисов для удовлетворения текущих потребностей человека - в разумных  пределах!");
$full_description_invention = sanitizeString("Волшебная палочка - это носимый технологичный гаджет, который обеспчеивает выполнение желаний в области услуг и получения желанных объектов (из неживой природы) в течение короткого промежутка времени (не более 5 минут); Работает принцип - за ваши деньги любой каприз и мгновенно! ");
$bibliograf_invention       = sanitizeString("русские наордные сказки, советсике фильмы и губозакатывательная машинка");
$date_registration          = sanitizeString("2024-01-06");
$date_finish                = NULL;
$user_verificator_id        = sanitizeString("1");
$user_expert_plag_id        = sanitizeString("1");
$user_expert_znak_id        = sanitizeString("1");
$user_patent_regs_id        = sanitizeString("1");

$result1 = $pdo->query("SELECT * FROM aplication_form WHERE (user_id='$user_id' AND name_invention='$name_invention')");

if ($row = $result1->fetch())
{
    echo "заявка на изобретение: " . $name_invention . " от пользователя с user_id =" . $user_id . " - уже зарегестрирована <br>";
}
else
{   
    try 
    {
        $result = $pdo->query("INSERT INTO aplication_form VALUES(
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
        '$user_verificator_id',
        '$user_expert_plag_id',
        '$user_expert_znak_id',
        '$user_patent_regs_id')");

        echo "ЗАЯВКА НА ИЗОБРЕТЕНИЕ : " . $name_invention . " от пользователя с user_id =" . $user_id . " - ЗАРЕГЕСТРИРОВАНА <br>";
    }
    catch (PDOException $e)
    {
        echo "<br>" . $e->getMessage();
    }
  
}


// 6 заявка
$aplication_id              = NULL;
$user_id                    = sanitizeString("4");
$status_id                  = sanitizeString("1");
$name_invention             = sanitizeString("Траспортное средство для пермещния грузов - паровоз на ядерном топливе");
$description_invention      = sanitizeString("Транспортное средство, двигательная система которого работает на принципах парового движетеля, при этом энергетическа система производства пара обеспечиватеся ядерным реактором.");
$formula_invention          = sanitizeString("Инновационный механизм парообразования на основе нагревательной системы ядерного реактора - обеспечивающий повышение кпд паровоза на 3=5%! ");
$full_description_invention = sanitizeString("Парвовоз ранее сжигал уголь или дрова и сильно дымил, в предлагаемом варианте новое траспортное срество - паровоз на ядерном топливе лищен этого недостатка и посути не производит никаких выбросов углекислого газа и окислов углерода от сжигаемого в топке топлива нек производит. За счет использования ядерного реактора эффективность двигателя паровоза повышается аж на 5-7 %. Управляемая ядерная рееакци, протекающая в реакторе паровоза обеспечивает выделение необходимого тепла, которое отводится за счет охлаждающей жидкости и далее передается в паровую машинй для приведения транспортного средства в движение! Как уже выше описвался принцип работы паровоза на ядерном топливе - ядерный реактор в процессе ядерной реакции выделяет необходимое тепло, которое посредством теплоносителя передается паровой машине, кторая в свою очередь приводит в движение транспортное средство! Все работает! Есть только один недостаток - для безопасности реактора - необхоимо постоянный отвод тепла и для этого паровоз долэен постоянно двигаться  - он не может стоять на месте! Но над этим неосттатком работаем - планируем дополнить его реактивным двигателем для выода на орбиту земли с целью охлаждения реактора в состоянии покоя транспортного средства!");
$bibliograf_invention       = sanitizeString("полная технологическая инновация - аналогов не имеет");
$date_registration          = sanitizeString("2024-01-06");
$date_finish                = NULL;
$user_verificator_id        = sanitizeString("1");
$user_expert_plag_id        = sanitizeString("1");
$user_expert_znak_id        = sanitizeString("1");
$user_patent_regs_id        = sanitizeString("1");

$result1 = $pdo->query("SELECT * FROM aplication_form WHERE (user_id='$user_id' AND name_invention='$name_invention')");

if ($row = $result1->fetch())
{
    echo "заявка на изобретение: " . $name_invention . " от пользователя с user_id =" . $user_id . " - уже зарегестрирована <br>";
}
else
{   
    try 
    {
        $result = $pdo->query("INSERT INTO aplication_form VALUES(
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
        '$user_verificator_id',
        '$user_expert_plag_id',
        '$user_expert_znak_id',
        '$user_patent_regs_id')");

        echo "ЗАЯВКА НА ИЗОБРЕТЕНИЕ : " . $name_invention . " от пользователя с user_id =" . $user_id . " - ЗАРЕГЕСТРИРОВАНА <br>";
    }
    catch (PDOException $e)
    {
        echo "<br>" . $e->getMessage();
    }
  
}


// 7 заявка
$aplication_id              = NULL;
$user_id                    = sanitizeString("2");
$status_id                  = sanitizeString("1");
$name_invention             = sanitizeString("Скатерь самобранка");
$description_invention      = sanitizeString("Скатерь самобранка - инновационный высокотехнологичный сервис по экспрес накрыванию на столна неограниченный круг лиц");
$formula_invention          = sanitizeString("В основу технологичного сервиса скатери самобранкои положено использование искуственного интелекта для проведения предикативного анализа потребностей.");
$full_description_invention = sanitizeString("В основу технологичного сервиса скатери самобранкои положено использование искуственного интелекта для проведения предикативного анализа потребностей субъекта на основе сигналов снимаемых системой дистанционно от желудочного ракта подопечного, а также включение в систему предикативного анализа анлогичных анных от других субъектов его коружающих, после предварительного отбора круга лиц на приглашение к совметной трапезе. Скатерь самобрнака - включает в себя высокотехнологичный сервис с использованием элементов исскуственного интелекта, и обеспчеивает заказ, экспресс доставку и сервис катеринга (накрывания на стол и подачи блюд по очередности потребления) в течение 10 минут с момента высказыания пожелания субъекта или на основе предикативного анализа произведенного системой на инсскуственного интелекта по сигналам желудочного тракта субъекта и его окружения (список соседей формируется наоснове зарегестированных в радиусе 10 метров от субъекта телефонных номеров со смартфонов и далее проводится аналогичный предикативный анализ желудочных трактов на предмет необхоимости кормить и предпочтений в отношении набора блюд желаемых к потреблению)!");
$bibliograf_invention       = sanitizeString("русские наордные сказки, чертеж ступы бабы Яги в разрезе.");
$date_registration          = sanitizeString("2024-01-06");
$date_finish                = NULL;
$user_verificator_id        = sanitizeString("1");
$user_expert_plag_id        = sanitizeString("1");
$user_expert_znak_id        = sanitizeString("1");
$user_patent_regs_id        = sanitizeString("1");

$result1 = $pdo->query("SELECT * FROM aplication_form WHERE (user_id='$user_id' AND name_invention='$name_invention')");

if ($row = $result1->fetch())
{
    echo "заявка на изобретение: " . $name_invention . " от пользователя с user_id =" . $user_id . " - уже зарегестрирована <br>";
}
else
{   
    try 
    {
        $result = $pdo->query("INSERT INTO aplication_form VALUES(
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
        '$user_verificator_id',
        '$user_expert_plag_id',
        '$user_expert_znak_id',
        '$user_patent_regs_id')");

        echo "ЗАЯВКА НА ИЗОБРЕТЕНИЕ : " . $name_invention . " от пользователя с user_id =" . $user_id . " - ЗАРЕГЕСТРИРОВАНА <br>";
    }
    catch (PDOException $e)
    {
        echo "<br>" . $e->getMessage();
    }
  
}








?>
