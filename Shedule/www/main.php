    
    <?php
    session_start();
    if(!isset($_SESSION['Password'])){
        header("Location: ./index.php");
    }
// Параметры для подключения
    $host = 'localhost';
    $database = 'shedule';
    $user = $_SESSION['Role'];
    $password = $_SESSION['Password'];
// Соединяемся, выбираем базу данных
    $link = mysqli_connect($host, $user, $password, $database) 
        or die("Ошибка " . mysqli_error($link));
    mysqli_query($link,'use '.$database)or die("Ошибка " . mysqli_error($link));
    
// Переменные с формы
    $Naud=$_POST['Naud'];

if (isset($_POST['Naud'])){
    $query = 'INSERT INTO `auditory` (`idA`, `Naud`) VALUES (NULL, "'.$_POST["Naud"].'")';
    $result = mysqli_query($link, $query)or die("Ошибка " . mysqli_error($link));
    if ($result == true){
    	echo "Информация занесена в базу данных";
    }else{
    	echo "Информация не занесена в базу данных";
    }
    header("Location: ./main.php");
}
if (isset($_POST['CodeS']) && isset($_POST['NameS']) ){
    $query = 'INSERT INTO `specialization` (`idC`, `Code`, `Name`) VALUES (NULL, "'.$_POST["CodeS"].'", "'.$_POST["NameS"].'")';
    $result = mysqli_query($link, $query)or die("Ошибка " . mysqli_error($link));
    if ($result == true){
    	echo "Информация занесена в базу данных";
    }else{
    	echo "Информация не занесена в базу данных";
    }
    header("Location: ./main.php");
}
if (isset($_POST['NameK'])){
    $query = 'INSERT INTO `faculty` (`idK`, `Name`) VALUES (NULL, "'.$_POST["NameK"].'")';
    $result = mysqli_query($link, $query)or die("Ошибка " . mysqli_error($link));
    if ($result == true){
    	echo "Информация занесена в базу данных";
    }else{
    	echo "Информация не занесена в базу данных";
    }
    header("Location: ./main.php");
}
if (isset($_POST['CodeG']) && isset($_POST['spec']) ){
    $query = 'INSERT INTO `groups` (`idG`, `Name`, `idC`) VALUES (NULL, "'.$_POST['CodeG'].'", "'.$_POST['spec'].'");';
    $result = mysqli_query($link, $query)or die("Ошибка " . mysqli_error($link));
    if ($result == true){
    	echo "Информация занесена в базу данных";
    }else{
    	echo "Информация не занесена в базу данных";
    }
    header("Location: ./main.php");
}
if (isset($_POST['NameD'])){
    $query = 'INSERT INTO `lessons` (`idD`, `Name`) VALUES (NULL, "'.$_POST["NameD"].'")';
    $result = mysqli_query($link, $query)or die("Ошибка " . mysqli_error($link));
    if ($result == true){
    	echo "Информация занесена в базу данных";
    }else{
    	echo "Информация не занесена в базу данных";
    }
    header("Location: ./main.php");
}
if (isset($_POST['NameP']) && isset($_POST['kaf']) ){
    $query = 'INSERT INTO `teachers` (`idP`, `Name`, `idK`) VALUES (NULL, "'.$_POST['NameP'].'", "'.$_POST['kaf'].'");';
    $result = mysqli_query($link, $query)or die("Ошибка " . mysqli_error($link));
    if ($result == true){
    	echo "Информация занесена в базу данных";
    }else{
    	echo "Информация не занесена в базу данных";
    }
    header("Location: ./main.php");
}
if (isset($_POST['nump']) && isset($_POST['lesson']) && isset($_POST['prep']) && isset($_POST['group']) && isset($_POST['aud'])){
    $query = 'INSERT INTO `shedule` (`Num`, `idP`, `idA`, `idG`, `idD`) VALUES ("'.$_POST['nump'].'", "'.$_POST['prep'].'", "'.$_POST['aud'].'", "'.$_POST['group'].'", "'.$_POST['lesson'].'")';
    $result = mysqli_query($link, $query)or die("Ошибка " . mysqli_error($link));
    if ($result == true){
    	echo "Информация занесена в базу данных";
    }else{
    	echo "Информация не занесена в базу данных";
    }
    header("Location: ./main.php");
}
if (isset($_POST['delA'])){
    echo $_POST["delA"];
    $query = 'DELETE FROM `auditory` WHERE `auditory`.`idA` = '.$_POST["delA"].'';
    $result = mysqli_query($link, $query)or die("Ошибка " . mysqli_error($link));
    if ($result == true){
    	echo "Информация удалена в базу данных";
    }else{
    	echo "Информация не удалена в базу данных";
    }
    header("Location: ./main.php");
}
    function section1($link, $user) {
        $lesson = mysqli_query($link, "SELECT * from lessons")or die("Ошибка " . mysqli_error($link));
        $prep = mysqli_query($link, "SELECT * from teachers")or die("Ошибка " . mysqli_error($link));
        $group = mysqli_query($link, "SELECT * from groups")or die("Ошибка " . mysqli_error($link));
        $aud = mysqli_query($link, "SELECT * from auditory")or die("Ошибка " . mysqli_error($link));
            $retString = '<form action="./main.php" method="post" id="data">
                                <p> Номер пары </p>
                                <p><select name="nump" required>
                                 <option></option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                  <option value="6">6</option>
                                 </select></p>
                          <p> Предмет </p>
                        <p><select name="lesson" required>
                         <option></option>';
                            while($object = mysqli_fetch_object($lesson)){
                            $retString .= "<option value = '$object->idD' > $object->Name </option>";
                            }
                         $retString .= '</select></p>
                        <p> Преподаватель </p>
                        <p><select name="prep" required>
                         <option></option>';
                            while($object = mysqli_fetch_object($prep)){
                            $retString .= "<option value = '$object->idP' > $object->Name </option>";
                            }
                         $retString .= '</select></p>
                        <p> Группа </p>
                        <p><select name="group" required>
                         <option></option>';
                            while($object = mysqli_fetch_object($group)){
                            $retString .= "<option value = '$object->idG' > $object->Name </option>";
                            }
                         $retString .= '</select></p>
                        <p> Аудитория </p>
                        <p><select name="aud" required>
                         <option></option>';
                            while($object = mysqli_fetch_object($aud)){
                            $retString .= "<option value = '$object->idA' > $object->Naud </option>";
                            }
                         $retString .= '</select></p>
                    <input class="sendButton" type="submit" value="Добавить" >
                    </form>';
                    return $retString;
        }      
    function section2($link, $user) {
        $sql = "SELECT idK, Name FROM `faculty`";
            $result = mysqli_query($link, $sql)or die("Ошибка " . mysqli_error($link));
            $retString = '<form action="./main.php" method="post" id="data">
                        <p> ФИО </p>
                        <input class="inputText" name="NameP" type="text" placeholder="Введите ФИО преподавателя">
                        <p> Название кафедры </p>
                        <p><select name="kaf" required>
                         <option></option>';
            while($object = mysqli_fetch_object($result)){
                            $retString .= "<option value = '$object->idK' > $object->Name </option>";
                            }
                         $retString .= '</select></p>
                     <input class="sendButton" type="submit" value="Добавить" >
                    </form>';
                    return $retString;
        }
    function section3($user) {
            return '<form action="./main.php" method="post" id="data">
                        <p> Название предмета </p>
                        <input class="inputText" name="NameD" type="text" placeholder="Введите название предмета">
                        <input class="sendButton" type="submit" value="Добавить" >
                    </form>';
        }
    function section4($link, $user) {
            $sql = "SELECT idC, Name FROM `specialization`";
            $result = mysqli_query($link, $sql)or die("Ошибка " . mysqli_error($link));
            $retString = '<form action="./main.php" method="post" id="data">
                        <p> Шифр группы </p>
                        <input class="inputText" name="CodeG" type="text" placeholder="Введите шифр группы">
                        <p> Название специальности </p>
                        <p><select name="spec" required>
                         <option></option>';
        
            while($object = mysqli_fetch_object($result)){
                            $retString .= "<option value = '$object->idC' > $object->Name </option>";
                            }
    
                         $retString .= '</select></p>
                     <input class="sendButton" type="submit" value="Добавить" >
                    </form>';
                    return $retString;
        }
    function section5($user) {
            return '<form action="./main.php" method="post" id="data">
                        <p> Название кафедры </p>
                        <input class="inputText" name="NameK" type="text" placeholder="Введите название кафедры">
                        <input class="sendButton" type="submit" value="Добавить" >
                    </form>';
        }
    function section6($user) {
            return '<form action="./main.php" method="post" id="data">
                        <p> Шифр специальности </p>
                        <input class="inputText" name="CodeS" type="text" placeholder="Введите шифр">
                        <p> Название специальности </p>
                        <input class="inputText" name="NameS" type="text" placeholder="Введите название специальности">

                     <input class="sendButton" type="submit" value="Добавить" >
                    </form>';
        }
    function section7($user) {
            return '<form action="./main.php" method="post" id="data">
                        <p padding="4px"> Номер аудитории </p>
                        <input class="inputText" name="Naud" type="text" placeholder="Введите номер аудитории">
                     <input class="sendButton" type="submit" value="Добавить">
                    
                    </form>';
        }
     
    ?>
<html>
<head>
<title>
    Shedule
</title>
<link rel="stylesheet" type="text/css" href="./css/css.css"/>
</head>
<body>

  <!-- Верхнее меню -->
   <div class="topnav">
          <a class="active" href="#home">Home</a>
          <a href="#news">Расписание</a>
          <a href="#contact">Редактор</a>
          <!-- кнопки входа -->
          <a id="login" class="button blue" href="./index.php">
              <i class="fa fa-unlock"></i>
                  <span>Выйти</span>
            </a>
            <?php
            if($_SESSION['Role']=='Admin'){
               echo' <a id="register" class="button purple" href="/register.php">
                  <i class="fa fa-user-plus"></i>
                      <span>Зарегистрировать нового польз-ля</span>
                </a>';
            }  
                ?>
    </div>
<!--
    <div id="menu">
        <ul id="menuItems">
          <li>Критерий 1</li> 
          <li>Критерий 2</li>
          <li>Критерий 3</li>
        </ul>
    </div>
-->
                 
    <div id="content">
        <!-- Левое меню -->
        <div id="container"> 
            <div class="tabs"> 
                <input id="tab1" type="radio" name="tabs" checked> 
                <label for="tab1">Расписание</label> 
                <input id="tab2" type="radio" name="tabs"> 
                <label for="tab2">Преподаватели</label>
                <input id="tab3" type="radio" name="tabs"> 
                <label for="tab3">Предметы</label>
                <input id="tab4" type="radio" name="tabs"> 
                <label for="tab4">Группы</label> 
                <input id="tab5" type="radio" name="tabs"> 
                <label for="tab5">Кафедры</label>
                <input id="tab6" type="radio" name="tabs"> 
                <label for="tab6">Специальности</label>
                <input id="tab7" type="radio" name="tabs"> 
                <label for="tab7">Аудитории</label> 
                <section id="content1"> 
                    <table class="cwdtable" width="100%" cellspacing="0" cellpadding="1" border="1">
                        <tr>
                            <th>Пара</th>
                            <th>Предмет</th>
                            <th>Преподаватель</th>
                            <th>Группа</th>
                            <th>Аудитория</th>
                        </tr>
                    <tbody>
                        <?php
                            $query = "SELECT r.Num, p.Name as prep, a.Naud, g.Name as gruppa, d.Name as lesson FROM shedule as r 
                                        join teachers as p on p.idP=r.idP 
                                        join auditory as a on a.idA=r.idA 
                                        join groups as g on g.idG=r.idG 
                                        join lessons as d on d.idD=r.idD";
                            $result = mysqli_query($link, $query)or die("Ошибка " . mysqli_error($link));
                            while($r = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                echo "<tr>";
                                    echo "<td>".$r["Num"]."</td><td>".$r["lesson"]."</td><td>".$r["prep"]."</td><td>".$r["gruppa"]."</td><td>".$r["Naud"]."</td>";
                                echo "</tr>";
                            }
                            mysqli_free_result($result);
                        ?>
                    </table>
                    <?php
                        if($_SESSION['Role']=='UMU' ||  $_SESSION['Role']=='Admin'){
                            echo section1($link, $user);
                        }
                     ?>
                    
                </section>  
                <section id="content2"> 
                     <table class="cwdtable" cellspacing="0" cellpadding="1" border="1">
                    <tr>
                        <th>ФИО</th>
                        <th>Название кафедры</th>
                    </tr>
                <tbody>
                    <?php
                            $query = "SELECT t.`Name`, f.`Name` as `F` FROM teachers as t join `faculty` as f on t.idK = f.idK";
                            $result = mysqli_query($link, $query)or die("Ошибка " . mysqli_error($link));
                            while($r = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                echo "<tr>";
                                    echo "<td>".$r["Name"]."</td><td>".$r["F"]."</td>";
                                echo "</tr>";
                            }
                            mysqli_free_result($result);
                        ?>
                </table>
                
                    <?php
                    if($_SESSION['Role']=='KAF' ||  $_SESSION['Role']=='Admin'){
                        echo section2($link, $user);
                    }
                     ?>
                </section>
                <section id="content3"> 
                    <table class="cwdtable" cellspacing="0" cellpadding="1" border="1">
                    <tr>
                        <th>Название предмета</th>
                    </tr>
                    <tbody>
                       <?php
                            $query = "SELECT * FROM `lessons`";
                            $result = mysqli_query($link, $query)or die("Ошибка " . mysqli_error($link));
                            while($r = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                echo "<tr>";
                                    echo "<td>".$r["Name"]."</td>";
                                echo "</tr>";
                            }
                            mysqli_free_result($result);
                        ?>
                    </table>
                    
                    <?php 
                    if($_SESSION['Role']=='Admin'){
                        echo section3($user);
                    } ?>
                </section> 
                <section id="content4"> 
                    <table class="cwdtable" cellspacing="0" cellpadding="1" border="1">
                     <col width="150">
                    <tr>
                        <th id="thGroup">Шифр группы</th>
                        <th>Название специальности</th>
                    </tr>
                    <tbody>
                        <?php
                            $query = "SELECT t.`Name`, s.`Name` as S FROM groups as t join `specialization` as s on t.idC = s.idC";
                            $result = mysqli_query($link, $query)or die("Ошибка " . mysqli_error($link));
                            while($r = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                echo "<tr>";
                                    echo "<td>".$r["Name"]."</td><td>".$r["S"]."</td>";
                                echo "</tr>";
                            }
                            mysqli_free_result($result);
                        ?>
                    </table>
                    <?php 
                    if($_SESSION['Role']=='Admin'){
                        echo section4($link, $user);
                    } ?>
                </section> 
                <section id="content5"> 
                    <table class="cwdtable" cellspacing="0" cellpadding="1" border="1">
                    <tr>
                        <th>Название кафедры</th>
                    </tr>
                    <tbody>
                    <?php
                            $query = "SELECT * FROM faculty";
                            $result = mysqli_query($link, $query)or die("Ошибка " . mysqli_error($link));
                        
                            while($r = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                echo "<tr>";
                                    echo "<td>".$r["Name"]."</td>";
                                echo "</tr>";
                            }
                            mysqli_free_result($result);
                        ?>
                    </table>
                    <?php 
                    if($_SESSION['Role']=='Admin'){
                        echo section5($user);
                    } ?>
                </section>  
                <section id="content6"> 
                    <table class="cwdtable" cellspacing="0" cellpadding="1" border="1">
                    <tr>
                        <th>Шифр специальности</th>
                        <th>Название специальности</th>
                    </tr>
                    <tbody>
                    <?php
                            $query = "SELECT * FROM specialization";
                            $result = mysqli_query($link, $query)or die("Ошибка " . mysqli_error($link));
                            while($r = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                echo "<tr>";
                                    echo "<td>".$r["Code"]."</td><td>".$r["Name"]."</td>";
                                echo "</tr>";
                            }
                            mysqli_free_result($result);
                        ?>
                    </table>
                    
                    <?php 
                    if($_SESSION['Role']=='Admin'){
                        echo section6($user);
                    } ?>
                </section>
                <section id="content7"> 
                    <table class="cwdtable" cellspacing="0" cellpadding="1" border="1">
                    <tr>
                        <th>Номер аудитории</th>
                    </tr>
                    <tbody>
                       <?php
                            $query = "SELECT * FROM auditory";
                            $result = mysqli_query($link, $query)or die("Ошибка " . mysqli_error($link));
                        $i=1;
                            while($r = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                echo "<tr>";
                                    echo "<td>".$r["Naud"]."</td>";
                                    if($_SESSION['Role']=='Admin'){
                                        echo '<td class="trashtd">'.'<form action="./main.php" method="post" id="data">
                                            <input type="text" name="delA" value="'.$r['idA'].'">
                                           <input class="delbutton" id="delA'.$i.'" type="submit"> <label class="delbutton" for="delA'.$i.'"><img  src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/4273/trashcan.svg" alt="удалить"></label>  </form>'."</td>";
                                    }
                                echo "</tr>";
                                $i++;
                            }
                            mysqli_free_result($result);
                        
                        ?>
                    </table>
                    <?php 
                    if($_SESSION['Role']=='Admin'){
                        echo section7($user);
                    } ?>
                </section> 
            </div> 
        </div>
            
    </div>
    
    <span></span>
</body>
</html>
<!--
                        <p><select name="lesson" required>
                         <option></option>
                          <option value="1">МАТАН</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                         </select></p>
-->
            <?php>

             // Освобождаем память от результата
                    mysqli_free_result($result);

                    // Закрываем соединение
                    mysqli_close($link);
            ?>