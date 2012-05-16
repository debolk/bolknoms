<tbody data-id="<?php echo $meal->id; ?>">
	<tr class="meal">
		<th class="control">
			<img src="/images/arrow-right.png" alt="" class="expander" title="Toon aanmeldingen" />
		</th>
		<th class="date"><?php echo $meal; ?></th>
		<th class="control">
			<?php if ($meal->promoted()): ?>
				<img src="/images/tick.png" alt="Ja" title="Deze maaltijd wordt extra gepromoot" />
			<?php endif; ?>
		</th>
		<th class="date"><?php echo $meal->deadline(); ?></th>
		<th class="number"><?php echo $meal->registrations->count_all(); ?></th>
		<th>
			<a href="administratie/checklist/<?php echo $meal->id; ?>">Print</a>
		</th>
		<th>
			<a href="/administratie/bewerk/<?php echo $meal->id; ?>">
				<img src="/images/pencil.png" alt="Bewerken"/>
			</a>
			<a href="/administratie/verwijder/<?php echo $meal->id; ?>" class="confirmation-needed">
				<img src="/images/cross.png" alt="Verwijderen"/>
			</a>
		</th>
	</tr>

	<tr class="new_registration">
		<td>&nbsp;</td>
		<td><?php echo Form::input('name', '', array('placeholder' => 'Nieuwe aanmelding')); ?></td>
		<td><?php echo Form::input('handicap', '', array('placeholder' => 'handicap')); ?></td>
		<td><input type="submit" value="+" /></td>
		<td colspan=3>&nbsp;</td>
	</tr>

	<?php foreach ($meal->registrations->find_all() as $registration): ?>
		<tr class="registration">
			<td>&nbsp;</td>
			<td class="name"><?php echo $registration; ?></td>
			<td class="handicap"><?php echo $registration->handicap; ?></td>
			<td class="control">
				<a href="/administratie/afmelden/<?php echo $registration->id; ?>" class="destroy-registration">
					<img src="/images/cross.png" alt="Verwijderen"/>
				</a>
			</td>
			<td colspan=3>&nbsp;</td>
		</tr>
	<?php endforeach; ?>
	
</tbody>
