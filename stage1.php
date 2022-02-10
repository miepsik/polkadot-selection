<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="custom/styles/css1.css">
    <link rel="stylesheet" href="custom/styles/custom.css">

</head>
<body>
<script src="jquery-3.6.0.min.js"></script>
<script src="custom/js/customSelection.js"></script>
<script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>

<div class="header">
    <div class="row">

        <h1>Stage 1</h1>
        <div class="note">
            <p>On this page, we show you a list of the current validators (anonymized) and would like you to select
                seven
                validators that match your preferences. As mentioned before, there is no right or wrong, we want you to
                select the validators as you would normally do.</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="header-note">
        <h3>
            Selection
        </h3>
        <div class="note">
            Please select seven validators that match your preferences. You can click on the column names to sort. Click
            “next” at the bottom of the screen when you are finished.
        </div>
    </div>
    <div id="placeholder">
        <table class="table b-table table-hover table-dark sortable width-auto" aria-rowcount="5" aria-busy="false"
               role="table"
               aria-colcount="7">
            <thead role="rowgroup">
            <tr role="row">
                <th role="columnheader" scope="col" tabindex="0" aria-colindex="0"
                    class="text-center d-none d-sm-none d-md-none d-lg-table-cell d-xl-table-cell cursor-pointer">
                    <div>commission_percent</div>
                </th>
                <th role="columnheader" scope="col" tabindex="0" aria-colindex="1"
                    class="text-center d-none d-sm-none d-md-none d-lg-table-cell d-xl-table-cell cursor-pointer">
                    <div>self_stake</div>
                </th>
                <th role="columnheader" scope="col" tabindex="0" aria-colindex="2"
                    class="text-center d-none d-sm-none d-md-none d-lg-table-cell d-xl-table-cell cursor-pointer">
                    <div>total_stake</div>
                </th>
                <th role="columnheader" scope="col" tabindex="0" aria-colindex="3"
                    class="text-center d-none d-sm-none d-md-none d-lg-table-cell d-xl-table-cell cursor-pointer">
                    <div>voters</div>
                </th>
                <th role="columnheader" scope="col" tabindex="0" aria-colindex="4"
                    class="text-center d-none d-sm-none d-md-none d-lg-table-cell d-xl-table-cell cursor-pointer">
                    <div>era_points</div>
                </th>
                <th role="columnheader" scope="col" tabindex="0" aria-colindex="5"
                    class="text-center d-none d-sm-none d-md-none d-lg-table-cell d-xl-table-cell cursor-pointer">
                    <div>cluster_size</div>
                </th>
                <th role="columnheader" scope="col" tabindex="0" aria-colindex="6"
                    class="text-center d-none d-sm-none d-md-none d-lg-table-cell d-xl-table-cell cursor-pointer">
                    <div>Select</div>
                </th>
            </tr>
            </thead>
            <tbody role="rowgroup">
            <?php
            function getRow($data, $i) {
                $output = "<tr id=\"{$data[0]}\" role=\"row\" aria-rowindex=\"{$i}\">";
                for ($j = 0; $j < 6; $j++) {
                    $output .= "<td aria-colindex=\"{$j}\" role=\"cell\" 
class=\"d-none d-sm-none d-md-none d-lg-table-cell d-xl-table-cell\">{$data[$j+1]}</td>";
                }
                $output .= "<td aria-colindex=\"6\" role=\"cell\" class=\"d-none d-sm-none d-md-none d-lg-table-cell d-xl-table-cell\">
                <button id=\"b{$data[0]}\" onclick=\"select('{$data[0]}')\">Select</button>
            </td></tr>";
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

    <div class="footer">
        <h3>
            GO TO THE NEXT STAGE
        </h3>
        <p>Thank you very much for your choices. Press “next” to reach Stage 2 of the study.
        </p>
        <button onclick="proceed()" class="btn btn-info" role="button">Next</button>
    </div>


</body>
</html>