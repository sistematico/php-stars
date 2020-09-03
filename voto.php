<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['reset']) && !empty($_POST['reset'])) {
        $reset = [
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0
        ];

        file_put_contents('votos.json', json_encode($reset));
    }
    extract($_POST);
    $novo = ++$votos[$voto];
    $votos[$voto] = $novo;
    file_put_contents('votos.json', json_encode($votos));
    var_dump($votos);
}

$votos = json_decode(file_get_contents("votos.json"), true);
$totalStars = 0;
$voters = array_sum($votos);

foreach ($votos as $stars => $votes) {
    $totalStars += (int) $stars * $votes;
}

echo ($totalStars/$voters);

?>