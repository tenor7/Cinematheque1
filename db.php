<?php
require "libs/rb.php";
R::setup( 'mysql:host=localhost;dbname=mediatec',
    'root','' );
$db_host='localhost'; // ваш хост
$db_name='mediatec'; // ваша бд
$db_user='root'; // пользователь бд
$db_pass=''; // пароль к бд
session_start();?>