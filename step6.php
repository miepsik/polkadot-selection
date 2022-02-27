<?php
session_start();
$user = $_SESSION['user'];
require "connect.php";
require "includes/headerRow.php";
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
        echo "<input type=\"radio\" id=\"{$opt}{$id}\" name=\"q{$id}\" value=\"{$opt}\">
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

<?php $hero_title = 'Questionnaire'; ?>
<?php $hero_desc = 'In this part, we would like to ask you a few more questions. Please note, that your answers are anonymous and we do not try to link them to your identity.'; ?>
<?php include("includes/hero.php"); ?>

<section class="bg-white">
    <form id="questionnaire">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2>Part 1: The Selection Process</h2>
                    <div class="note">
                        In this section we want to learn more about how you perceived the different stages of the
                        selection.
                    </div>

                    <h3 class="font-weight-bold">This was the final recommendation of the algorithm</h3>

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

                    <h3>How well does the recommendation suit your preferences?</h3>

                    <input type="range" min="1" max="7" value="3" class="slider" id="q1" name="q1">


                    <h3>If you would have to evaluate the effort that it took for manual selection (Selection A)?</h3>
                    <input type="range" min="1" max="7" value="3" class="slider" id="q2" name="q2">


                    <h3>If you would have to evaluate the effort that it took for the algorithm (Selection B)?</h3>
                    <input type="range" min="1" max="7" value="3" class="slider" id="q3" name="q3">

                    <h3>Which method would you prefer having the choice?</h3>
                    <input type="range" min="1" max="7" value="3" class="slider" id="q4" name="q4">

                    <h3>Why</h3>
                    <textarea name="q5" form="questionnaire">Enter text here...</textarea>


                    <h2>Part 2: Your Background</h2>
                    <div class="note">
                        In this section we would like to learn more about your background in the crypto space.
                    </div>

                    <h3>Are you currently staking any DOT or KSM?</h3>
                    <?php printOptions(array("Yes", "No"), 6); ?>

                    <h3>IF YES: Please estimate how much of your total staked funds you hold at custodial staking
                        services (for example exchanges)</h3>
                    <input id="q7">

                    <h3>Are you currently staking any other token than DOT or KSM?</h3>
                    <?php printOptions(array("Yes", "No"), 8); ?>

                    <h3>IF YES: Please estimate how much of your total staked funds you hold at custodial staking
                        services (for example exchanges)</h3>
                    <input id="q9">


                    <h3>How often do you nominate validators yourself on Polkadot?</h3>
                    <?php printOptions(array("Daily", "Weekly", "Monthly", "Once per several months", "Once per year", "Never"), 10); ?>

                    <h3>How often do you open polkadot.js/apps?</h3>
                    <?php printOptions(array("Daily", "Weekly", "Monthly", "Once per several months", "Once per year", "Never"), 11); ?>

                    <h3>How do you rate the current staking experience on Polkadot?</h3>
                    <?php printOptions(array("Very good", "Good", "Not so good", "Very bad"), 12); ?>

                    <h3>How do you rate the current staking experience on other networks?</h3>
                    <?php printOptions(array("Very good", "Good", "Not so good", "Very bad"), 13); ?>

                    <h3>How well do you think you understand Polkadot?</h3>
                    <?php printOptions(array("Very well", "To some extend", "Not very well", "Not at all"), 14); ?>

                    <h3>How long have you held crypto-currencies in general?</h3>
                    <?php printOptions(array("Less than 1 month", "Between 1 to 6 months", "Between 6 to 12 months",
                        "Between 1-2 years", "Between 2-3 years", "More than 3 years"), 15); ?>

                    <h2>Part 3: Your Feedback</h2>

                    <h3>Do you have any ideas how to further improve the staking experience on Polkadot?</h3>
                    <textarea name="q16" form="questionnaire">Enter text here...</textarea>

                    <h3>Do you have any comments with regard to this study?</h3>
                    <textarea name="q17" form="questionnaire">Enter text here...</textarea>

                </div>
            </div>
        </div>
    </form>
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
                <a href="step7.php" class="btn btn-lg btn-primary btn-white" role="button">Next</a>
            </div>
        </div>
    </div>
</section>

<?php include("includes/footer.php"); ?>
