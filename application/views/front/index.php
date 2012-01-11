<h1>BolkNoms</h1>
<p class="introduction">
    Met deze extreem hippe tool kun je je aanmelden voor maaltijden op De Bolk.
    De eettafel blijft open voor iedereen, iedere week van maandag tot donderdag.
    Van te voren aanmelden hoeft alleen in witte weken en tentamenweken van de TU Delft.
</p>

<?php echo Flash::display_messages(); ?>

<?php if (isset($validation)): ?>
    <?php echo Helper_Form::error_messages_for($validation); ?>
<?php endif; ?>

<h2>Aanmelden</h2>
<form action="/aanmelden" method="post" accept-charset="utf-8" class="clearfix">
    <p>
        <label for="name" class="label">Naam</label>
        <input type="text" name="name" id="name"/>
    </p>
    <p>
        <label for="email" class="label">E-mail</label>
        <input type="text" name="email" id="email"/>
    </p>

    <p>
        <span class="label">Eettafels</span>
        <?php if (count($meals) > 0): ?>
            <table>
                <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>Datum</th>
                    <th>Aanmelding sluit</th>
                    <th>Aanmeldingen</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($meals as $meal): ?>
                        <?php if ($meal->open_for_registrations()): ?>
                            <tr>
                                <td><?php echo Form::checkbox('meals[]', $meal->id); ?></td>
                                <td class="date"><?php echo $meal; ?></td>
                                <td class="date"><?php echo $meal->deadline(); ?></td>
                                <td class="number"><?php echo $meal->registrations->count_all(); ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>

                </tbody>
            </table>
        <?php else: ?>
            <span class="zero">Er zijn geen maaltijden beschikbaar om je voor aan te melden.</span>
        <?php endif; ?>
    </p>
    <p>
        <input type="submit" id="submit" value="Aanmelden"/>
    </p>
</form>

<h2>Afmelden</h2>
<p>
    Na je aanmelding ontvang je een e-mail van no-reply@debolk.nl ter bevestiging. Deze e-mail bevat een link om je uit te schrijven.
    Let op: als de inschrijving is gesloten, kun je je ook niet meer afmelden voor een maaltijd.
    Neem bij problemen contact op met het bestuur via het bekende e-mailadres of 015 212 60 12.
</p>

<p class="navigation">
    <a href="administratie">
        <img src="/images/key.png" alt="" width="16" height="16" />
        Administratie
    </a>
</p>
