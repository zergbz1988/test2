<?php

/* @var $content */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->title ?></title>

    <link rel="stylesheet" href="/assets/css/lib/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/site.css">
</head>
<body>
<header class="container">
    <div class="row">
        <div class="col-xs-12">
            <ul class="nav nav-pills nav-justified">
                <li class="nav-item  <?= $_SERVER['REQUEST_URI'] == '/site/index' ? 'active' : '' ?>">
                    <a class="nav-link" href="/site/index">Одобренные отзывы</a>
                </li>
                <li class="nav-item  <?= $_SERVER['REQUEST_URI'] == '/site/all' ? 'active' : '' ?>">
                    <a class="nav-link" href="/site/all">Все отзывы</a>
                </li>
                <?php if (empty($this->registry->session['user_id'])) { ?>
                    <li class="nav-item  <?= $_SERVER['REQUEST_URI'] == '/site/login' ? 'active' : '' ?>">
                        <a class="nav-link" href="/site/login">Вход</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item  <?= $_SERVER['REQUEST_URI'] == '/admin/index' ? 'active' : '' ?>">
                        <a class="nav-link" href="/admin/index">Проверка отзывов</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/site/logout">Выход</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</header>
<div class="container">
    <?= $content ?>
</div>

<script src="/assets/js/lib/jquery-3.1.1.min.js"></script>
<script src="/assets/js/script.js"></script>
</body>
</html>