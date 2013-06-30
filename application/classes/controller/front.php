<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Front extends Controller_Application
{
    /**
     * Displays a form with all available meals
     * @return void
     */
    public function action_index()
    {
        $this->template->content->upcoming_meal = ORM::factory('meal')->available()->find();
    }

    public function action_inschrijven_specifiek()
    {
        $this->template->content->meal = $this->find_meal();
    }

    public function action_aanmelden_specifiek()
    {
        $meal = $this->find_meal();

        $validation = $this->valideer_aanmelding($_POST);
        if ($validation->check()) {
            // Escape data
            $name = HTML::chars($_POST['name']);
            $handicap = HTML::chars($_POST['handicap']);
            $email = HTML::chars($_POST['email']);
            
            if ($meal->loaded()) {
                $reg = ORM::factory('registration');
                $reg->name = $name;
                $reg->email = $email;
                $reg->handicap = $handicap;
                $reg->meal = ORM::factory('meal', $meal->id);
                try {
                    $reg->save();
                    Log::instance()->add(Log::NOTICE, "Aangemeld: specifiek|$reg->id|$reg->name");
                }
                catch (ORM_Validation_Exception $e) {
                    // Do nothing; errors are retrieved in view
                }
                // Update user
                Flash::set(Flash::SUCCESS, '<p>Aanmelding geslaagd. Je kunt mee-eten.</p>'.Helper_Chef::random_video());
            }
            else {
                throw new HTTP_Exception_404('Maaltijd niet gevonden');
            }
        }
        else {
            $message = $this->errors($validation);
            Flash::set(Flash::ERROR, $message);    
        }
        // Redirect back to form
        $this->redirect(Route::url('inschrijven_specifiek',array('id' => $meal->id)));
    }
    
    /**
     * Displays a form with all available meals
     * @return void
     */
    public function action_uitgebreidinschrijven()
    {
        $this->template->content->meals = ORM::factory('meal')->available()->find_all();
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
            $meal = ORM::factory('meal')->available()->find();
            if ($meal->loaded()) {
                $reg = ORM::factory('registration');
                $reg->name = $name;
                $reg->meal = $meal;
                try {
                    $reg->save(); 
                    Log::instance()->add(Log::NOTICE, "Aangemeld: snel|$reg->id|$reg->name");
                }
                catch (ORM_Validation_Exception $e) {
                    // Do nothing; errors are retrieved in view
                }
                // Update user
                Flash::set(Flash::SUCCESS, '<p>Aanmelding geslaagd. Je kunt mee-eten.</p>'.Helper_Chef::random_video());
            }
            else {
                throw new HTTP_Exception_404('Maaltijd niet gevonden');
            }
        }
        else {
            $message = $this->errors($validation);
            Flash::set(Flash::ERROR, $message);    
        }
        // Redirect back to form
        $this->redirect('/');
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
            $handicap = HTML::chars($_POST['handicap']);
            $email = HTML::chars($_POST['email']);
            // Create registrations
            $registrations = array();
            foreach ($_POST['meals'] as $meal_id) {
                $reg = ORM::factory('registration');
                $reg->name = $name;
                $reg->email = $email;
                $reg->handicap = $handicap;
                $reg->meal = ORM::factory('meal', (int)$meal_id);
                $reg->save();
                Log::instance()->add(Log::NOTICE, "Aangemeld: uitgebreid|$reg->id|$reg->name");
                $registrations[] = $reg;
            }
            // Update user
            Mailer_Registration::send_confirmation($name, $email, $registrations);
            Flash::set(Flash::SUCCESS, '<p>Aanmelding geslaagd. Je ontvangt een e-mail met alle details.</p>'.Helper_Chef::random_video());
        }
        else {
            $message = $this->errors($validation);
            Flash::set(Flash::ERROR, $message);
        }
        $this->redirect('/');
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
                $id = $registration->id;
                $name = $registration->name;
                $meal = $registration->meal->date;
                $registration->delete();
                Log::instance()->add(Log::NOTICE, "Afgemeld: e-mail|$id|$name|$meal");
                Flash::set(Flash::SUCCESS, "Je bent afgemeld voor de maaltijd op $date");
            }
            else {
                Flash::set(Flash::ERROR, 'De inschrijving voor deze maaltijd is gesloten. Je kunt je niet meer afmelden.');
            }
        }
        else {
            Flash::set(Flash::ERROR, 'Je bent niet afgemeld voor de maaltijd. Dat kan verschillende oorzaken hebben: <ul><li>je bent al eerder afgemeld</li><li>de beveiligingscode klopt niet (gebruik de link in je e-mail)</li></ul>');
        }
        $this->redirect('/');
    }

    /**
     * Outputs the disclaimer for the website
     */
    public function action_disclaimer()
    {
    }

    /**
     * Outputs the privacy statement for the website
     */
    public function action_privacy()
    {
    }
    
    /**
     * Validates a quick registration attempt
     * @param array $data
     * @return Validation
     */
    private function valideer_aanmelding($data)
    {
        $validation = Validation::factory($data);
        $validation->rules('name', array(array('not_empty'),array('regex',array(':value','/[A-Za-z -]+/'))));
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

    private function find_meal()
    {
        $meal = ORM::factory('meal',$this->request->param('id'));
        if (! $meal->loaded()) {
            throw new HTTP_Exception_404;
        }
        return $meal;
    }
}