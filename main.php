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
            <div class="menu-item-active">
                <a href="#">Все</a>
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

<div class="lastadded">
    <div class="la-title">последние добавленные:</div>
    <div class="la-items">
        <?php $result = $mysqli->query("SELECT * FROM `films` ORDER BY id DESC LIMIT 0, 1"); while($row = mysqli_fetch_assoc($result)) { $maxId = $row['id']; };?>
        <?php for ($i = $maxId; $i >= $maxId-7; $i--){?>
        <div class="la-item">
            <?php $result = $mysqli->query("SELECT * FROM `films` WHERE  id='$i'"); while($row = mysqli_fetch_assoc($result)) { $id=$row['id']; };?>
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

                <?php $result = $mysqli->query("SELECT * FROM `films` WHERE  id = '$i'"); while($row = mysqli_fetch_assoc($result)) { $url = $row['image_name']; echo '<div class="item-cover" style="background-image: url(../img/cover/'.$url.')" >';}; ?>
                <?php $result = $mysqli->query("SELECT * FROM `films` WHERE  id = '$i'");
                while($row = mysqli_fetch_assoc($result))
                {
                    if ($row['type']=='мультфильм'){
                        echo '<div class="type-cartoon">' .$row['type']. '</div>';}
                    elseif ($row['type']=='фильм'){
                        echo '<div class="type-movie">' .$row['type']. '</div>';}
                    elseif ($row['type']=='сериал'){
                        echo '<div class="type-show">' .$row['type']. '</div>';}
                };
                ?>
        </div>
        </a>
        <div class="item-description">
            <div class="item-status"></div>
            <div class="item-title"><?php $result = $mysqli->query("SELECT * FROM `films` WHERE  id = '$i'"); while($row = mysqli_fetch_assoc($result)) {echo $row['film'];}; ?></div>
            <div class="item-info">
                <div class="item-year"><?php $result = $mysqli->query("SELECT * FROM `films` WHERE  id = '$i'"); while($row = mysqli_fetch_assoc($result)) {echo $row['year'];}; ?>,</div>
                <div class="item-genre"><?php $result = $mysqli->query("SELECT * FROM `films` WHERE  id = '$i'"); while($row = mysqli_fetch_assoc($result)) {echo $row['genre'];}; ?></div>
            </div>
        </div>
    </div>
    <?php };?>
    </div>
</div>

<! --/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div class="watchlist">
    <div class="wl-title">
        можно посмотреть:<br><span>случайная подборка</span>
    </div>
    <?php $result = $mysqli->query("SELECT * FROM `films` ORDER BY id DESC LIMIT 0, 1"); while($row = mysqli_fetch_assoc($result)) { $maxId2 = $row['id']; };?>
    <?php $randview = rand($maxId2-7, $maxId2);?>

    <div class="big-items">
        <div class="big-item">
            <?php $result = $mysqli->query("SELECT * FROM `films` WHERE  id='$randview'"); while($row = mysqli_fetch_assoc($result)) { $url = $row['image_name']; echo '<div class="big-item-cover" style="background-image: url(../img/cover/'.$url.')" >';}; ?>

            <?php $result = $mysqli->query("SELECT * FROM `films` WHERE  id='$randview'");
                while($row = mysqli_fetch_assoc($result))
                {
                    if ($row['type']=='мультфильм'){
                        echo '<div class="big-type-cartoon">' .$row['type']. '</div>';}
                    elseif ($row['type']=='фильм'){
                        echo '<div class="big-type-movie">' .$row['type']. '</div>';}
                    elseif ($row['type']=='сериал'){
                        echo '<div class="big-type-show">' .$row['type']. '</div>';}
                };
                ?>
                <div class="btn-watch"></div>
            </div>
            <div class="big-item-info">
                <div class="big-item-title"><?php $result = $mysqli->query("SELECT * FROM `films` WHERE  id='$randview'"); while($row = mysqli_fetch_assoc($result)) {echo $row['film'];}; ?></div>
                <div class="big-item-details">
                    <div class="detail">
                        <div class="dt-title">Год:</div>
                        <div class="year"><?php $result = $mysqli->query("SELECT * FROM `films` WHERE  id='$randview'"); while($row = mysqli_fetch_assoc($result)) {echo $row['year'];}; ?></div>
                    </div>
                    <div class="detail">
                        <div class="dt-title">Страна:</div>
                        <div class="country"><?php $result = $mysqli->query("SELECT * FROM `films` WHERE  id='$randview'"); while($row = mysqli_fetch_assoc($result)) {echo $row['country'];}; ?></div>
                    </div>
                    <div class="detail">
                        <div class="dt-title">Время:</div>
                        <div class="time"><?php $result = $mysqli->query("SELECT * FROM `films` WHERE  id='$randview'"); while($row = mysqli_fetch_assoc($result)) {echo $row['time'];}; ?></div>
                    </div>
                    <div class="big-item-description">
                        <?php $result = $mysqli->query("SELECT * FROM `films` WHERE  id='$randview'"); while($row = mysqli_fetch_assoc($result)) {echo $row['description'];}; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php $result = $mysqli->query("SELECT * FROM `films` ORDER BY id DESC LIMIT 0, 1"); while($row = mysqli_fetch_assoc($result)) { $maxId2 = $row['id']; };?>
    <?php $randview2 = rand($maxId2-7, $maxId2); if ($randview2==$randview && $randview2!==8){ $randview2= $randview2+1;} else if ($randview2==$randview && $randview2==8){$randview2= $randview2-1;}?>
        <div class="big-item">
            <?php $result = $mysqli->query("SELECT * FROM `films` WHERE  id='$randview2'"); while($row = mysqli_fetch_assoc($result)) { $url = $row['image_name']; echo '<div class="big-item-cover" style="background-image: url(../img/cover/'.$url.')" >';}; ?>

            <?php $result = $mysqli->query("SELECT * FROM `films` WHERE  id='$randview2'");
                while($row = mysqli_fetch_assoc($result))
                {
                    if ($row['type']=='мультфильм'){
                        echo '<div class="big-type-cartoon">' .$row['type']. '</div>';}
                    elseif ($row['type']=='фильм'){
                        echo '<div class="big-type-movie">' .$row['type']. '</div>';}
                    elseif ($row['type']=='сериал'){
                        echo '<div class="big-type-show">' .$row['type']. '</div>';}
                    };
                    ?>
                <div class="btn-watch"></div>
            </div>
            <div class="big-item-info">
                <div class="big-item-title"><?php $result = $mysqli->query("SELECT * FROM `films` WHERE  id='$randview2'"); while($row = mysqli_fetch_assoc($result)) {echo $row['film'];}; ?></div>
                <div class="big-item-details">
                    <div class="detail">
                        <div class="dt-title">Год:</div>
                        <div class="year"><?php $result = $mysqli->query("SELECT * FROM `films` WHERE  id='$randview2'"); while($row = mysqli_fetch_assoc($result)) {echo $row['year'];}; ?></div>
                    </div>
                    <div class="detail">
                        <div class="dt-title">Страна:</div>
                        <div class="country"><?php $result = $mysqli->query("SELECT * FROM `films` WHERE  id='$randview2'"); while($row = mysqli_fetch_assoc($result)) {echo $row['country'];}; ?></div>
                    </div>
                    <div class="detail">
                        <div class="dt-title">Время:</div>
                        <div class="time"><?php $result = $mysqli->query("SELECT * FROM `films` WHERE  id='$randview2'"); while($row = mysqli_fetch_assoc($result)) {echo $row['time'];}; ?></div>
                    </div>
                    <div class="big-item-description">
                        <?php $result = $mysqli->query("SELECT * FROM `films` WHERE  id='$randview2'"); while($row = mysqli_fetch_assoc($result)) {echo $row['description'];}; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>