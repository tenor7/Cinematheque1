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
$data= $_POST;

if (isset($data['do_add'])){

    $path = "img/cover/".$_FILES["image"]["name"];
    move_uploaded_file($_FILES["image"]["tmp_name"], $path);
    $image_name = $_FILES["image"]["name"];

    $film = $_POST['film'];
    $type = $_POST['type'];
    $year = $_POST['year'];
    $genre = $_POST['genre'];
    $time = $_POST['time'];
    $country = $_POST['country'];
    $description = $_POST['description'];


    $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name); // коннект с сервером бд
    $mysqli->set_charset("utf8"); // задаем кодировку
    $mysqli->query("INSERT INTO `films` ( `id`,`film`,`type`,`year`,`genre`,`time`,`country`,`description`,`image_name`) VALUES ('','$film','$type','$year','$genre','$time','$country','$description','$image_name')");

header('Location: /main.php');
}
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
<div class="addingwrap">
    <form action="add.php" method="POST" enctype="multipart/form-data">
        <div class="addform">
            <div class="addwrap">
                <div class="addinputs">
                    <input class="addinput" type="text" name="film" placeholder="* название" autocomplete="off" value="<?php echo @$data['film']; ?>">
                    <input class="addinput" type="text" name="type" placeholder="* фильм/мультфильм/сериал" autocomplete="off" value="<?php echo @$data['type']; ?>">
                    <input class="addinput" type="text" name="year" placeholder="год" autocomplete="off" value="<?php echo @$data['year']; ?>">
                    <input class="addinput" type="text" name="genre" placeholder="жанр" autocomplete="off" value="<?php echo @$data['genre']; ?>">
                    <input class="addinput" type="text" name="time" placeholder="продолжительность" autocomplete="off" value="<?php echo @$data['time']; ?>">
                    <input class="addinput" type="text" name="country" placeholder="страна" autocomplete="off" value="<?php echo @$data['country']; ?>">
                    <textarea class="adddescription" type="text" name="description" placeholder="описание" autocomplete="off" value="<?php echo @$data['description']; ?>"></textarea>
                    <input class="addinput" type="file" name="image" placeholder="обложка" autocomplete="off">
                </div>
                <input class="btn-adding" type="submit" value="Добавить" name="do_add">
            </div>
        </div>
    </form>
</div>
</body>
</html>