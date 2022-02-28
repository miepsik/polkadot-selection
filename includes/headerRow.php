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
    $desc = array(
        "Commission (in %)" => "How much the validator is charging for their services. A lower commission, 
    all other criteria being equal, means more reward for the nominator. A higher commission of an 
    active validator indicates more skin-in-the-game of that validator because they would miss more 
    future rewards for getting slashed.",
        "Self Stake (in DOT)" => "The amount of DOT that the validator is using to nominate themselves. 
    Since this amount is slashable, a higher amount generally means that the validator has more 
    skin-in-the-game.",
        "Total Stake (in DOT)" => "The total amount of DOT that the validator is staking. 
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
    $i = 0;
    foreach ($headers as $column) {
        if (strpos($column, "_") !== FALSE) {
            continue;
        }
        echo "<th role=\"columnheader\" scope=\"col\" tabindex=\"{$i}\" aria-colindex=\"{$i}\"
    class=\"text-center d-none d-sm-none d-md-none d-lg-table-cell d-xl-table-cell cursor-pointer\">
    <div>{$column}";
        if (array_key_exists($column, $desc)) {
            echo "<div class=\"tooltip\">&#x1F6C8;
  <span class=\"tooltiptext\">{$desc[$column]}</span>
</div>";
        }
        echo"</div>
</th>";
    }

}
