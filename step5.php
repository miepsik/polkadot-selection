<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

$user = $_SESSION['user'];
$withSelect = TRUE;
require_once "connect.php";
require_once "includes/headerRow.php";


function getRow($data, $i, $a, $b) {
    $ina = in_array($data[0], $a);
    $inb = in_array($data[0], $b);
    if ($ina || $inb) {
        $output = "<tr data-coil=\"{$data[0]}\" role=\"row\" aria-rowindex=\"{$i}\">";
        $type = "";
        if ($ina) {
            $type .= "A";
        }
        if ($inb) {
            $type .= "B";
        }
        $output .= "<td aria-colindex=\"{-1}\" role=\"cell\" class=\"d-none d-sm-none d-md-none d-lg-table-cell d-xl-table-cell\">{$type}</td>";
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

<!-- custom js -->
<script type="text/javascript" src="/custom/js/customSelection3.js"></script>
<script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>

<?php $hero_title = 'Final Selection'; ?>
<?php $hero_desc = 'In this stage, we would like to ask you to make a final choice of your preferred validators. Be aware that your participation reward will be staked with those validators, before you receive it. Pease select 7 validators in total.'; ?>
<?php include("includes/hero.php"); ?>
<?php require_once "includes/checkpoint.php"; ?>
<?php checkFlow($step, $_SESSION['user'])?>

<section class="bg-dark">
    <div class="container">
        <div class="row mb-5">
            <div class="col col-lg-6">
                <h2 class="text-white font-weight-bold">
                INSTRUCTIONS
                </h2>
                <p>This table lists all validators from the Part A (your manual selection) and the Part B (algorithm recommendation). The column "Selection" indicates from which part of the study they were selected. In the case that a validator is in both selections, it is marked as "AB".</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table b-table table-hover table-dark sortable width-auto" aria-rowcount="5" aria-busy="false"
                    role="table"
                    aria-colcount="6">
                    <thead role="rowgroup">
                    <tr role="row">
                        <?php
                            $columns = getHeaders();
                            array_unshift($columns , 'Selection');
                            $columns[] = '';
                            printHeaders($columns)

                        ?>
                    </tr>
                    </thead>
                    <tbody role="rowgroup">
                    <?php
                    $df = array();
                    $i = -2;
                    if (($handle = fopen("validators2.csv", "r")) !== FALSE) {
                        while (($data = fgetcsv($handle, 5000, ",")) !== FALSE) {
                            if (++$i < 0) continue;

                            $df[] = $data;
                        }
                        fclose($handle);
                        shuffle($df);
                        $i = 0;
                        foreach ($df as $data) {
                            echo getRow($data, $i, $selected, $proposed);
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

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
                <button id="submit_step_5" class="btn btn-lg btn-primary btn-white" onclick="proceed()" class="btn btn-info" role="button" disabled>Next</button>
            </div>
        </div>
    </div>
</section>

<?php include("includes/footer.php"); ?>
