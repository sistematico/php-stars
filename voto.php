<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $votos = json_decode(file_get_contents("votos.json"), true);
    $totalStars = 0;
    $voters = array_sum($votos);
    foreach ($votos as $stars => $votes) {
        $totalStars += $stars * $votes;
    }
    echo ($totalStars/$voters);
} //else 
//if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['voto']) && !empty($_POST['voto'])) {
    $votos = json_decode(file_get_contents("votos.json"), true);
    
    $key = 1;

    $atual = $votos[$key];

    echo ++$atual;

    //file_put_contents('votos.json', json_encode($ratings));

?>