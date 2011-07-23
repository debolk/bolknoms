<h1>Nieuwe maaltijd toevoegen</h1>

<?php Helper_Form::error_messages_for($day); ?>

<?php echo Form::open(Request::current()); ?>
    <p>
       <label class="label" for="date">Datum</label>
       <input type="text" name="date" id="date" />
    </p>
    <p>
        <input type="submit" value="Maaltijd toevoegen" />
    </p>
</form>