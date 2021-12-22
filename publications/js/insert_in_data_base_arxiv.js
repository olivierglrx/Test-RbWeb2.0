

function insert_publication(){
  jQuery(':checkbox').each(function() {
    if(this.checked){
      const data= new Object();
      data['title']     =document.getElementById('title'+this.id).textContent;
      data['authors']   =document.getElementById('authors'+this.id).textContent;
      data['abstract']  =document.getElementById('abstract'+this.id).textContent;
      data['dop']      =document.getElementById('year'+this.id).textContent;

     

     data['action']='register_publications';
     data['id']=this.id;
     
     

     jQuery.ajax({
      url : adminAjax.ajaxurl,
      method : 'POST', // GET par défaut
      data,
      
      success : function( return_data ) { // en cas de requête réussie
        console.log(return_data);
        table=document.getElementById('main_table');
        table.style['display']='none';

        button=document.getElementById('button_container');
        button.style['display']='none';

        
        var tag = document.createElement("p");
        var text = document.createTextNode(data['title']+' has been register');
        tag.appendChild(text);

        container=document.getElementById('container');
        container.appendChild(tag);

      },
      error : function( data ) { // en cas d'échec
        // Sinon je traite l'erreur
        console.log( 'Erreur…' );
      }
     });

    }
  });
}


function see_more(){
  trs=document.getElementsByTagName('tr');

  const data= new Object();
  data.action='see_more_arxiv';
  var authors=document.getElementById('search_input').value;
  data['authors']=authors;
  data['total']=trs.length-1
  
  jQuery.ajax({
  url : adminAjax.ajaxurl,
  method : 'POST', // GET par défaut
  data,
  
  success : function( return_data ) { // en cas de requête réussie
    console.log(return_data['data'][0]);
    table=document.getElementById('main_table');
    for(index in return_data['data']){
    
    newRow = table.insertRow(-1);

    newCell = newRow.insertCell(0)
    var input = document.createElement("input");
    input.setAttribute('type', 'checkbox');
    input.checked=true;
    newCell.appendChild(input);

    newCell = newRow.insertCell(1)
    newText = document.createTextNode(return_data['data'][index]['title']);
    newCell.appendChild(newText);

    newCell = newRow.insertCell(2)
    newText = document.createTextNode(return_data['data'][index]['authors']);
    newCell.appendChild(newText);


    newCell = newRow.insertCell(3)
    newText = document.createTextNode(return_data['data'][index]['year'].substr(0, 4));
    newCell.appendChild(newText);

    newCell = newRow.insertCell(4)
    newText = document.createTextNode(return_data['data'][index]['abstract']);  
    newCell.appendChild(newText);
    newCell.style['display']='none';


    newCell = newRow.insertCell(5)
    newText = document.createTextNode(return_data['data'][index]['url']);  
    newCell.appendChild(newText);
    newCell.style['display']='none';
    };

  },
  error : function( data ) { // en cas d'échec
    // Sinon je traite l'erreur
    console.log( 'Erreur…' );
  }
 });

}


function toggle_all(){
  jQuery(':checkbox').each(function() {
    if(this.checked){
      this.checked = false;
    }else{
      this.checked = true;
    }
  });
}