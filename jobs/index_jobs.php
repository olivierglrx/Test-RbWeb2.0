<?php




function job_page_setup(){
	?>
	 <div class='container'>
  	<div class="file-drop-area">
  	 <span class="fake-btn">Choose file</span>
 		 <span class="file-msg">Drag and drop file</span>
 		 <input id='file' class="file-input" type="file" onchange="previewFile(this)" >
	<p id="content"></p>

  <div  id='table_container' >
    <!-- <form class=""  method="post"> -->
      <table id="myTable"  style="display:none;">
        <thead>
          
        </thead>
        <tbody>
        </tbody>
      </table>    
  </div>


  <script type="text/javascript">

  function previewFile(input) {
  	let file = input.files[0];
  	let reader = new FileReader();
  	reader.readAsText(file);

  reader.onload = function() {
  	var lines=reader.result.split(/\r?\n/);
  	lines.forEach(function(element){
  		var gps =element.split(';')[2]
  		var lat =gps.split(',')[0]
  		var lon =gps.split(',')[1].substr(1);
  		parse(lat,lon);




  	});


  };

}








function parse(lat,lon){
 
  
    
    var url_orcid='https://nominatim.openstreetmap.org/reverse?format=geojson'+'&lat='+lat+'&lon='+lon;
   jQuery.ajax({
      url: url_orcid,
      crossDomain: true,
      dataType: "text",
      error: function() {
             console.log('error');
         
      },
      success: function(data) {
      	// console.log(data);
      	var json = JSON.parse(data) 	
      	var adress=json.features[0].properties.display_name;
      	console.log(adress);
      	var p = document.getElementById('content');
      	p.innerText = p.innerText+adress+'\n'





      },
      type: 'GET'
   });

};



























  </script>
  <?php
}
