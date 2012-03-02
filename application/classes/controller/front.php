<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Front extends Controller_Application
{
    /**
     * Displays a form with all available meals
     * @return void
     */
    public function action_index()
    {
        $this->template->content->upcoming_meal = ORM::factory('meal')->upcoming()->find();
    }
    
    /**
     * Displays a form with all available meals
     * @return void
     */
    public function action_uitgebreidinschrijven()
    {
        $this->template->content->meals = ORM::factory('meal')->upcoming()->find_all();
    }
    
    /**
     * Frontpage of the website and the quick form
     * @return void
     */
    public function action_aanmelden()
    {
        $validation = $this->valideer_aanmelding($_POST);
        if ($validation->check()) {
            // Escape data
            $name = HTML::chars($_POST['name']);
            // Find the first meal
            $meal = ORM::factory('meal')->upcoming()->find();
            if ($meal->loaded()) {
                $reg = ORM::factory('registration');
                $reg->name = $name;
                $reg->meal = $meal;
                try {
                    $reg->save();    
                }
                catch (ORM_Validation_Exception $e) {
                    // Do nothing; errors are retrieved in view
                }
                // Update user
                Flash::set(Flash::SUCCESS, 'Aanmelding geslaagd. Je kunt vanavond mee-eten.');
            }
            else {
                throw new HTTP_Exception_404('Maaltijd niet gevonden');
            }
        }
        // Redirect back to form
        $this->request->redirect('/');
    }

    /**
     * Adds a new set of registrations with a specified name
     * @return void
     */
    public function action_uitgebreidaanmelden()
    {
        $validation = $this->valideer_aanmelding($_POST);
        if ($validation->check()) {
            // Escape data
            $name = HTML::chars($_POST['name']);
            $email = HTML::chars($_POST['email']);
            // Create registrations
            $registrations = array();
            foreach ($_POST['meals'] as $meal_id) {
                $reg = ORM::factory('registration');
                $reg->name = $name;
                $reg->email = $email;
                $reg->meal = ORM::factory('meal', (int)$meal_id);
                $reg->save();
                $registrations[] = $reg;
            }
            // Update user
            Mailer_Registration::send_confirmation($name, $email, $registrations);
            Flash::set(Flash::SUCCESS, 'Aanmelding geslaagd. Je ontvangt een e-mail met alle details.');
        }
        else {
            $message = $this->errors($validation);
            Flash::set(Flash::ERROR, $message);
        }
        $this->request->redirect('/');
    }

    /**
     * Removes a registration (after validation)
     * @return void
     */
    public function action_afmelden()
    {
        $id = $this->request->param('id');
        $salt = $this->request->param('salt');
        $registration = ORM::factory('registration', array('id' => $id, 'salt' => $salt));

        if ($registration->loaded()) {
            if ($registration->meal->open_for_registrations()) {
                $date = (string)$registration->meal;
                $registration->delete();
                Flash::set(Flash::SUCCESS, "Je bent afgemeld voor de maaltijd op $date");
            }
            else {
                Flash::set(Flash::ERROR, 'De inschrijving voor deze maaltijd is gesloten. Je kunt je niet meer afmelden.');
            }
        }
        else {
            Flash::set(Flash::ERROR, 'Je bent niet afgemeld voor de maaltijd. Dat kan verschillende oorzaken hebben: <ul><li>je bent al eerder afgemeld</li><li>de beveiligingscode klopt niet (gebruik de link in je e-mail)</li></ul>');
        }
        $this->request->redirect('/');
    }
    
    /**
     * Validates a quick registration attempt
     * @param array $data
     * @return Validation
     */
    private function valideer_aanmelding($data)
    {
        $validation = Validation::factory($data);
        $validation->rules('name', array(array('not_empty'),array('regex',array(':value','/[:alpha,:blank]+/'))));
        return $validation;
    }

    /**
     * Validates a extensive registration attempt
     * @param array $data
     * @return Validation
     */
    private function valideer_uitgebreideaanmelding($data)
    {
        $validation = $this->valideer_aanmelding($data);
        $validation->rules('email', array(array('not_empty'), array('email')));
        $validation->rules('meals', array(array('not_empty')));
        return $validation;
    }

    /**
     * Prints the errors of a validation object in a user-friendly format
     * @param Validation $validation
     * @return string
     */
    private function errors(Validation $validation)
    {
        $string = '';
        $fields = $validation->errors('errors');

        // Don't output anything when the errors-array is empty
        if (sizeof($fields) === 0) {
            return;
        }

        $string .= '<p><strong>De wijzigingen konden niet worden opgeslagen:</strong></p>';

        $string .= '<ul>';

        foreach ($fields as $field => $error) {
            $string .= '<li>' . $error . '</li>';
        }
        $string .= '</ul>';

        return $string;
    }
}