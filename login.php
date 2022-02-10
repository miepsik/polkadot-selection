<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
<div class="row">
    <div class="col">
        <div class="title center">
            <h1>LOGIN</h1>
        </div>

        <div class="note">
            <p>To start the study, please insert your individual participation code that you received and note, that it
                is not allowed to share your participation code with others. During this study, you can earn a reward
                based on your choices. Please read all the instructions carefully. It is only possible to participate by
                using a web-browser on a computer. </p>
        </div>
    </div>
</div>

<div class="row">
    <form action="codeCheck.php" method="post">
        <input id="code" name="code" value="Code">
        <input type="submit" value="Submit">
    </form>

</div>

</body>
</html>
