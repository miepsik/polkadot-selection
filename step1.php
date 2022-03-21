<?php session_destroy();?>
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
                <form action="checkpoint1.php" method="post">
                    <input id="code" name="code" placeholder="Code" class="p-3 border-0 rounded-lg col-3 mr-2 bg-light">
                    <input type="submit" value="Submit" class="p-3 border-0 rounded-lg mr-2 bg-black text-white cursor-pointer">
                </form>
            </div>
        </div>
        <div class="alert mt-4">
            <div class="text-primary">
                <?php if (isset($_GET['msg'])): ?>
                    <?php echo $_GET['msg']; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<div class="cookie-alert fixed-bottom alert alert-info bg-gradient">
    We only use strictly necessary cookies
    for the system features to verify if the user is logged in and has access to the
    different sections of the software. By closing this notice or continuing to explore
    our pages, you accept the use of these cookies.
</div>

<?php include("includes/footer.php"); ?>
