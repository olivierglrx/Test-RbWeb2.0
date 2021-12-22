<?php


include('publication_cpt.php');
include('register_publications.php');
function add_common_css_for_publication(){
  wp_register_style( 'publications_table', plugins_url().'/rbWeb/publications/css/publications_table.css');
  wp_enqueue_style( 'publications_table' );

  wp_register_style( 'common_css_for_publication', plugins_url().'/rbWeb/publications/css/common_css_for_publication.css');
  wp_enqueue_style( 'common_css_for_publication' );

  wp_enqueue_script('table_data_save', plugins_url().'/rbWeb/publications/js/insert_table_in_database.js');
  wp_localize_script( 'table_data_save', 'adminAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
  wp_enqueue_script('table_creation', plugins_url().'/rbWeb/publications/js/create_table.js');
}


add_action('admin_enqueue_scripts','add_common_css_for_publication');



function add_side_form_fill_ajax(){
	wp_register_style( 'index_publication_css', plugins_url().'/rbWeb/publications/css/index_publication.css');
  wp_enqueue_style( 'index_publication_css' );


	wp_register_script( 'side_form_fill_ajax', plugins_url().'/rbWeb/publications/js/side_form_fill_and_save.js',array('jquery') );
  	wp_enqueue_script( 'side_form_fill_ajax' );
  	wp_localize_script( 'side_form_fill_ajax', 'adminAjax', 
	array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'var2'=>'php data' ));
}

if (isset($_GET['page'])){
	if($_GET['page']=='publications'){
		add_action('admin_enqueue_scripts','add_side_form_fill_ajax');
	}
}
add_action( 'wp_ajax_ajax_side', 'callBack_function' );

function callBack_function(){
	$id=$_POST['article_id'];
	$doi=get_field('publication_doi',$id);
	$title=get_field('publication_title',$id);
	$dop=get_field('publication_dop',$id);
	$authors=get_field('publication_authors',$id);
	$abstract=get_field('publication_abstract',$id);
	wp_send_json_success( array('id'=>$id, 'doi'=>$doi, 'author'=>$authors, 'title'=>$title , 'abstract'=>$abstract ));
}


add_action( 'wp_ajax_update_publication', 'actualize_publication' );

function actualize_publication(){
  $id=$_POST['article_id'];
  
    

  $title=$_POST['title'];

  // $dop=strval($_POST['Year'.strval($i)]);
  // update_field('publication_dop', $dop, $inserted_post_id);
  update_field('publication_title', $title, $id);
  // update_field('publication_journal', $_POST['Journal'.strval($i)], $inserted_post_id);
  // update_field('publication_authors', $_POST['Authors'.strval($i)],$inserted_post_id);
  // update_field('publication_abstract', $_POST['Abstract'.strval($i)],$inserted_post_id);
  // update_field('publication_volume', $_POST['Volume'.strval($i)],$inserted_post_id);
  // update_field('publication_pages', $_POST['Pages'.strval($i)],$inserted_post_id);
  // update_field('publication_doi', $_POST['DOI'.strval($i)],$inserted_post_id);
}

  


	



function publication_page_setup(){

	?>
	<h1>Publications </h1>
	 <div class='container' >
    
      <table id="main_table"  style="">
        <thead>
          <tr>

            <th>title</th>
            <th>authors</th>
            <th>Year</th>
            
          </tr>
    </thead>
        <tbody>
    <?php

	$loop = new WP_Query( array( 'post_type' => 'publication' ) ); 
	while ( $loop->have_posts() ) {
		$loop->the_post(); 
		$id=get_the_id();
    	// echo(get_field('publication_title',get_the_id()));
    	?>
	    <tr class="row" onClick=AjaxFunction(this.id) id=<?php echo('publication_'.$id);?> >
        <td>  
      		<input  type="text" name="title" value="<?php echo(get_field('publication_title',$id));?>" >
      
        </td>
        <td>
            <input type="text" name="authors" value="<?php echo( get_field('publication_authors',$id));?> ">  
        </td>
         <td>
            <input type="text" name="dop" value="<?php echo( get_field('publication_dop',$id));?> ">  
        </td>
  
         <?php
       }
	
	wp_reset_query(); 

	?>
</tbody>
</table>
<div class='side_form'>


	<table id='side_table'>




	</table>

</div>
</div>


 


</head>
<body>
 

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<script>
   
 // $('#main_table').sortable();
     $('#main_table tbody').sortable({
    helper: fixWidthHelper
}).disableSelection();

function fixWidthHelper(e, ui) {
    ui.children().each(function() {
        $(this).width($(this).width());
    });
    return ui;
}



</script> 

<?php


}








