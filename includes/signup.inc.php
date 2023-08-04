<?php
//padarome, kad negalėtų prieiti prie scripto failo per url
if (isset($_POST["submit"])) {
   
    $name = $_POST["name"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdRepeat"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    //tikrinam ar nors vienas laukelis ne tusčias
    if (emptyInputSignup($name, $lastname, $email, $username, $pwd, $pwdRepeat) !== false ) {
        header("location: ../signup.php?error=emptyinput");
        exit();
    }
    //tikrinam ar prisijungimo vardas geras
    if (invalidUid($username) !== false ) {
        header("location: ../signup.php?error=invaliduid");
        exit();
    }
    //tikrinam ar el paštas geras
    if (invalidEmail($email) !== false ) {
        header("location: ../signup.php?error=invalidemail");
        exit();
    }
    //tikrinam ar slaptažodis turi 1 didžiają raidę ir vieną skaičių
    if (pwdstrength($pwd) !== false ) {
        header("location: ../signup.php?error=invalidpassword");
        exit();
    }
     //tikrinam ar slaptažodžiai sutampa
     if (pwdMatch($pwd, $pwdRepeat) !== false ) {
        header("location: ../signup.php?error=passwordsdontmatch");
        exit();
    }
    //tikrinam ar jau yra toks prisijungimo vardas
    if (uidExists($conn, $username, $email) !== false ) {
        header("location: ../signup.php?error=usernametaken");
        exit();
    }

    createUser($conn, $name,$lastname, $email, $username, $pwd);

}
else {
    header("location: ../signup.php");
    exit();
}