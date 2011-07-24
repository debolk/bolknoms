$(document).ready(function() {
    $('.datepicker').datepicker({
        minDate: 0,
        showWeek: true,
        firstDay: 1,
        dayNames: ['Zondag','Maandag','Dinsdag','Woensdag','Donderdag','Vrijdag','Zaterdag'],
        dayNamesMin: ['zo','ma','di','wo','do','vr','za'],
        dateFormat: 'yy-mm-dd'
    });

    $('.confirmation-needed').click(confirm_intent);
});

/**
 * Confirms the intent of the user
 */
function confirm_intent()
{
    return confirm('Are you sure?');
}