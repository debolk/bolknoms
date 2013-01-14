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

    // Set the total amount of meals in the administration interface
    $('body.administratie.index select#count').change(function(){
      $(this).parents('form').submit();
    });

    $('.confirmation-needed').live("click",confirm_intent);

    $('.destroy-registration').live("click",remove_registration);

    $('.new_registration input[type="submit"]').live('click',add_registration);
    $('.new_registration input[type="text"]').live('keyup',add_registration_if_enter);
    
    $('input[name="all-meals"]').change(select_all_meals);
    
    if ($('body').hasClass('administratie') && $('body').hasClass('checklist')) {
        window.print();
    }

    // Interactive tables for administration
    hide_subtables();
    $('.expander').click(toggle_subtable);

    // Hiding and showing form help texts
    $('form p small').hide();
    $('form p input[type="text"]').focus(show_input_help);
    $('form p input[type="text"]').blur(hide_input_help);

    // Store values of forms in localstorage for form persistence
    $('input[type="text"]').blur(save_form_value);
    fill_form_values();
});

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

function add_registration_if_enter(data) {
    // If enter is pressed
    if (data.which == 13) {
        // Trigger the submit-function
        var row = $(this).parents('.new_registration');
        $('input[type="submit"]',row).click();
    }
}

/**
 * Submits a registration to the server
 */
function add_registration()
{
    // Get the values, ignoring whitespace
    var form = $(this).parents('.new_registration');
    var meal_id = $(this).parents('tbody').attr('data-id');
    var name = $('input[name="name"]',form).val().trim();
    var handicap = $('input[name="handicap"]',form).val().trim();

    if (name !== '') {
        // Update the server
        $.post('/administratie/aanmelden',{
                meal_id: meal_id,
                name: name,
                handicap: handicap
            },
            function(new_row){
                // Update meal
                $('tbody[data-id="'+meal_id+'"]').replaceWith(new_row);
                // Re-open the list of names
                $('.expander', 'tbody[data-id="'+meal_id+'"]').click();
            },'html');
    }
}

/**
 * Removes a registration from the server
 */
function remove_registration()
{
    // Get the value, ignoring whitespace
    var meal = $(this).parents('.meal');
    var registration = $(this).parents('.registration');
    var meal_id = meal.attr('data-id');
    var name = $('.name',registration).html();

    if (confirm('Weet je zeker dat je '+name+' wilt uitschrijven?')) {
        $.post($(this).attr('href'), null, 
            function(result){
                if (result == 'success') {
                    $(registration).remove();    
                }
                else {
                    alert('Er is een fout opgetreden. Probeer de pagina te verversen.')
                }
            });
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
    // Find the subtable
    var meal = $(this).parents('tbody');

    // Hide the rows
    $('.registration, .new_registration', meal).toggle();

    // Toggle arrow
    if ($(this).attr('src') == '/images/arrow-right.png') {
        $(this).attr('src', '/images/arrow-down.png');
    }
    else {
        $(this).attr('src', '/images/arrow-right.png');
    }
    
}

function show_input_help() {
    $('small',$(this).parents('p')).show();
}

function hide_input_help() {
    $('small',$(this).parents('p')).hide();
}

function localstorage_supported()
{
    try {
        return 'localStorage' in window && window['localStorage'] !== null;
    }
    catch (e) {
        return false;
    }
}

function on_front()
{
    return $('body').hasClass('front');
}

function save_form_value()
{
    if (on_front() && localstorage_supported()) {
        localStorage[$(this).attr('name')] = $(this).val();
    }
}

function fill_form_values()
{
    if (on_front() && localstorage_supported()) {
        $('input[type="text"]').each(function () {
            if (localStorage.getItem($(this).attr('name')) !== null) {
                $(this).val(localStorage[$(this).attr('name')]);
            }
        });
    }
}