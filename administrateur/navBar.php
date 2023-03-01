<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="">MOVIE TICKET</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Product menu -->
            <ul class="navbar-nav mr-auto">

                <li class="nav-item">
                    <a class="nav-link" href="">ALL MOVIES</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">BEST MOVIES </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">TODAT SHOW</a>
                </li>

            </ul>
            <!-- Login and register menu -->
            <ul class="navbar-nav">
                <li class="nav-item">

                    <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true) {
                        echo "<li class'nav-link'><a class='nav-link' href='logout.php'>logout</a></li>";
                    } else {
                        echo "<li class'nav-link'><a class='nav-link' href='indexindex.php'>Login</a></li>";
                    }
                    ?>
                </li>
                <?php if (isset($_SESSION['user_logged_in_name'])) {

                    echo "  <li class='ml-3 nav-item border pl-4 pr-4 border-primary rounded bg-info'>
                    <a class='nav-link text-white' href=''>" . $_SESSION['user_logged_in_name'] . "</a>
                    </li>";
                } else {

                    echo "  <li class='nav-item'>
                    <a class='nav-link' href='register.php'>Register</a>
                    </li>";
                } ?>
            </ul>
        </div>
    </nav>


    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
</body>

</html>