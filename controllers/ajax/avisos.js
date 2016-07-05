$('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  });
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
