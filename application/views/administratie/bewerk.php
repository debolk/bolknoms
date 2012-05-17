<h1>Maaltijd bewerken</h1>

<?php Helper_Form::error_messages_for($meal); ?>

<?php echo Form::open(Request::$current->uri(), array('class' => 'clearfix', 'data-id' => $meal->id)); ?>
    <p>
       <label class="label" for="date">Datum</label>
       <?php echo Form::input('date',Arr::get($meal->as_array(),'date'),array('id' => 'date','class' => 'datepicker')); ?>
    </p>
    <p>
       <label class="label" for="locked">Inschrijving sluit</label>
        <?php echo Form::input('locked',strftime('%H:%M',strtotime(Arr::get($meal->as_array(),'locked'))),array('id' => 'locked')); ?>
    </p>
    <p>
      <label for="event" class="label">Evenement</label>
      <?php echo Form::input('event', Arr::get($meal->as_array(),'event'), array('id' => 'event')); ?>
    </p>
    <p>
      <label for="promoted" class="label">Extra promotie</label>
      <?php echo Form::checkbox('promoted','1', (Arr::get($meal->as_array(),'promoted')), array('id' => 'promoted')); ?>
    </p>
    <p>
        <input type="submit" value="Wijzigingen opslaan" />
        of <?php echo HTML::anchor(Route::url('default',array('controller' => 'administratie')),'niet opslaan'); ?>
    </p>
</form>

<?php echo View::factory('layouts/_navigation'); ?>
