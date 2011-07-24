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
     * List all past and current days
     * @return void
     */
    public function action_index()
    {
        $this->template->content->upcoming_days = ORM::factory('day')->upcoming()->find_all();
        $this->template->content->previous_days = ORM::factory('day')->previous()->find_all();
    }

    /**
     * Creates a new day in the system
     * @return void
     */
    public function action_nieuwe_maaltijd()
    {
        $this->template->content->day = $day = ORM::factory('day');

        if ($_POST) {
            $day->values($_POST, array('date'));
            try {
                $day->save();
                Flash::set(Flash::SUCCESS, 'Maaltijd toegevoegd');
                $this->request->redirect('/administratie');
            }
            catch (ORM_Validation_Exception $e) {
                // Nothing here, errors are retrieved in the view
                // specifically the Helper_Form class
            }
        }
    }

    public function action_verwijder($day_id)
    {
        ORM::factory('day',$day_id)->delete();
        Flash::set(Flash::SUCCESS,'Maaltijd verwijderd');
        $this->request->redirect('/administratie');
    }
}