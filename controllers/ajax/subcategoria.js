$(document).ready(function()
{
    $('#formasubcategoria').submit(function()
    {
        var formulario = $('#formasubcategoria');
        var data = formulario.serialize();
        var ms = $('#message');
        var modal = $('#myModal');
        agregarSubcategoria(archivo,modal,ms);


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