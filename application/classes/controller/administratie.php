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
     * Creates a new meal in the system
     * @return void
     */
    public function action_nieuwe_maaltijd()
    {
        $this->template->content->meal = $meal = ORM::factory('meal');

        if ($_POST) {
            $meal->values($_POST, array('date'));
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

    public function action_verwijder()
    {
        $meal_id = $this->request->param('id');
        ORM::factory('meal',$meal_id)->delete();
        Flash::set(Flash::SUCCESS,'Maaltijd verwijderd');
        $this->request->redirect('/administratie');
    }

    public function action_afmelden()
    {
        $registration = ORM::factory('registration',$this->request->param('id'))->find();
        $name = $registration->name;
        $meal = $registration->meal;

        $registration->delete();

        Flash::set(Flash::SUCCESS,"$name afgemeld voor de maaltijd op $meal");
        $this->request->redirect('/administratie');
    }
}