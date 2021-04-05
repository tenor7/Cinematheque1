<?php
require "db.php";

$data= $_POST;
if (isset($data['do_signup'])){
    if (trim($data['login'])==''){
        $errors[]='Введите логин';
        $message = "Введите логин";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
    if ($data['password']==''){
        $errors[]='Введите пароль';
        $message = "Введите пароль";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
    if ($data['password_2']==''){
        $errors[]='Введите пароль';
        $message = "Введите повторный пароль";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
    if ($data['password_2']!= $data['password']){
        $errors[]='Повторный пароль введен неверно';
        $message = "Повторный пароль введен неверно";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
    if (R::count('users', "login = ? ", array($data['login'])) >0 ){ //проверка существования акк
        $errors[]='Пользователь с таким логином уже существует';
        $message = "Пользователь с таким логином уже существует";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }

    if (empty($errors)){
        $user = R::dispense('users');
        $user->login = $data['login'];
        $user->password = password_hash($data['password'], PASSWORD_DEFAULT); //шифрование
        R::store($user);
        $_SESSION['logged_user']= $user;
        header('Location: /index.php');
    }
}
?>
<html>
<head>
    <meta charset="utf-8">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>Мувери</title>
</head>    
<body>

<div class="columnwrap">
    <form action="register.php" method="post">
        <div class="loginform">
            <div class="loginwrap">
                <div class="logo"><img src="img/logo.svg" alt="Логотип"> </div>
                <div class="logininputs">
                    <input class="logininput" type="text" name="login" placeholder="Логин" autocomplete="off" value="<?php echo @$data['login']; ?>">
                    <input class="logininput" type="password" name="password" placeholder="Пароль" autocomplete="off" value="<?php echo @$data['password']; ?>">
                    <input class="logininput" type="password" name="password_2" placeholder="Повторите пароль" autocomplete="off" value="<?php echo @$data['password_2']; ?>">
                </div>
                <input class="btn-login" type="submit" value="Регистрация" name="do_signup">
                <div class="register">Уже есть аккаунт? <a href="index.php" >Войти</a></div>
            </div>
        </div>
    </form>
</div>
</body>

</html>