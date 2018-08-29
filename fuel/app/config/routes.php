<?php
return array(
	'_root_'  => 'user/login',  // The default route
	'_404_'   => 'welcome/404',    // The main 404 route
	'subscribe' => 'user/create',  //The user subscribe page
	'login' => 'user/login', //the login user page
	'populate' => 'film/populate',
	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
);
