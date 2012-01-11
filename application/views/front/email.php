<p>
    Beste <?php echo $name; ?>,
</p>
<p>
    Je hebt je aangemeld voor de eettafel op De Bolk op de volgende dagen:
</p>
<ul>
    <?php foreach ($registrations as $registration): ?>
        <li>
            <?php echo $registration->meal; ?>
            (<a href="<?php echo Route::url('afmelden',array('id' => $registration->id, 'salt' => $registration->salt), true); ?>">afmelden</a>)
        </li>
    <?php endforeach; ?>
</ul>
<p>
    Met vriendelijke groet,<br />
    Ruben Maessen<br />
    Commissaris Maaltijden, D.S.V. Nieuwe Delft (De Bolk)
</p>