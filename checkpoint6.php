<?php
session_start();
require_once "includes/checkpoint.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/connect.php";

$step = 6;
$user = $_SESSION['user'];

print_r($_POST);

$db = connect();

foreach ($_POST as $key => $value) {
    $stmt = $db->prepare("INSERT INTO feedback VALUES (?, ?, ?);");
    $id = substr($key, 1);
    $stmt->bind_param("sis", $user, $id, $value);
    $stmt->execute();

    if ($stmt->affected_rows < 1) {
        session_destroy();
        $stmt->close();
        $db->close();
        header("Location: step1.php?msg=Error");
        die();
    }
    $stmt->close();
}

$db->close();

checkFlow($step, $_SESSION['user']);

saveStep($_SESSION['user'], $step);

header("Location: step" . ($step + 1) . ".php");
die();
