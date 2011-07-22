<?php defined('SYSPATH') or die('No direct script access.');

class Model_Day extends ORM
{
    public function __construct()
    {
        parent::__construct();
        
        // Default sorting order
        $this->order_by('date','asc');
    }

    /**
     * Excludes all past dates
     * @chainable
     * @return $this
     */
    public function upcoming()
    {
        return $this->where('date','>=',date('%Y-%m-%d'));
    }

    /**
     * Controls output when an object of the class is printed
     * @return string
     */
    public function __toString()
    {
        return date('l j F Y', strtotime($this->date));
    }
}