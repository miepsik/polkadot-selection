<?php
session_start();
$user = $_SESSION['user'];
$placebo = $_SESSION['placebo'];
require_once "connect.php";
require_once "includes/headerRow.php";
$withSelect = FALSE;
function getRow($data, $i, $a) {
    if (in_array($data[0], $a)) {
        $output = "<tr data-coil=\"{$data[0]}\" role=\"row\" aria-rowindex=\"{$i}\">";
        for ($j = 0; $j < 6; $j++) {
            $output .= "<td aria-colindex=\"{$j}\" role=\"cell\" class=\"d-none d-sm-none d-md-none d-lg-table-cell d-xl-table-cell\">{$data[$j+1]}</td>";
        }
        $output .= "</tr>";
        return $output;
    } else
        return "";
}

function printOptions($options, $id) {
    foreach ($options as $opt) {
        echo "<input type=\"radio\" id=\"{$opt}{$id}\" name=\"q{$id}\" value=\"{$opt}\" required>
                    <label for=\"{$opt}{$id}\">{$opt}</label><br>";
    }
}

$db = connect();
$stmt = $db->prepare("SELECT s1, s2, s3, s4, s5, s6, s7 FROM proposed where user = ?");
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result(); // get the mysqli result
$proposed = $result->fetch_assoc(); // fetch data
$stmt->close();

?>

<?php $step = 6; ?>
<?php include("includes/header.php"); ?>

<!-- custom js -->
<script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>

<?php $hero_title = 'Questionnaire'; ?>
<?php $hero_desc = 'In this part, we would like to ask you a few more questions. Please note, that your answers are anonymous and we do not link them to your identity.'; ?>
<?php include("includes/hero.php"); ?>
<?php require_once "includes/checkpoint.php"; ?>
<?php checkFlow($step, $_SESSION['user'])?>
<form id="questionnaire" action="checkpoint6.php" type="post">

<section class="bg-dark">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10 col-lg-6 col-xl-6 text-center">
                <h2 class="h1 text-white font-weight-bold text-">Part 1: The Selection Process</h2>
                <p class="text-white">In this section we want to learn more about how you perceived the different stages of the selection.</p>
            </div>
        </div>
        <div class="row mt-5 mb-5">
            <div class="col">
            <h5 class="font-weight-bold text-primary text-center">This was the final recommendation of the algorithm</h5>
            </div>
        </div>
        <div class="row mt-5 mb-5">
            <div class="col">
                <table class="table b-table table-hover table-dark sortable width-auto" aria-rowcount="5"
                    aria-busy="false"
                    role="table"
                    aria-colcount="6">
                    <thead role="rowgroup">
                    <tr role="row">
                        <?php printHeaders(getHeaders()) ?>
                    </tr>
                    </thead>
                    <tbody role="rowgroup">
                    <?php
                    $df = array();
                    $i = -2;
                    if (($handle = fopen("validators2.csv", "r")) !== FALSE) {
                        while (($data = fgetcsv($handle, 5000, ",")) !== FALSE) {
                            if (++$i < 0) continue;
                            echo getRow($data, $i, $proposed);
                            $df[] = $data;
                        }
                        fclose($handle);
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<section class="bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10 col-lg-7">
                <h3 class="my-4">How well does the recommendation suit your preferences?*</h3>

                <?php printOptions(array("Very well", "To some extend", "Not very well", "Not at all"), 1); ?>

                <h3 class="my-4">If you would have to evaluate the effort that it took for manual selection (Part A)?*</h3>
                <?php printOptions(array("Very easy", "Easy", "Medium", "Hard", "Very hard"), 2); ?>

                <?php if ($_SESSION['type'] != 'random'):?>
                <h3 class="my-4">If you would have to evaluate the effort that it took for the pairwise comparisons (Part B)?*</h3>
                <?php printOptions(array("Very easy", "Easy", "Medium", "Hard", "Very hard"), 3); ?>


                <h3 class="my-4">Which method would you prefer having the choice?*</h3>
                <?php printOptions(array("Manual", "Rather manual", "I don't know", "Rather algorithm", "Algorithm"), 4); ?>


                <h3 class="my-4">Why</h3>
                <textarea name="q5" maxlength="300" form="questionnaire" style="width: 100%; min-height: 200px; padding: 20px;" placeholder="Enter text here..."></textarea>
                <?php endif;?>
            </div>
        </div>
    </div>
</section>

<section class="bg-dark">
    <div class="container">
    <div class="row justify-content-center">
            <div class="col-10 col-lg-6 col-xl-6 text-center">
            <h2 class="h1 text-white font-weight-bold"> Part 2: Your Background </h2>
            <p class="text-white">In this section we would like to learn more about your background in the crypto space.</p>
            </div>
        </div>
    </div>
</section>


<section class="bg-white">
    <div class="container">
    <div class="row justify-content-center">
            <div class="col-10 col-lg-7">
                <h3 class="my-4">Are you currently staking any DOT or KSM?*</h3>
                <?php printOptions(array("Yes", "No"), 6); ?>

                <div id="optional1" style="display: none">
                <h5 class="my-4 text-secondary">Please estimate how much of your total staked funds (in percent) you hold at custodial staking
                    services (for example exchanges).*</h5>
                <input type="number" max="100" min="0" id="q7" placeholder="0-100%" class="p-3 border-0 rounded-lg col-3 mr-2 bg-light">
                </div>


                <h3 class="my-4">Are you currently staking any other token than DOT or KSM?*</h3>
                <?php printOptions(array("Yes", "No"), 8); ?>

                <div id="optional2" style="display: none">
                <h5 class="my-4 text-secondary">Please estimate how much of your total staked funds (in percent) you hold at custodial staking
                    services (for example exchanges).*</h5>
                <input type="number" max="100" min="0" id="q9" placeholder="0-100%" class="p-3 border-0 rounded-lg col-3 mr-2 bg-light">
                </div>

                <h3 class="my-4">How often do you nominate validators yourself on Polkadot?*</h3>
                <?php printOptions(array("Daily", "Weekly", "Monthly", "Once per several months", "Once per year", "Never"), 10); ?>

                <h3 class="my-4">How often do you open polkadot.js.org/apps?*</h3>
                <?php printOptions(array("Daily", "Weekly", "Monthly", "Once per several months", "Once per year", "Never"), 11); ?>

                <h3 class="my-4">How do you rate the current staking experience on Polkadot?*</h3>
                <?php printOptions(array("Very good", "Good", "Not so good", "Very bad"), 12); ?>

                <h3 class="my-4">How do you rate the current staking experience on other networks?*</h3>
                <?php printOptions(array("Very good", "Good", "Not so good", "Very bad"), 13); ?>

                <h3 class="my-4">How well do you think you understand Polkadot?*</h3>
                <?php printOptions(array("Very well", "To some extend", "Not very well", "Not at all"), 14); ?>

                <h3 class="my-4">How long have you held crypto-currencies in general?*</h3>
                <?php printOptions(array("Less than 1 month", "Between 1 to 6 months", "Between 6 to 12 months",
                    "Between 1-2 years", "Between 2-3 years", "More than 3 years"), 15); ?>
            </div>
        </div>
    </div>
</section>

<section class="bg-dark">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10 col-lg-6 col-xl-6 text-center">
                <h2 class="h1 text-white font-weight-bold"> Part 3: Your Feedback </h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-10 col-lg-7">
                <h5 class="my-4 text-white text-center">Do you have any ideas how to further improve the staking experience on Polkadot?</h5>
                <textarea name="q16" maxlength="300" form="questionnaire" style="width: 100%; min-height: 200px; padding: 20px;" placeholder="Enter text here..."></textarea>

                <h5 class="my-4 text-white text-center">Do you have any comments with regard to this study?</h5>
                <textarea name="q17" maxlength="300" form="questionnaire" style="width: 100%; min-height: 200px; padding: 20px;" placeholder="Enter text here..."></textarea>
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
                <p>Thank you very much for completing the questionnaire. Please be assured that your answers are
                    anonymous.</p>
            </div>
        </div>
        <div class="row">
            <div class="col d-flex justify-content-center">
                <button type="submit" class="btn btn-lg btn-primary btn-white" formmethod="post" formaction="checkpoint6.php">Next</button>
            </div>
        </div>
    </div>
</section>
</form>

<script type="text/javascript">
    var optionA = document.getElementById("Yes6");
    var optionB = document.getElementById("No6");
    var question = document.getElementById("optional1");

    function toogle1() {
        if (optionA.checked) {
            question.style.display = "";
            document.getElementById("q7").required = true;
        } else {
            question.style.display = "none";
            document.getElementById("q7").required = false;

        }
    }
    optionA.addEventListener("click", toogle1, false);
    optionB.addEventListener("click", toogle1, false);


    var optionA2 = document.getElementById("Yes8");
    var optionB2 = document.getElementById("No8");
    var question2 = document.getElementById("optional2");

    function toogle2() {
        if (optionA2.checked) {
            question2.style.display = "";
            document.getElementById("q9").required = true;
        } else {
            question2.style.display = "none";
            document.getElementById("q9").required = false;
        }
    }
    optionA2.addEventListener("click", toogle2, false);
    optionB2.addEventListener("click", toogle2, false);

</script>

<?php include("includes/footer.php"); ?>
