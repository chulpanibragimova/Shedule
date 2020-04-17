<?php
session_abort();
if(isset($_POST["login"])){
  session_start();
// Параметры для подключения
    $host = 'localhost';
    $database = 'shedule';
    $user = 'Visitor';
    $password = '123';
// Соединяемся, выбираем базу данных
    $link = mysqli_connect($host, $user, $password, $database) 
        or die("Ошибка " . mysqli_error($link));
    mysqli_query($link,'use '.$database)or die("Ошибка " . mysqli_error($link));

$query = 'SELECT Role FROM `users` WHERE `Login` = "'.$_POST["login"].'" and `Password` = "'.$_POST["password"].'"';
$result = mysqli_query($link, $query)or die("Ошибка " . mysqli_error($link));
$res = mysqli_fetch_object($result);
if ($res == NULL){
        header("Location: ./");
    }else{
    	$_SESSION['Role']=$res->Role;
        switch($_SESSION['Role']){
            case 'Admin': $_SESSION['Password']='adminadmin';
                break;
            case 'UMU': $_SESSION['Password']='umuumu';
                break;
            case 'KAF': $_SESSION['Password']='kafkaf';
                break;
        }
            header("Location: ./main.php");
    }
}
?>
<html>
<head>
   <title>
            Вход
    </title>
        <link rel="stylesheet" type="text/css" href="./css/registerStyle.css"/> 
</head>
    <body>
     
        <form class="block" action="" method="post">
          <div class="container">
            <h1>Вход в систему</h1>
            <p>Заполните формы</p>
            <hr>

            <label for="Login"><b>Login</b></label>
            <input class="" name="login" type="text" placeholder="Логин" required>

            <label for="psw"><b>Password</b></label>
            <input class="" name="password" type="password" placeholder="Пароль" required>
            <hr>
            <input class="sendButton" type="submit" value="Войти" >
          </div>
  
        </form>
    </body>
</html>