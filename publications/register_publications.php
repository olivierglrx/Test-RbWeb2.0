<?php
// ['Title', 'Authors', 'Year', 'Type', 'Journal','DOI','ISBN', 'Volume', 'Link', 'Pages', 'Keywords', 'Publisher', 'Editor','Booktitle','Abstract','extra-info'];
add_action( 'wp_ajax_register_publications', 'register_publications');
function register_publications(){
    $args = array(
      'post_type' => 'publication',
      'post_status' => 'publish',
      'post_title'=>$_POST['Title'],
    );
    $inserted_post_id = wp_insert_post( $args );
    
    update_field('publication_title',   $_POST['Title'], $inserted_post_id);
    update_field('publication_authors', $_POST['Authors'], $inserted_post_id);
    update_field('publication_dop'    , $_POST['Year'],    $inserted_post_id);
    update_field('publication_journal', $_POST['Journal'], $inserted_post_id);
    update_field('publication_volume' , $_POST['Volume'],  $inserted_post_id);
    update_field('publication_pages'  , $_POST['Pages'],   $inserted_post_id);
    update_field('publication_doi',     $_POST['DOI'],     $inserted_post_id);
    update_field('publication_isbn',    $_POST['ISBN'],    $inserted_post_id);       
    update_field('publication_editor',  $_POST['editor'],  $inserted_post_id);
    update_field('publication_abstract',$_POST['Abstract'], $inserted_post_id);
    update_field('publication_arxiv_url',$_POST['Link'],   $inserted_post_id);
    update_field('publication_publisher', $_POST['Publisher'], $inserted_post_id);
    





    wp_send_json_success($_POST);
}







