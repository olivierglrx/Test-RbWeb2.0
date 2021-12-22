<?php
function hal_script(){
	wp_register_style( 'index_hal_css', plugins_url( 'css', __FILE__ ).'/index_hal.css');
    wp_enqueue_style( 'index_hal_css' );

    wp_register_script( 'hal_script', plugins_url( 'js', __FILE__ ).'/hal_script.js',array('jquery') );
    wp_enqueue_script( 'hal_script' );
  	wp_localize_script( 'hal_script', 'adminAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
 

}

if (isset($_GET['page'])){
	if($_GET['page']=='hal'){
		add_action('admin_enqueue_scripts','hal_script');
	}
}




function hal_page_setup(){
	
	?> 
	<div class='img_container'>
		<img id='hal_logo' src=" <?php echo(plugins_url().'/rbWeb/publications/hal/hal_logo.jpg'); ?>">
	</div>

	<!-- Search -->
	<div class='search'>
		<input id="search_input" type="text" size="50" placeholder="Search..." >
		<button class='bn36 bn3637' id='action-button' >Search</button>
	</div>

    <!-- Messages -->
    <div  class='message_container' >
        <div  id='message'> </div>
    </div>

    <!-- Table -->
    <div  id='table_container' >
        <table id="myTable"  style="display:none;">
        	<thead>
          	</thead>

			<tbody>
			</tbody>
      </table>    
    </div>

    <!-- Buttons -->
    <div id='button_container' style="display:none;">
        <button class='bn36 bn3637' id='toggle_all' onclick='toggle_all()' >Toggle All</button>
        <button class='bn36 bn3637' id='add_all' onclick='insert_publication()' >Add to my Publications </button>
    </div>

	<?php	


}



add_action( 'wp_ajax_get_hal_content', 'rb_get_hal_content');
function rb_get_hal_content(){
	$query=$_POST['author'];
	
	
	$results_of_search='abstract_s,authFullName_s,arxivId_s,files_s,journalDate_s,publicationDate_s,journalTitle_s,keyword_s,title_s';
	$base_url = 'http://api.archives-ouvertes.fr/search/?fl='.$results_of_search."&q=".$query;
	$json = file_get_contents($base_url);
	
	wp_send_json_success($json);
}



