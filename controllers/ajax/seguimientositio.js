$(document).ready(function ()
{

     $('#seguimientos').on('click','.seguimiento',function()
    {
        $('#table1 .selected').removeClass('selected');
        $(this).toggleClass('selected');
    });

    $(document).ready(function () {
        $('ul.tabs').tabs();
    });

     $('#seguimientos2').on('click','.seguimiento2',function()
    {
        $('#table2 .selected').removeClass('selected');
        $(this).toggleClass('selected');
    });

    $('#searchtxt2').keypress(
        function(e)
        {
            alert('nada');
            var pressed = (e.key.toString().length == 1)? e.key :'';
            var search = $(this).val()+ pressed;
            searchnoresuelta(search,$('#table2'));
        });

});


function searchnoresuelta(search, table) {
    httpL = Connect();
    httpL.onreadystatechange = function () {
        if (httpL.readyState == 4 && httpL.status == 200) {
            table.html(httpL.responseText);
        } else if (httpL.readyState != 4) {
            text = '<div class="alert alert-dismissible alert-info center s12 m12">' +
                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                '<img src="views/img/load2.gif"></img> Cargando...</div>';
            table.html(text);
        }
    }
    httpL.open('GET', '?get=incidenciatablenoresuelta&search=' + search);
    httpL.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    httpL.send(null);
}
