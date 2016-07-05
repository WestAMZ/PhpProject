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
        getAvisos(id_mod);
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
                $('[name= "nombre1"]').val(empleado.nombre1);
                $('[name= "nombre2"]').val(empleado.nombre2);
                $('[name= "apellido1"]').val(empleado.apellido1);
                $('[name= "apellido2"]').val(empleado.apellido2);
                $('[name= "cedula"]').val(empleado.cedula);
                $('[name= "id_empleado"]').val(empleado.id_empleado);
                $('[name= "telefono"]').val(empleado.telefono);
                $('[name= "inss"]').val(empleado.inss);
                $('[name= "correo"]').val(empleado.correo);
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
