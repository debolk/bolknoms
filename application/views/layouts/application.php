<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <title>Noms @ De Bolk</title>

        <link rel="stylesheet" href="/stylesheets/application.css" type="text/css"/>
        <style type="text/css" src="/javascripts/jquery.js"></style>
        <style type="text/css" src="/javascripts/application.js"></style>

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
