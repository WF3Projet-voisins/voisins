function hideService(id){

 
  var x = document.getElementById(id);
 
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
          $("#passerMessage").empty();
       
         
          $("div[name=" + value + "]").show();

       

          if (!$("div[name=" + value + "]").show('.card')[0]){
            $("#passerMessage").empty();
           
           let passerMessage = document.getElementById('passerMessage');
            let newP = document.createElement('p');
            let newTexte = document.createTextNode("Pas de services pour cette catégorie!");

             
              passerMessage.prepend(newP);
              passerMessage.append(newTexte);
            
              $('#passerMessage').show();
          
          }
    
        });
      })




})
    

 