<?php
spl_autoload_register(function ($classname) {
    $classname = __DIR__ . "/" . $classname . ".php";
    if (file_exists($classname)) {
        require_once $classname;
    } else {
        echo 'LA CLASE: ' . $classname . ' NO EXISTE<br>';
    }
});
