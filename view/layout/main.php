<?php

/* @var $content */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->vars['title'] ?></title>

    <link rel="stylesheet" href="/assets/css/lib/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/site.css">
</head>
<body>
<div class="container">
    <?= $content ?>
</div>

<script src="/assets/js/lib/jquery-3.1.1.min.js"></script>
<script src="/assets/js/lib/bootstrap.min.js"></script>
<script src="/assets/js/script.js"></script>
</body>
</html>