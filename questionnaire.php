<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Selection</title>
    <link rel="stylesheet" href="custom/styles/css1.css">

</head>
<body>
<script src="jquery-3.6.0.min.js"></script>

<div class="header">
    <div class="row">

        <h1>Questionnaire</h1>
        <div class="note">
            <p>In this part, we would like to ask you a few more questions.
                Please note, that your answers are anonymous and we do not try to link them to your identity.</p>

        </div>
    </div>
</div>

<p>What do you prefer?</p>

<form>
    <input type="radio" id="custom" name="fav_language" value="Custom">
    <label for="custom">Custom</label><br>
    <input type="radio" id="model" name="fav_language" value="Model">
    <label for="model">Model</label><br>
    <input type="radio" id="no" name="fav_language" value="Don't know">
    <label for="no">Don't know</label>
</form>


<div class="footer">
    <h3>
        CONTINUE TO SEE YOUR DOT REWARD
    </h3>
    <p>Thank you very much for completing the questionnaire.</p>

    <p class="note">Please note, that you cannot change your answers after you submitted this page.</p>
    <a href="thank.php" class="btn btn-info" role="button">Next</a>
</div>


</body>
</html>