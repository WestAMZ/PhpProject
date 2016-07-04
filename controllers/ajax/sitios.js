/*-----------
                -------------------ON load
------------- nl;kj;lkjlk*/
$(document).ready(function ()
{

    $('#table').on('click','.sitio',function()
    {
        $('#table .selected').removeClass('selected');
        $(this).toggleClass('selected');
        var id_mod = $(this).children(0).html();
        var form = $('#formsitio');
        getSitio(id_mod);
    });

     $('#searchtxt').keypress(
        function(e)
        {
            //condicion para linpiar de caracteres especiales (no alfa nunmericos)
            var pressed = (e.key.toString().length == 1)? e.key :'';
            var search = $(this).val()+ pressed;
            searchSitios(search,$('#table'));
        });
});
/*-----------
                ------------------ON submit
-------------*/
$("#formsitio").submit(function () {
        var data = $("#formsitio").serialize();
        var result = $('#result');
        var table = $('#table');
        var modal = $('#myModal');
        var ms = $('#message');

        if($('[name = "editar"]').prop('checked') == false)
        {
            addsitio(data, result, modal, ms);
            setTimeout(loadSitios(table,result,modal, ms),3000);
        }
        else
        {
            if($('.selected').size() == 0)
            {
                alert('debe seleccionar el sitio a modificar!');
            }
            else
            {
                updateSitio(data, result, modal, ms);
            }
        }
        return false;
    });

/*-------
           ---------------------AJAX
---------*/

function addsitio(data,result,modal,message_area_modal)
{
    http = Connect();
    http.onreadystatechange = function ()
    {
         if (http.readyState == 4 && http.status == 200)
         {

            if (http.responseText == 1)
            {
                message_area_modal.html("<img src='views/img/success.png'></img> El sito ha sido registrado satisfactoriamente");
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
    http.open('POST','?post=sitio');
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send(data);
}

/*-------
           -------------------- AJAX Metodos load
---------*/


function loadSitios(table,result,modal,message_area_modal)
{
    httpL = Connect();
    httpL.onreadystatechange = function()
    {
        if(httpL.readyState == 4 && httpl.status ==200)
        {
            table.html(httpL.responseText);
            message_area_modal.html("<img src='views/img/success.png'></img> El sito ha sido registrado satisfactoriamente");
            modal.openModal();
            result.html('');
        }
        else if(httpl.readyState != 4)
        {
            text = '<div class="alert alert-dismissible alert-info center s12 m12">' +
                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                '<img src="views/img/load2.gif"></img> Cargando...</div>';
            table.html(text);
        }
    }
    httpL.open('GET','?get=sitios');
    httpL.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    httpL.send(null);
}


/*
    ----------------------------------Load sitio unico
*/

function getSitio(id)
{
    http = Connect();
    http.onreadystatechange = function()
    {
        if(http.readyState == 4 && http.status ==200)
        {
            //Respuesta recivida
            var sitio = JSON.parse(http.responseText).sitio[0];

            $('[name= "id_insidencia"]').val(sitio.idSitio);
            $('[name= "nombre"]').val(sitio.nombre);
            $('[name= "pais"]').val(sitio.pais);
            $('[name= "ciudad"]').val(sitio.ciudad);
            $('[name= "telefono"]').val(sitio.telefono);
            $('[name= "direccion"]').val(sitio.direccion);
        }
        else if(http.readyState != 4)
        {
            //Esperando respuesta
        }
    }
    http.open('GET','?get=sitio&id='+id);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send(null);
}

/*
    ---------------------------------modificar sitio
*/

function updateSitio(data,result,modal,message_area_modal)
{
    http = Connect();
    http.onreadystatechange = function ()
    {
         if (http.readyState == 4 && http.status == 200)
         {

            if (http.responseText == 1)
            {
                message_area_modal.html("<img src='views/img/success.png'></img> El sito ha sido modificado con exíto");
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
    http.open('POST','?post=sitio&mod=1');
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send(data);
}

function searchSitios(search,table)
{
    httpL = Connect();
    httpL.onreadystatechange = function()
    {
        if(httpL.readyState == 4 && httpL.status ==200)
        {
            table.html(httpL.responseText);
        }
        else if(httpL.readyState != 4)
        {
            text = '<div class="alert alert-dismissible alert-info center s12 m12">' +
                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                '<img src="views/img/load2.gif"></img> Cargando...</div>';
            table.html(text);
        }
    }
    httpL.open('GET','?get=sitios&search='+search);
    httpL.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    httpL.send(null);
}
