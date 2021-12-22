<?php





function activated_plugin_script_and_style() {
        wp_register_style( 'activated_button_css', plugin_dir_url(__FILE__).'css/activated_button_css.css');
        wp_enqueue_style( 'activated_button_css' );

        wp_register_script( 'activated_button_js', plugin_dir_url(__FILE__).'js/activated_button_js.js',array('jquery'));
        wp_enqueue_script( 'activated_button_js' );
        wp_localize_script( 'activated_button_js', 'adminAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ));
}
if (isset($_GET['page'])){
	if($_GET['page']=='RbWeb'){
		add_action( 'admin_enqueue_scripts', 'activated_plugin_script_and_style' );
	}
}
add_action( 'wp_ajax_activated_button', 'activate_plugin_ajax' );

add_option( 'activated_plugins', [], '', 'yes' );
function activate_plugin_ajax(){		
	$activated_plugin=[];
	foreach ($_GET as $key=> $value ) {
		if ($value==1){
			$activated_plugin[]=$key;
		}
	}
	update_option('activated_plugins',$activated_plugin);
	wp_send_json_success( $activated_plugin );
}











function on_off_button($name,$id){

	
	echo(
		' <div class="switch-holder">
            <div class="switch-label">
                <i class=""></i><span>'.$name.'</span>
            </div>
            <div class="switch-toggle">
                <input id='.$id.' onclick=hide_and_show_buttons() class="input" name="'.$id.'" type="checkbox"'); if(in_array($id,get_option("activated_plugins"))){echo('checked ' );} echo('id="'.$id.'">
                <label for="'.$id.'"></label>
            </div>
        </div>


        '
	);


}

function Handle_all_menus(){

	?>
	<div class="container" id='container'>
		<div>
			<?php on_off_button('Publication','publication');?>
			
		</div>
		<div id='publication_child_plugin'>
			<?php on_off_button('Arxiv','arxiv');?>
			<?php on_off_button('BibTex','bibtex');?>
			<?php on_off_button('Zotero','zotero');?>
			<?php on_off_button('ORCID','orcid');?>
			<?php on_off_button('HAL','hal');?>
		</div>

		<div>
			<?php on_off_button('Member','member');?>
		</div>

		<div>
			<?php on_off_button('Jobs','job');?>
		</div>

		<div>
			<?php on_off_button('Team','team');?>
		</div>
		


	</div>
	<form method='post'><input type="submit" name="Valider"></form>
	
	<?php
}