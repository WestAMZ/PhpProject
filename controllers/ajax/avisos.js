$('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15,
    format: 'dd-mm-yyyy' });
$(document).ready(function()
{
   $('#table').on('click','.aviso',function()
    {
        $('#table .selected').removeClass('selected');
        $(this).toggleClass('selected');
        var id_mod = $(this).children(0).html();
        var form = $('#formaviso');

        if($('[name = "editar"]').prop('checked') == true)
        {
            getAvisos(id_mod);
        }
       else
           {
                $('[name= "titulo"]').val("");
                $('[name= "fecha_publicacion"]').val("");
                $('[name= "fecha_finalizacion"]').val("");
                $('[name= "contenido"]').val("");
           }
    });

    $('#searchtxt').keypress(
        function(e)
        {
            //condicion para linpiar de caracteres especiales (no alfa nunmericos)
            var pressed = (e.key.toString().length == 1)? e.key :'';
            var search = $(this).val()+ pressed;
            searchaviso(search,$('#table'));
        });

});
$("#formaviso").submit(function ()
{
    var data = $("#formaviso").serialize();
        var result = $('#result');
        var table = $('#table');
        var modal = $('#myModal');
        var ms = $('#message');

        if($('[name = "editar"]').prop('checked') == false)
        {
            addaviso(data, result, modal, ms);
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

/*
==================================================
                AJAX
==================================================
*/

function getAvisos(id)
{
    http = Connect();
    http.onreadystatechange = function()
    {
        if(http.readyState == 4 && http.status ==200)
        {
            //Respuesta recivida
            var aviso = JSON.parse(http.responseText).aviso[0];

            if(aviso != null)
            {
                $('[name= "titulo"]').val(aviso.titulo);
                $('[name= "fecha_publicacion"]').val(aviso.fecha_publicacion);
                $('[name= "fecha_finalizacion"]').val(aviso.fecha_finalizacion);
                $('[name= "contenido"]').val(aviso.contenido);
            }

        }
        else if(http.readyState != 4)
        {
            //Esperando respuesta
        }
    }
    http.open('GET','?get=aviso&id='+id);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send(null);
}

function searchaviso(search,table)
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
    httpL.open('GET','?get=avisos&search='+search);
    httpL.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    httpL.send(null);
}
function addaviso(data,result,modal,message_area_modal)
{
    http = Connect();
    http.onreadystatechange = function ()
    {
         if (http.readyState == 4 && http.status == 200)
         {

            if (http.responseText == 1)
            {
                message_area_modal.html("<img src='views/img/success.png'></img> EL aviso ha sido agregado Satisfactoriamente !!");
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
    http.open('POST','?post=aviso');
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send(data);
}
