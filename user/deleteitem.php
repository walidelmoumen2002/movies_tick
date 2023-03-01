<?php
	session_start();
	$item=$_GET["id"];
	include ("connexion.php");
	$pdostat=$mysqlconnection->prepare("delete from reservations where id=$item");
	$pdostat->execute();
	header("location:http://localhost/movies_ticket/user/panier.php");