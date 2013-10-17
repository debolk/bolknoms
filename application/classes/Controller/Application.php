<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller_Application extends Controller_Template
{
    /**
     * The template to use by default for all views (can be overridden if needed)
     * @var string
     */
    public $template = 'layouts/application';

    /**
     * Construct the default settings for controllers: mostly deals with
     * layouts and views
     */
    public function before()
    {
        parent::before();

        $this->_load_default_view();

        $this->top(10);
        $this->promotions();
    }

    /**
     * Auto-loads the view if it matches the controller/action.php naming scheme
     */
    private function _load_default_view()
    {
        $view_file = strtolower($this->request->controller() . DIRECTORY_SEPARATOR . $this->request->action());
        if (Kohana::find_file('views', $view_file, 'php')) {
            $this->template->content = View::factory($view_file);
        }
    }

    /**
     * Forces an user to authenticate before proceeding
     * @return void
     */
    protected function authenticate()
    {
        // If no password is supplied, force the user to authenticate
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
           return $this->_ask_for_credentials();
        }
        else {
            // If a credentials are supplied, attempt to authenticate
            $username = Kohana::$config->load('bolknoms.administration.username');
            $password = Kohana::$config->load('bolknoms.administration.password');
            if ($_SERVER['PHP_AUTH_USER'] === $username && $_SERVER['PHP_AUTH_PW'] === $password) {
                return;
            }
            else {
                throw new HTTP_Exception_403();
            }
        }
    }

    /**
     * Asks the user nicely to supply valid credentials
     * @return void
     */
    private function _ask_for_credentials()
    {
        header('WWW-Authenticate: Basic realm="Bolknoms"');
        header('HTTP/1.0 401 Unauthorized');
        echo View::factory('error/403');
        exit;
    }

    /**
     * Loads the top X of eaters with their stats
     * @param int $count number of eaters to retrieve
     */
    private function top($count = 5)
    {
        View::set_global('top_eaters_alltime', ORM::factory('Registration')->top_alltime($count));
        View::set_global('top_eaters_ytd', ORM::factory('Registration')->top_ytd($count));
    }

    /**
     * Loads all promoted meals
     */
    private function promotions()
    {
        View::set_global('promoted_meals', ORM::factory('Meal')->promotions()->find_all());
    }
}