// change inner text
jQuery( document ).ready(function($) {
 
  
});

function parse_zotero(){
  send_message('Request Send - wait...');
  var zot_id=document.getElementById('zot_id').value;
  var zot_key=document.getElementById('zot_key').value;
  base_url='https://api.zotero.org/users/'+zot_id+'/items/?key='+zot_key+'&limit=10';
  jQuery.ajax({
  url : base_url,

      success : function( return_data ) { // en cas de requête réussie
        send_message('');
        insert_first_line();
        ID=1;
        return_data.forEach(function(element,index){
        if ('creators' in element.data){
          data=element.data;
          
          var title=data.title
          var authors=''
          data.creators.forEach(function(author){
            authors=authors+ author.firstName +' ' +author.lastName+', '
          })
          
          
          var year    =data.date.match(/\d{4}/)[0];
          var type    =data.itemType;
          var journal =data.publicationTitle;
          var DOI     =data.DOI;
          var ISBN    =data.ISSN;
          var volume  =data.volume;
          if (data.url!=''){
            var link  =data.url;           
          }else{
            var link  ='https://doi.org/'+data.DOI;
          }
          var pages   = data.pages;
          var keywords='';
          data.tags.forEach(function(tag){
            keywords=keywords+ tag.tag+' ; '
          })

          var publisher='';
          var editor   ='';
          var booktitle='';
          var abstract =data.abstractNote;
          var extra    =data.extra

          insert_table_line([title, authors, year, type, journal,DOI,ISBN, volume, link,
           pages, keywords, publisher, editor, booktitle,abstract,extra],ID);
          ID++;
          

        }

       });

      },
      error : function( data ) { 
        send_message('There has been an error, are you sure of your ID and key ? ');
        
      }
     });
}

function send_message(message){
  jQuery('#message').text(message);
}
