
var route = "";


function myfunction(event){
 
  route =  event ;
 
 
  var x = document.getElementById(event);
    if (x.style.display === "none") {
     x.style.display = "block";
     } else {
      x.style.display = "none";
      }
  }
 




var message = document.getElementById('message');
var messageDiv = document.getElementsByClassName('message');





$(document).ready(function(){


      $( "select" ).change(function() {
        $( "select option:selected" ).each(function() {
          var value = $('#myChoice').val();
          $('.card').hide();
       

          $("div[name=" + value + "]").show();

          
        });
      })
})
    

 