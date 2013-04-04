<?php defined('SYSPATH') or die('No direct script access.');

class Model_meal extends ORM
{
    protected $_has_many = array('registrations' => array());
    protected $_sorting = array('date' => 'asc');

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
     * Excludes all past dates
     * @chainable
     * @return Model_Meal
     */
    public function upcoming()
    {
        return $this->where('date', '>=', date('Y-m-d'));
    }

    /**
     * Lists all meals available for registering
     * @chainable
     * @return Model_Meal
     */
    public function available()
    {
        // Allow all upcoming meals on later days
        $this->where('date', '>', date('Y-m-d'));
        // Include the meal from today, if the deadline still looms
        $this->or_where_open();
            $this->where('date', '=', date('Y-m-d'));
            $this->where('locked', '>=', strftime('%H:%I'));
        $this->where_close();
        // Enable method chaining for futher refinement
        return $this;
    }

    /**
     * Excludes all dates later than yesterday
     * @chainable
     * @return Model_Meal
     */
    public function previous()
    {
        return $this->where('date', '<', date('Y-m-d'))->order_by('date', 'desc');
    }

    /**
     * Controls output when an object of the class is printed
     * @return string
     */
    public function __toString()
    {
        $output = strftime('%A %d %B %Y', strtotime($this->date));

        if ($this->event !== null) {
            $output .= ' ('.$this->event.')';
        }
        return $output;
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
     * Returns whether a meal is being promoted
     * @return boolean
     */
    public function promoted()
    {
        return ($this->promoted === '1');
    }

    /**
     * Returns all promoted meals
     * @return Model_Meal
     */
    public function promotions()
    {
        return $this->upcoming()->where('promoted','=','1');
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
     * @return boolean
     */
    public function open_for_registrations()
    {
        $closing_moment = strtotime($this->date.' '.$this->locked);
        return ($closing_moment > time());
    }

    /**
     * Returns whether a meal is today
     * @return boolean
     */
    public function today()
    {
        return ($this->date === strftime('%Y-%m-%d'));
    }
}