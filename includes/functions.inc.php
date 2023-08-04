<?php


function emptyInputSignup($name,$lastname, $email, $username, $pwd, $pwdRepeat) {
    $result = 0;
    if (empty($name) || empty($lastname) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidUid($username) {
    $result = 0;
    if (preg_match("/^[a-zA-Z0-9]/*$/", $username)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidEmail($email) {
    $result = 0;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function pwdMatch($pwd, $pwdRepeat) {
    $result = 0;
    if ($pwd !== $pwdRepeat) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}
function pwdstrength($pwd) {
    $result = 0;
    if (!preg_match("/^(?=.*?[A-Z])(?=.*?[0-9]).{8,}$/" , $pwd)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}
function uidExists($conn, $username, $email) {
    $sql = "SELECT * FROM users WHERE user_uid = ? OR user_email = ?;";
    // tikrinam ar sql uzklausa feilins
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare( $stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss",  $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }
    //mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $lastname, $email, $username, $pwd) {
    $sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd ) VALUES (?, ?, ?, ?, ?); ";
    // tikrinam ar sql uzklausa feilins
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare( $stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssss",  $name, $lastname, $email, $username, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../index.php?error=none");
    exit();
}

function emptyInputLogin( $username, $pwd) {
    $result = 0;
    if ( empty($username) || empty($pwd) ) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}
function loginUser($conn, $username, $pwd) {
    // prisijungimas tiek su username tiek su email
    $uidExists =  uidExists($conn, $username, $username);

    if ($uidExists === false ) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $pwdhashed = $uidExists["user_pwd"];
    $checkPwd = password_verify($pwd,$pwdhashed );

    if ($checkPwd === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }
    elseif ($checkPwd === true) {
        session_start();
        $_SESSION["userid"] = $uidExists["user_id"];
        $_SESSION["useruid"] = $uidExists["user_uid"];
        header("location: ../index.php");
        exit();
    }
    
}
function updateUser($conn, $name,  $lname, $email, $pwd) {

    $sql = "UPDATE users SET user_first = ?, user_last = ?, user_email= ?, user_pwd = ? WHERE user_id = ?";
    // tikrinam ar sql uzklausa feilins
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../profile.php?error=stmtfailed");
        exit();
    }
    
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "ssssd", $name, $lname, $email, $hashedPwd, $_SESSION['userid']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
   
    header("location: ../profile.php?error=none");
    exit();
}