<?php
session_start();
?>

<?php $step = 4; ?>
<?php include("includes/header.php"); ?>

<!-- custom js -->
<script type="text/javascript" src="/custom/js/customSelection2.js"></script>

<!-- custom css -->
<style>
    /* hide data dump */
    table.dataframe {display: none;}
    #placeholder > #a1 { display: none; }
    #placeholder > #b1 { display: none; }
</style>

<?php $hero_title = 'Selection B'; ?>
<?php $hero_desc = 'In this stage, we use a process to create a recommendation of validators to you by applying an active learning algorithm that learns from your answers. In the following, we present you a choice between two validators and ask you to select the one that you prefer. We will ask you five of those pairwise comparisons in total.'; ?>
<?php include("includes/hero.php"); ?>

<section class="bg-dark">
    <div class="container">
        <div class="row mb-5">
            <div class="col col-lg-6">
                <h2 class="text-white font-weight-bold">
                INSTRUCTIONS
                </h2>
                <p>In the following, we present you a choice between two validators and ask you to select which of the two you prefer.</p>
                <p>SELECTION <span id="counter">1</span>/5</p>
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
                <a href="step5.php" class="btn btn-lg btn-primary btn-white" role="button">Next</a>
            </div>
        </div>
    </div>
</section>

<div id="user" style="display: none"><?php echo $_SESSION['user'] ?></div>
<?php include("includes/footer.php"); ?>
