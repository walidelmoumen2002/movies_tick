<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="images/logo-removebg-preview.png">
    <title>Movies tick</title>
</head>
<body>
<?php
include('Composants/NavBar.php');
?>
<div>
    <img height="900" width="1600" class="logo-auth" src="images/working-with-an-infant.png" alt="logo"/>
    <form class="auth-container" method="post">
        <div class="auth">
            <legend>Besoin D'aide</legend>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Adresse email</label>
                <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Message</label>
                <textarea name="message" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <button type="submit" name="envoyer" value="envoyer" class="btn btn-danger">Envoyer</button>
            <button type="reset"  class="btn btn-dark">Annuler</button>
        </div>
    </form>
</div>
<?php
include('Composants/footer.php');
include ("connexion.php");
if($_SERVER['REQUEST_METHOD'] === 'POST'){
	//INSERT INTO `messages` (`id`, `email`, `message`) VALUES (NULL, 'g', 'g')
	$pdostat=$mysqlconnection->prepare("INSERT INTO `messages` (`id`, `email`, `message`) VALUES (NULL,?,?)");
    $pdostat->bindValue(1, $_POST["email"]);
    $pdostat->bindValue(2, $_POST["message"]);
    $pdostat->execute();
    if($pdostat->rowCount()>0){
	    header('location:http://localhost/movies_ticket/user/Home.php');
    }
}

?>
</body>
</html>
<?php
