<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Front extends Controller_Application
{
    /**
     * Displays a form with all available meals
     * @return void
     */
    public function action_index()
    {
        $this->template->content->meals = ORM::factory('meal')->upcoming()->find_all();
    }

    /**
     * Adds a new set of registrations with a specified name
     * @return void
     */
    public function action_aanmelden()
    {
        if ($_POST && isset($_POST['name']) && isset($_POST['meals'])) {
            try {
                $registrations = array();
                // Create registrations
                foreach($_POST['meals'] as $meal_id) {
                    $reg = ORM::factory('registration');
                    $reg->name = $_POST['name'];
                    $reg->meal = ORM::factory('meal',$meal_id);
                    $reg->save();
                    $registrations[] = $reg;
                }
                // Update user
                Flash::set(Flash::SUCCESS, 'Aanmelding geslaagd');
            }
            catch (ORM_Validation_Exception $e) {
                // Nothing here, errors retrieved in the view
            }
        }
        else {
            Flash::set(Flash::ERROR, 'Je moet wel even je naam invullen en een datum kiezen');
        }
        $this->request->redirect('/');
    }
}