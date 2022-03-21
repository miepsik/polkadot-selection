<?php
session_start();
?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
?>

<?php $step = 4; ?>
<?php include("includes/header.php"); ?>
<?php 
require_once "includes/checkpoint.php"; ?>
<?php 
checkFlow($step, $_SESSION['user'])?>

<!-- custom js -->
<script type="text/javascript" src="/custom/js/customSelection2.js"></script>

<!-- custom css -->
<style>
    /* hide data dump */
    #placeholder > #a1 { display: none; }
    #placeholder > #b1 { display: none; }
</style>

<?php $hero_title = 'Selection B'; ?>
<?php $hero_desc = 'In this stage, we use an algorithm to provide a recommendation of validators for you.'; ?>
<?php include("includes/hero.php"); ?>

<section class="bg-dark">
    <div class="container">
        <div class="row mb-5">
            <div class="col col-lg-6">
                <h2 class="text-white font-weight-bold">
                INSTRUCTIONS
                </h2>
                <p>In the following, we present you a choice between two validators and ask you to select which of the two you prefer. We ask you to answer five of those pairwise comparisons. Afterwards, the active learning algorithm selects the most suited validators from all available validators.</p>
            </div>
            <div class="col-12">
                <p class="font-weight-bold text-right">SELECTION <span id="counter">1</span>/5</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="selection">
                    <div id="placeholder">
                        <div id="a1"></div>
                        <div id="b1"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row mb-5">
            <div class="col col-lg-6 text-white">
                <h2 class="font-weight-bold text-white">
                GO TO THE NEXT STEP
                </h2>
                <p>Thank you very much for your choices. After you answered the above questions, you can continue to the next part of the study.</p>
            </div>
        </div>
        <div class="row">
            <div class="col d-flex justify-content-center">
                <a id="submit_step_4" href="checkpoint4.php" class="btn btn-lg btn-primary btn-white disabled" role="button">Next</a>
            </div>
        </div>
    </div>
</section>

<div id="user" style="display: none"><?php echo $_SESSION['user'] ?></div>
<div id="type" style="display: none"><?php echo $_SESSION['type'] ?></div>

<?php include("includes/footer.php"); ?>
