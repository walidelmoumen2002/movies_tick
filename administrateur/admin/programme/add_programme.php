<?php

session_start();
if (!$_SESSION['admin_logged_in']) {
    header('Location:../../index.php');
}

require('../../db/db.php');

$arry_erreurs = array();

$sql_f = "select * from films";
$all_films  = $connection->prepare($sql_f);
$all_films->execute();
$data_film = $all_films->fetchAll();


$sql_s = "select * from salles";
$all_salles  = $connection->prepare($sql_s);
$all_salles->execute();
$data_salle = $all_salles->fetchAll();



if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if (isset($_POST['film']) and isset($_POST['salle']) and isset($_POST['date_p']) and isset($_POST['time']) and isset($_POST['price'])) {

        $films_id = $_POST['film'];
        $salles_id = $_POST['salle'];
        $date_p = $_POST['date_p'];
        $time = $_POST['time'];
        $price = $_POST['price'];

        if (empty($time)) {
            $error = "Please select a time.";
            $arry_erreurs['time'] = $error;
            $time = "";
        }

        if (empty($date_p)) {
            $error = "Please select a date.";
            $arry_erreurs['date_p'] = $error;
            $date_p = "";
        }

        if (empty($price)) {
            $error = "Please enter a price.";
            $arry_erreurs['price'] = $error;
            $price = "";
        } else if (!is_numeric($price)) {
            $error = "Please enter a valid prive.";
            $arry_erreurs['price'] = $error;
            $price = "";
        } else {
            $price = trim($price);
        }

        if (empty($films_id)) {
            $error = "Please select a film.";
            $arry_erreurs['films_id'] = $error;
            $films_id = "";
        }

        if (empty($salles_id)) {
            $error = "Please select a screan.";
            $arry_erreurs['salles_id'] = $error;
            $salles_id = "";
        }



        if (!empty($films_id) and !empty($salles_id) and !empty($date_p) and !empty($time) and !empty($price)) {


            // INSERT INTO `programmes`(`id`, `films_id`, `salles_id`, `date`, `time`, `prix`, `created_at`, `updated_at`) 
            // VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]','[value-8]')

            $sql_p = "INSERT INTO programmes (films_id, salles_id, date, time , prix , created_at)
             VALUES (:films_id , :salles_id , :date , :time , :prix , :created_at )";


            // Prepare the statement
            $insertProgramme = $connection->prepare($sql_p);

            // Bind the values to the placeholders
            $insertProgramme->bindValue(':films_id', $films_id);
            $insertProgramme->bindValue(':salles_id', $salles_id);
            $insertProgramme->bindValue(':date', $date_p);
            $insertProgramme->bindValue(':time', $time);
            $insertProgramme->bindValue(':prix', $price);
            $date = new DateTime();
            $insertProgramme->bindValue(':created_at', $date->format('Y-m-d H:i:s'));

            // Execute the statement
            $insertProgramme->execute();

            if ($insertProgramme->rowCount() > 0) {
                header('location:show_all.php?valid=data is added');
            }
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add programme</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style>
        .box_shadow {
            box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
        }
    </style>
</head>

<body>
    <?php
    require('../navBar/navBar.php');
    ?>



    <div class="container col-8 mt-5 mb-5 ">


        <div class="card box_shadow">

            <div class="card-header">
                <h1 class="h3 mb-3 font-weight-normal">form add programe</h1>
            </div>
            <div class="card-body">



                <form method="post" autocomplete="off" enctype="multipart/form-data">
                    <?php

                    if (isset($arry_erreurs) and !empty($arry_erreurs)) {

                        echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>warning</strong> ';
                        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>';
                    }

                    ?>

                    <div class="form-group">
                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">movie</label>
                        <select class="custom-select my-1 mr-sm-2" name="film" id="inlineFormCustomSelectPref">
                            <option value="">select one film</option>
                            <?php

                            foreach ($data_film as $row) {
                                $id = $row['id'];
                                $name = $row['name'];
                                if (isset($_POST['film']) and $_POST['film'] == $id) {
                                    echo "<option value='$id' selected >$name</option>";
                                }
                                echo "<option value='$id'>$name</option>";
                            }

                            ?>
                        </select>
                        <div class="text-danger">
                            <?php if (isset($arry_erreurs['films_id']) and !empty($arry_erreurs['films_id'])) {
                                echo $arry_erreurs['films_id'];
                            } ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">screan</label>
                        <select class="custom-select my-1 mr-sm-2" name="salle" id="inlineFormCustomSelectPref">
                            <option value="">select one screan</option>
                            <?php
                            foreach ($data_salle as $row) {
                                $id = $row['id'];
                                $name = $row['name'];
                                if (isset($_POST['salle']) and $_POST['salle'] == $id) {
                                    echo "<option value='$id' selected >$name</option>";
                                }
                                echo "<option value='$id'>$name</option>";
                            }

                            ?>
                        </select>
                        <div class="text-danger">
                            <?php if (isset($arry_erreurs['salles_id']) and !empty($arry_erreurs['salles_id'])) {
                                echo $arry_erreurs['salles_id'];
                            } ?>
                        </div>
                    </div>

                    <!-- `date`, `time`, `prix`, `created_at` -->

                    <div class="form-group">
                        <label for="duré">date</label>
                        <input type="date" class="form-control" id="duré" name="date_p" placeholder="write the date of ths show" value="<?php if (isset($_POST['date_p'])) {
                                                                                                                                            echo $_POST['date_p'];
                                                                                                                                        } ?>">
                        <div class="text-danger">
                            <?php if (isset($arry_erreurs['date_p']) and !empty($arry_erreurs['date_p'])) {
                                echo $arry_erreurs['date_p'];
                            } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="duré">time</label>
                        <input type="time" class="form-control" id="duré" name="time" placeholder="write the time" value="<?php if (isset($_POST['time'])) {
                                                                                                                                echo $_POST['time'];
                                                                                                                            } ?>">
                        <div class="text-danger">
                            <?php if (isset($arry_erreurs['time']) and !empty($arry_erreurs['time'])) {
                                echo $arry_erreurs['time'];
                            } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="duré">price</label>
                        <input type="number" class="form-control" id="duré" name="price" placeholder="write the price" value="<?php if (isset($_POST['price'])) {
                                                                                                                                    echo $_POST['price'];
                                                                                                                                } ?>">
                        <div class="text-danger">
                            <?php if (isset($arry_erreurs['price']) and !empty($arry_erreurs['price'])) {
                                echo $arry_erreurs['price'];
                            } ?>
                        </div>
                    </div>



                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>


            </div>
        </div>
    </div>



    <!-- Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.16.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>