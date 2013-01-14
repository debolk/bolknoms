<h1>Administratie</h1>

<?php echo Flash::display_messages(); ?>

<p>
  <a href="administratie/nieuwe_maaltijd">
    <img src="/images/add.png" alt="" />
    Nieuwe maaltijd toevoegen
  </a>
</p>

<form action="" method="get">
  <p>
    Toon
    <?php echo Form::select('count', array('5' => '5', '13' => '13', '25' => '25', '100' => '100', '0' => 'alle'), Arr::get($_GET, 'count', 10), array('id' => 'count')); ?> 
    maaltijden per lijst
  </p>
</form>

<h2>Komende maaltijden</h2>
<?php echo View::factory('administratie/_meals',array('meals' => $upcoming_meals)); ?>

<h2>Afgelopen maaltijden</h2>
<?php echo View::factory('administratie/_meals',array('meals' => $previous_meals)); ?>

<?php echo View::factory('layouts/_navigation'); ?>