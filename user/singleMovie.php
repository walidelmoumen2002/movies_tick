<?php
	include('Composants/NavBar.php');
	include("connexion.php");
	if(empty($_SESSION["nom"])){
	    header("location:http://localhost/movies_ticket/user/authentification.php");
	}

	$id = $_GET["id"];
	$pdostat = $mysqlconnection->prepare("
            select f.image as filmimage,f.name as filmname,s.name as sallename ,f.description as description
            from films f, programmes p,salles s 
            where s.id=p.salles_id and f.id=p.films_id and f.id=$id ");
	$pdostat->execute();
	$film = $pdostat->fetchAll(PDO::FETCH_ASSOC);
	//print_r($film);
    $idprogramme=
	$img = $film[0]["filmimage"];
	$name = $film[0]["filmname"];
	$salle = $film[0]["sallename"];
    $description=$film[0]["description"];
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
<?php
	echo "<body style='background-image:linear-gradient(to bottom, rgba(245, 246, 252, 0.52), rgba(180, 23, 21, 0.6)),url($img);
background-size: cover; background-position: top;background-attachment: fixed;color: white;'>
        <div class='single' style='margin-top: 3rem'>
            <div style='width: 40%;line-height:12rem;'>
                <p class='h1 display-4'>$name<span style='color: rgba(180, 23, 21)'>.</span></p>
                <p class='h4 display-7' style='color: #4e555b'>$salle</p>
                <p class='h5 display-8'>$description</p>
            </div>
            <div style=' display: flex;justify-content: space-around;flex-direction: column; width: 30%;min-height: 600px'>
        ";
	$pdostat = $mysqlconnection->prepare("
           select DISTINCT DATE_FORMAT(p.date, '%a') as day,DATE_FORMAT(p.date, '%d') as jour,DATE_FORMAT(p.date,'%b') as mois,p.date as date
from films f, programmes p,salles s 
where s.id=p.salles_id and f.id=p.films_id and f.id=$id ");
	$pdostat->execute();
	$date = $pdostat->fetchAll(PDO::FETCH_ASSOC);
	//print_r($date);

	foreach ($date as $key => $jour) {
		$fulldate = $jour['date'];
		echo " <div style='display: flex;justify-content: space-between;align-items: center '> 
                    <div class='date' >
                        <p >" . $jour['day'] . "</p>
                        <p style='font-weight: 800'>" . $jour['jour'] . "</p>
                        <p>" . $jour['mois'] . "</p>
                    </div>";;
		$pdostat = $mysqlconnection->prepare("
           select DISTINCT DATE_FORMAT(p.time, '%H:%i') as time
           from films f, programmes p,salles s 
           where s.id=p.salles_id and f.id=p.films_id and f.id=$id and DATE_FORMAT(p.date,'%d/%m/%y')=DATE_FORMAT('$fulldate','%d/%m/%y')");
		$pdostat->execute();
		$times = $pdostat->fetchAll(PDO::FETCH_ASSOC);
		//print_r($times);
		echo "       <div>";
		foreach ($times as $key => $val) {
			echo "      <a class='btn btn-danger' href='http://localhost/movies_ticket/user/reservation.php?idfilm=$id'>". $val['time'] ." PM</a>";
		}
		echo "       
              </div> </div>
            ";
    }
?>

</div>
</div>
</div>
<footer>
    <div style=' text-align: center;margin-top: 50px;' class='text-bg-dark p-3'>

        <p class='h6 '>Copyright &copy; 2022 All Rights Reserved by
            <a href='http://localhost/cinemaApp/'>Movies tick</a>.
        </p>
    </div>
</footer>
</body>
</html>
