<?php
session_start();
require_once 'dbh.inc.php';
switch (strtolower($_GET['action'] ?? '')) {
    case "getpokes":
        echo json_encode(getPokes($conn, (int)$_SESSION["userid"] ?? null));
        break;
    case "sendpoke":
        echo json_encode(sendPoke($conn, (int)$_SESSION["userid"] ?? null, (int)trim($_POST['to_uid']) ?? null));
        break;
}


function getPokes(mysqli $conn, int $userId = null)
{
    if($userId === null) {
        return [];
    }
    $query = "
        SELECT pokes.the_date,  
               from_user.user_first,
               from_user.user_last,
               from_user.user_email,
               to_user.user_first,
               to_user.user_last,
               to_user.user_email,
               FROM pokes 
                   LEFT JOIN users as from_user on from_user.id = pokes.from_uid 
                   LEFT JOIN users as to_user on to_user.id = pokes.to_uid
                    where pokes.from_uid = ? OR pokes.to_uid = ? 
                   ";

    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare( $stmt, $query);

    mysqli_stmt_bind_param($stmt, "ss",  $userId, $userId);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $items = [];
    if($row = mysqli_fetch_assoc($resultData)) {
        $items[] = $row;
    }
    return  $items;
}

function sendPoke(mysqli $conn, int $fromUser = null, int $toUser = null)
{
   if($fromUser === null || $toUser === null) {
        return ['status' => false];
    }
    $query = "INSERT INTO pokes (from_uid, to_uid, the_date) VALUES (?, ?, ?);";
    $timeNow = date('Y-m-d H:i:s');
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare( $stmt, $query);

    mysqli_stmt_bind_param($stmt, "sss",  $fromUser, $toUser, $timeNow);
    mysqli_stmt_execute($stmt);
    // TODO: issiusti emaila
    return  ['status' => true];
}