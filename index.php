<?php
// Устанавливаем общие настройки
ini_set('display_errors', 1);
error_reporting(E_ALL);
define('ROOT',dirname(__FILE__));
// Подключаем БД

// Подключаем нужные файлы
require_once ROOT.'/components/Router.php';
require_once ROOT."/components/Db.php";

// Запускаем роутер
$router = new Router();
$router->run();