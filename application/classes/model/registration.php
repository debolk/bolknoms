<?php defined('SYSPATH') or die('No direct script access.');

class Model_Registration extends ORM
{
    protected $_belongs_to = array('day' => array());

    public function __construct()
    {
        parent::__construct();
        
        // Default sorting order
        $this->order_by('name','asc');
    }

    /**
     * Controls output when an object of the class is printed
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}