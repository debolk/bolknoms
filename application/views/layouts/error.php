<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <title>bolknoms</title>

        <link rel="stylesheet" href="/stylesheets/jquery-ui.css" type="text/css"/>
        <link rel="stylesheet" href="/stylesheets/application.css" type="text/css"/>

        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />

        <base href="<?php echo URL::base(true,true); ?>" />
    </head>
   <body class="<?php echo strtolower(Request::$current->controller()); ?> <?php echo Request::$current->action(); ?>">
        <div id="container" class="clearfix">
            <div class="content clearfix">
                <?php echo $content; ?>
            </div>
        </div>
    <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-445432-25']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    </script>
    </body>
</html>
