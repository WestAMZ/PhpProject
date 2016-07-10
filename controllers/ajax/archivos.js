$(document).ready(function()
{
    $('#formarchivo').submit(function(e)
    {
        e.preventDefault();
        var formulario = $('#formarchivo');
        var data = formulario.serialize();
        var archivo = new FormData();
        if($('#file')[0].files.length > 0)
        {
            archivo.append('archivo', $('#file')[0].files[0]);
            var nombre_archivo = $('#file')[0].files[0].name;
            nombre_archivo = nombre_archivo.substring(0,nombre_archivo.indexOf('.'));
            archivo.append('nombre_archivo', nombre_archivo);
            var ms = $('#message');
            var modal = $('#myModal');
            agregarArchivo(archivo,data,modal,ms);
        }
        else
        {
            alert('no se ha cargado ningun archivo');
        };


    });

});

function agregarArchivo(archivo,data,modal,message_area_modal)
{
    $.ajax(
    {
        url: '?post=archivo&'+data,
        type: 'POST',
        data: archivo,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false,
        complete: function(res)
                    {
                        try
                        {
                            if(res.responseText==1)
                            {
                                message_area_modal.html("<img src='views/img/success.png'></img> El archivo ha sido cargado");
                                modal.openModal();
                                $('#result').html('');
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

function editarArchivo(archivo,data,modal,message_area_modal)
{
    $.ajax(
    {
        url: '?post=archivo&mod=1&'+data,
        type: 'POST',
        data: archivo,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false,
        complete: function(res)
                    {
                        try
                        {
                            if(res.responseText==1)
                            {
                                message_area_modal.html("<img src='views/img/success.png'></img> El archivo ha sido editado");
                                modal.openModal();
                                $('#result').html('');
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
