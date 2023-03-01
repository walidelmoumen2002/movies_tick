<?php
	include('Composants/NavBar.php');
	include("connexion.php");
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-straight/css/uicons-regular-straight.css'>
	<title>Document</title>
</head>
<body>

<div class="container-lg">
    <h1 style="text-align: center;margin: 1em auto" class="h2 display-4">Votre Panier</h1>
<table class="table table-striped ">
<thead>
	<tr>
		<th scope="col">Image du film</th>
		<th scope="col">Nom du film</th>
		<th scope="col">Nom de la salle</th>
		<th scope="col">Nombre de ticket</th>
		<th scope="col">Prix</th>
	</tr>
	</thead>
	<tbody class="table-group-divider">
	<?php
		$id=$_SESSION["id"];
		$pdostat=$mysqlconnection->prepare("select r.id as id,f.image as image,f.name as filmname,s.name as sallename,r.N_ticket as nbr,r.total_p as prix 
from films f,reservations r,programmes p,salles s 
where f.id=p.films_id and r.programmes_id=p.id and p.salles_id=s.id and r.users_id=$id");
		$pdostat->execute();
		$reservation=$pdostat->fetchAll(PDO::FETCH_ASSOC);
		//print_r($reservation);
        foreach($reservation as $key=>$val){
            $id=$val["id"];
            $img=$val["image"];
            $nomf=$val["filmname"];
	        $noms=$val["sallename"];
	        $nbr=$val["nbr"];
	        $prix=$val["prix"];
            echo"<tr>
		<th scope='row'><img height='100px' width='50px' src='$img' alt='$nomf'></th>
		<td>$nomf</td>
		<td>$noms</td>
		<td>$nbr</td>
		<td>$prix dh</td>
		<td><a class='btn btn-outline-danger' href='http://localhost/movies_ticket/user/deleteitem.php?id=$id'><i class='fi fi-rs-trash'></i></a></td>
	</tr>";
        }
	?>
	</tbody>
</table>

<?php
	$id=$_SESSION["id"];
	$pdostat=$mysqlconnection->prepare("select sum(r.total_p) as total from reservations r where  r.users_id=$id");
	$pdostat->execute();
	$total=$pdostat->fetchAll(PDO::FETCH_ASSOC);
    $t=$total[0]["total"];
	//print_r($reservation);
	echo"<div style='display: flex;justify-content: space-between;align-items: center'><p style='font-weight: bold' class='h6 display-6'>Prix Total : $t DH</p>";
?>
    <a href="http://localhost/movies_ticket/user/payment.php" class="btn btn-danger">Passer au Payment</a></div>
</body>
</html>

