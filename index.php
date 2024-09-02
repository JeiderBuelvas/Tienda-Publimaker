<?php
require_once "config/app.php";

session_name(SESSION_NAME);
session_start();

require_once "config/database.php";
require_once "core/autoload.php"; // Autoload core Libraries

$app = new App();
$app->run();
