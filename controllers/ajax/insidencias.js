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
    loadInsidencias($('#insidencias'),result,modal,ms);
    return false;
});

/*
        $("#agregarinsidencia").on("submit", function(e)
        {

            e.preventDefault();
            var input_file = document.getElementById('fileToUpload');
            var file = input_file.files;
            console.log(file);
            //var formData = new FormData(document.getElementById("agregarinsidencia"));
            //formData.append("dato", "valor");
            //formData.append(f.attr("name"), $(this)[0].files[0]);
            /*$.ajax(
            {
                url: "?post=empleado",
                type: "post",0
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
	           processData: false
            })
                .done(function(res){
                    $("#mensaje").html("Respuesta: " + res);
                });*/

//        });
$(document).ready(function()
{
    $('.tooltipped').tooltip({delay: 50});

     $('.finalizar').click(
         function()
         {
             var id_insidencia =  $(this).attr('name');
         }
     );

    $('#insidencias').on('click','.finalizar',function()
    {
        finalizarinsidencia($(this).attr('name'));
        loadInsidencias($('#insidencias'),null,null,null);

    });

    $('#insidencias').on('click','.editar-insidencia',function()
    {
       var id_insidencia =  $(this).attr('name');
                $('#id_insidencia').val(id_insidencia);
                $('#modal-modificar-insidencia').openModal();
    });


    $('#insidencias').on('click','.activar',function()
    {
        reanudarinsidencia($(this).attr('name'));
        loadInsidencias($('#insidencias'),null,null,null);
    });


});
/*-------
            AJAX
---------*/
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
                                result.html('');
                            }
                            else
                            {
                                text = '<div class="alert alert-dismissible alert-danger">' +
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>' + http.responseText + '</div>';
                                result.html(http.responseText);
                            }
                        }
                        catch (e)
                        {
                            $('result').html(res.responseText);
                        }
                    }
    });
    /*http = Connect();
    http.onreadystatechange = function ()
    {
         if (http.readyState == 4 && http.status == 200)
         {

                if (http.responseText == 1)
                {
                    message_area_modal.html("<img src='views/img/success.png'></img> la insidencia ha sido posteada");
                    modal.openModal();
                    result.html('');

                } else
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
                '<img src="views/img/load.gif"></img> Publicando insidencia </div>';
            result.html(text);
        }
    }
    http.open('POST','?post=insidencia&'+data);
    http.setRequestHeader("Content-type", "multipart/form-data");
    http.send(archivo);*/
}

/*-------
            AJAX Metodos load
---------*/


function loadInsidencias(div,result,modal,message_area_modal)
{
    http = Connect();
    http.onreadystatechange = function()
    {
        if(http.readyState == 4 && http.status ==200)
        {
            div.html(http.responseText);
            message_area_modal.html("<img src='views/img/success.png'></img> La insidencia ha sido publicada satisfactoriamente");
            modal.openModal();
            result.html('');
        }
        else if(http.readyState != 4)
        {
            text = '<div class="alert alert-dismissible alert-info center s12 m12">' +
                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                '<img src="views/img/load2.gif"></img> Cargando...</div>';
            div.html(text);
        }
    }
    http.open('GET','?get=insidencias');
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send(null);
}

function finalizarinsidencia(id,result,modal,message_area_modal)
{

    http = Connect();
    http.onreadystatechange = function ()
    {
         if (http.readyState == 4 && http.status == 200)
         {

            if (http.responseText == 1)
            {
                message_area_modal.html("<img src='views/img/success.png'></img> la insidencia ha sido finalizada");
                modal.openModal();
                result.html('');
            }
            else
            {
                text = '<div class="alert alert-dismissible alert-danger">' +
                    '<button type="button" class="close" data-dismiss="alert">&times;</button>' + http.responseText + '</div>';
                    //result.html(http.responseText);
            }

        }
        else if (http.readyState != 4)
        {
            text = '<div class="alert alert-dismissible alert-info">' +
                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                '<img src="views/img/load.gif"></img> Procesando acciÃ³n...</div>';
            //result.html(text);
        }
    }
    http.open('POST','?post=insidencia&mod=2&id='+id+'&estado=0');
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send(null);
}
function reanudarinsidencia(id,result,modal,message_area_modal)
{

    http = Connect();
    http.onreadystatechange = function ()
    {
         if (http.readyState == 4 && http.status == 200)
         {

            if (http.responseText == 1)
            {
                message_area_modal.html("<img src='views/img/success.png'></img> la insidencia ha sido reanudad");
                modal.openModal();
                result.html('');
            }
            else
            {
                text = '<div class="alert alert-dismissible alert-danger">' +
                    '<button type="button" class="close" data-dismiss="alert">&times;</button>' + http.responseText + '</div>';
                    //result.html(http.responseText);
            }

        }
        else if (http.readyState != 4)
        {
            text = '<div class="alert alert-dismissible alert-info">' +
                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                '<img src="views/img/load.gif"></img> Procesando acciÃ³n...</div>';
            //result.html(text);
        }
    }
    http.open('POST','?post=insidencia&mod=2&id='+id+'&estado=1');
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send(null);
}

function modificarinsidencia(id,result,modal,message_area_modal,descripcion)
{

    http = Connect();
    http.onreadystatechange = function ()
    {
         if (http.readyState == 4 && http.status == 200)
         {

            if (http.responseText == 1)
            {
                message_area_modal.html("<img src='views/img/success.png'></img> la insidencia ha sido modificada!!");
                modal.openModal();
                result.html('');
            }
            else
            {
                text = '<div class="alert alert-dismissible alert-danger">' +
                    '<button type="button" class="close" data-dismiss="alert">&times;</button>' + http.responseText + '</div>';
                    //result.html(http.responseText);
            }

        }
        else if (http.readyState != 4)
        {
            text = '<div class="alert alert-dismissible alert-info">' +
                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                '<img src="views/img/load.gif"></img> Procesando acciÃ³n...</div>';
            //result.html(text);
        }
    }
    http.open('POST','?post=insidencia&mod=1&id='+id+'&descripcion='+descripcion);
    http.setRequestHeader("Content-type", "multipart/form-data");
    http.send(null);
}

