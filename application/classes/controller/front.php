<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Front extends Controller_Application
{
    public function action_index()
    {
        $this->template->content->days = ORM::factory('day')->upcoming()->find_all();
    }
}