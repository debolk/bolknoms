<tbody data-id="<?php echo $meal->id; ?>">
	<tr class="meal">
		<th class="control">
			<img src="/images/arrow-right.png" alt="" class="expander" />
		</th>
		<th class="date"><?php echo $meal; ?></td>
		<th class="date"><?php echo $meal->deadline(); ?></td>
		<th class="number"><?php echo $meal->registrations->count_all(); ?></td>
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
			<td colspan="2">&nbsp;</td>
		</tr>
	<?php endforeach; ?>
	<tr class="new_registration">
		<td>&nbsp;</td>
		<td><?php echo Form::input('name', '', array('class' => 'new_registration')); ?></td>
		<td colspan="4">&nbsp;</td>
	</tr>
</tbody>
