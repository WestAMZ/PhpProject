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

    $('#searchtxt').keypress(
        function(e)
        {
            //condicion para linpiar de caracteres especiales (no alfa nunmericos)
            var pressed = (e.key.toString().length == 1)? e.key :'';
            var search = $(this).val()+ pressed;
            var id = $('[name="id_subcategoria"]').val();
            searchArchivos(search,id,$('#table'));
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


function cambiarEstado(id,estado)
{
    data = '&mod=2&'+'id='+id+'&estado='+estado;

    $.ajax(
    {
        url: '?post=archivo'+data,
        type: 'POST',
        data: null,
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
                                $('#message').html('Se ha cambiado el estado del archivo');
                                $('#myModal').openModal();
                                searchArchivos("",$('[name="id_subcategoria"]').val(),$('#table'));
                            }
                            else
                            {
                                $('#message').html('Ha ocurrido un error');
                                $('#myModal').openModal();
                            }
                        }
                        catch (e)
                        {
                            $('#message').html(res.responseText);
                                $('#myModal').openModal();
                        }
                    }
    });
}


function searchArchivos(search,id,table)
{
    $.ajax(
    {
        url: '?get=archivos_table&search='+search+'&id='+id,
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
                        '<img src="views/img/load2.gif"></img> Cargando...</div>';
                        table.html(text);
                    },
        complete: function(res)
                    {
                        try
                        {
                            table.html(res.responseText);
                        }
                        catch (e)
                        {
                            table.html(res.responseText);
                        }
                    }
    });
}
