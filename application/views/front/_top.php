<h2>Top eters</h2>
<ol class="top_registrations">
	<?php foreach($top_eaters as $registration): ?>
		<li><?php echo $registration->name; ?> (<?php echo $registration->count;?>)</li>
	<?php endforeach; ?>
</ol>