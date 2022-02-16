<?php $step = 1; ?>
<?php include("includes/header.php"); ?>

<section class="bg-white">
    <div class="container">
        <div class="row mb-5">
            <div class="col col-lg-6">
                <div class="title center">
                    <h1 class="font-weight-bold">LOGIN</h1>
                </div>
                <div class="note">
                    <p>To start the study, please insert your individual participation code that you received and note, that it
                        is not allowed to share your participation code with others. During this study, you can earn a reward
                        based on your choices. Please read all the instructions carefully. It is only possible to participate by
                        using a web-browser on a computer.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <form action="codeCheck.php" method="post">
                    <input id="code" name="code" value="Code">
                    <input type="submit" value="Submit">
                </form>
            </div>
        </div>
    </div>
</section>

<?php include("includes/footer.php"); ?>
