<html>
<head>
    <meta charset="utf-8">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>Мувери</title>
</head>

<body>
<script src="/js/jquery-3.5.1.js"></script>
<?php
require "db.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name); // коннект с сервером бд
$mysqli->set_charset("utf8mb4"); // задаем кодировку
?>

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
                <div class="menu-item">
                    <a href="cartoon.php">Мультфильмы</a>
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
                <div class="logout">
                    <img class="exit-icon" src="img/exit.svg">
                    <a href="logout.php">Выйти</a>
                </div>
            </div>
        </div>
    </div>
<?php $result = $mysqli->query("SELECT * FROM `films` ORDER BY id DESC LIMIT 0, 1"); while($row = mysqli_fetch_assoc($result)) { $maxId = $row['id']-1; };?>
<div class="viewwrap">
    <div class="big-item-view">
        <?php $result = $mysqli->query("SELECT * FROM `films` WHERE  id = '$maxId'"); while($row = mysqli_fetch_assoc($result)) { $url = $row['image_name']; echo '<div class="big-item-cover-view" style="background-image: url(../img/cover/'.$url.')" >';}; ?>
            <div class="big-type-show-view">
                сериал
            </div>
        </div>
        <div class="big-item-info-view">
            <div class="big-item-title"><?php $result = $mysqli->query("SELECT * FROM `films` WHERE  id = '$maxId'"); while($row = mysqli_fetch_assoc($result)) {echo $row['film']; $view=$row['film']; }; ?></div>
            <div class="big-item-details-view">
                <div class="detail">
                    <div class="dt-title">Год:</div>
                    <div class="year"><?php $result = $mysqli->query("SELECT * FROM `films` WHERE  id = '$maxId'"); while($row = mysqli_fetch_assoc($result)) {echo $row['year'];}; ?></div>
                </div>
                <div class="detail">
                    <div class="dt-title">Страна:</div>
                    <div class="country"><?php $result = $mysqli->query("SELECT * FROM `films` WHERE  id = '$maxId'"); while($row = mysqli_fetch_assoc($result)) {echo $row['country'];}; ?></div>
                </div>
                <div class="detail">
                    <div class="dt-title">Время:</div>
                    <div class="time"><?php $result = $mysqli->query("SELECT * FROM `films` WHERE  id = '$maxId'"); while($row = mysqli_fetch_assoc($result)) {echo $row['time'];}; ?></div>
                </div>
                <div class="big-item-description">
                    <?php $result = $mysqli->query("SELECT * FROM `films` WHERE  id = '$maxId'"); while($row = mysqli_fetch_assoc($result)) {echo $row['description'];}; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="kinowrap">
<?php echo '<div id="kinoplayertop" data-title="'.$view.'"></div> '?>
</div>
<script src="//kinoplayer.top/top.js"></script>
</body>
</html>