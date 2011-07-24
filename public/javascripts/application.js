$(document).ready(function() {
    $('.datepicker').datepicker({
        minDate: 0,
        showWeek: true,
        firstMeal: 1,
        mealNames: ['Zondag','Maandag','Dinsdag','Woensdag','Donderdag','Vrijdag','Zaterdag'],
        mealNamesMin: ['zo','ma','di','wo','do','vr','za'],
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