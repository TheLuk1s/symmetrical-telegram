<?php
session_start();
//padarome, kad negalėtų prieiti prie scripto failo per url
if (isset($_POST["submit"])) {
   
    $name = $_POST["name"];
    $lname = $_POST["lastname"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdRepeat"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    // //tikrinam ar nors vienas laukelis ne tusčias
    // if (emptyInputSignup($name, $email,  $name, $lname, $pwd, $pwdRepeat) !== false ) {
    //     header("location: ../signup.php?error=emptyinput");
    //     exit();
    // }
    // //tikrinam ar el paštas geras
    // if (invalidEmail($email) !== false ) {
    //     header("location: ../signup.php?error=invalidemail");
    //     exit();
    // }
    //tikrinam ar slaptažodis turi 1 didžiają raidę ir vieną skaičių
    
    if (pwdstrength($pwd) !== false ) {
        header("location: ../profile.php?error=invalidpassword");
        exit();
    }
     //tikrinam ar slaptažodžiai sutampa
     
     if (pwdMatch($pwd, $pwdRepeat) !== false ) {
        header("location: ../profile.php?error=passwordsdontmatch");
        exit();
    }
    
    updateUser($conn, $name,  $lname, $email, $pwd);

}
else {
    header("location: ../profile.php");
    exit();
}