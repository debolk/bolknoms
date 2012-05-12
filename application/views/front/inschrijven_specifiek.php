<h2>Aanmelden voor maaltijd</h2>
<?php echo Flash::display_messages(); ?>

<?php if (isset($validation)): ?>
    <?php echo Helper_Form::error_messages_for($validation); ?>
<?php endif; ?>

<?php echo Form::open(Route::url('aanmelden_specifiek', array('id' => $meal->id))); ?>
    <p>
        <label for="date" class="label">Eettafel</label>
        <?php echo $meal; ?>
    </p>
    <?php if ($meal->open_for_registrations()): ?>
        <p>
            <label for="name" class="label">Naam</label>
            <input type="text" name="name" value="" />
            <small>Gebruik je volledige voor- en achternaam. Onduidelijke inschrijvingen worden vernietigd.</small>
        </p>
        <p>
	        <label for="email" class="label">E-mail</label>
	        <input type="text" name="email" id="email"/>
	    </p>
	    <p>
	        <label for="handicap" class="label">Handicap</label>
	        <input type="text" name="handicap" id="handicap">
	        <small>Bijvoorbeeld vegetari&euml;r, geen pinda's, etc..</small>
	    </p>
        <p>
            <input type="submit" value="Aanmelden"/>
        </p>    
    <?php else: ?>
        <p class="notification warning">
            Sorry, de deadline is verstreken. Je kunt je niet meer aanmelden voor de maaltijd.
        </p>
    <?php endif; ?>
</form>


<?php echo View::factory('front/_spelregels'); ?>

<?php echo View::factory('layouts/_navigation'); ?>