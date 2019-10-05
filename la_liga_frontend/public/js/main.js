
$(document).ready(function () {
    // Ver plantilla
    $('.showModal').on('click', function () {
        var idClub = $(this).attr('data-club');

        datosPlantilla(idClub);
        console.log(idClub);
        $('#showModal').modal('show');
    });
});

/**
 * Rellenar datos del modal
 *
 * @param {integer}   var id 
 */
function datosPlantilla(id) {

    $.ajax({
        url: 'http://127.0.0.1:8000/api/get-jugadores/' + id,
        type: 'GET',
        contentType: "application/json",
        dataType: 'json',
        success: function (data) {
            console.log(data);
        },
        error : function(request,error)
        {
            alert("Request: "+JSON.stringify(request));
        }
    });

}


/*
$.ajax({

        url : 'http://127.0.0.1:8000/api/get-jugadores/'+id,
        type : 'GET',
        data : {
            'numberOfWords' : 10
        },
        dataType:'json',
        success : function(data) {
            alert('Data: '+data);
        },
        error : function(request,error)
        {
            alert("Request: "+JSON.stringify(request));
        }
    });
*/