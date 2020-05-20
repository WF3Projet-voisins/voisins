$(document).ready(function(){


    $("#myChoice").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("p").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });



  });