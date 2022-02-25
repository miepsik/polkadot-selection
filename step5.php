<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

$user = $_SESSION['user'];
$withSelect = TRUE;
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
$stmt = $db->prepare("SELECT s1, s2, s3, s4, s5, s6, s7 FROM selected where user = ?");
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result(); // get the mysqli result
$selected = $result->fetch_assoc(); // fetch data
$stmt->close();

$stmt = $db->prepare("SELECT s1, s2, s3, s4, s5, s6, s7 FROM proposed where user = ?");
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result(); // get the mysqli result
$proposed = $result->fetch_assoc(); // fetch data
$stmt->close();
$manualFirst = (bool)random_int(0, 1);
?>

<?php $step = 5; ?>
<?php include("includes/header.php"); ?>

<?php $hero_title = 'Selection C'; ?>
<?php $hero_desc = 'In this stage, we would like to ask you to make a final choice of your preferred validators. Pease select 7 validators in total. You are free to select from both tables. In the case that one validator is present in both tables, both are highlighted at once.'; ?>
<?php include("includes/hero.php"); ?>

<!-- custom js -->
<script type="text/javascript" src="/custom/js/customSelection3.js"></script>


<?php if ($manualFirst): ?>
<section class="bg-dark">
    <div class="container">
        <div class="row mb-5">
            <div class="col col-lg-6">
                <h2 class="text-white font-weight-bold">
                MANUAL SELECTION
                </h2>
                <p>This table is the selection from Selection A in the first stage of the study.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6">
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
                            echo getRow($data, $i, $selected);
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


<?php endif ?>

<section class="bg-dark">
    <div class="container">
        <div class="row mb-5">
            <div class="col col-lg-6">
                <h2 class="text-white font-weight-bold">
                ALGORITHM SELECTION
                </h2>
                <p>This table is the recommendation of our algorithm.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6">
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
            </div>
        </div>
    </div>
</section>

<?php if (!$manualFirst): ?>
    <section class="bg-dark">
        <div class="container">
            <div class="row mb-5">
                <div class="col col-lg-6">
                    <h2 class="text-white font-weight-bold">
                        MANUAL SELECTION
                    </h2>
                    <p>This table is the selection from Selection A in the first stage of the study.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
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
                                echo getRow($data, $i, $selected);
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


<?php endif ?>

<section>
    <div class="container">
        <div class="row mb-5">
            <div class="col col-lg-6 text-white">
                <h2 class="font-weight-bold text-white">
                SUBMIT YOUR SELECTIONS
                </h2>
                <p>Thank you very much for your choices.</p>
                <p>Please note, that you cannot change your final selection after you submitted this page. </p>
            </div>
        </div>
        <div class="row">
            <div class="col d-flex justify-content-center">
                <button class="btn btn-lg btn-primary btn-white" onclick="proceed()" class="btn btn-info" role="button">Next</button>
            </div>
        </div>
    </div>
</section>

<?php include("includes/footer.php"); ?>
