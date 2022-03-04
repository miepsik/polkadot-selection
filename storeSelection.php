<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(E_ALL);
$user = $_SESSION['user'];
print_r($_SESSION);

require_once $_SERVER['DOCUMENT_ROOT'] . "/connect.php";


$s = $_POST['selected'];
$t = $_POST['table'];
$db = connect();
print_r($s);
$stmt  = $db->prepare("INSERT into {$t} (User, s1,s2,s3,s4,s5,s6,s7) values (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $user, $s[0], $s[1], $s[2], $s[3], $s[4], $s[5], $s[6]);
$stmt->execute();
echo $stmt->affected_rows;
echo $stmt->error;
$stmt->close();
echo $db->error;
