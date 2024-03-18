<!doctype html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <link rel="stylesheet" href="css/style.css">
   <title>Pop it MVC</title>
</head>
<body>
<header>
   <nav>
    <div>
       <a href="<?= app()->route->getUrl('/hello') ?>">Главная</a>
       <?php
       if (!app()->auth::check()):
           ?>
           <a href="<?= app()->route->getUrl('/login') ?>">Вход</a>
       <?php
       else:
           ?>
           <a href="<?= app()->route->getUrl('/logout') ?>">Выход (<?= app()->auth::user()->name ?>)</a>
       <?php
       endif;
       ?>
       </div>

       <div class="b">
       <?php

       if (app()->auth::check() && app()->auth::user()->role=="admin"):
           ?>
           <a href="<?= app()->route->getUrl('/') ?>">Добавить нового системного администратора</a>
       <?php
       elseif(app()->auth::check()):
           ?>
           <a href="<?= app()->route->getUrl('/abonents') ?>">Абоненты</a>
           <a href="<?= app()->route->getUrl('/numbers') ?>">Телефон</a>
           <a href="<?= app()->route->getUrl('/rooms') ?>">Помещения</a>
           <a href="<?= app()->route->getUrl('/subdivisions') ?>">Подразделения</a>
       <?php
       endif;
       ?>
       
       </div>
   </nav>
</header>
<main>
   <?= $content ?? '' ?>
</main>

</body>
</html>