$(document).ready(function()
{
    $('#formsubcategoria').submit(function(e)
    {
        e.preventDefault();
        var formulario = $('#formsubcategoria');
        var data = formulario.serialize();
        var ms = $('#message');
        var modal = $('#myModal');
        agregarSubcategoria(data,modal,ms);


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
                $('[name= "id_subcategoria"]').val(subcategoria.id_subcategoria);

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
