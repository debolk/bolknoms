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

        <base href="<?php echo URL::base(true,true); ?>" />
    </head>
    <body>
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
    </body>
</html>
