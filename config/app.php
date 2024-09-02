<?php

// Configuración de la URL base según el entorno
switch ($_SERVER['HTTP_HOST']) {
    case 'localhost':
        define('BASE_URL', 'http://localhost/joselito/app-tienda');
        break;
    case 'sis-demo.wuaze.com':
        define('BASE_URL', 'https://sis-demo.wuaze.com/app-tienda');
        break;
    default:
        define('BASE_URL', 'http://192.168.1.40/joselito/app-tienda');
}

/*---------- Nombre de la sesion ----------*/
const SESSION_NAME = "SIS-TO";

/*----------  Zona horaria - Time zone  ----------*/
date_default_timezone_set("America/Lima");
