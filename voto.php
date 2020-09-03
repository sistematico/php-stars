<?php

// Read
$shipments = json_decode(file_get_contents("votos.json"), true);

// Write
$ratings = [
    1 => 220,
    2 => 31,
    3 => 44,
    4 => 175,
    5 => 3188
];

file_put_contents('votos.json', json_encode($json_data));

$totalStars = 0;
$voters = array_sum($ratings);
foreach ($ratings as $stars => $votes) {
    $totalStars += $stars * $votes;
}

echo ($totalStars/$voters);

?>