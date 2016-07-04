
/*-----------
                -------------------ON load
-------------*/
//Asignar eventos a cosas cargadas con AJAX desde el elemento PADRE

$(document).ready(function ()
{

    $('#table').on('click','.empleado',function()
    {
        $('#table .selected').removeClass('selected');
        $(this).toggleClass('selected');
        var id_mod = $(this).children(0).html();
        var form = $('#formEmpleado');
        getEmpleado(id_mod);
    });

    $('#modal-jefe').on('click','.empleado',function()
    {
        $('#tabla-jefe .selected').removeClass('selected');
        $(this).toggleClass('selected');
        var id_jefe= $(this).children(0).html();
        var form = $('#id_jefe').val(id_jefe);


    });

    $('#searchtxt').keypress(
        function(e)
        {
            //condicion para linpiar de caracteres especiales (no alfa nunmericos)
            var pressed = (e.key.toString().length == 1)? e.key :'';
            var search = $(this).val()+ pressed;
            searchEmpleado(search,$('#table'));
        });

    $('#select-jefe').click(function()
    {
        $('#modal-jefe').openModal();
    });
});


$(document).ready(function()
{
    $('select').material_select();
});

/*-----------
                ------------------ON submit
-------------*/
$("#formEmpleado").submit(function ()
{

        var data = $("#formEmpleado").serialize();
        var result = $('#result');
        var table = $('#table');
        var modal = $('#myModal');
        var ms = $('#message');
        var id = $('[name= "id_empleado"]').val();
        if($('[name = "editar"]').prop('checked') == false)
        {
            agregarEmpleado(data, result, modal, ms);

        }
        else
        {
            if($('.selected').size() == 0)
            {
                alert('debe seleccionar el empleado a modificar!');
            }
            else
            {
                updateEmpleado(data,id, result, modal, ms);
            }
        }
        return false;
    });

/*=======================================================
                    AJAX PART
=========================================================*/

  $(document).ready(function () {
      $('select').material_select();
  });


  /*=======================================================
                      AJAX PART
  =========================================================*/
function agregarEmpleado(data,result,modal,message_area_modal)
{
    http = Connect();
    http.onreadystatechange = function ()
    {
         if (http.readyState == 4 && http.status == 200)
         {

                if (http.responseText == 1)
                {
                    message_area_modal.html("<img src='views/img/success.png'></img> Se ha agregadoel empleado con exìto");
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
                '<img src="views/img/load.gif"></img> Agragando empleado</div>';
            result.html(text);
        }
    }
    http.open('POST','?post=empleado');
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send(data);
}


/*
    ----------------------------------Load sitio unico
*/

function getEmpleado(id)
{
    http = Connect();
    http.onreadystatechange = function()
    {
        if(http.readyState == 4 && http.status ==200)
        {
            //Respuesta recivida
            var empleado = JSON.parse(http.responseText).empleado[0];

            if(empleado != null)
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
    http.open('GET','?get=empleado&id='+id);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send(null);
}

/*
    ---------------------------------modificar empleado
*/

function updateEmpleado(data,id,result,modal,message_area_modal)
{
    http = Connect();
    http.onreadystatechange = function ()
    {
         if (http.readyState == 4 && http.status == 200)
         {

            if (http.responseText == 1)
            {
                message_area_modal.html("<img src='views/img/success.png'></img> El empleado ha sido modificado con exíto");
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
    http.open('POST','?post=empleado&mod=1&id='+id);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send(data);
}

/*--------
            Busqueda con AJAX
---------*/

function searchEmpleado(search,table)
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
    httpL.open('GET','?get=empleados&search='+search);
    httpL.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    httpL.send(null);
}

/*
    Subida de archivo
*/


