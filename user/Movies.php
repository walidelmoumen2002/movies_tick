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
<body id="corps">
<?php
	include('Composants/NavBar.php');
	include("connexion.php");
	$pdostat = $mysqlconnection->prepare("select Distinct c.name as nom,c.id as id from categories c ");
	$pdostat->execute();
	$data = $pdostat->fetchAll(PDO::FETCH_ASSOC);
	echo "
    <div class='movies'>
    <div style='margin:1em auto'>
        <form method='get'>
        <div   class='container text-center'>
        <div style='display: flex; align-items: center' class='row'>
            <div class='col form-floating mb-3'>
                <input name='date' type='date' class='form-control col' id='floatingInput'>
                <label for='floatingInput'>Date de projection</label>
            </div>
            <div class='col'>
                <select name='genre' class='form-select ' aria-label='Default select example'>
                    <option >Genres</option>";
	foreach ($data as $key => $val) {
		$id = $val["id"];
		$nom = $val["nom"];
		echo "<option value='$id'>$nom</option>";
	}

	echo "</select>
        </div>
              <div class='col'>  
                  <select name='annee' class='form-select col' aria-label='Default select example'>
                      <option>Année</option>";
	$pdostat = $mysqlconnection->prepare("select DISTINCT anne from films order by anne");
	$pdostat->execute();
	$data = $pdostat->fetchAll(PDO::FETCH_ASSOC);
	foreach ($data as $key => $val) {
		$annee = $val["anne"];
		echo "<option value='$annee'>$annee</option>";
	}
	echo "    </select>
            </div>
        </div>
       <button style='justify-content: center' type='submit' name='rechercher' value='rechercher un film' class='btn btn-danger'>rechercher un film</button> 
      </div> 
    </form>
 </div>";
?>
<div class="list-films ">
	<?php
		$sql = "select DISTINCT f.id as id ,f.image as image,f.description as description ,f.name as name 
                from films f , programmes p
                where f.id=p.films_id and  f.projection=1";
		if (isset($_GET["rechercher"])) {
			if (!empty($_GET["date"])) {
				$data = $_GET["date"];
				$sql=$sql." and DATE_FORMAT(p.date, '%d/%m/%y') = DATE_FORMAT('$data','%d/%m/%y')";
			}
			if (!empty($_GET["genre"]) && $_GET["genre"]!=="Genres" ) {
				$data = $_GET["genre"];
				$sql = $sql." and f.categories_id=$data";
			}
			if (!empty($_GET["annee"]) && $_GET["annee"]!=="Année") {
				$data = $_GET["annee"];
				$sql= $sql." and f.anne=$data";
			}
		}
		$pdostat = $mysqlconnection->prepare($sql);
		$pdostat->execute();
		$films = $pdostat->fetchAll(PDO::FETCH_ASSOC);
		foreach ($films as $cle => $value) {
			$id = $value['id'];
			echo "<div class='card movie_card' >
                    <img src='" . $value["image"] . "' class='card-img-top' alt='...'>
    <div class='card-body'>
    <h5 class='card-title'>" . $value['name'] . "</h5>
    <p class='card-text'>" . $value["description"] . "</p>
    <a href='http://localhost/movies_ticket/user/singleMovie.php?id=$id' class='btn btn-danger'>Reserver</a></div></div>";
		}

	?>
</div>
</div>

<footer>
    <div style=' text-align: center;margin-top: 50px;' class='text-bg-dark p-3'>
        <p class='h6'>Copyright &copy; 2022 All Rights Reserved by
            <a href='http://localhost/cinemaApp/'>Movies tick</a>.
        </p>
    </div>
</footer>
</body>
</html>
<?php
