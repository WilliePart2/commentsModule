<?php

class Router
{
    private $routes;
    public function __construct()
    {
        $this->routes = include_once(ROOT."/config/route.php");
    }
    private function getURI()
    {
        if(isset($_SERVER['REQUEST_URI'])){
            return $_SERVER['REQUEST_URI'];
        }
    }
    public function run()
    {
        $uri = $this->getURI();
        foreach($this->routes as $uriPattern => $action){
            if(preg_match("~$uriPattern~", $uri)){
                $section = explode("/", $action);
                $controllerName = "controller".ucfirst(array_shift($section));
                $actionName = "action".ucfirst(array_shift($section));

                $controllerFile = ROOT."/controller/".$controllerName.".php";
                if(file_exists($controllerFile)){
                    require_once "$controllerFile";
                    $controllerObject = new $controllerName();
                    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'){
                        $_POST = json_decode(file_get_contents('php://input'), true);
                        $head = $_POST['head'];
                        $text = $_POST['text'];

                        $result = $controllerObject->$actionName($head, $text);
                    }
                    else {
                        $result = $controllerObject->$actionName();
                    }
                    if($result !== null){
                        exit; // Заканчиваем выполнение скрипта. Тут сходятся все точки программы.
                    }
                }
            }
        }
    }
}