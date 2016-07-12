$(document).ready(function()
{
    $('#formsubcategoria').submit(function(e)
    {
        e.preventDefault();
        var formulario = $('#formsubcategoria');
        var data = formulario.serialize();
        var ms = $('#message');
        var modal = $('#myModal');
        if($('[name = "editar"]').prop('checked') == false)
        {
            agregarSubcategoria(data,modal,ms);
        }
        else
        {
            updateSubcategoria(data,modal,ms);
        }


    });


    $('#table').on('click','.subcategoria',function()
    {
        $('#table .selected').removeClass('selected');
        $(this).toggleClass('selected');
        var id_mod = $(this).children(0).html();

        if($('[name = "editar"]').prop('checked') == true)
        {

            getSubCategoria(id_mod);
        }
        else
        {
             $('[name= "id_subcategoria"]').val(0);
             $('[name= "nombre"]').val("");
             $('[name= "id_categoria"]').val(0);
        }
    });

    //modificacion de texto de boton
    $('#editar').change(function () {
        if ($('#editar').prop('checked') == true)
        {
            $('#accion').text('Modificar');
        }
        else
        {
            $('#accion').text('Agregar');
        }
    });

    $('#searchtxt').keypress(
        function(e)
        {
            //condicion para linpiar de caracteres especiales (no alfa nunmericos)
            var pressed = (e.key.toString().length == 1)? e.key :'';
            var search = $(this).val()+ pressed;
            searchSubcategoria(search,$('#table'));
        });

    //Cambio de estado
    $('#table').on('click','.cambiar-estado',function()
    {
        //invertimos el estado
        estado = ($(this).attr('estado') == 0 )? '1' : '0';
        id = $(this).attr('id');

        cambiarEstado(id,estado);
    });

});

function agregarSubcategoria(data,modal,message_area_modal)
{
    $.ajax(
    {
        url: '?post=subcategoria&'+data,
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
                                message_area_modal.html("<img src='views/img/success.png'></img> Se ha creado subcategoría");
                                modal.openModal();
                                $('#result').html('');
                                searchSubcategoria('',$('#table'));
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

function editarSubcategoria(data,modal,message_area_modal)
{
    $.ajax(
    {
        url: '?post=subcategoria&mod=1'+data,
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
                                message_area_modal.html("<img src='views/img/success.png'></img> Se ha editado subcategoría");
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

function getSubCategoria(id)
{
    http = Connect();
    http.onreadystatechange = function()
    {
        if(http.readyState == 4 && http.status ==200)
        {
            //Respuesta recivida
            var subcategoria = JSON.parse(http.responseText).subcategoria[0];
            if(subcategoria != null)
            {
                subcategoria = subcategoria[0];
                $('[name= "id_subcategoria"]').val(subcategoria.id_subcategoria);
                $('[name= "nombre"]').val(subcategoria.nombre);
            }

        }
        else if(http.readyState != 4)
        {
            //Esperando respuesta
        }
    }
    http.open('GET','?get=subcategoria&id='+id);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send(null);
}

function searchSubcategoria(search,table)
{
    $url = $('[name="url"]').val();
    $.ajax(
    {
        url: '?get=subcategorias_table&search='+search+'&url='+$url,
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

function cambiarEstado(id,estado)
{
    data = '&mod=2&'+'id='+id+'&estado='+estado;

    $.ajax(
    {
        url: '?post=subcategoria'+data,
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
                                $('#message').html('Se ha cambiado el estado de la subcategoría');
                                $('#myModal').openModal();
                                searchSubcategoria("",$('#table'));
                            }
                            else
                            {
                                $('#message').html('Se ha ocurrido un error');
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


function updateSubcategoria(data,modal,message_area_modal)
{
    http = Connect();
    http.onreadystatechange = function ()
    {
         if (http.readyState == 4 && http.status == 200)
         {

            if (http.responseText == 1)
            {
                message_area_modal.html("<img src='views/img/success.png'></img> La subcategoría se ha modifícado con exíto");
                modal.openModal();
                $('#result').html('');
                searchSubcategoria('',$("#table"));
            }
            else
            {
                text = '<div class="alert alert-dismissible alert-danger">' +
                    '<button type="button" class="close" data-dismiss="alert">&times;</button>' + http.responseText + '</div>';
                    $('#result').html(http.responseText);
            }

        }
        else if (http.readyState != 4)
        {
            text = '<div class="alert alert-dismissible alert-info">' +
                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                '<img src="views/img/load.gif"></img> Procesando acción...</div>';
            $('#result').html(text);
        }
    }
    http.open('POST','?post=subcategoria&mod=1');
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send(data);
}
