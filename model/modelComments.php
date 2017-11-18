<?php

class modelComments
{
    private static $counter = 0;
    private $db = array();
    public function __construct()
    {
        $this->db['connection'] = Db::dbConnection();
    }
    public function write($head, $content)
    {
        // Записываем коментарий в базу данных
        try {
            $this->db['statement'] = $this->db['connection']->prepare('INSERT INTO users_comments (head, content) VALUES (:head, :content);');
            $this->db['statement']->bindValue(':head', $head, PDO::PARAM_STR);
            $this->db['statement']->bindValue(':content', $content, PDO::PARAM_STR);
            $this->db['statement']->execute();
        } catch( PDoException $error){
            echo "Ошибка: ".$error->getMessage();
        }
        if($this->db['statement']){
            return true;
        }
    }
    public function read()
    {
        // Считываем коментарий из базы данных
        $result = array();
        $this->db['readComments'] = $this->db['connection']->query('SELECT * FROM users_comments LIMIT 10');
        foreach($this->db['readComments'] as $row){
            $result[self::$counter]['id'] = $row['id'];
            $result[self::$counter]['head'] = $row['head'];
            $result[self::$counter]['content'] = $row['content'];
            self::$counter++;
        }
        return $result;
    }
    public function __destruct()
    {
        $this->db = null; // 100% уверенность в закрытии подключения к БД
    }
}