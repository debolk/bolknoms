<h1>Bolknoms</h1>
<p class="introduction">
    Met deze extreem hippe tool kun je je aanmelden voor maaltijden op De Bolk.<br/>
    Aanmelden is niet verplicht, behalve in witte weken en tentamenwerken.
</p>

<?php echo Flash::display_messages(); ?>

<?php echo Form::open('/aanmelden'); ?>
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