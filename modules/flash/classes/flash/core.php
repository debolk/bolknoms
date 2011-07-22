<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Allows you to easily set and display flash messages
 */
class Flash_Core
{
    /**
     * Available types
     */
    const WARNING = 'warning';
    const ERROR = 'error';
    const SUCCESS = 'success';

    /**
     * Sets a flash message
     * @param string $message
     * @param const $type either warning, error or success
     */
    public static function set($type, $message)
    {
        if (!in_array($type, array(Flash_Core::ERROR, Flash_Core::WARNING, Flash_Core::SUCCESS))) {
            throw new InvalidArgumentException('Type of flash message should be a defined constant');
        }

        $messages = Session::instance()->get('_flash', array());
        $messages[] = array('type' => $type, 'message' => $message);
        Session::instance()->set('_flash',$messages);
    }

    /**
     * Display all messages formatted
     * @return string
     */
    public static function display_messages()
    {
        $view = View::factory('flash/messages');
        $view->messages = Session::instance()->get_once('_flash', array());
        return $view->render();
    }
}