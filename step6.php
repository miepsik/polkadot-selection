<?php $step = 6; ?>
<?php include("includes/header.php"); ?>

<?php $hero_title = 'Questionnaire'; ?>
<?php $hero_desc = 'In this part, we would like to ask you a few more questions. Please note, that your answers are anonymous and we do not try to link them to your identity.'; ?>
<?php include("includes/hero.php"); ?>

<section class="bg-white">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="font-weight-bold">What do you prefer?</h2>
                <form>
                    <input type="radio" id="custom" name="fav_language" value="Custom">
                    <label for="custom">Custom</label><br>
                    <input type="radio" id="model" name="fav_language" value="Model">
                    <label for="model">Model</label><br>
                    <input type="radio" id="no" name="fav_language" value="Don't know">
                    <label for="no">Don't know</label>
                </form>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row mb-5">
            <div class="col col-lg-6 text-white">
                <h2 class="font-weight-bold text-white">
                CONTINUE TO SEE YOUR REWARD INFORMATION
                </h2>
                <p>Thank you very much for completing the questionnaire.</p>
            </div>
        </div>
        <div class="row">
            <div class="col d-flex justify-content-center">
                <a href="step7.php" class="btn btn-lg btn-primary btn-white" role="button">Next</a>
            </div>
        </div>
    </div>
</section>

<?php include("includes/footer.php"); ?>
