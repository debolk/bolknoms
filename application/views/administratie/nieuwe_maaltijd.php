<h1>Nieuwe maaltijd toevoegen</h1>

<?php Helper_Form::error_messages_for($day); ?>

<form action="/administratie/nieuwe_maaltijd" method="post" accept-charset="utf-8" class="clearfix">
    <p>
       <label class="label" for="date">Datum</label>
       <?php echo Form::input('date',Arr::get($_POST,'date'),array('id' => 'date','class' => 'datepicker')); ?>
    </p>
    <p>
        <input type="submit" value="Maaltijd toevoegen" />
    </p>
</form>

<p class="navigation">
    <a href="/administratie">&lsaquo; Terug naar administratie</a>
</p>