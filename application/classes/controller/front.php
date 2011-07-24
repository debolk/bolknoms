<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Front extends Controller_Application
{
    public function action_index()
    {
        $this->template->content->days = ORM::factory('day')->upcoming()->find_all();
    }

    public function action_aanmelden()
    {
        if ($_POST) {
            try {
                $registrations = array();
                // Create registrations
                foreach($_POST['days'] as $day_id) {
                    $reg = ORM::factory('registration');
                    $reg->name = $_POST['name'];
                    $reg->day = ORM::factory('day',$day_id);
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
        $this->request->redirect('/');
    }
}