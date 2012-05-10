<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <title>BolkNoms</title>

        <link rel="stylesheet" href="/stylesheets/jquery-ui.css" type="text/css"/>
        <link rel="stylesheet" href="/stylesheets/application.css" type="text/css"/>

        <script type="text/javascript" src="/javascripts/jquery.js"></script>
        <script type="text/javascript" src="/javascripts/jquery-ui.js"></script>
        <script type="text/javascript" src="/javascripts/date-format.js"></script>
        <script type="text/javascript" src="/javascripts/application.js"></script>

        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />

        <base href="<?php echo URL::base(true,true); ?>" />
    </head>
    <body class="<?php echo Request::$current->controller(); ?> <?php echo Request::$current->action(); ?>">
        <div id="container" class="clearfix">
            <div class="content clearfix">
                <?php echo $content; ?>
            </div>
            <?php if (Kohana::$environment !== Kohana::PRODUCTION): ?>
                <div class="clearfix">
                    <?php echo View::factory('profiler/stats'); ?>
                </div>
            <?php endif; ?>
        </div>
        <div id="sidebar">
            <?php echo View::factory('front/_top'); ?>
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
