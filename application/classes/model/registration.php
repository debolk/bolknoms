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
                    array('not_empty')
                ),
                'name' => array(
                    array('not_empty')
                )
        );
    }

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

    private function generate_salt()
    {
        $source = 'abcdefghijklmnopqrstuvwxyz';
        $salt  = '';

        for ($i=0; $i<10; $i++) {
            $salt .= $source[mt_rand(0,25)];
        }

        return $salt;
    }
}