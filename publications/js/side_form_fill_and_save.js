


function AjaxFunction(id){
  jQuery( document ).ready( function($) {
    Main_Table = document.getElementById('main_table');
    inputs = Main_Table.getElementsByTagName('input');
    const data= new Object();
    data.action='ajax_side';
    data.article_id=id.split('_')[1];
    
    $.ajax({
      url : adminAjax.ajaxurl,
      method : 'POST', // GET par défaut
      data,
      
      success : function( return_data ) { // en cas de requête réussie
        Side_Table = document.getElementById('#side_table');
        $("#side_table tr").remove(); 
        publication=return_data.data;

        
        // $('#side_table')[0].setAttribute("id", publication.id);
        $('#side_table').append('<tr><td>Title</td><td><input  type="text" name="title" value="'+publication.title+ '" ></td></tr>')
                        .append('<tr><td>Author</td><td><input  type="text" name="author" value="'+publication.author+ '" ></td></tr>')
                        .append('<tr><td>Abstract</td><td><input  type="text" name="abstract" value="'+publication.abstract+ '" ></td></tr>')
      },
      error : function( data ) { // en cas d'échec
        // Sinon je traite l'erreur
        console.log( 'Erreur…' );
      }
    });
  });
}
jQuery(document).ready(function(){

var inputs = jQuery('#main_table').find('input[type="text"]');

inputs.click(function() {
 

   setTimeout(() => {
        var inputs = jQuery('#side_table').find('input[type="text"]');
        console.log(inputs);
        
        inputs.keyup(function() {



  
    const data= new Object();
    data.action='update_publication';
    data.article_id=this.id;
    data.title=this.value;
    
    $.ajax({
      url : adminAjax.ajaxurl,
      method : 'POST', // GET par défaut
      data,
      
      success : function( return_data ) { // en cas de requête réussie
        console.log('good');
        
     
      },
      error : function( data ) { // en cas d'échec
        // Sinon je traite l'erreur
        console.log( 'Erreur…' );
      }
    });
          
  });


 }, 1000);

});





}



  );














