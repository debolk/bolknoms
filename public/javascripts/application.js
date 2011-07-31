var disabled_days = null;

$(document).ready(function() {
    // Only execute loading days on the page that's needed
    if ($('body.administratie.nieuwe_maaltijd').size() > 0) {
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

    $('.confirmation-needed').click(confirm_intent);
});

/**
 * Confirms the intent of the user
 */
function confirm_intent() {
    return confirm('Are you sure?');
}

/**
 * Retrieves an array of all disabled dates from the server
 * @return void
 */
function get_disabled_days() {
    $.ajax({
        url: '/administratie/gevulde_dagen',
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