<?php

class controllerComments
{
    public function actionCommentsList()
    {
        $connect = Db::dbConnection();
        $comments = Db::dbRead($connect);
        $result = array();
        $count = 0;
        while($elt = $comments->fetch()){
            $result[$count]['user'] = $elt['user'];
            $result[$count]['head'] = $elt['head'];
            $result[$count]['content'] = $elt['content'];
        }
        $connect = null; // Закрытие подключения к базе данных
        // Подключить представление и вивести в него значения
        require_once ROOT."/view/CommentsModule.php";
    }
    public function actionWrite($commentHead, $commentContent)
    {
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
            $message = json_decode($_POST['message'], true);
        }
        $connect = Db::dbConnection();
        $query = Db::dbWrite($connect, $commentHead, $commentContent);
        if($query){
            echo "Коментарий сохранен <br/>";
        }
        else {
            echo "Комментарий не сохранет <br/>";
        }
        $connect = null; // Закрытие подключения к базе данных
    }
}