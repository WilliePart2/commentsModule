<?php

require_once(ROOT.'/model/modelComments.php');
class controllerComments
{
    public function actionCommentsList()
    {
        $connect = new modelComments();
        $list = $connect->read();
        // Подключить представление и вивести в него значения
        require_once ROOT."/view/CommentsModule.php";
        if($list){
            $connect = null; // Закрытие подключения к базе данных
            return false;
        }
        else {
            return false; // Коментарии кончились.
        }
    }
    public function actionWrite($commentHead, $commentContent)
    {
        $connect = new modelComments();
        $query = $connect->write($commentHead, $commentContent);
        if($query) {
            $connect = null; // Закрытие подключения к базе данных
            return true;
        }
        // Возможно стоит использовать окончание выполнения программы через exit()/die()?
    }
}