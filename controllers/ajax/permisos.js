$(document).ready(function ()
{
    $('#select-usuario').click(function () {
        $('#modal-jefe').openModal();
    });

    $('#modal-jefe').on('click', '.empleado', function () {
        $('#tabla-usuario .selected').removeClass('selected');
        $(this).toggleClass('selected');
        var id_jefe = $(this).children(0).html();
        var form = $('#id_usuario').val(id_jefe);
    });

});
