<?php
try{
    $host='mysql:host=localhost;dbname=dev_movie_ticket_;charset=utf8';
    $root='root';
    $mdp='';
    $mysqlconnection=new PDO($host,$root,$mdp);

}catch(PDOException $e){
    print_r($e->getMessage());
}
