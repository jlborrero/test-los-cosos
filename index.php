<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Test">
    <title>Test</title>
    <link rel="stylesheet" href="css/Style.css">
    <style>
        span.stars, span.stars span {
            display: block;
            background: url(images/stars_blue.png) 0 -25px repeat-x;
            width: 125px;
            height: 25px;
        }

        span.stars span {
            background-position: 0 0;
        }
    </style>
    <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript">
        $.fn.stars = function () {
            return $(this).each(function () {
                var val = parseFloat($(this).html());
                var size = Math.max(0, (Math.min(5, val))) * 25;
                var $span = $('<span />').width(size);
                $(this).html($span);
            });
        }
    </script>
</head>
<body>
<?php
$str_datos = file_get_contents("http://los-cosos.appspot.com/api/apply_detail.json");
$datos = json_decode(utf8_decode($str_datos), true);
?>
<div class="contenido">
    <section class="post">
        <article>
            <header>
                <div class="color_azul cabecera"> &nbsp;</div>
            </header>
            <div class="contenido_article">
                <figure>
                    <img class="img_contenido" src="<?php echo $datos['_wp_attached_file'] ?>">
                </figure>
                <h3><?php echo $datos['post_title'] ?></h3>
                <span class="stars"><?php echo $datos['rating_average'] ?></span>

                <div class="comentarios">
                    <div class="nube izq">
                        <p class="cant_comentario"><?php echo $datos['comment_count'] ?></p>
                    </div>
                    <p class="izq comentario">
                        <strong>Comentario<?php echo ($datos['comment_count'] > 1) ? "s" : "" ?></strong></p>
                </div>
                <p class="descripcion"><strong><?php echo $datos['post_excerpt'] ?></strong></p>
                    <a class="enlace" href="<?php echo $datos['permalink'] ?>">Enlace al post</a>

            </div>

            <footer>
                <div class="color_azul footer">&nbsp;</div>
            </footer>
        </article>
    </section>
</div>
<script type="text/javascript">
    $(function () {
        $('span.stars').stars();
    });
</script>
</body>
</html>