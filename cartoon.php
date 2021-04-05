<html>
<head>
    <meta charset="utf-8">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>Мувери</title>
</head>

<body>
<?php
require "db.php";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name); // коннект с сервером бд
$mysqli->set_charset("utf8mb4"); // задаем кодировку
?>

<?php
if (isset($_SESSION['logged_user'])){
    $r = $_SESSION['logged_user']->login;
    if ($r != 'admin'){?>
        <style>
            .add-item{
                display: none; !important}
        </style>
    <?php } } ?>

<div class="header">

    <a href="main.php" class="logo-main"></a>

    <div class="top">
        <div class="menu-main">
            <div class="menu-item">
                <a href="main.php">Все</a>
            </div>
            <div class="menu-item">
                <a href="films.php">Фильмы</a>
            </div>
            <div class="menu-item-active">
                <a href="#">Мультфильмы</a>
            </div>
            <div class="menu-item">
                <a href="show.php">Сериалы</a>
            </div>
        </div>
        <div class="search">
            <img class="search-icon" src="img/search.svg">
            <input class="search-input" type="text" name="search" placeholder="Поиск" autocomplete="off">
        </div>
        <div class="top-btns">
            <div class="add-item">
                <img class="plus-icon" src="img/plus.svg">
                <a href="add.php">Добавить</a>
            </div>
            <div class="logout">
                <img class="exit-icon" src="img/exit.svg">
                <a href="logout.php">Выйти</a>
            </div>
        </div>
    </div>
</div>

<! --/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<div class="watchlist">
    <div class="wl-title">
        можно посмотреть:<br><span>из категории мультфильмы</span>
    </div>

    <?php $result = $mysqli->query("SELECT * FROM `films` ORDER BY id DESC LIMIT 0, 1"); while($row = mysqli_fetch_assoc($result)) { $maxId = $row['id'];};?>
    <?php for ($i = $maxId; $i >= $maxId-7; $i--){?>
        <?php $result = $mysqli->query("SELECT * FROM `films` WHERE  id='$i'"); while($row = mysqli_fetch_assoc($result)) { $type= $row['type']; $id=$row['id'];}; if ($type=='мультфильм'){?>

            <div class="big-items-column">
                <div class="big-item-column">

                    <?php if ($id==$maxId){
                        echo '<a href="view1.php">';}
                    elseif ($id==$maxId-1){
                        echo '<a href="view2.php">';}
                    elseif ($id==$maxId-2){
                        echo '<a href="view3.php">';}
                    elseif ($id==$maxId-3){
                        echo '<a href="view4.php">';}
                    elseif ($id==$maxId-4){
                        echo '<a href="view5.php">';}
                    elseif ($id==$maxId-5){
                        echo '<a href="view6.php">';}
                    elseif ($id==$maxId-6){
                        echo '<a href="view7.php">';}
                    elseif ($id==$maxId-7){
                        echo '<a href="view8.php">';};?>


                    <?php $result = $mysqli->query("SELECT * FROM `films` WHERE  id='$i'"); while($row = mysqli_fetch_assoc($result)) { $url = $row['image_name']; echo '<div class="big-item-cover" style="background-image: url(../img/cover/'.$url.')" >';}; ?>

                    <div class="big-type-cartoon">мультфильм</div>
                    <div class="btn-watch"></div>
                </div>
                </a>
                <div class="big-item-info">
                    <div class="big-item-title"><?php $result = $mysqli->query("SELECT * FROM `films` WHERE  id='$i'"); while($row = mysqli_fetch_assoc($result)) {echo $row['film'];}; ?></div>
                    <div class="big-item-details">
                        <div class="detail">
                            <div class="dt-title">Год:</div>
                            <div class="year"><?php $result = $mysqli->query("SELECT * FROM `films` WHERE  id='$i'"); while($row = mysqli_fetch_assoc($result)) {echo $row['year'];}; ?></div>
                        </div>
                        <div class="detail">
                            <div class="dt-title">Страна:</div>
                            <div class="country"><?php $result = $mysqli->query("SELECT * FROM `films` WHERE  id='$i'"); while($row = mysqli_fetch_assoc($result)) {echo $row['country'];}; ?></div>
                        </div>
                        <div class="detail">
                            <div class="dt-title">Время:</div>
                            <div class="time"><?php $result = $mysqli->query("SELECT * FROM `films` WHERE  id='$i'"); while($row = mysqli_fetch_assoc($result)) {echo $row['time'];}; ?></div>
                        </div>
                        <div class="big-item-description">
                            <?php $result = $mysqli->query("SELECT * FROM `films` WHERE  id='$i'"); while($row = mysqli_fetch_assoc($result)) {echo $row['description'];}; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php };?>
    <?php };?>

</body>
</html>