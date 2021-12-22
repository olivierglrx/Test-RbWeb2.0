<?php



function orcid_script(){
	// Specific css for the page
	wp_register_style( 'index_orcid_css', plugins_url( 'css', __FILE__ ).'/index_orcid.css');
    wp_enqueue_style( 'index_orcid_css' );

    // We  transform orcid entry into bibtex, then we parse the bib
    wp_enqueue_script('bib-parser-js', plugins_url().'/rbWeb/publications/bibtex/js/bibtexParseJs-master/bibtexParse.js');
    wp_register_script( 'bibtex_entry', plugins_url().'/rbWeb/publications/bibtex/js/bibtex_table_and_parser.js',array('jquery') );
    wp_enqueue_script( 'bibtex_entry' );


    // Specific js, needed to parse and 
    wp_enqueue_script('orcid-parser', plugins_url( 'js', __FILE__ ).'/orcid_parse.js');
    wp_localize_script( 'orcid-parser', 'adminAjax', 
	array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));

   

}

if (isset($_GET['page'])){
	if($_GET['page']=='orcid'){
		add_action('admin_enqueue_scripts','orcid_script');
	}
}


function orcid_page_setup(){
	?> 
	<!-- LOGO -->
	<div class='img_container'>
		<img id='orcid_logo' src=" <?php echo(plugins_url().'/rbWeb/publications/orcid/orcid_logo.png'); ?>">
	</div>


	<!-- Form -->
	<div class='search'>
 		<input id='orcid' type="text" name="orcid" placeholder="Name or ORCID..." >
		<button id='action-button'  class='bn36 bn3637' type="submit" name="orcid_button"> Search </button>		
	</div>

	<!-- Messages -->
  	<div  class='message_container' >
    	<div  id='message'> </div>
  	</div>

 	<!-- Table -->
	<div id='table_container'>
    	<table id="myTable"  style="display:none;">
    		<thead>
    		</thead>
      		
      		<tbody>
      		</tbody>
    	</table>  
	</div>

	<!-- Buttons -->
   	<div id='button_container' style="display:none;">
		<button class='bn36 bn3637' id='add_all' onclick='toggle_all()' >Toggle All</button>
    	<button class='bn36 bn3637' id='add_all' onclick='insert_publication()' >Add to my Publications </button>
    </div>
<?php

}

add_action( 'wp_ajax_get_orcid_number_from_name', 'get_orcid_number_from_name');
function get_orcid_number_from_name(){
	$name=$_POST['name'];
	$url='https://pub.orcid.org/v3.0/search/?q='.$name;
	$html = file_get_contents($url);
	echo $html;
}




