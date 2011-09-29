<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<!--[if lt IE 7]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class='no-js' lang='en'>
  <!--<![endif]-->
  <head>
    <meta charset='utf-8' />
    <meta content='IE=edge,chrome=1' http-equiv='X-UA-Compatible' />
    <title><?php
        if ($status == 'NULL_RESPONSE') {
            echo 'Пустой ответ сервера';
        }
        if ($status == 'WRONG_PARAMETERS') {
            echo 'Неверные параметры запроса';
        }
    ?></title>
    <meta content='' name='description' />
    <meta content='' name='author' />
    <meta content='width=device-width, initial-scale=1.0' name='viewport' />
    <link href='css/style.css?v=1' media='all' rel='stylesheet' />
    <script src='js/modernizr.min.js'></script>
    <script src='js/respond.min.js'></script>
  </head>
  <body class='error'>
    <div id='error-message'>
      <h1><?php
        if ($status == 'NULL_RESPONSE') {
            echo 'Пустой ответ сервера';
        }  
        if ($status == 'WRONG_PARAMETERS') {
            echo 'Неверные параметры запроса';
        }
      ?></h1>
      <p><?php
        if ($status == 'NULL_RESPONSE') {
            echo 'Ответ от сервера пустой. Вероятной причиной могут быть неверные параметры, запрещенный доступ к запрашиваемым данным, или неверные данные для аутентификации пользователя.';
        }
        if ($status == 'WRONG_PARAMETERS') {
            echo 'Переданы неверные параметры. Тщательно проверьте параметры, а также прочитайте документацию по работе с приземлением.';        
        }
      ?></p>
    </div>
    <script src='//ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.js'></script>
    <script type='text/javascript'>
      //<![CDATA[
        window.jQuery || document.write("<script src='js/jquery.min.js'>\x3C/script>")
      //]]>
    </script>
    <script src='js/script.js?v=1'></script>
    <script>
      center_message();
    </script>
  </body>
</html>
