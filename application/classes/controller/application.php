<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller_Application extends Controller_Template
{
    public $template = 'layouts/application';

    /**
     * Construct the default settings for controllers: mostly deals with
     * layouts and views
     */
    public function before()
    {
        parent::before();

        $this->_load_default_view();
    }

    /**
     * Auto-loads the view if it matches the controller/action.php naming scheme
     */
    private function _load_default_view()
    {
        $view_file = $this->request->controller() . DIRECTORY_SEPARATOR . $this->request->action();
        if (Kohana::find_file('views', $view_file, 'php')) {
            $this->template->content = View::factory($view_file);
        }
    }
}