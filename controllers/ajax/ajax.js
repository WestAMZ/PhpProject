/*-------
            AJAX Metodo de inicialización de conexión
---------*/
function Connect()
{
    var http = null;
    if(window.XMLHttpRequest)
    {
        http = new XMLHttpRequest();
    }
    else if(window.ActiveXObject)
    {
        http = new ActiveXObject("Microsoft.XMLHTTP");
    }
    return http;
}
