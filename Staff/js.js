$(document).ready(function() {
    // Get current page URL
var url = window.location.href;

// remove # from URL
url = url.substring(0, (url.indexOf("#") == -1) ? url.length : url.indexOf("#"));

// remove parameters from URL
url = url.substring(0, (url.indexOf("?") == -1) ? url.length : url.indexOf("?"));

// select file name
url = url.substr(url.lastIndexOf("/") + 1);

// If file name not avilable
if(url == ''){
url = 'index.html';
}

// Loop all menu items
$('#nav li').each(function(){

 // select href
 var href = $(this).find('a').attr('href');

 // Check filename
 if(url == href){

  // Add active class
  $(this).addClass('active');
 }
});


  
$(document).ready(function() {
       $("#addClientForm").submit(function(e){
         e.preventDefault();
          var query = $("#oNr").val();
          if (query != "") {
            $.ajax({
              url: 'onCheck.php',
              method: 'GET',
              data: {oNumber : query},
              dataType: "json",
              headers: {Accept : "application/json;charset=utf-8"},

 
              success: function(data){
                
 
               
              }
            });
          }
      });
    });
});