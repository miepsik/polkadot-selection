<?php session_start(); ?>
<?php $step = 3; ?>
<?php include("includes/header.php"); ?>

<!-- custom js -->
<script type="text/javascript" src="/custom/js/customSelection1.js"></script>
<script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>

<?php $hero_title = 'Selection A'; ?>
<?php $withSelect = TRUE; ?>
<?php $hero_desc = 'On this page, we show you a list of the current validators (anonymized) and would like you to select 7 validators that match your preferences. As mentioned before, there is no right or wrong, we want you to select the validators as you would normally do.'; ?>
<?php include("includes/hero.php"); ?>
<?php require 'includes/headerRow.php'; ?>

<?php 
require_once "includes/checkpoint.php"; ?>
<?php 
checkFlow($step, $_SESSION['user'])?>

<section class="bg-dark">
    <div class="container">
        <div class="row">
            <div class="col col-lg-6">
                <h2 class="text-white font-weight-bold">
                    INSTRUCTIONS
                </h2>
                <p>
                    Please select 7 validators that match your preferences. You can click on the column names to sort. Once you selected exactly seven validators, please click
                    “next” at the bottom of the screen to continue.
                </p>
            </div>
        </div>
    </div>
</section>


<section class="bg-white">
    <div class="container">
        <div class="row">
            <div class="col mb-4"><h3>Table values</h3></div>
        </div>
        <div class="row">
                <?php
                $desc = array(
                "Commission" => "How much the validator is charging for their services. A lower commission, 
                all other criteria being equal, means more reward for the nominator. A higher commission of an 
                active validator indicates more skin-in-the-game of that validator because they would miss more 
                future rewards for getting slashed.",
                "Self Stake" => "The amount of DOT that the validator is using to nominate themselves. 
                Since this amount is slashable, a higher amount generally means that the validator has more 
                skin-in-the-game.",
                "Total Stake" => "The total amount of DOT that the validator is staking. 
                All other criteria being equal, a lower total stake means that your stake has a larger share 
                and increases your payoff.",
                "Era Points" => "The total rewards to all validators is distributed based on the 
                relative share of the era-points of one validator compared to other validators. 
                Should be similar over time but can fluctuate based on the infrastructure and location 
                of a validator.",
                "Cluster Size" => "The number of (known) validators that are operated by the same entity. 
                A higher number might indicate higher proficiency but could also indicate more centralization 
                and a higher risk of getting slashed.",
                "Voters" => "The number of nominators that are voting for a validator. 
                Could be regarded as a sign of popularity.",
                );

                foreach ($desc as $key => $value) {
                    echo "<div class=\"col-12 col-mg-6 col-lg-4 mb-4 pr-3\"><h5 class=\"font-weight-bold\">{$key}</h5><p>{$value}</p></div>";
                }
                ?>
        </div>
    </div>
</section>

        
<section class="bg-dark">
    <div class="container">
        <div class="row">
            <div class="col">
                <div id="placeholder">
                <table class="table b-table table-hover table-dark sortable width-auto" aria-rowcount="5" aria-busy="false"
                    role="table"
                    aria-colcount="7">
                    <thead role="rowgroup">
                    <tr role="row">
                        <?php
                        $columns = getHeaders();
                        $columns[] = '';
                        printHeaders($columns)

                        ?>

                    </tr>
                    </thead>
                    <tbody role="rowgroup">
                    <?php
                    function getRow($data, $i) {
                        $output = "<tr id=\"{$data[0]}\" role=\"row\" aria-rowindex=\"{$i}\">";
                        for ($j = 0; $j < 6; $j++) {
                            $output .= "<td aria-colindex=\"{$j}\" role=\"cell\" class=\"d-none d-sm-none d-md-none d-lg-table-cell d-xl-table-cell\">{$data[$j+1]}</td>";
                        }
                        $output .= "<td aria-colindex=\"6\" role=\"cell\" class=\"d-none d-sm-none d-md-none d-lg-table-cell d-xl-table-cell\"> <button id=\"b{$data[0]}\" onclick=\"select('{$data[0]}')\">Select</button> </td></tr>";
                        return $output;
                    }
                    $df = array();
                    $i = -2;
                    if (($handle = fopen("validators2.csv", "r")) !== FALSE) {
                        while (($data = fgetcsv($handle, 5000, ",")) !== FALSE) {
                            if (++$i < 0) continue;
                            echo getRow($data, $i);
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
    </div>
</section>

<section>
    <div class="container">
        <div class="row mb-5">
            <div class="col col-lg-6 text-white">
                <h2 class="font-weight-bold text-white">
                GO TO THE NEXT STEP
                </h2>
                <p>Thank you very much for your choices. After you selected seven validators, you can continue to the next part of the study.</p>
            </div>
        </div>
        <div class="row">
            <div class="col d-flex justify-content-center">
                <button id="submit_step_3" class="btn btn-lg btn-primary btn-white" onclick="proceed();" disabled>Next</button>
            </div>
        </div>
    </div>
</section>

<?php include("includes/footer.php"); ?>
