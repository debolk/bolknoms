<h1>Administratie</h1>

<?php echo Flash::display_messages(); ?>

<a href="administratie/nieuwe_maaltijd">
    <img src="/images/add.png" alt="" />
    Nieuwe maaltijd toevoegen
</a>

<h2>Komende maaltijden</h2>
<?php echo View::factory('administratie/_meals',array('meals' => $upcoming_meals)); ?>

<h2>Afgelopen maaltijden</h2>
<?php echo View::factory('administratie/_meals',array('meals' => $previous_meals)); ?>

<p class="navigation">
    <a href="/inschrijven">&lsaquo; Terug naar inschrijven</a>
</p>