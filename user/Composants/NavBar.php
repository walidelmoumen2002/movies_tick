<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-solid-straight/css/uicons-solid-straight.css'>
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a href="http://localhost/movies_ticket/user/Home.php" id="logo"><img src="./images/logo-removebg-preview.png" alt="logo"></a>
    <div class="collapse navbar-collapse menu" id="navbarNavAltMarkup">

        <div class="navbar-nav ">
            <a class="nav-item nav-link" href="http://localhost/movies_ticket/user/Home.php">Accueil </a>
            <a class="nav-item nav-link" href="http://localhost/movies_ticket/user/Movies.php">Films</a>
            <a class="nav-item nav-link" href="http://localhost/movies_ticket/user/About.php">Movies Tick</a>
            <a class="nav-item nav-link" href="http://localhost/movies_ticket/user/Contact.php">Contact</a>
        </div>


        <?php

        if (isset($_SESSION["nom"])) {
            echo '<i style="margin-right: 10px" class="fi fi-ss-user text-secondary-emphasis"> Hello '.$_SESSION["nom"].' !    </i>
    <a class="nav-item  btn btn-outline-danger" href="http://localhost/movies_ticket/user/deconnexion.php">Se Deconnecter</a> 
    <a class="nav-item  btn btn-outline-primary" href="http://localhost/movies_ticket/user/panier.php"><i class="fi fi-ss-shopping-cart"></i></a>
    ';
        
        } else {
            echo '<a class="nav-item  btn btn-outline-light" href="http://localhost/movies_ticket/user/authentification.php">Se Connecter</a>
                  <a class="nav-item  btn btn-outline-light" href="http://localhost/movies_ticket/user/sinscrire.php">S\'Inscrire</a> ';
        }
        ?>
    </div>
</nav>
</body>
</html>


