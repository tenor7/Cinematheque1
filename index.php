<html>
<?php
require "db.php";
$data= $_POST;

if (isset($data['do_login'])){
    $user = R::findOne('users', 'login = ?', array($data['login']));
    if ($user){
        if (password_verify($data['password'], $user->password)){
            $_SESSION['logged_user']= $user;
            header('Location: /main.php');
        }else{
            $message = "Неверный пароль";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }else{
        $message = "Пользователь с таким логином не найден";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
}
?>

<head>
    <meta charset="utf-8">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>Мувери</title>
</head>
<body>
<div class="columnwrap">
    <form action="index.php" method="post">
    <div class="loginform">
        <div class="loginwrap">
            <div class="logo"><img src="img/logo.svg" alt="Логотип"> </div>
            <div class="logininputs">
                <input class="logininput" type="text" name="login" placeholder="Логин" autocomplete="off" value="<?php echo @$data['login']; ?>">
                <input class="logininput" type="password" name="password" placeholder="Пароль" autocomplete="off" value="<?php echo @$data['password']; ?>">
            </div>
            <input class="btn-login" type="submit" value="Войти" name="do_login">
            <div class="register">Еще нет аккаунта? <a href="/register.php" >Зарегистрироваться</a></div>
        </div>
    </div>
    </form>
</div>
</body>
</html>