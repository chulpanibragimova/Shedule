<?php

session_start();
if(!isset($_SESSION['Password'])){
        header("Location: ./index.php");
    }
// Параметры для подключения
    $host = 'localhost';
    $database = 'shedule';
    $user = 'Admin';
    $password = 'adminadmin';
// Соединяемся, выбираем базу данных
    $link = mysqli_connect($host, $user, $password, $database) 
        or die("Ошибка " . mysqli_error($link));
    mysqli_query($link,'use '.$database)or die("Ошибка " . mysqli_error($link));


if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['role'])){
    $check = 'SELECT Login FROM `users` WHERE Login = "'.$_POST["login"].'"';
    $checkRes = mysqli_query($link, $check)or die("Ошибка " . mysqli_error($link));
    $Res = mysqli_fetch_object($checkRes);
    if ($Res != NULL){
        $_SESSION['message']= "Пользователь с таким логином уже существует";
        $res = false;
    }else{
        $query = 'INSERT INTO `users` (`idU`,`Login`,`Password`,`Role`) VALUES (NULL, "'.$_POST["login"].'", "'.$_POST["password"].'", "'.$_POST["role"].'")';
        $result = mysqli_query($link, $query)or die("Ошибка " . mysqli_error($link));
        if ($result == true){
                $_SESSION['message']="Информация занесена в базу данных";
            }else {
                $_SESSION['message']= "Информация не занесена в базу данных";
                }
        }
} 
?>
<html>
    <head>
        <title>
            Регистрация
        </title>
        <link rel="stylesheet" type="text/css" href="./css/registerStyle.css"/>
        
    </head>
<body>
<form class="block" action="./register.php" method="post">
  <div class="container">
    <h1>Регистрация нового пользователя</h1>
    <p>Заполните формы</p>
    <hr>
    <label for="role"><b>Role</b></label>
    <div class="styled-select">
        <select name="role" required>
            <option></option>;
            <option value="Admin">Администратор</option>
            <option value="KAF">Сотрудник кафедры</option>
            <option value="UMU">Сотрудник УМУ</option>
        </select>
    </div>
    <label for="email"><b>Login</b></label>
    <input type="text" placeholder="Enter Login" name="login" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
    <hr>
    <input type="submit" class="registerbtn" value="Create an account">
    <p> Вернуться назад  <a href="./main.php" class="previous">‹</a> </p>
   <?php if (isset($_SESSION['message']) && ($result == true)){
                    echo '<div class="success">
                      <p>'.$_SESSION['message'].'</p>
                    </div>';  
                    unset($_SESSION['message']);
                    }
      if (isset($_SESSION['message']) && ($result != true)){
                    echo '<div class="danger">
                          <p>'.$_SESSION['message'].'</p>
                        </div>';  
                    unset($_SESSION['message']);
                    }
    ?>
   
  </div>
  
</form>

</body>
</html>
 