<?php
if (($handle = fopen("validators2.csv", "r")) !== FALSE) {
    $data = fgetcsv($handle, 5000, ",");
    $i = 0;
    print_r($data);
    foreach ($data as $column) {
        if (strpos($column, "_") !== FALSE) {
            continue;
        }
        echo "<th role=\"columnheader\" scope=\"col\" tabindex=\"{$i}\" aria-colindex=\"{$i}\"
    class=\"text-center d-none d-sm-none d-md-none d-lg-table-cell d-xl-table-cell cursor-pointer\">
    <div>{$column}</div>
</th>";
    }
    echo "<th role=\"columnheader\" scope=\"col\" tabindex=\"0\" aria-colindex=\"6\"
    class=\"text-center d-none d-sm-none d-md-none d-lg-table-cell d-xl-table-cell cursor-pointer\">
    <div>Select</div>
</th>";

    fclose($handle);
}
