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
	<form class="auth auth-container" method="get">
        <legend></legend>
            <div class="form-group">
                <label for="cardNumber">Card Number</label>
                <input type="text" class="form-control" id="cardNumber" placeholder="Enter card number">
            </div>
            <div class="form-group">
                <label for="cardExpiry">Expiration Date</label>
                <input type="text" class="form-control" id="cardExpiry" placeholder="MM/YY">
            </div>
            <div class="form-group">
                <label for="cardCVV">CVV</label>
                <input type="text" class="form-control" id="cardCVV" placeholder="CVV">
            </div>
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="text" class="form-control" id="amount" placeholder="Enter amount">
            </div>
        <div style="margin-top: 1em">
            <button type="submit" name="payer" value="inscrire" class="btn btn-danger">Payer</button>
            <button type="reset"  class="btn btn-dark">Annuler</button>
        </div>


	</form>
</div>
<img height="1200" width="1600" class="logo-auth" src="images/add-to-cart.png" alt="logo"/>
<?php
	if(isset($_GET["payer"])){
		header("location:http://localhost/movies_ticket/user/Home.php");
	}
?>
</body>
</html>
