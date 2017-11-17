<?php

class Db
{
    private static $counter = 0;
    public static function dbConnection()
    {
        $props = require_once(ROOT."/config/db_configuration.php");
        $dns = "mysql: host={$props['host']}; dbname={$props['dbname']}";
        $db = new PDO($dns, $props['user'], $props['password']);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->exec('set names utf8');
        return $db;
    }
    public static function dbWrite($db, $commentHead, $commentContent)
    {
        $query = $db->prepare('INSERT INTO users_comments (id, head, content) VALUES (:id, :head, :content)');
        $query->bindParams(':id', self::$counter++, PDO::PARAM_INT);
        $query->bindParams(':head', $commentHead, PDO::PARAM_STR);
        $query->bindParams(':content', $commentContent, PDO::PARAM_STR);
        $result = $query->execute();
        return $result;
    }
    public static function dbRead($db)
    {
        $query = $db->query('SELECT * FROM users_comments'); // Добавить сортировку по датам
        return $query;
    }
}