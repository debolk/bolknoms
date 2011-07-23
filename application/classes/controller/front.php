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
            Flash::set(Flash::SUCCESS, 'Aanmelding geslaagd. Je ontvangt een bevestiging per e-mail.');
        }
        else {
            Flash::set(Flash::ERROR, 'Aanmelding mislukt. Er ging iets mis met je aanmelding. Probeer het nog eens of neem contact op met het bestuur.');
        }
        $this->request->redirect('/');
    }

    public function action_administratie()
    {
        $this->template->content->upcoming_days = ORM::factory('day')->upcoming()->find_all();
        $this->template->content->previous_days = ORM::factory('day')->previous()->find_all();
    }
}