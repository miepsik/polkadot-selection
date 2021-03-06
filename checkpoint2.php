<?php
session_start();
require_once "includes/checkpoint.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/connect.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);

checkFlow(2, $_SESSION['user']);
print_r($_POST);

$user = $_SESSION['user'];
$polka = $_POST['polkadot_address'];
$email = $_POST['email'];
$agree = isset($_POST['agree']) ? $_POST['agree'] : false;

if ($agree !== "Yes") {
    header("Location: step2.php?msg=Accept%20conditions");
    die();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $stmt->close();
    $db->close();
    header("Location: step2.php?msg=Wrong%20email");
    die();
}

if ($polka[0] != "1" || strlen($polka) != 47) {
    $stmt->close();
    $db->close();
    header("Location: step2.php?msg=Wrong%20polkadot%20address");
    die();
}

$db = connect();
$stmt = $db->prepare("UPDATE users SET email=?, polkadot=? where ukey=?;");
$stmt->bind_param("sss", $email, $polka, $user);
$stmt-> execute();

if ($stmt->affected_rows < 1) {
    session_destroy();
    $stmt->close();
    $db->close();
    header("Location: step1.php?msg=Error");
    die();
}

$stmt->close();
$db->close();

saveStep($_SESSION['user'], 2);

header("Location: step3.php");
die();
