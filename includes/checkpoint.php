<?php
function checkFlow($step, $history) {
    $i = 0;
    while ($history[$i] > 0) $i++;
    if ($i < $step) {
        header("Location: step" . ($i+1) . ".php");
        die();

    }
}