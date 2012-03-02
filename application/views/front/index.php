<?php echo View::factory('front/_introductie'); ?>

<h2>Snel aanmelden</h2>
<div class="section">
    <p>
        Met snel aanmelden, meld je je direct aan voor de maaltijd van vandaag. 
        Je krijgt geen e-mail ter bevestiging en je kunt je niet meer afmelden.
        Je kunt ook gebruik maken van <a href="/uitgebreid-inschrijven">uitgebreid aanmelden</a>
        om je makkelijk aan te melden voor meerdere dagen tegelijk. 
    </p>
    
    <?php echo Flash::display_messages(); ?>

    <?php if (isset($validation)): ?>
        <?php echo Helper_Form::error_messages_for($validation); ?>
    <?php endif; ?>

    <form action="/aanmelden" method="post" accept-charset="utf-8" class="clearfix">
        <p>
            <label for="date" class="label">Volgende eettafel</label>
            <?php echo $upcoming_meal; ?>
        </p>
        <?php if ($upcoming_meal->open_for_registrations()): ?>
            <p>
                <label for="name" class="label">Naam</label>
                <input type="text" name="name" value="" />
            </p>    
            <p>
                <input type="submit" value="Aanmelden"/>
            </p>    
        <?php else: ?>
            <p class="notification warning">
                Sorry, de deadline is verstreken. Je kunt je niet meer aanmelden voor de maaltijd
                van vandaag. Je kunt je nog wel <a href="/uitgebreid-inschrijven">aanmelden voor een andere eettafel</a>.
            </p>
        <?php endif; ?>
    </form>    
</div>

<?php echo View::factory('front/_spelregels'); ?>
<?php echo View::factory('layouts/_navigation'); ?>