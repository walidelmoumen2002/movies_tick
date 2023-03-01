<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="icon" href="images/logo-removebg-preview.png">
    <title>Movies tick</title>
</head>
<body class="back">
<?php
include("Composants/NavBar.php");
include("connexion.php");
if (isset($_POST["connecter"])) {
    $pdostat = $mysqlconnection->prepare("select id,name from users where email=? and password=?");
    $pdostat->bindValue(1, $_POST["email"]);
    $pdostat->bindValue(2, $_POST["pass"]);
    $pdostat->execute();
    $utilisateur = $pdostat->fetchAll(PDO::FETCH_ASSOC);
    print_r($utilisateur);
    if (isset($utilisateur)) {
        foreach ($utilisateur as $key => $val) {
	        $_SESSION["id"] = $val["id"];
            $_SESSION["nom"] = $val["name"];
        }
        header("location:Home.php");
    }
}

?>
<div>
    <form class="auth-container" method="post">
        <div class="auth">
            <legend>Connectez-vous</legend>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                       aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="pass" class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" name="connecter" class="btn btn-danger">Connecter</button>
            <button type="reset"  class="btn btn-dark">Annuler</button>
        </div>
    </form>
    <img height="1200" width="1600" class="logo-auth" src="images/working-from-home.png" alt="logo"/>
</div>

<?php
include('Composants/footer.php');
?>
</body>
</html>

