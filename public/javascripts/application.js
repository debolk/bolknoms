$(document).ready(function() {
    $('.datepicker').datepicker({
        minDate: 0,
        showWeek: true,
        firstDay: 1,
        dayNames: ['Zondag','Maandag','Dinsdag','Woensdag','Donderdag','Vrijdag','Zaterdag'],
        dayNamesMin: ['zo','ma','di','wo','do','vr','za'],
    });
});
