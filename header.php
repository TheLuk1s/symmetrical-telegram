<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <script src="js/jquery-3.7.0.js"></script>
    <script src="js/scripts.js"></script>

    <title>Poker 2000</title>
</head>

<body>
    <nav class="display-m">
        <button id="demo-menu-lower-left" class="mdl-button mdl-js-button mdl-button--icon">
            <i class="material-icons">more_vert</i>
        </button>

        <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-js-ripple-effect" for="demo-menu-lower-left">
        <li class="mdl-menu__item"><?php echo "<p>Hello there " . $_SESSION["useruid"] . "</p>"; ?></li>
            <?php 
             if (isset($_SESSION["useruid"])) {
                echo "<li class='mdl-menu__item'><a href='index.php'>Home</a></li>";
                echo "<li class='mdl-menu__item'><a href='profile.php'>Profile</a></li>";
                echo "<li class='mdl-menu__item'><a href='pokes.php'>Pokes</a></li>";
                echo "<li class='mdl-menu__item'><a href='includes/logout.inc.php'>Log out</a></li>";
            } else {
                echo "<li class='mdl-menu__item'><a href='index.php'>Home</a></li> ";
                echo " <li class='mdl-menu__item'><a href='signup.php'>Sign up</a></li>";
               
            }
            ?>
    </nav>

    <nav class="display-d">
        <div class="wrapper">
            <a class="logo" href="index.php">
                <p>Baksnotojas 2000</p>
            </a>
            <ul>
                <?php
                if (isset($_SESSION["useruid"])) {
                    echo "<li><a href='pokes.php'><i class='fa-solid fa-thumbs-up' style='color: #ffffff;'></i></a></li>";
                    echo "<li><a href='profile.php'><i class='fa-solid fa-circle-user' style='color: #ffffff;'></i></a></li>";
                    echo "<li><a href='includes/logout.inc.php'><i class='fa-solid fa-right-from-bracket' style='color: #ffffff;'></i></a></li>";
                } else {
                    echo " <li><a href='signup.php'>Sign up</a></li>";
                    echo "<li><a href='login.php'>Log in</a></li> ";
                }
                ?>

            </ul>
        </div>
    </nav>