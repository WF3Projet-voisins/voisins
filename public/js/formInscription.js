






$(document).ready(function(){

    $("a").click(function(){

        $('#user_city').html(function(){

            $("input:text").val("Glenn Quagmire");

        })
        

      });






     $("a").click(function(){
            $('#user_city').html("#user_city");
       });


        $("#user_postalCode").on("keyup", function() {
            $('#tableBody').html('');
                const codePostal = $('#user_postalCode').val();
                $.get('https://geo.api.gouv.fr/communes?codePostal='+codePostal, function(datas){


                    for(const commune of datas){
                        const row = document.createElement('tr');
                        const tdNom = document.createElement('td');
                        const aNom = document.createElement('a');
                        $(aNom).text(commune.nom);
                        $(aNom).attr("id", "nomCommune");
                       // const tdCode = document.createElement('td');
                       // $(tdCode).text(commune.codesPostaux[0]);
                       // $(tdCode).attr("id", "codePostal");
                       tdNom.append(aNom);
                        row.append(tdNom);
                       // row.append(tdCode);
                        $("#tableBody").append(row);
                    }
                });

        });
 
});