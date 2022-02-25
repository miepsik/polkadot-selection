<?php $step = 3; ?>
<?php include("includes/header.php"); ?>

<!-- custom js -->
<script type="text/javascript" src="/custom/js/customSelection1.js"></script>

<?php $hero_title = 'Selection A'; ?>
<?php $hero_desc = 'On this page, we show you a list of the current validators (anonymized) and would like you to select seven validators that match your preferences. As mentioned before, there is no right or wrong, we want you to select the validators as you would normally do.'; ?>
<?php include("includes/hero.php"); ?>

<section class="bg-dark">
    <div class="container">
        <div class="row mb-5">
            <div class="col col-lg-6">
                <h2 class="text-white font-weight-bold">
                    INSTRUCTIONS
                </h2>
                <p>
                    Please select <b> seven </b> validators that match your preferences. You can click on the column names to sort. Once you selected exactly seven validators, please click
                    “next” at the bottom of the screen to continue.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div id="placeholder">
                <table class="table b-table table-hover table-dark sortable width-auto" aria-rowcount="5" aria-busy="false"
                    role="table"
                    aria-colcount="7">
                    <thead role="rowgroup">
                    <tr role="row">
                        <?php include("includes/headerRow.php"); ?>

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
                <button class="btn btn-lg btn-primary btn-white" onclick="proceed();">Next</button>
            </div>
        </div>
    </div>
</section>

<?php include("includes/footer.php"); ?>
