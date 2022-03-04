<?php
session_start();
require_once "includes/checkpoint.php";
$step = 4;

checkFlow($step, $_SESSION['user']);

saveStep($_SESSION['user'], $step);

header("Location: step" . ($step + 1) . ".php");
die();
