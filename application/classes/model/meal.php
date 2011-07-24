<?php defined('SYSPATH') or die('No direct script access.');

class Model_meal extends ORM
{
    protected $_has_many = array('registrations' => array());

    /**
     * Defines the validation rules for this model
     * @return array
     */
    public function rules()
    {
        return array('date' => array(
                                   array('not_empty'),
                                   array('Model_Meal::valid_date'),
                                   array('Model_Meal::free_meal'),
                                   array('Model_Meal::today_or_later')
                               )
                );
    }

    public function __construct($id = NULL)
    {
        parent::__construct($id);

        // Default sorting order
        $this->order_by('date', 'asc');
    }

    /**
     * Excludes all past dates
     * @chainable
     * @return $this
     */
    public function upcoming()
    {
        return $this->where('date', '>=', date('Y-m-d'));
    }

    /**
     * Excludes all dates later than yesterday
     * @chainable
     * @return $this
     */
    public function previous()
    {
        return $this->where('date', '<', date('Y-m-d'));
    }

    /**
     * Controls output when an object of the class is printed
     * @return string
     */
    public function __toString()
    {
        return strftime('%A %d %B %Y', strtotime($this->date));
    }

    /**
     * Returns whether the given date is still free
     * @static
     * @param string $date
     * @return bool
     */
    public static function free_day($date)
    {
        return ! DB::select(array(DB::expr('COUNT(*)'), 'total'))
            ->from('meals')
            ->where('date', '=', $date)
            ->execute()
            ->get('total');
    }

    /**
     * Checks whether a date is in the future
     * @static
     * @param string $date
     * @return bool
     */
    public static function today_or_later($date)
    {
        $today = strtotime(date('Y-m-d'));
        $date = strtotime($date);
        return ($today <= $date);
    }

    /**
     * Checks whether a date is well-formed (yyyy-mm-dd) and valid
     * @static
     * @param string $date
     * @return bool validity of the date
     */
    public static function valid_date($date)
    {
        // Invalid date by definition if you can't split it
        $date_components = explode('-',$date);
        if (count($date_components) <> 3 ) {
            return false;
        }
        // Check date validity
        return checkdate($date_components[1], $date_components[2], $date_components[0]);
    }
}