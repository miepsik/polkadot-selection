<?php

function getHeaders() {
    if (($handle = fopen("validators2.csv", "r")) !== FALSE) {
        $headers = fgetcsv($handle, 5000, ",");
        fclose($handle);
        array_splice($headers, 0, 1);
        return $headers;
    }
    return array();
}

function printHeaders($headers) {
    $i = 0;
    foreach ($headers as $column) {
        if (strpos($column, "_") !== FALSE) {
            continue;
        }
        echo "<th role=\"columnheader\" scope=\"col\" tabindex=\"{$i}\" aria-colindex=\"{$i}\"
    class=\"text-center d-none d-sm-none d-md-none d-lg-table-cell d-xl-table-cell cursor-pointer\">
    <div>{$column}</div>
</th>";
    }

}
