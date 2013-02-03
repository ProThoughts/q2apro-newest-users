<?php
/*
	Plugin Name: Newest Users Page
	Plugin URI: https://github.com/echteinfachtv/q2a-newest-users-page
	Plugin Description: Displays the newest users of the last x days on a separate page
	Plugin Version: 0.4
	Plugin Date: 2013-01-25
	Plugin Author: echteinfachtv
	Plugin Author URI: http://www.echteinfach.tv/
	Plugin License: GPLv3
	Plugin Minimum Question2Answer Version: 1.5
	Plugin Update Check URI: https://raw.github.com/echteinfachtv/q2a-newest-users-page/master/qa-plugin.php

	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	More about this license: http://www.gnu.org/licenses/gpl.html
	
*/

if ( !defined('QA_VERSION') )
{
	header('Location: ../../');
	exit;
}

// page
qa_register_plugin_module('page', 'qa-new-users-page.php', 'qa_new_users_page', 'New Users Page');

// language file
qa_register_plugin_phrases('qa-new-users-lang.php', 'qa_new_users_lang');

// change default users page, add subnavigation "newest users"
// qa_register_plugin_layer('qa-new-users-layer.php', 'New-Users-Subnav');



/*
	Omit PHP closing tag to help avoid accidental output
*/