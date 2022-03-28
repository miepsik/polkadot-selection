<?php session_start(); ?>
<?php $step = 7; ?>
<?php include("includes/header.php"); ?>

<?php $date = strtotime("+30 day"); ?>
<?php require_once "includes/checkpoint.php"; ?>
<?php checkFlow($step, $_SESSION['user'])?>

<section class="bg-white">
    <div class="container">
        <div class="row mb-5">
            <div class="col col-lg-6">
                <h1 class="display-4 font-weight-bold">Thank You!</h1>
                <p>You receive a baseline reward of 2 DOT for participating in this study. As mentioned in the introduction, we use this reward to simulate staking rewards based on your final selection of validators. Since this amount is below the staking limit, we will track the average performance (and potential slashes) until the end of the study and thereby estimate your staking rewards theoretically. The final payout (baseline plus staking rewards) will be send to your specified address around the <?php echo date('M d, Y', $date);?>-. If you have any questions, please contact <a href="mailto:experiments@web3.foundation" class="font-weight-bold text-underline" target="_blank">experiments@web3.foundation</a>.</p>
                <p class="mt-5">You can close the webpage now.</p>
            </div>
        </div>
    </div>
</section>

<?php include("includes/footer.php"); ?>
