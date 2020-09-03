<?php
// https://stackoverflow.com/questions/28028242/calculate-average-rating-of-5-ratings
// http://jsbin.com/IBIDalEn/2/edit?html,css,js,output
// https://jsfiddle.net/sistematico/1dnygksw/

$ratings = [
    1 => 220,
    2 => 31,
    3 => 44,
    4 => 175,
    5 => 3188
];

$totalStars = 0;
$voters = array_sum($ratings);
foreach ($ratings as $stars => $votes) {
    $totalStars += $stars * $votes;
}

//printf(
//    '%d voters awarded a total of %d stars to X, giving an average rating of %.1f',
//    $voters,
//    $totalStars,
//    $totalStars/$voters
//);

$media = $totalStars/$voters;

?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Descrição">
    <meta name="author" content="Autor do site">
    <title>PHP Stars Rating</title>
    <meta property="og:title" content="titulo" />
    <meta property="og:description" content="descrição" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://site.com" />
    <meta property="og:image" content="https://site.com/img/logo.png" />
    <link rel="stylesheet" href="css/main.css">
    <link rel="shortcut icon" href="img/favicon.ico">
    <style>
        span.stars, span.stars>* {
    display: inline-block;
    background: url(http://i.imgur.com/YsyS5y8.png) 0 -16px repeat-x;
    width: 80px;
    height: 16px;
}
span.stars>*{
    max-width:80px;
    background-position: 0 0;
}
    </style>
</head>
<body>
    Rating: <span class="stars">0.6</span>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>