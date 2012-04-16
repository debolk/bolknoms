var disabled_days = null;

$(document).ready(function() {
    // Only execute loading days on the page that's needed
    if ($('body.administratie.nieuwe_maaltijd, body.administratie.bewerk').size() > 0) {
        // Load disabled days
        get_disabled_days();
        console.log(disabled_days);

        $('.datepicker').datepicker({
            minDate: 0,
            showWeek: true,
            firstDay: 1,
            dayNames: ['Zondag','Maandag','Dinsdag','Woensdag','Donderdag','Vrijdag','Zaterdag'],
            dayNamesMin: ['zo','ma','di','wo','do','vr','za'],
            dateFormat: 'yy-mm-dd',
            beforeShowDay: check_free_date
        });
    }

    $('.confirmation-needed').live("click",confirm_intent);

    $('.destroy-registration').live("click",remove_registration);

    $('.new_registration').live("blur",add_registration);
    
    $('input[name="all-meals"]').change(select_all_meals);
    
    $('.toggle-names').live("click", toggle_names);
    
    if ($('body').hasClass('administratie') && $('body').hasClass('checklist')) {
        window.print();
    }

    hide_subtables();
    $('.expander').click(toggle_subtable);
});

function toggle_names()
{
    $('.names',$(this).parents('td')).toggle();
    if ($(this).html() === 'Verberg namen') {
        $(this).html('Toon namen');    
    }
    else {
        $(this).html('Verberg namen');
    }
    return false;
}

function select_all_meals()
{
    $('input[type="checkbox"]').attr('checked',($(this).attr('checked')=='checked'));
}

/**
 * Confirms the intent of the user
 */
function confirm_intent() {
    return confirm('Are you sure?');
}

/**
 * Submits a registration to the server
 */
function add_registration()
{
    // Get the value, ignoring whitespace
    var meal_id = $(this).parents('tr').attr('data-id');
    var name = $(this).val().trim();

    if (name !== '') {
        // Update the server
        $.post('/administratie/aanmelden',{
                name: name,
                meal_id: meal_id
            },
            function(new_row){
                // Update meal
                $('tr[data-id="'+meal_id+'"]').replaceWith(new_row);
                // Re-open the list of names
                $('.toggle-names', 'tr[data-id="'+meal_id+'"]').click();
            },'html');
    }
}

/**
 * Removes a registration from the server
 */
function remove_registration()
{
    // Get the value, ignoring whitespace
    var meal = $(this).parents('tr');
    var meal_id = meal.attr('data-id');
    var name = $(this).prev().html();

    if (confirm('Weet je zeker dat je '+name+' wilt uitschrijven?')) {
        $.post($(this).attr('href'), null, 
            function(new_row){
                // Update meal
                $('tr[data-id="'+meal_id+'"]').replaceWith(new_row);
                // Re-open the list of names
                $('.toggle-names', 'tr[data-id="'+meal_id+'"]').click();
            },'html');
    }
    
    // Stop default event (follow link)
    return false;
}

/**
 * Retrieves an array of all disabled dates from the server
 * @return void
 */
function get_disabled_days() {
    // Exclude current day
    var meal_id = null;
    if ($('form').size() > 0) {
        meal_id = $('form').attr('data-id');
    }

    $.ajax({
        url: '/administratie/gevulde_dagen',
        data: {
            meal_id: meal_id
        },
        success: function(result) {
            disabled_days = result
        },
        dataType: 'json',
        async: false
    });
}

/**
 * Checks whether a specific date is still free
 * @param Date date
 * @return array[boolean]
 */
function check_free_date(date) {
    var date_string = date.format('yyyy-mm-dd');
    if ($.inArray(date_string, disabled_days) > -1) {
        return [false];
    }
    else {
        return [true];
    }
}

function hide_subtables() {
    $('.registration, .new_registration').hide();
}

function toggle_subtable() {
    var meal = $(this).parents('tbody');
    $('.registration, .new_registration', meal).toggle();
    if ($(this).attr('src') == '/images/arrow-right.png') {
        $(this).attr('src', '/images/arrow-down.png');
    }
    else {
        $(this).attr('src', '/images/arrow-right.png');
    }
    
}