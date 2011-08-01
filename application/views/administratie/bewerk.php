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
        <input type="submit" value="Wijzigingen opslaan" />
        of <?php echo HTML::anchor(Route::url('default',array('controller' => 'administratie')),'niet opslaan'); ?>
    </p>
</form>
        