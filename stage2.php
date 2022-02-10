<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Polkadot</title>
    <link rel="stylesheet" href="custom/styles/css1.css">
</head>
<body>
<script src="jquery-3.6.0.min.js"></script>
<script src="custom/js/custom.js"></script>

<div class="header">
    <div class="row">

        <h1>Stage 2</h1>
        <div class="note">
            <p>In this stage, we use a process to create a recommendation of validators to you by applying an active
            learning algorithm that learns from your answers. In the following, we present you a choice between two
            validators and ask you to select the one that you prefer. We will ask you five of those pairwise comparisons
                in total.</p>

        </div>
    </div>
</div>

<div class="selection">

    <div class="selection-count">
        SELECTION <span id="counter"></span>
    </div>
    <div class="note">
        <p>In the following, we present you a choice between two validators and ask you to select which of the two you
            prefer.</p>
    </div>
    <div id="placeholder">
        <div id="a1"></div>
        <div id="b1"></div>
    </div>
    <div>
        <a href="stage3.php" class="btn btn-info" role="button">Next</a>
    </div>
    <div id="user" style="display: none"><?php echo $_SESSION['user'] ?></div>

</div>
</body>
</html>
