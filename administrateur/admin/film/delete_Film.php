<?php


session_start();
if (!$_SESSION['admin_logged_in']) {
    header('Location:../../index.php');
}

require('../../db/db.php');

$sql = 'DELETE FROM Films WHERE id = :id';
$delete_f = $connection->prepare($sql);

$delete_f->bindValue(':id', $_GET['id']);

$delete_f->execute();


if ($delete_f->rowCount() > 0) {
    header('location:show_all_films.php?valid=data is deleted');
} else {
    header('location:show_all_films.php?erreur=data is not deleted');
}
