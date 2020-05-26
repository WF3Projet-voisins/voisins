function hideService(id){

 
  var x = document.getElementById(id);
  console.log(x);
    if (x.style.display === "none") {
     x.style.display = "block";
     } else {
      x.style.display = "none";
      }
  }


$(document).ready(function(){


      $( "select" ).change(function() {
        $( "select option:selected" ).each(function() {
          var value = $('#myChoice').val();
          $('.card').hide();
       

          $("div[name=" + value + "]").show();

          
        });
      })
})
    

 