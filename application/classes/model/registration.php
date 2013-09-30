<?php defined('SYSPATH') or die('No direct script access.');

class Model_Registration extends ORM
{
    protected $_belongs_to = array('meal' => array());
    protected $_sorting = array('name' => 'asc');

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
     * Loads the top X of eaters with their stats
     * @param int $count number of eaters to retrieve
     */
    public function top_alltime($count = 5)
    {
        return DB::query(Database::SELECT, 'SELECT name, COUNT(name) AS count 
                                                                    FROM registrations 
                                                                    LEFT JOIN meals ON registrations.meal_id = meals.id
                                                                    WHERE meals.date <= NOW() 
                                                                    GROUP BY name 
                                                                    ORDER BY count 
                                                                    DESC LIMIT :count')->bind(':count',$count)->as_object('Model_Registration')->execute();
    }

    /**
     * Loads the top X of eaters since 1 september with their stats
     * @param int $count number of eaters to retrieve
     */
    public function top_ytd($count = 5)
    {
        // Construct query
        $query = 'SELECT name, COUNT(name) AS count 
                  FROM registrations 
                  LEFT JOIN meals ON registrations.meal_id = meals.id
                  WHERE meals.date >= :soy 
                  AND meals.date <= NOW()
                  GROUP BY name 
                  ORDER BY count DESC 
                  LIMIT :count';
        $query = DB::query(Database::SELECT, $query);
        $query->bind(':count', $count);

        // Determine last 1-sep
        if (time() > strtotime('01 September')) {
            $date = date('Y-m-d', strtotime('01 September'));
        }
        else {
            $date = date('Y-m-d', strtotime('01 September last year'));
        }
        $query->bind(':soy', $date);

        // Execute query
        return $query->as_object('Model_Registration')->execute();
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