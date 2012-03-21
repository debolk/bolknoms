<tr data-id="<?php echo $meal->id; ?>">
	<td class="date"><?php echo $meal; ?></td>
	<td class="date"><?php echo $meal->deadline(); ?></td>
	<td class="number"><?php echo $meal->registrations->count_all(); ?></td>
	<td class="registrations">
		<a href="#" class="toggle-names">Toon namen</a><br />
		<div class="names">
			<?php foreach ($meal->registrations->find_all() as $registration): ?>
				<span class="registration"><?php echo $registration; ?></span>
				<a href="/administratie/afmelden/<?php echo $registration->id; ?>" class="destroy-registration">
					<img src="/images/cross.png" alt="Verwijderen"/>
				</a>				
				<br />
			<?php endforeach; ?>
			<?php echo Form::input('name', '', array('class' => 'new_registration')); ?>
		</div>
	</td>
	<td>
		<a href="administratie/checklist/<?php echo $meal->id; ?>">Print</a>
	</td>
	<td>
		<a href="/administratie/bewerk/<?php echo $meal->id; ?>">
			<img src="/images/pencil.png" alt="Bewerken"/>
		</a>
		<a href="/administratie/verwijder/<?php echo $meal->id; ?>" class="confirmation-needed">
			<img src="/images/cross.png" alt="Verwijderen"/>
		</a>
	</td>
</tr>