<h1>Bolknoms</h1>
<p class="introduction">
    Met deze extreem hippe tool kun je je aanmelden voor maaltijden op De Bolk.<br/>
    Aanmelden is niet verplicht, behalve in witte weken en tentamenwerken.
</p>

<?php echo Flash::display_messages(); ?>

<h2>Aanmelden</h2>
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
            <?php foreach ($meals as $meal): ?>
                <tr>
                    <td><?php echo Form::checkbox('meals[]', $meal->id); ?></td>
                    <td class="date"><?php echo $meal; ?></td>
                    <td class="number"><?php echo $meal->registrations->count_all(); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </p>
    <p>
        <input type="submit" id="submit" value="Aanmelden"/>
    </p>
</form>

<h2>Afmelden</h2>
<p>
    Je kunt je op dit moment nog niet online afmelden. Neem contact op met het bestuur via
    <a href="mailto:bestuur@nieuwedelft.nl">bestuur@nieuwedelft.nl</a> of 015 212 60 12.
</p>

<p class="navigation">
    <a href="administratie">
        <img src="/images/key.png" alt="" width="16" height="16" />
        Administratie
    </a>
</p>