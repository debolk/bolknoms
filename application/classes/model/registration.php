<?php defined('SYSPATH') or die('No direct script access.');

class Model_Registration extends ORM
{
    protected $_belongs_to = array('meal' => array());

    public function __construct($id = null)
    {
        parent::__construct($id);
        
        // Default sorting order
        $this->order_by('name','asc');
    }

    /**
     * Defines the validation rules for this model
     * @return array
     */
    public function rules()
    {
        return array(
                'meal_id' => array(
                    array('not_empty'),
                ),
                'name' => array(
                    array('not_empty')
                )
        );
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