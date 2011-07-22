<h1>Bolknoms</h1>
<p class="introduction">
    Met deze extreem hippe tool kun je je aanmelden voor maaltijden op De Bolk.<br />
    Aanmelden is niet verplicht, behalve in witte weken en tentamenwerken.
</p>

<form action="/" method="post" accept-charset="utf-8">
    <p>
        <label for="name" class="label">Naam</label>
        <input type="text" name="name" id="name" />
    </p>
    <p>
        <span class="label">Openstaande dagen</span>
        <?php foreach($days as $day): ?>
            <?php echo Form::checkbox('days[]',$day->id); ?>
            <?php echo $day; ?><br />
        <?php endforeach; ?>
    </p>
</form>