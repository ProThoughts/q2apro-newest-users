<?php

class qa_html_theme_layer extends qa_html_theme_base
{

	function doctype(){
	
		qa_html_theme_base::doctype();

		global $qa_request;
		// adds subnavigation to pages newusers and users
		if($qa_request == 'newusers' || $qa_request == 'users' ) {
			$this->content['navigation']['sub'] = array(
				'users' => array(
					'url' => qa_path_html('users'),
					'label' => qa_lang_html('main/highest_users'),
					'selected' => ($qa_request == 'users')
				),
				'newusers' => array(
					'label' => qa_lang_html('qa_new_users_lang/subnav_title'),
					'url' => qa_path_html('newusers'),
					'selected' => ($qa_request == 'newusers')
				),
			);
		}
	}

}
