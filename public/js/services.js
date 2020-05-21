


    // Quand on appuie sur le boutton, je veux récupérer le contenu de mon input.
    // je dois effectuer une requete HTTP avec en paramètre le contenu de mon input
    // afficher le résultat de ma requete dans le tableau
    $(document).ready(function(){
        $('#button').click(function(){
            callApi();
        });


        $("#myChoice").on("keyup", function() {
          var value = $(this).val().toLowerCase();
          $("#cardService").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
        });



        
    });

    function callApi(){
        $('#tableBody').html('');
        const departement = $('#inputValue').val();
        $.get('https://geo.api.gouv.fr/communes?codeDepartement='+departement, function(datas){
            for(const commune of datas){
                const row = document.createElement('tr');
                const tdNom = document.createElement('td');
                $(tdNom).text(commune.nom);
                const tdCode = document.createElement('td');
                $(tdCode).text(commune.codesPostaux[0]);
                const tdPopulation = document.createElement('td');
                $(tdPopulation).text(commune.population);
                row.append(tdNom);
                row.append(tdCode);
                row.append(tdPopulation);
                $("#tableBody").append(row);
            }
        });
    }