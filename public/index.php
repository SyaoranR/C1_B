<?php

session_start();
// this phpError is only recommended in delepment enviroment
// put as comment if you deploy
// include './../app/phpError.php';
include './../app/config.php';
include './../app/autoload.php';

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">    
    <link href="<?=URL?>/public/css/styles.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?= URL ?>/public/imgs/icon.png" type="image/x-icon">
    <link rel="icon" href="<?= URL ?>/public/imgs/icon.png" type="image/x-icon">
</head>
<body>

    <?php
        include '../app/Views/header.php';  
        // creating instance, () is optional              
        $routes = new Routes();
        // $routes->url();            
        include '../app/Views/footer.php';   
    ?>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> 
    <script src="<?=URL?>/public/js/jquery.functions.js"></script> 
    
</body>
</html>

<!-- Hello friend
index.php?category=5&subcategory=2
index.php?post=10&edit$id=10
^^^^^ The rule changes that ^^^ 

vvvvv to this vvv
the best for the user is friendly url
category/news/most-read
post/edit/10
-->