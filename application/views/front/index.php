<?php echo View::factory('front/_introductie'); ?>

<h2>Snel aanmelden</h2>
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
            <small>Gebruik je volledige voor- en achternaam. Onduidelijke inschrijvingen worden vernietigd.</small>
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

<p>
    Wil je je aanmelden voor meerdere dagen tegelijkertijd, je vrienden meenemen, of 
    heb je speciale eisen m.b.t. voedsel? Schrijf je dan in via
    <a href="/uitgebreid-inschrijven">uitgebreid aanmelden</a>.
</p>

<?php echo View::factory('front/_spelregels'); ?>

<h2>Nog sneller aanmelden</h2>
<p>
    Gebruik je Google Chrome? Installeer dan de gratis
    <a href="https://chrome.google.com/webstore/detail/cpofokaclgokgfcalaiodpkjkhafahfe/">bolknoms-app</a>!
</p>

<?php echo View::factory('layouts/_navigation'); ?>