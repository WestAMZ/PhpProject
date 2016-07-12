$(document).ready(function ()
{

     $('#seguimientos').on('click','.seguimiento',function()
    {
        $('#table1 .selected').removeClass('selected');
        $(this).toggleClass('selected');
    });

    $(document).ready(function () {
        $('ul.tabs').tabs();
    });

     $('#seguimientos2').on('click','.seguimiento2',function()
    {
        $('#table2 .selected').removeClass('selected');
        $(this).toggleClass('selected');
    });

    $('#searchtxt').keypress(
        function(e)
        {
            var pressed = (e.key.toString().length == 1) ? e.key :'';
            var search = $(this).val()+ pressed;
            id =$('[name= "id_sitio"]').val();
            searchnoresuelta(search,$('#table2'),id);
        });

});
$("#agregarinsidencia").submit(function ()
{
    var data = $("#agregarinsidencia").serialize();
    var archivo = new FormData();
    if($('#file')[0].files.length > 0)
    {
        archivo.append('archivo', $('#file')[0].files[0]);
        var nombre_archivo = $('#file')[0].files[0].name;
        nombre_archivo = nombre_archivo.substring(0,nombre_archivo.indexOf('.'));
        archivo.append('nombre_archivo', nombre_archivo);
    }
    archivo.append('ruta', "sources/public/files/");
    result = $('#result');
    var ms = $('#message');
    var modal = $('#myModal');

    agregarinsidencia(archivo ,data, result, modal, ms);
  //  loadInsidencias($('#insidencias'),result,modal,ms);
    return false;
});

function searchnoresuelta(search, table,id) {
    httpL = Connect();
    httpL.onreadystatechange = function () {
        if (httpL.readyState == 4 && httpL.status == 200) {
            table.html(httpL.responseText);
        } else if (httpL.readyState != 4) {
            text = '<div class="alert alert-dismissible alert-info center s12 m12">' +
                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                '<img src="views/img/load2.gif"></img> Cargando...</div>';
            table.html(text);
        }
    }
    httpL.open('GET', '?get=incidenciatablenoresuelta&search=' + search+'&id=' + id);
    httpL.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    httpL.send(null);
}
function agregarinsidencia(archivo,data,result,modal,message_area_modal)
{
    $.ajax(
    {
        url: '?post=insidencia&'+data,
        type: 'POST',
        data: archivo,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false,
        complete: function(res)
                    {
                        var json;
                        try
                        {
                            if(res.responseText==1)
                            {
                                message_area_modal.html("<img src='views/img/success.png'></img> la insidencia ha sido posteada");
                                modal.openModal();
                                //result.html('');
                            }
                            else
                            {
                                text = '<div class="alert alert-dismissible alert-danger">' +
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>' + http.responseText + '</div>';
                              //  result.html(http.responseText);
                            }
                        }
                        catch (e)
                        {
                            $('#result').html(res.responseText);
                        }
                    }
    });
}
