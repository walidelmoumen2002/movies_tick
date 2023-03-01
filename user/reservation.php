<?php
	include("Composants/NavBar.php");
	include("Composants/footer.php");
    include ("connexion.php");

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<div style='display: flex ;justify-content: center;align-items: center;margin-top: 3rem' >
    <div class="reservation">
        <form method="post">
            <legend style='margin-bottom:0.5em;' class="h2 display-5">Valider votre Reservation</legend>
            <div class="form-floating mb-3 row">
                <div class="col form-floating mb-3">
                    <input name="prenom" type="text" class="form-control" id="floatingInput" placeholder="Prénom">
                    <label for="floatingInput">Prénom</label>
                </div>
                <div class="col form-floating mb-3">
                    <input name="nom" type="text" class="form-control" id="floatingInput" placeholder="Nom de famille">
                    <label for="floatingInput">Nom de famille</label>
                </div>
            </div>
            <div class="form-floating mb-3">
                <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
            </div>
            <select name="nbr" style="margin-bottom: 1em" class="form-select" aria-label="Default select example">
                <option selected>Nombre de tickets</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <div class="form-floating mb-3">
                <input name="numero" type="text" class="form-control" id="floatingInput" placeholder="numéro de téléphone">
                <label for="floatingInput">Numéro de téléphone</label>
            </div>
            <button name="valider" type="submit" class="btn btn-danger">Valider</button><button type="reset" style="margin-left:1em " class="btn btn-outline-secondary">Annuler</button>
        </form>
    </div>
	    <?php
		    $id = $_GET["idfilm"];
		    $pdostat=$mysqlconnection->prepare("select DISTINCT f.image as image,f.name as name,p.prix as prix,p.id as programme_id from films f,programmes p where f.projection=1 and f.id=p.films_id and p.films_id=$id ");
		    $pdostat->execute();
		    $films=$pdostat->fetchAll(PDO::FETCH_ASSOC);
		    $img=$films[0]["image"];
            $name=$films[0]["name"];
            $prix=$films[0]["prix"];
            $idprogramme=$films[0]["programme_id"];
		    //print_r($films);
			    echo "<div class='card mb-3' style='max-width: 400px;'>
                        <div class='row g-0'>
                            <div class='col-md-4'>
                                <img src='$img' class='img-fluid rounded-start' alt='$name'>
                            </div>
                            <div class='col-md-8'>
                                <div class='card-body'>
                                    <h5 class='card-title display-6'>$name</h5>
                                    <p class='card-text'></p>
                                    <span class='card-text'><span class='text-muted display-7'>Prix :  </span>$prix DH</p>
                                </div>
                            </div>
                        </div>
                    </div>";
		    if(isset($_POST["valider"])){
			    $pdostat=$mysqlconnection->prepare("INSERT INTO `reservations` (`id`, `programmes_id`, `users_id`, `N_ticket`, `total_p`, `created_at`, `updated_at`) VALUES (NULL, ?, ?, ?, ?, NULL, NULL)");
                $pdostat->bindValue(1,$idprogramme);
			    $pdostat->bindValue(2,$_SESSION["id"]);
			    $pdostat->bindValue(3,$_POST["nbr"]);
			    $pdostat->bindValue(4,$prix*$_POST["nbr"]);
                $pdostat->execute();

		    }
		    //header("Location:http://localhost/movies_ticket/user/panier.php");
	    ?>
</div>
</body>
</html>


