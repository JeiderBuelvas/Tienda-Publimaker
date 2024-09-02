<?php

class Controller
{
    public function view($view, $data = [])
    {
        extract($data);

        $filename = "app/views/" . $view . ".php";
        if (file_exists($filename)) {
            require $filename;
        } else {
            echo '<h1>404 NOT FOUND</h1>';
            exit();
        }
    }
    public function model($model)
    {
        $filename = "app/models/" . ucfirst($model) . ".php";

        if (file_exists($filename)) {
            require $filename;

            return new $model();
        }

        return false;
    }

    public function redirect($url)
    {
        header("Location: " . BASE_URL . "/" . $url);
    }
}
