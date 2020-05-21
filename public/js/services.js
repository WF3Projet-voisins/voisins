



    $(document).ready(function(){
       

        $("#myChoice").on("keyup", function() {
          var value = $(this).val().toLowerCase();
          $("#cardService").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
        });

        
    });

 