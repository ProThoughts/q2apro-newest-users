<?php

	class qa_new_users_page {
		
		var $directory;
		var $urltoroot;
		
		function load_module($directory, $urltoroot)
		{
			$this->directory=$directory;
			$this->urltoroot=$urltoroot;
		}
		
		// for display in admin interface under admin/pages
		function suggest_requests() 
		{	
			return array(
				array(
					'title' => 'Newest Users Page', // title of page
					'request' => 'newusers', // request name
					'nav' => 'M', // 'M'=main, 'F'=footer, 'B'=before main, 'O'=opposite main, null=none
				),
			);
		}
		
		// for url query
		function match_request($request)
		{
			if ($request=='newusers') {
				return true;
			}

			return false;
		}

		function process_request($request)
		{
		
			/* SETTINGS */
			$lastdays = 14; 			// show new users from last x days
			$maxusers = 100;			// max new users to display
			$creditDeveloper = true;	// leave true if you like this plugin, it sets one hidden link to my q2a-forum from the new-user-page only
			
			/* start */
			$qa_content=qa_content_prepare();

			// return if not admin!
			$level=qa_get_logged_in_level();
			if ($level < QA_USER_LEVEL_ADMIN) {
				$qa_content['custom0']='<div>'.qa_lang_html('qa_new_users_lang/access_forbidden').'</div>';
				return $qa_content;
			}
			
			// add sub navigation
			// $qa_content['navigation']['sub']=qa_users_sub_navigation();
			$qa_content['title'] = $maxusers . ' ' . qa_lang_html('qa_new_users_lang/page_title'); // page title

			// counter for custom html output
			$c = 2;
			
			// query last 100 users
			$queryRecentUsers = qa_db_query_sub("SELECT userid,created,handle,avatarblobid,avatarwidth,avatarheight,email,flags
											FROM `^users`
											ORDER BY created DESC
											LIMIT 0,#;", $maxusers); 

			// initiate output string
			$newestusers = "<table> <thead><tr>
								<th>".qa_lang_html('qa_new_users_lang/user_since')."</th> 
								<th>".qa_lang_html('qa_new_users_lang/user_name')."</th> 
								<th>".qa_lang_html('users/website')."</th> 
								<th>".qa_lang_html('qa_new_users_lang/user_email')."</th> 
								<th>".qa_lang_html('qa_new_users_lang/user_email_confirmed')."</th> 
								<th>".qa_lang_html('qa_new_users_lang/points_abbr')."</th> 
								<th>".qa_lang_html('qa_new_users_lang/questions_abbr')."</th> 
								<th>".qa_lang_html('qa_new_users_lang/answers_abbr')."</th> 
								<th>".qa_lang_html('qa_new_users_lang/comments_abbr')."</th> 
							</tr></thead>";
			$d = 0;
			while ( ($userrow = qa_db_read_one_assoc($queryRecentUsers,true)) !== null ) {
				// do not list blocked users
				// if (! (QA_USER_FLAGS_USER_BLOCKED & $userrow['flags'])) {
					//$avatar = "-";
					//if(!empty($userrow['avatarblobid'])) {
					//	$avatar = "<img src='?qa=image&qa_blobid=". $userrow['avatarblobid'] . "&qa_size=30' />";			
					//}
					// query userprofile
					$queryUserWebsite = qa_db_read_one_assoc( qa_db_query_sub('SELECT content
											FROM `^userprofile`
											WHERE `userid`=$
											AND title="website"
											LIMIT 1;', $userrow['userid']), true ); 
					$userwebsite = (isset($queryUserWebsite['content']) && trim($queryUserWebsite['content'])!='') ? $queryUserWebsite['content'] : '-';
					
					$emailConfirmed = ( QA_USER_FLAGS_EMAIL_CONFIRMED && $userrow['flags'] ) ? "x" : qa_lang_html('qa_new_users_lang/user_email_notconfirmed');
					
					// query userpoints and Q,A,C
					$queryUserPQAC = qa_db_read_one_assoc( qa_db_query_sub('SELECT points, qposts, aposts, cposts
											FROM `^userpoints`
											WHERE `userid`=$
											LIMIT 1;', $userrow['userid']), true ); 

					// substr removes seconds
					$newestusers .= "<tr>
						<td>".substr($userrow['created'],0,16)."</td> 
						<td>". qa_get_user_avatar_html($userrow['flags'], $userrow['email'], $userrow['handle'], $userrow['avatarblobid'], $userrow['avatarwidth'], $userrow['avatarheight'], qa_opt('avatar_users_size'), false) . " " . qa_get_one_user_html($userrow['handle'], false) . " </td> 
						<td>".$userwebsite."</td> 
						<td>".$userrow['email']."</td> 
						<td>".$emailConfirmed."</td> 
						<td>".$queryUserPQAC['points']."</td> 
						<td>".$queryUserPQAC['qposts']."</td> 
						<td>".$queryUserPQAC['aposts']."</td> 
						<td>".$queryUserPQAC['cposts']."</td> 
						</tr>";
				//}
			}
			$newestusers .= "</table>";

			
			/* output into theme */
			$qa_content['custom'.++$c]='<div class="newusers" style="border-radius:0; padding:0; margin-top:-2px;">';
			
			$qa_content['custom'.++$c]= $newestusers;
			
			$qa_content['custom'.++$c]='</div>';
			
			// make newest users list bigger on page
			$qa_content['custom'.++$c] = '<style type="text/css">
			table thead tr th,table tfoot tr th{background-color:#cfc;border:1px solid #CCC;padding:4px} 
			table{background-color:#EEE;margin:30px 0 15px;text-align:left;border-collapse:collapse} 
			td{border:1px solid #CCC;padding:1px 10px;line-height:25px}
			tr:hover{background:#ffc} th {text-align:center; } 
			td img{border:1px solid #DDD !important; margin-right:5px;} 
			table>tbody>tr>td:nth-child(7){background:#DFD;}
			table>tbody>tr>td:nth-child(8){background:#DDF;}
			table>tbody>tr>td:nth-child(9){background:#DDD;}
			</style>';
			
			// as I said, this is one chance to say thank you
			if($creditDeveloper) {
				$qa_content['custom'.++$c] = "<a style='display:none' href='http://www.gute-mathe-fragen.de/'>Gute Mathe-Fragen! * Bestes Mathe-Forum</a>";
			}
			
			return $qa_content;
		}
		
	};
	

/*
	Omit PHP closing tag to help avoid accidental output
*/