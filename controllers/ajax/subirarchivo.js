function subirArchivo(data,result,modal,message_area_modal)
{
    http = Connect();
    http.onreadystatechange = function ()
    {
         if (http.readyState == 4 && http.status == 200)
         {

                if (http.responseText == 1)
                {
                    message_area_modal.html("<img src='views/img/success.png'></img> Archivo subido exitosamente");
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
