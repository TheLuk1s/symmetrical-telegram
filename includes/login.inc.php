<?php
// tikrinam, kad viskas suveiktu paspaudus submit
if (isset($_POST["submit"])) {

    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    //tikrinam ar nors vienas laukelis ne tusčias
    if (emptyInputLogin( $username, $pwd) !== false ) {
        header("location: ../index.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $username, $pwd);
}

    // jei puslapis pasiektas neteisingu budu
    else {
        header("location: ../index.php");
        exit();
    }