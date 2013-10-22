<?php

	Class HomeController {
	    public function home()
	    {
	        global $template;

	        $template = 'home';
	        $class = Champion::$class;

	        return $class;
	    }
	}