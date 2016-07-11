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
        $('#nombre_empledo').val(nombre_empleado);
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


function guar(data,modal,message_area_modal)
{
    $.ajax(
    {
        url: '?post=categoria&'+data,
        type: 'POST',
        data: null,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false,
        beforeSend:function()
                    {
                        text = '<div class="alert alert-dismissible alert-info center s12 m12">' +
                        '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                        '<img src="views/img/load.gif"></img> Creando categoría</div>';
                        $('#result').html(text);
                    },
        complete: function(res)
                    {
                        try
                        {
                            if(res.responseText==1)
                            {
                                message_area_modal.html("<img src='views/img/success.png'></img> La categoría se ha creado");
                                modal.openModal();
                                $('#result').html('');
                                searchCategoria("",$('#table'));
                            }
                            else
                            {
                                text = '<div class="alert alert-dismissible alert-danger">' +
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>' + http.responseText + '</div>';
                                $('#result').html(http.responseText);
                            }
                        }
                        catch (e)
                        {
                            $('#result').html(res.responseText);
                        }
                    }
    });
}

