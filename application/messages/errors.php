<?php defined('SYSPATH') or die('No direct script access.');

/*
 * Custom errors for form field validation
 */
return array(
  'date' => array(
                  'Model_Day::free_day'       => 'Op deze dag is al een maaltijd',
                  'Model_Day::today_or_later' => 'Je kunt geen maaltijden in het verleden toevoegen',
                  'Model_Day::valid_date'     => 'Je moet een geldige datum invoeren (yyyy-mm-dd)'
                ),
);