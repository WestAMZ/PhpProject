$(document).ready(function ()
{
    $('#select-usuario').click(function () {
        $('#modal-jefe').openModal();
    });

    $('#modal-jefe').on('click', '.empleado', function () {
        $('#tabla-usuario .selected').removeClass('selected');
        $(this).toggleClass('selected');
        var id_usuario = $(this).children(0).html();
        var nombre_empleado = $(this).children('.nombre').html();
        $('·nombre_empledo').val(nombre_empleado);
        $('#id_usuario').val(id_usuario);
    });

    $('#formpermisos').submit(function(e)
    {
        e.preventDefault();
        var formulario = $('#formpermisos');
        var result = $('#result')
        var data = formulario.serialize();
        var ms = $('#message');
        var modal = $('#myModal');

        if($('[name = "id_usuario"]').val() != "")
        {
            alert("Usuario no seleccionado");
        }
        else
        {
            alert("Usuario no seleccionado");
        }

    });
});


