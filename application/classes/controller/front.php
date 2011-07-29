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
        if ($_POST && isset($_POST['name']) && isset($_POST['meals']) && isset($_POST['email'])) {
            $name = HTML::chars($_POST['name']);
            $email = HTML::chars($_POST['email']);

            try {
                $registrations = array();
                // Create registrations
                foreach($_POST['meals'] as $meal_id) {
                    $reg = ORM::factory('registration');
                    $reg->name = $name;
                    $reg->email = $email;
                    $reg->meal = ORM::factory('meal',(int)$meal_id);
                    $reg->save();
                    $registrations[] = $reg;
                }
                // Update user
                Mailer_Registration::send_confirmation($name, $email, $registrations);
                Flash::set(Flash::SUCCESS, 'Aanmelding geslaagd. Je ontvangt een e-mail met alle details.');
            }
            catch (ORM_Validation_Exception $e) {
                // Nothing here, errors retrieved in the view
            }
        }
        else {
            Flash::set(Flash::ERROR, 'Je moet wel even je naam en e-mailadres invullen en een datum kiezen');
        }
        $this->request->redirect('/');
    }
}