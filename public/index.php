<?php
require_once '../app/config/config.php';

set_include_path(
    get_include_path().
    PATH_SEPARATOR. ROOT. '/app/controllers'.
    PATH_SEPARATOR. ROOT. '/app/models'.
    PATH_SEPARATOR. ROOT. '/app/views'.
    PATH_SEPARATOR. ROOT. '/app/core'
);
spl_autoload_extensions('.php');
spl_autoload_register();

session_start();

$app = new App;

