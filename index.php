<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Descrição">
    <meta name="author" content="Autor do site">
    <title>PHP Stars Rating</title>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css"> -->
    <!-- <link rel="shortcut icon" href="img/favicon.ico"> -->
    <style>

main {
  display: flex;
  align-items: center;
  justify-content: center;
}

.container {
  max-width: 50%;
}

.Aligner-item--top {
  align-self: flex-start;
}

.Aligner-item--bottom {
  align-self: flex-end;
}


        span.stars, span.stars>* {
            display: inline-block;
            background: url(estrela.png) 0 -16px repeat-x;
            width: 80px;
            height: 16px;
        }
        span.stars>*{
            max-width: 80px;
            background-position: 0 0;
        }
    </style>
</head>
<body>
    <main>
        <div class="container">
            <h1 class="title">Sistema de Classificação</h1>
            <p class="subtitle">Clique em uma estrela e avalie.</p>

            <span class="stars">0.6</span>

            <h4>Média: <span class="media">0</span></h4>            
            <h4>Total: <span class="total">0</span></h4>
            <button>RESET</button>
            <h4>JSON</h4>
            <pre class="json"></pre>
            <br />
            Fontes no <a href="https://github.com/sistematico/php-stars">Github</a>.
        </div>
    </main>
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