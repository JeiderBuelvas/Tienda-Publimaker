<?php

class App
{
    private $controller = 'Home';
    private $method = 'index';
    private $params;

    public function run()
    {
        $URL = $this->splitURL();

        // $this->show($URL);

        // controller
        $controllerName = ucfirst($URL[0] ?? $this->controller);
        $filename = "app/controllers/{$controllerName}.php";
        if (file_exists($filename)) {
            require $filename;
            $this->controller = $controllerName;
            unset($URL[0]);
        } else {
            $this->error();
            return;
        }

        // method
        $controllerInstance = new $this->controller();

        $methodName = $URL[1] ?? $this->method;
        if (method_exists($controllerInstance, $methodName)) {
            $this->method = $methodName;
            unset($URL[1]);
        } else {
            $this->error();
            return;
        }

        // params
        $this->params = $URL ? array_values($URL) : [];

        // run
        call_user_func_array([$controllerInstance, $this->method], $this->params);
    }

    private function splitURL()
    {
        $URL = $_GET['uri'] ?? $this->controller;
        $URL = explode("/", filter_var(trim($URL, "/"), FILTER_SANITIZE_URL));
        return $URL;
    }

    public function show($stuff)
    {
        echo '<pre style="background-color: #000; color: #fff;">';
        print_r($stuff);
        echo '</pre>';
        exit();
    }

    private function error()
    {
        echo '<h1>404 NOT FOUND</h1>';
        exit();
    }
}
