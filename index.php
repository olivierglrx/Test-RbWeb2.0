<?php
/**
 * @package Rb_Web
 * @version 1.0
 */
/*
Plugin Name: Rb_Web
Plugin URI: www.rubidiumweb.fr
Description: Rb Web option page
Author: Rb83 and Rb87
Version: 1.0
Author URI: http://ww.rubidiumweb.fr/
*/



include('activated_plugins.php');
include('menus.php');


if (in_array('publication',get_option("activated_plugins"))){
	include(plugin_dir_path(__FILE__).'publications/index_publications.php');

	if (in_array('arxiv',get_option("activated_plugins"))){
		include(plugin_dir_path(__FILE__).'publications/arxiv/index_arxiv.php');
	}
	if (in_array('bibtex',get_option("activated_plugins"))){
		include(plugin_dir_path(__FILE__).'publications/bibtex/index_bibtex.php');
	}
	if (in_array('zotero',get_option("activated_plugins"))){
		include(plugin_dir_path(__FILE__).'publications/zotero/index_zotero.php');
	}
	if (in_array('orcid',get_option("activated_plugins"))){
		include(plugin_dir_path(__FILE__).'publications/orcid/index_orcid.php');
	}
	if (in_array('hal',get_option("activated_plugins"))){
		include(plugin_dir_path(__FILE__).'publications/hal/index_hal.php');
	}
}

if (in_array('member',get_option("activated_plugins"))){
	include(plugin_dir_path(__FILE__).'members/index_members.php');

}

if (in_array('job',get_option("activated_plugins"))){
	include(plugin_dir_path(__FILE__).'jobs/index_jobs.php');

}

if (in_array('team',get_option("activated_plugins"))){
	include(plugin_dir_path(__FILE__).'teams/index_teams.php');

}


