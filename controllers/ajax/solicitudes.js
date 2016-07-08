$(document).ready(function ()
{

    $('#formsolicitud').submit(function()
    {


        var data = $('#formsolicitud').serialize();
        agregarSolicitud(data);
        return false;
    });

    //seleccion de filas
    $('#table').on('click','.empleado',function()
    {

        var id_emp = $(this).children(0).html();
        var form = $('#formsolicitud [name = "id_empleado"]').val(id_emp);
    });

});



function agregarSolicitud(data)
{

    $.ajax(
    {
        url: '?post=solicitud&'+data,
        type: 'POST',
        data: null,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false,
        beforeSend:function()
                    {
                        text = '<div class="alert alert-dismissible alert-info">' +
                        '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                        '<img src="views/img/load.gif"></img> Generando solicitud</div>';
                        //$('#result').html(text);
                    },
        complete: function(res)
                    {
                        var json;
                        try
                        {
                            if(res.responseText==1)
                            {
                              //  message_area_modal.html("<img src='views/img/success.png'></img> Solicitud guardada");
                                //modal.openModal();
                            //    result.html('');
                            }
                            else
                            {
                                text = '<div class="alert alert-dismissible alert-danger">' +
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>' + http.responseText + '</div>';
                                //result.html(res.responseText);
                            }
                        }
                        catch (e)
                        {
                            //$('result').html(res.responseText);
                        }
                    }
    });
}
