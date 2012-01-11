<?php defined('SYSPATH') or die('No direct script access.');

class Model_Registration extends ORM
{
    protected $_belongs_to = array('meal' => array());

    /**
     * Initializes the model, setting the default ordering to name
     * @param int $id
     */
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
                    array('not_empty')
                ),
                'name' => array(
                    array('not_empty')
                )
        );
    }

    /**
     * Generate a salt, then save the model
     * @param null|Validation $validation
     * @return ORM
     */
    public function save(Validation $validation = null)
    {
        $this->salt = $this->generate_salt();
        return parent::save($validation);
    }

    /**
     * Controls output when an object of the class is printed
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * Generates a random string of 10 characters in the a-z range, used for securing cancellation requests
     * @return string
     */
    private function generate_salt()
    {
        return substr(str_shuffle(str_repeat('abcdefghijklmnopqrstuvwxyz',10)),0,10);
    }
}