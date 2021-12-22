<?php

add_action('admin_menu', 'add_menu_for_rbWeb');

function add_menu_for_rbWeb() {
 	add_menu_page('RbWeb', //Menu Name
 				'Rubidium Web', // Menu label
 				'manage_options', // capability
 				'RbWeb',// slug
 				'Handle_all_menus' //function to call -> activated_plugins.php
 				);
}


if (in_array('publication',get_option("activated_plugins"))){
	add_action('admin_menu', 'add_menu_for_publication');
	function add_menu_for_publication() {
	 	add_menu_page('RbPublication', //Menu Name
	 				'Publications', // Menu label
	 				'manage_options', // capability
	 				'publications',// slug
	 				'publication_page_setup',//function to call -> /publications/index_publications.php
	 				'dashicons-welcome-write-blog', 
	 				'10'
	 				
	 				);
	}



	// submenu of publication
	if (in_array('arxiv',get_option("activated_plugins"))){
		add_action('admin_menu', 'add_submenu_for_arxiv');
		function add_submenu_for_arxiv() {
		 	add_submenu_page('publications', //Parent slug 
		 				'Arxiv', // page title
		 				'Arxiv', // Menu label
		 				'manage_options', // capability
		 				'arxiv',// slug
		 				'arxiv_page_setup',//function to call -> /arxiv/index_arxiv.php
		 				
		 				);
		}
	}

	if (in_array('bibtex',get_option("activated_plugins"))){
		add_action('admin_menu', 'add_submenu_for_Bibtex');
		function add_submenu_for_Bibtex() {
		 	add_submenu_page('publications', //Parent slug 
		 				'Bibtex', // page title
		 				'Bibtex', // Menu label
		 				'manage_options', // capability
		 				'Bibtex',// slug
		 				'Bibtex_page_setup',//function to call -> /bibtex/index_bibtex.php
		 				
		 				);
		}
	}

	if (in_array('zotero',get_option("activated_plugins"))){
		add_action('admin_menu', 'add_submenu_for_zotero');
		function add_submenu_for_zotero() {
		 	add_submenu_page('publications', //Parent slug 
		 				'Zotero', // page title
		 				'Zotero', // Menu label
		 				'manage_options', // capability
		 				'zotero',// slug
		 				'Zotero_page_setup',//function to call -> /zotero/index_zotero.php
		 				
		 				);
		}
	}

	if (in_array('orcid',get_option("activated_plugins"))){
		add_action('admin_menu', 'add_submenu_for_orcid');
		function add_submenu_for_orcid() {
		 	add_submenu_page('publications', //Parent slug 
		 				'ORCID', // page title
		 				'ORCID', // Menu label
		 				'manage_options', // capability
		 				'orcid',// slug
		 				'orcid_page_setup',//function to call -> /orcid/index_orcid.php
		 				
		 				);
		}
	}


	if (in_array('hal',get_option("activated_plugins"))){
		add_action('admin_menu', 'add_submenu_for_hal');
		function add_submenu_for_hal() {
		 	add_submenu_page('publications', //Parent slug 
		 				'HAL', // page title
		 				'HAL', // Menu label
		 				'manage_options', // capability
		 				'hal',// slug
		 				'hal_page_setup',//function to call -> /hal/index_hal.php
		 				
		 				);
		}
	}
}




if (in_array('member',get_option("activated_plugins"))){
	add_action('admin_menu', 'add_menu_for_member');
	function add_menu_for_member() {
	 	add_menu_page('RbMember', //Menu Name
	 				'Members', // Menu label
	 				'manage_options', // capability
	 				'member',// slug
	 				'member_page_setup',//function to call -> /members/index_members.php
	 				'dashicons-universal-access', 
	 				'11'
	 				);
	}
}


if (in_array('job',get_option("activated_plugins"))){
	add_action('admin_menu', 'add_menu_for_job');
	function add_menu_for_job() {
	 	add_menu_page('RbJob', //Menu Name
	 				'Jobs', // Menu label
	 				'manage_options', // capability
	 				'job',// slug
	 				'job_page_setup',//function to call -> /jobs/index_jobs.php
	 				'dashicons-money-alt', 
	 				'12'
	 				);
	}
}


if (in_array('team',get_option("activated_plugins"))){
	add_action('admin_menu', 'add_menu_for_team');
	function add_menu_for_team() {
	 	add_menu_page('RbTeam', //Menu Name
	 				'Teams', // Menu label
	 				'manage_options', // capability
	 				'team',// slug
	 				'team_page_setup',//function to call -> /teams/index_teams.php
	 				'', 
	 				'13'
	 				);
	}
}






















