fetch_api();
function fetch_api(){
  console.log(restAPI.restURL+'/wp/v2/publication');
  console.log(restAPI.totalPub);
  jQuery.ajax({
  url : restAPI.restURL+'wp/v2/publication/?per_page=100',
  
  success : function( return_data ) { // en cas de requête réussie   
    console.log(return_data);

  },
  error : function( data ) { // en cas d'échec
    console.log ('error');
    // jQuery('#message').text('Sorry, there has been an error...');
  }
 });

}




