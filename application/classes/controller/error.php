<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Error extends Controller_Application
{
    
    public function action_403()
    {
        $this->response->status(403);
    }
    
    public function action_404()
    {
        $this->response->status(404);
    }
    
    public function action_500()
    {
        $this->response->status(500);
    }
     
    public function action_503()
    {
        $this->response->status(503);
    }    
}