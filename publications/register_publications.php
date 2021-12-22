<?php

add_action( 'wp_ajax_register_publications', 'register_publications');
function register_publications(){
    $args = array(
      'post_type' => 'publication',
      'post_status' => 'publish',
      'post_title'=>$_POST['Title'],
    );
    $inserted_post_id = wp_insert_post( $args );
    
    foreach ($_POST as $key => $value) {
      $field='publication_'.$key;
      update_field($field, $value, $inserted_post_id);
    }
    wp_send_json_success($_POST);
}







