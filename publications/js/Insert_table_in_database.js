
function insert_publication(){
  jQuery(':checkbox').each(function() {
    if(this.checked){
      id=this.id;
      const data= new Object();
      list_of_entry.forEach(function(element){
        data[element]= document.getElementById(element+id).textContent;
        
      });
    data['action']='register_publications';
    jQuery('#message').text('');
     

    jQuery.ajax({
      url : adminAjax.ajaxurl,
      method : 'POST', // GET par défaut
      data,
      
      success : function( return_data ) { // en cas de requête réussie   
        table=document.getElementById('table_container');
        table.style['display']='none';
        button=document.getElementById('button_container');
        button.style['display']='none';  
        
        jQuery('#message').append( '<p>'+ data.Title + ' has been registered </p>');     

      },
      error : function( data ) { // en cas d'échec
        
        jQuery('#message').text('Sorry, there has been an error...');
      }
     });

    }
  });
}




