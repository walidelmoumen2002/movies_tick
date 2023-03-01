<?php
	include("Composants/NavBar.php");
	include("connexion.php");
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
<div>
    <img height="1200" width="1600" class="logo-auth" src="images/writing-a-blog.png" alt="logo"/>
    <form class="auth-container" method="get">
        <div class="auth">
            <legend>Inscrivez-vous</legend>
            <div class="row">
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Prénom</label>
                    <input name="prenom" type="text" class="form-control" id="inputEmail4">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Nom</label>
                    <input name="nom" type="text" class="form-control" id="inputPassword4">
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                       aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="pass" class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" name="sinscrire" value="sinscrire" class="btn btn-danger">s'inscrire</button>
            <button type="reset"  class="btn btn-dark">Annuler</button>
        </div>
    </form>
</div>
<?php
	include('Composants/footer.php');
	include ("connexion.php");
	if($_SERVER['REQUEST_METHOD'] === 'GET'){
        $insertUser = $mysqlconnection->prepare("INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `isAdmin`, `remember_token`, `created_at`, `updated_at`) 
        VALUES (NULL, ?, ?, NULL,? , 'user', NULL, NULL, NULL)");
		$insertUser->bindValue(1, $_GET["nom"]." ".$_GET["prenom"]);
		$insertUser->bindValue(2, $_GET["email"]);
		$insertUser->bindValue(3, $_GET["pass"]);
		$insertUser->execute();
		if ($insertUser->rowCount() > 0) {
			header('location:http://localhost/movies_ticket/user/Movies.php');
		}
	}
?>
</body>
</html>
