<?php defined('SYSPATH') or die('No direct script access.');

/*
 * Custom errors for form field validation
 */
return array(
  'date' => array(
                  'Model_Meal::free_day'       => 'Op deze dag is al een maaltijd',
                  'Model_Meal::today_or_later' => 'Je kunt geen maaltijden in het verleden toevoegen',
                  'Model_Meal::valid_date'     => 'Je moet een geldige datum invoeren (yyyy-mm-dd)'
                ),
);