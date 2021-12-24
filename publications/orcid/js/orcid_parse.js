
jQuery(document).ready(function($){
  jQuery('#action-button').click(function() {
    jQuery('#message').text('Click only once, it can take up to 5 seconds');
    jQuery("#myTable > tbody").html("");
    jQuery("#myTable > thead").html("");
      var orcid_num=jQuery('#orcid').val();
      
      if (orcid_num.search(/([0-9]{4}\-){3}/)!=0){
        
        const data= new Object();
        data.action='get_orcid_number_from_name';
        data.name=orcid_num.replace(' ','+');
        jQuery.ajax({
        url:adminAjax.ajaxurl,
        method : 'POST',
        data,
        
        error: function() {
           jQuery('#message').text('We are sorry. There has been an error...');
        },
        success: function(data) {
          L=data.match(/([0-9]{4}\-){3}[0-9]{4}/);
          orcid_num=L[0];
          jQuery('#message').text('Your ORCID number is '+orcid_num+' ?');
          fill_orcid_table(orcid_num);
        }
      });
      }else{

        fill_orcid_table(orcid_num);
      }
      
     
      
    });
});




function fill_orcid_table(orcid_num){
  // There are two API calls.
  // The first one gets all the works of a given ORCID num. 
    // We get a json file with lot of useless informations and a line like 
    //  <work:work-summary put-code="60042438" path="/0000-0002-0044-2795/work/60042438">
  // Then we get details of every publications with the 'put-code' number. 
  // In the second API call, we get the "citaion-value" which is the bibtex of the publication. 
  // Then we parse the bib using the bibtex js. 
  

  var url_orcid='https://pub.orcid.org/v3.0/'+orcid_num+'/works/';
  jQuery.ajax({
    url: url_orcid,
    crossDomain: true,
    dataType: "text",
    error: function() {
            jQuery('#message').text('Sorry... this ORCID  does not seem to be valid');
       
    },
    success: function(data) {
      
      insert_first_line();

      var regex=/put-code="[0-9]*"/g;
      found=data.match(regex);
      var code_input=[];
      found.forEach((item, i) => {
      code2=item.match(/\d+/g);
      code_input.push(code2[0]);

      var url_search='https://pub.orcid.org/v3.0/'+orcid_num+'/works/'+code2[0];
      jQuery.ajax({
         url: url_search,
         crossDomain: true,
         dataType: "text",
         error: function() {
           console.log('<p>An error has occurred</p>');

     
         },
         success: function(data2) {
            var publisher='';
            var editor='';
            var booktitle='';
            var extraInfo='';
            var ISBN='';
            var link='';
            var doi ='';
            var year = ' ';
            var abstract = ' ';
            var keywords = ' ';
            var volume = ' ';
            var pages = ' ';
            var type = 'article';
            var journal ='';
            var author ='';

          result=data2.match(/:citation-value>[^<]*/g)
          if (result==null){
            // some of the entries are still not entered. 
            // console.log(data2); 
            title=data2.match(/common:title>[^<]*/g)[0].substring('common:title>'.length);
            journal=data2.match(/journal-title>[^<]*/g)[0].substring('journal-title>'.length);
            year=data2.match(/common:year>[^<]*/g)[0].substring('common:year>'.length);

            

          }else{
            result=result[0].substring(16);
          
          let regex=/([A-Za-z])+ *\=/g;
          result_min=result.replace(regex, replacerFunction)
           
           bib=cleaning_the_bib(result_min);
           
           parse=bibtexParse.toJSON(bib)[0]['entryTags'];
           
           var journal =capitalize( parse['journal']);
           var author = capitalize(parse['author']);
           var title = Capitalize_first_letter(parse['title']);
           if (parse['doi']){
             var doi = parse['doi'].replace('\{','').replace('\}','');
           }

           if(parse['year']){
             var year = parse['year'];
           }


           if(parse['abstract']){
               var abstract = Capitalize_first_letter(parse['abstract']);
           }


           if(parse['keywords']){
             var keywords = parse['keywords'];
           }


           if(parse['volume']){
             var volume = parse['volume'];
           }


           if(parse['pages']){
             var pages = parse['pages'].replace('--','-');
           }



           if(parse['type']){
             var type =parse['type'];
           }


         }

          insert_table_line([title, author, year, type, journal, doi, ISBN, volume, link, pages, keywords, publisher, editor, booktitle, abstract,extraInfo],i);


         },
         type:'GET'
       });




      });



    },
    type: 'GET'
  });
}

