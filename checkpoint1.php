<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);

$code = $_POST['code'];

require_once $_SERVER['DOCUMENT_ROOT'] . "/connect.php";
require_once "includes/checkpoint.php";

$db = connect();

$stmt = $db->prepare("SELECT * from ukeys WHERE ukey = ?;");
$stmt->bind_param("s", $code);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows < 1) {
    $stmt->close();
    $db->close();
    header("Location: step1.php?msg=Invalid%20code");
    die();
}

$stmt->close();

$stmt = $db->prepare("SELECT * from users WHERE ukey = ? AND finished > 6;");
$stmt->bind_param("s", $code);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->close();
    $db->close();
    header("Location: step1.php?msg=Code%20already%20used");
    die();
}
$stmt->close();

$stmt = $db->prepare("SELECT * from users WHERE ukey = ? AND finished > 5");
$stmt->bind_param("s", $code);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->close();
    $db->close();
    header("Location: step1.php?msg=Code%20already%20used");
    die();
}
$stmt->close();

$stmt = $db->prepare("SELECT TIMESTAMPDIFF(MINUTE,udate,NOW()) from users WHERE ukey = ? and finished < 6 and date_add(udate, INTERVAL 30 minute) > CURRENT_TIMESTAMP ;");
$stmt->bind_param("s", $code);
$stmt->execute();
$stmt->bind_result($date);
$stmt->store_result();
$stmt->fetch();
$dif = 31 - $date;
if ($stmt->num_rows > 0) {
    $stmt->close();
    $db->close();
    header("Location: step1.php?msg=Code%20already%20used.%20Please%20wait%20" . $dif . "%20minutes%20to%20login%20again");
    die();
}
$stmt->close();

$stmt = $db->prepare("SELECT * from users WHERE ukey = ?");
$stmt->bind_param("s", $code);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows < 1) {
    $stmt->close();
    $stmt = $db->prepare("INSERT INTO users(ukey, udate, finished) VALUES(?, NOW(), ?)");
    $step = 0;
    $stmt->bind_param("si", $code, $step);
    $stmt->execute();
}
$stmt->close();
$db->close();

$_SESSION['user'] = $code;
$_SESSION['placebo'] = false;
saveStep($code, 1);
header("Location: step2.php");
die();

