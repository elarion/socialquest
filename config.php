<?php

	// routes
	$config["routes"] = array(
		//game
		"init_party" => "game",
		"action" => "game",
		"restart" => "game",
		//home
        'home' => "home",
	);

	// Action par défaut
	$config["default"]["action"] = "home";