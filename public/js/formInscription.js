
$(document).ready(function(){
    // $("button").click(function(){
        $("#inputValue").on("keyup", function() {
            $('#tableBody').html('');
                const codePostal = $('#inputValue').val();
                $.get('https://geo.api.gouv.fr/communes?codePostal='+codePostal, function(datas){


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

        });
  //  });
});