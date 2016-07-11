$(document).ready(function ()
{

  $(document).ready(function(){
    $('ul.tabs').tabs();
  });


    $('#table').on('click','.insidencia',function()
    {
        alert('hola');
        $('#table .selected').removeClass('selected');
        $(this).toggleClass('selected');
        id = $(this).attr('id');
        alert(id);

    });

});
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
    httpL.open('GET','?get=seguimientositios&search='+search);
    httpL.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    httpL.send(null);
}
function
