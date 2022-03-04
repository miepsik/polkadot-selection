<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);

function saveStep($user, $step) {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/connect.php";

    $db = connect();

    $stmt = $db->prepare("UPDATE users set udate = CURRENT_TIMESTAMP, finished = ? WHERE ukey = ?;");
    $stmt->bind_param("is", $step, $user);
    $stmt->execute();

    if ($stmt->affected_rows < 1) {
        session_destroy();
        $stmt->close();
        $db->close();
        header("Location: step1.php?msg=Error");
        die();
    }

    $stmt->close();
    $stmt = $db->prepare("INSERT INTO uhistory(ukey, udate, step) VALUES (?, CURRENT_TIMESTAMP, ?);");
    $stmt->bind_param("si", $user, $step);
    $stmt->execute();

    if ($stmt->affected_rows < 1) {
        session_destroy();
        $stmt->close();
        $db->close();
        header("Location: step1.php?msg=Error");
        die();
    }

    $stmt->close();
    $db->close();

}

function checkFlow($step, $user) {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/connect.php";
    $db = connect();

    $stmt = $db->prepare("SELECT max(step) from uhistory WHERE ukey = ?;");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $stmt->bind_result($finished);
    $res = $stmt->fetch();
    if (!$res) {
        $finished = 0;
    }


    if ($finished != $step - 1) {
        $stmt->close();
        $db->close();
        header("Location: step" . ($finished + 1) . ".php");
        die();
    }
    $stmt->close();
    $db->close();
}
