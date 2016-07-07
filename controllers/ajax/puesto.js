    $(document).ready(function ()
    {
        $('#btncargo').click(

        function()
            {
                $('#modalPuesto').openModal();
            });

        $('#formCargo').submit(
            function()
            {
                var data = $("#formCargo").serialize();
                var result = $('#result');
                var modal = $('#myModal');
                var ms = $('#message');
                agregarpuesto(data, result,modal, ms);
                return false;
            });

         $('#searchtxt').keypress(
        function(e)
        {
            //condicion para linpiar de caracteres especiales (no alfa nunmericos)
            var pressed = (e.key.toString().length == 1)? e.key :'';
            var search = $(this).val()+ pressed;
            searchPuesto(search,$('#table'));
        });
    });

/*
==============================
AJAX
==============================
*/


function agregarpuesto(data,result,modal,message_area_modal)
{
    http = Connect();
    http.onreadystatechange = function ()
    {
         if (http.readyState == 4 && http.status == 200)
         {
                if (http.responseText == 1)
                {
                    message_area_modal.html("<img src='views/img/success.png'></img> cargo agregado con exito!!");
                    modal.openModal();
                    result.html('');
                    setTimeout(window.location.reload(),2000);
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
                '<img src="views/img/load.gif"></img> Procesando informacion ! </div>';
            result.html(text);
        }
    }
    http.open('POST','?post=puesto');
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send(data);
}
function searchPuesto(search,table)
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
    httpL.open('GET','?get=puesto&search='+search);
    httpL.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    httpL.send(null);
}
