<?php
session_start();

// OUT OF COMENT THIS ONLY IN DEVELOPMENT
// include './../app/phpError.php';
include './../app/config.php';
include './../app/autoload.php';

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?></title>    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
    <link rel="stylesheet" href="<?= URL ?>/public/css/estilos.css">
    <link rel="shortcut icon" href="<?= URL ?>/public/imgs/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?= URL ?>/public/imgs/favicon.ico" type="image/x-icon">
    <!-- Novo 5 -->
    
    <!-- <link rel="stylesheet" type="text/css" href="markitup/skins/markitup/style.css" />
    <link rel="stylesheet" type="text/css" href="markitup/sets/default/style.css" />
    
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="markitup/jquery.markitup.js"></script> -->
    
    <!-- Novo 4 -->
    
    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script> -->
    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/inline/ckeditor.js"></script> -->



    <!-- Novo 3 -->

    <!-- <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>  -->
   
    <!-- Novo 2 -->
    <!-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>   -->
    
    <!-- <script src="https://cdn.tiny.cloud/1/0xegxzck1dv3qfhy6a6yrbnelknk3147rn724zkfmu6bz80h/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->
    
    <!-- <script>tinymce.init({selector:'textarea'});</script> -->

    <!-- Novo 1 -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">  

</head>

<body>

    <?php

    include '../app/View/topo.php';
    // creating instance, () is optional
    $rotas = new Rotas();
    // $rotas->url();
    include '../app/View/rodape.php';

    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script> 
    <!-- Novo 5 -->
    <!-- <script type="text/javascript" src="markitup/sets/default/set.js"></script> -->

    
    <!-- Novo 4 -->    
    
    <!-- Novo 3 -->
 
    <!-- <script src="//cdn.quilljs.com/1.3.6/quill.core.js"></script>
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">   -->


    <!-- Novo 2 -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script> -->
    
    <!-- Novo 1 -->
    <script src="<?= URL ?>/public/js/summernote-pt-BR.js"></script>  

    <script src="<?= URL ?>/public/js/jquery.funcoes.js"></script>
    
</body>

</html>

<!-- Olá mundo bonito
index.php?categoria=5&subcategoria=2
index.php?post=10&editar$id=10
^^^^^ A regra faz a mudança disso ^^^ 

vvvvv para isso vvv
o melhor para o user url amigável
categoria/noticias/mais-lidas
post/editar/10
-->