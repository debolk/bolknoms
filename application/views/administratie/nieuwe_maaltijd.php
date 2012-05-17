<h1>Nieuwe maaltijd toevoegen</h1>

<?php Helper_Form::error_messages_for($meal); ?>

<form action="/administratie/nieuwe_maaltijd" method="post" accept-charset="utf-8" class="clearfix">
    <p>
       <label class="label" for="date">Datum</label>
       <?php echo Form::input('date',Arr::get($_POST,'date'),array('id' => 'date','class' => 'datepicker')); ?>
    </p>
    <p>
       <label class="label" for="locked">Inschrijving sluit</label>
       <?php if (Arr::get($_POST,'locked')): ?>
            <?php echo Form::input('locked',Arr::get($_POST,'locked'),array('id' => 'locked')); ?>
        <?php else: ?>
            <?php echo Form::input('locked','15:00',array('id' => 'locked')); ?>
        <?php endif; ?>
    </p>
    <p>
      <label for="event" class="label">Evenement</label>
      <?php echo Form::input('event',Arr::get($_POST,'event'),array('id' => 'event')); ?>
    </p>
    <p>
      <label for="promoted" class="label">Extra promotie</label>
      <?php echo Form::checkbox('promoted','1',Arr::get($_POST,'promoted'),array('id' => 'promoted')); ?>
    </p>
    <p>
        <input type="submit" value="Maaltijd toevoegen" />
    </p>
</form>

<?php echo View::factory('layouts/_navigation'); ?>