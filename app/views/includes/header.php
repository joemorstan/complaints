<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
          integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
    <?php
        if (rtrim($_SERVER['REQUEST_URI'], '/') == '/propositions/create' ||
            rtrim($_SERVER['REQUEST_URI'], '/') == '/complaints/create') {
            echo '<script src=\'https://www.google.com/recaptcha/api.js\'></script>';
        }
    ?>
</head>
<body>
<header class="mb-4">
    <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?= URL. 'propositions/page/1' ?>">Propositions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL. 'complaints/page/1' ?>">Complaints</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL. 'propositions/create' ?>">New proposition</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL. 'complaints/create' ?>">New complaint</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <?php if (Auth::check()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= URL. 'login/logout' ?>">Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= URL. 'login' ?>">Admin Login</a>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>
        </div>

    </nav>
</header>
<div class="container main-container">
