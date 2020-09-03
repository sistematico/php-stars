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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">
    <!-- <link rel="shortcut icon" href="img/favicon.ico"> -->
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
    <section class="section">
        <div class="container">
            <h1 class="title">Sistema de Classificação</h1>
            <p class="subtitle">Clique em uma estrela e avalie.</p>

            Classificação: <span class="stars" style="margin:0; padding: 0;">0.6</span>

            <h2>Média</h2>
            <p class="media">0</p>

            <h2>Total</h2>
            <p class="total">0</p>

            <button>RESET</button>

            <h2>JSON</h2>
            <pre class="json"></pre>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        $(document).ready(function(e) {
            $.fn.stars = function() {
                return this.each(function(i,e){$(e).html($('<span/>').width($(e).text()*16));});
            };

            $('button').click(function(){
                $.ajax({
                    url: "voto.php",
                    method: "POST",
                    data: { reset: 'true' },
                    context: document.body,
                    dataType: "json"
                }).done(function(data) {
                    $('.stars').html(data.media);
                    $('.media').html(data.media.toFixed(1));
                    $('.total').html(data.total);
                    $('.stars').stars();
                });
            });

            $.ajax({
                    url: "voto.php",
                    method: "GET",
                    context: document.body,
                    dataType: "json"
            }).done(function(data) {
                $('.stars').html(data.media);
                $('.media').html(data.media.toFixed(1));
                $('.total').html(data.total);
                $('.stars').stars();
            });

            $('.stars').click(function(e){
                var posicao = $(this).position().left;
                var nivel = e.pageX - posicao;
                let porcentagem =  (100 * nivel) / $(this).width();
                let cinco = porcentagem / 20;
                let voto = cinco.toFixed(0);
                $.ajax({
                    url: "voto.php",
                    method: "POST",
                    data: { voto : voto },
                    context: document.body,
                    dataType: "json"
                }).done(function(data) {
                    $('.stars').html(data.media);
                    $('.media').html(data.media.toFixed(1));
                    $('.total').html(data.total);
                    $('.stars').stars();
                });
            });

            $('.stars').stars();

            setInterval(function() {
                $.ajax({
                    url: 'votos.json',
                    dataType: 'json'
                }).done(function(data) {
                    $('.json').html(JSON.stringify(data, undefined, 2));
                });
            },1000);

        });
    </script>
</body>
</html>