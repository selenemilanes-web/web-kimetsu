$(document).ready(function() {
   /*  event.preventDefault();*/
    $.ajax({
        method:"POST",
        url:"votaciones.php",
        dataType:"json",

        success:function (data){
            console.log(data);
            for (let i=0; i<data.length; i++) {
                let row = $('<tr><td>' + data[i].idAnimes + '</td><td>' + data[i].Nom + '</td><td>' + parseFloat(data[i].media).toFixed(2)+'</td></tr>');
                /* El "parseFloat().toFixed(2)" lo que hace es dejar solo 2 decimales para el número.
                * El parseInt(media) redondea pero siempre hacia abajo, aunque el decimal sea superior a 5.
                * Por eso lo dejo con el .toFixed, porque si no aparecen animes con la misma nota por el redondeo y parece
                * que no estén ordenador alfabéticamente cuando en realidad es porque los decimales hacen que un anime tenga
                * una votación superior que otro.
                * También tengo arriba comentado lo que corregiría los "NaN" pero entonces pasaría lo mismo que he comentado
                * anteriormente en relación a la ordenación de los animes, que parecería que están desordenados cuando no es así,
                * ya que algunos animes han sido votados por algún usuario con un "0" mientras hay otros animes que no han sido
                * votados por ningún usuario, y por eso aparece "Nan"*/
                $('tbody').append(row);
            }
            window.stop();
        },

        error:function (jqXHR, textStatus, error){
            console.log(jqXHR);
            alert("Error: " + textStatus + " " + error);

        }
    })
})

/*$(document).ready(function(){
    $("#nomanime").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});*/


$("#comprobar").on('click', function() {
    $("table tbody tr").each(function(index) {
        if($(this).find('td:eq(1)').text().toLowerCase().indexOf($('#nomanime').val().toLowerCase()) === -1)
            $(this).hide();
        else
            $(this).show();

    });
})
