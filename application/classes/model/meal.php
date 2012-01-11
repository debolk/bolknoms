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
        return array('date'   => array(
                                   array('not_empty'),
                                   array('date'),
                                   array(array($this,'free_day')),
                                   array('Model_Meal::today_or_later')
                               ),
                     'locked' => array(
                                   array('not_empty'),
                                   array(array($this, 'valid_time'))
                               )
                );
    }

    /**
     * Initializes the model, setting the default ordering to date
     * @param int $id
     */
    public function __construct($id = null)
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
     * Prints the deadline of this meal in a user-friendly format
     * @return string
     */
    public function deadline()
    {
        return strftime('%H:%M',strtotime($this->locked)).' uur';
    }

    /**
     * Returns whether the given date is still free
     * @static
     * @param string $date
     * @return bool
     */
    public function free_day($date)
    {
        $candidate = ORM::factory('meal',array('date' => $date));
        if (! $candidate->loaded()) {
            return true;
        }
        if ($candidate->id == $this->id) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Checks whether this is a valid time
     * @param $time
     * @return bool
     */
    public function valid_time($time)
    {
        return (strtotime($time) !== FALSE);
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
     * Returns whether the meal is open for registrations
     * @return bool
     */
    public function open_for_registrations()
    {
        $closing_moment = strtotime($this->date.' '.$this->locked);
        return ($closing_moment > time());
    }
}