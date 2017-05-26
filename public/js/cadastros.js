/**
 * Created by Geovane Paz on 03/04/2017.
 */

function executaScriptCadastros()
{

    /*
    * função para cadastro de clientes
    *
     */
    $('#cliente').submit(function()
    {
        var dados = jQuery( this ).serialize();

        jQuery.ajax
        ({
            type: "POST",
            url: "/cliente/cadastrar",
            data: dados,
            success: function( data )
            {
                if (data == '') {
                    alert('Cliente cadastrado com sucesso');
                } else {
                    var dataJson = JSON.parse(data);
                    var dataJson = JSON.parse(data);
                    var arr = Object.keys(dataJson).map(function (key) { return dataJson[key]; });
                    alert(arr.toString());

                }
            }
        });

        return false;
    });

/*
    $("#finalizar").click(function(){

        var form = $('#itensProduto').serializeArray();
        id_cliente = $('#id_cliente').val();

        $.post( "/venda/vender", { id_cliente: id_cliente, form:form }, function(status ) {
            alert('status: ' + status);

        });

    });
    */

    $('#itensProduto').submit(function()
    {

        var dados = jQuery( this ).serialize();

        jQuery.ajax
        ({
            type: "POST",
            url: "/venda/vender",
            data: dados,
            success: function( data )
            {
                if (data == '') {
                    alert('Cliente cadastrado com sucesso');
                } else {
                    var dataJson = JSON.parse(data);
                    var arr = Object.keys(dataJson).map(function (key) { return dataJson[key]; });
                    alert(arr.toString());

                }
            }
        });

        return false;
    });


}


$(document).ready(executaScriptCadastros);