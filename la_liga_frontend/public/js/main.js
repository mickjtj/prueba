
$(document).ready(function () {
    // Ver plantilla
    $('.showModal').on('click', function () {
        var idClub = $(this).attr('data-club-id');
        var nombreClub = $(this).attr('data-club-nombre');

        datosPlantilla(idClub, nombreClub);

        $('#showModal').modal('show');
    });

    // Añadir jugador
    $('.addModal').on('click', function () {
        var idClub = $(this).attr('data-club-id');
        $('#club').val(idClub);
        $('#nombre').val('');
        dorsalesNoDisponibles(idClub);
        $('#addModal').modal('show');
    });

    // Guardar jugador
    $('#guardarJugador').on('click', function () {
        guardarJugador();
    });
});

/**
 * Rellenar datos del modal
 *
 * @param {integer}   var id
 * @param {string}   var nombreClub 
 */
function datosPlantilla(idClub, nombreClub) {
    $('#titlePlantilla').html(nombreClub);
    $('#datosJugadores').empty();
    $.ajax({
        url: 'http://127.0.0.1:8000/api/jugadores/' + idClub,
        type: 'GET',
        contentType: "application/json",
        dataType: 'json',
        success: function (data) {
            $.each(data, function (index, jugador) { 
                $('#datosJugadores').append('<tr><td>'+jugador.dorsal+'</td><td>'+jugador.nombre+'</td></tr>');                
            });
        },
        error : function(request,error)
        {
            alert("Request: "+JSON.stringify(request));
        }
    });

}

/**
 * Obtener dorsales disponibles
 *
 * @param {integer}   var id
 */
function dorsalesNoDisponibles(idClub, nombreClub) {
    $('#titlePlantilla').html(nombreClub);
    $('#datosJugadores').empty();
    $.ajax({
        url: 'http://127.0.0.1:8000/api/dorsales/' + idClub,
        type: 'GET',
        contentType: "application/json",
        dataType: 'json',
        success: function (data) {
            $('#dorsal').empty();
            for (let i = 1; i <= 25; i++) {
                disabled = '';
                if ($.inArray(i, data) !== -1) {
                    disabled = 'disabled="disabled"';
                }
                $('#dorsal').append('<option value="'+i+'" '+disabled+'>'+i+'</option>');                
            }           
        },
        error : function(request,error)
        {
            alert("Request: "+JSON.stringify(request));
        }
    });

}

/**
 * Guardar jugador
 *
 */
function guardarJugador() {
    var form = $('#formJugador');

    $.ajax({
        url: 'http://127.0.0.1:8000/api/jugadores/',
        type: 'POST',
        data: form.serialize(),
        success: function (response) {
            if (response.result = 'ok') {
                alert('Jugador añadido');
            } else {
                alert('No se pudo añadir al jugador: '+response.msg);
            }
            $('#addModal').modal('hide');
        },
        error : function(request,error)
        {
            alert("Request: "+JSON.stringify(request));
        }
    });

}
