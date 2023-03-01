<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="icon" href="images/logo-removebg-preview.png">
    <title>Movies tick</title>
</head>
<body class="home">
<?php
include('Composants/NavBar.php');
include ("connexion.php");
?>
<div class="main">
    <div class="main-film">
        <div>
            <p class="h5 display-7 minitext">8 April 2022 - 8 June 2022</p>
            <p class="h1 display-4">Dune(2021)</p>
        </div>
        <div class="button_home">
            <a class="nav-item btn btn-danger" href="http://localhost/movies_ticket/user/Movies.php">Autres Films</a>
            <a class="nav-item  btn btn-light" href="http://localhost/movies_ticket/user/Contact.php">Contact</a>
        </div>
        <div class="album">
            <?php
            $pdostat= $mysqlconnection->prepare("select id,image from films where projection=1 LIMIT 5");
            $pdostat->execute();
            $images=$pdostat->fetchAll(PDO::FETCH_ASSOC);
            foreach ($images as $clé =>$val){
                    $id = $val['id'];
                    $img= $val['image'];
                    echo "<a href='http://localhost/movies_ticket/user/singleMovie.php?id=$id'><img class='home-images' src='".$img."' alt='image'></a>";

            }
            ?>
        </div>
    </div>

</div>

</body>
</html>

