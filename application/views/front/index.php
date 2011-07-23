<h1>Bolknoms</h1>
<p class="introduction">
    Met deze extreem hippe tool kun je je aanmelden voor maaltijden op De Bolk.<br/>
    Aanmelden is niet verplicht, behalve in witte weken en tentamenwerken.
</p>

<?php echo Flash::display_messages(); ?>

<form action="/aanmelden" method="post" accept-charset="utf-8" class="clearfix">
    <p>
        <label for="name" class="label">Naam</label>
        <input type="text" name="name" id="name"/>
    </p>

    <p>
        <span class="label">Eettafels</span>
    <table>
        <thead>
        <tr>
            <th>&nbsp;</th>
            <th>Datum</th>
            <th>Aanmeldingen</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($days as $day): ?>
                <tr>
                    <td><?php echo Form::checkbox('days[]', $day->id); ?></td>
                    <td><?php echo $day; ?></td>
                    <td class="number"><?php echo $day->registrations->count_all(); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </p>
    <p>
        <input type="submit" id="submit" value="Aanmelden"/>
    </p>
</form>

<p class="navigation">
    <a href="administratie">
        <img src="/images/key.png" alt="" width="16" height="16" />
        Administratie
    </a>
</p>