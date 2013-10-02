# SisowIdeal
- - -

# Intro

This CakePHP plugin provides a Sisow (http://sisow.nl) iDEAL payment module.

# Installation and Setup

(1) Check out a copy of the SisowIdeal CakePHP plugin from the repository using Git :

	git clone http://github.com/stefanvangastel/CakePHP-SisowIdeal.git

or download the archive from Github: 

	https://github.com/stefanvangastel/CakePHP-SisowIdeal/archive/master.zip

You must place the SisowIdeal CakePHP plugin within your CakePHP 2.x app/Plugin directory.

(2) Load the plugin in app/Config/bootstrap.php

// Load SisowIdeal plugin, with loading routes for short urls
	
	CakePlugin::load('SisowIdeal');

(3) Load the Component in your AppController to get the info in the session var. Your $components array may then look like this:

	public $components = array(
		'Session',
		'RequestHandler',
		'SisowIdeal.Sisow', // <- This is the line that will trigger the magic
		'DebugKit.Toolbar'
	);

(4) Create a config ini file in app/Config/ called sisow.ini (example ini file in root of this plugin). The file should contain the following 2 lines:

	merchantId = 'thisshouldbeid'
	merchantKey = 'thisshouldbethekey'

# Usage

Example controller and view are included!