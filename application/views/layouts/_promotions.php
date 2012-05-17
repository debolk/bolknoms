<?php if ($promoted_meals->count() > 0): ?>
	<div class="block">
		<h2>Speciale maaltijden</h2>
		<?php foreach ($promoted_meals as $meal): ?>
			<?php echo HTML::anchor(Route::url('inschrijven_specifiek', array('id' => $meal->id)), $meal); ?><br>
		<?php endforeach; ?>
	</div>
<?php endif; ?>
