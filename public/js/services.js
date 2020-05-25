







$(document).ready(function(){






      $( "select" ).change(function() {
        $( "select option:selected" ).each(function() {
          var value = $('#myChoice').val();
          $('.card').hide();
          $("div[name=" + value + "]").show();
        });
      })



})
    

 