$(document).ready(function()
{
    $('#table').on('click','.categoria',function()
    {
        $('#table .selected').removeClass('selected');
        $(this).toggleClass('selected');
        var id_mod = $(this).children(0).html();


        if($('[name = "editar"]').prop('checked') == true)
        {
            getCategoria(id_mod);
        }
       else
           {
                $('[name= "id_categoria"]').val(0);
                $('[name= "nombre"]').val("");
                $('[name= "descripcion"]').val("");
           }
    });

    $('#formcategoria').submit(function(e)
    {
        e.preventDefault();
        var formulario = $('#formcategoria');
        var result = $('#result')
        var data = formulario.serialize();
        var ms = $('#message');
        var modal = $('#myModal');

        if($('[name = "editar"]').prop('checked') == true)
        {
            updateCategoria(data,result,modal,ms);
            searchCategoria('',$("#table"));
        }
        else
        {
            agregarCategoria(data,modal,ms);
        }

    });


    $('#searchtxt').keypress(
        function(e)
        {
            //condicion para linpiar de caracteres especiales (no alfa nunmericos)
            var pressed = (e.key.toString().length == 1)? e.key :'';
            var search = $(this).val()+ pressed;
            searchCategoria(search,$('#table'));
        });

    $('#table').on('click','.cambiar-estado',function()
    {
        //invertimos el estado
        estado = ($(this).attr('estado') == 0 )? '1' : '0';
        id = $(this).attr('id');

        cambiarEstado(id,estado);
    });
});

function agregarCategoria(data,modal,message_area_modal)
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


function editarCategoria(data,modal,message_area_modal)
{
    $.ajax(
    {
        url: '?post=categoria&mod=1&'+data,
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
                        '<img src="views/img/load.gif"></img> Creando categoría...</div>';
                        table.html(text);
                    },
        complete: function(res)
                    {
                        try
                        {
                            if(res.responseText==1)
                            {
                                message_area_modal.html("<img src='views/img/success.png'></img> La categoría se ha editado");
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


function searchCategoria(search,table)
{
    $.ajax(
    {
        url: '?get=categorias_table&search='+search,
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
        url: '?post=categoria'+data,
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
                                $('#message').html('Se ha cambiado el estado dela categoría');
                                $('#myModal').openModal();
                                searchCategoria("",$('#table'));
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

function getCategoria(id)
{
    http = Connect();
    http.onreadystatechange = function()
    {
        if(http.readyState == 4 && http.status ==200)
        {
            //Respuesta recivida
            var categoria = JSON.parse(http.responseText).categoria[0];

            if(categoria != null)
            {
                $('[name= "id_categoria"]').val(categoria.id_categoria);
                $('[name= "nombre"]').val(categoria.nombre);
                $('[name= "descripcion"]').val(categoria.descripcion);
            }

        }
        else if(http.readyState != 4)
        {
            //Esperando respuesta
        }
    }
    http.open('GET','?get=categoria&id='+id);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send(null);
}
function updateCategoria(data,result,modal,message_area_modal)
{
    http = Connect();
    http.onreadystatechange = function ()
    {
         if (http.readyState == 4 && http.status == 200)
         {

            if (http.responseText == 1)
            {
                message_area_modal.html("<img src='views/img/success.png'></img> El aviso ha sido modificado con exíto");
                modal.openModal();
                result.html('');
            }
            else
            {
                text = '<div class="alert alert-dismissible alert-danger">' +
                    '<button type="button" class="close" data-dismiss="alert">&times;</button>' + http.responseText + '</div>';
                    result.html(http.responseText);
            }

        }
        else if (http.readyState != 4)
        {
            text = '<div class="alert alert-dismissible alert-info">' +
                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                '<img src="views/img/load.gif"></img> Procesando acción...</div>';
            result.html(text);
        }
    }
    http.open('POST','?post=categoria&mod=1');
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send(data);
}
