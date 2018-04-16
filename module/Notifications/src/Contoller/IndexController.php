<?php
/**
 * @package Notifications Controller
 * This is the first class loaded when a request is made
 * by convention, indexAction is the method that's automatically run.
 */

namespace Notifications\Controller;

class IndexController
{
    public function indexAction()
    {
        error_log('Notifications\IndexController ran');
        return true;
        
    }
}
