<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Administratie extends Controller_Application
{
    public function before()
    {
        parent::before();

        // Authenticate users
        $this->authenticate();
    }

    /**
     * List all past and current meals
     * @return void
     */
    public function action_index()
    {
        $this->template->content->upcoming_meals = ORM::factory('meal')->upcoming()->find_all();
        $this->template->content->previous_meals = ORM::factory('meal')->previous()->find_all();
    }

    /**
     * Creates a new meal
     * @return void
     */
    public function action_nieuwe_maaltijd()
    {
        $this->template->content->meal = $meal = ORM::factory('meal');

        if ($_POST) {
            $meal->values($_POST, array('date','locked'));
            try {
                $meal->save();
                Flash::set(Flash::SUCCESS, 'Maaltijd toegevoegd');
                $this->request->redirect('/administratie');
            }
            catch (ORM_Validation_Exception $e) {
                // Nothing here, errors are retrieved in the view
                // specifically the Helper_Form class
            }
        }
    }

    /**
     * Removes a meal
     * @return void
     */
    public function action_verwijder()
    {
        $meal = ORM::factory('meal',$this->request->param('id'));
        $date = (string)$meal;

        $meal->delete();

        Flash::set(Flash::SUCCESS,"Maaltijd op $date verwijderd");
        $this->request->redirect('/administratie');
    }

    /**
     * Removes a registration
     * @return void
     */
    public function action_afmelden()
    {
        $registration = ORM::factory('registration',$this->request->param('id'));
        $name = $registration->name;
        $meal = $registration->meal;

        $registration->delete();

        Flash::set(Flash::SUCCESS,"$name afgemeld voor de maaltijd op $meal");
        $this->request->redirect('/administratie');
    }

    /**
     * Prints an array (json-encoded) of all upcoming dates with meals planned
     * @return void
     */
    public function action_gevulde_dagen()
    {
        $meals = ORM::factory('meal')->upcoming()->find_all();
        $dates = array();
        foreach ($meals as $meal) {
            $dates[] = $meal->date;
        }
        header('Content-Type: application/json');
        print(json_encode($dates));
        exit;
    }
}