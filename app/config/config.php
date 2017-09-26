<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

//database
define('DB_TYPE', 'mysql');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'complaints');
define('DB_LOGIN', 'root');
define('DB_PASSWORD', '');
define('DB_CHARSET', 'utf8');

define('URL_PROTOCOL', '//');
define('URL_DOMAIN', $_SERVER['HTTP_HOST']);
define('URL', URL_PROTOCOL .URL_DOMAIN. '/');

define('ROOT', $_SERVER['DOCUMENT_ROOT']);

define('SALT', '$1$somethin$');
define('SESSION_TIMEOUT', 3600); //1 hour

//reCaptcha
define('RECAPTCHA_SECRET', '6LfzDTIUAAAAACZgB7aXNpfUOe_BnQRnxFY2tmsl');