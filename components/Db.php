<?php

class Db
{
    public static function dbConnection()
    {
        // Что бы в бройзер не выводилось имя пользователя и пароль для подключения к БД
        try {
            $props = require_once(ROOT . "/config/db_configuration.php");
            $dns = "mysql: host={$props['host']}; dbname={$props['dbname']}";
            $db = new PDO($dns, $props['user'], $props['password']);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->exec('set names utf8');
            return $db;
        } catch (PDOException $err){
            echo "Ошибка: ".$err->getMessage();
        }
    }
}