<?php
session_start();
$user = $_SESSION['user'];
require "connect.php";

function getRow($data, $i, $a) {
    if (in_array($data[0], $a)) {
        $output = "<tr data-coil=\"{$data[0]}\" role=\"row\" aria-rowindex=\"{$i}\">";
        for ($j = 0; $j < 6; $j++) {
            $output .= "<td aria-colindex=\"{$j}\" role=\"cell\" class=\"d-none d-sm-none d-md-none d-lg-table-cell d-xl-table-cell\">{$data[$j+1]}</td>";
        }
        $output .= "<td aria-colindex=\"6\" role=\"cell\" class=\"d-none d-sm-none d-md-none d-lg-table-cell d-xl-table-cell\"> <button data-coil=\"b{$data[0]}\" onclick=\"select('{$data[0]}')\">Select</button> </td></tr>";
        return $output;
    } else
        return "";
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
                    <h2 class="font-weight-bold">This was the final recommendation of the algorithm</h2>

                    <table class="table b-table table-hover table-dark sortable width-auto" aria-rowcount="5" aria-busy="false"
                           role="table"
                           aria-colcount="6">
                        <thead role="rowgroup">
                        <tr role="row">
                            <?php include("includes/headerRow.php"); ?>
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

                    <h2>How well does the recommendation suit your preferences</h2>

                    <input type="range" min="1" max="7" value="3" class="slider" id="q1">


                    <h2>If you would have to evaluate the effort that it took for manual selection (Selection A)</h2>
                    <input type="range" min="1" max="7" value="3" class="slider" id="q2">


                    <h2>If you would have to evaluate the effort that it took for the algorithm (Selection B)</h2>
                    <input type="range" min="1" max="7" value="3" class="slider" id="q3">

                    <h2>Which method would you prefer having the choice</h2>
                    <input type="range" min="1" max="7" value="3" class="slider" id="q4">

                    <h2>Why</h2>
                    <textarea name="comment" form="questionnaire">Enter text here...</textarea>


                    

                    <input type="radio" id="custom" name="fav_language" value="Custom">
                    <label for="custom">Custom</label><br>
                    <input type="radio" id="model" name="fav_language" value="Model">
                    <label for="model">Model</label><br>
                    <input type="radio" id="no" name="fav_language" value="Don't know">
                    <label for="no">Don't know</label>

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
