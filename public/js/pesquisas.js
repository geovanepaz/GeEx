/**
 * Created by Geovane Paz on 27/03/2017.
 */
function executaScrpt() {

    //usuario
    $("#pesqUser").click(function()
    {

        var t = $('#tabUser').DataTable();
        t.clear().draw();

        $("#pesqUser").html('Procurando....');

        var  id = $('#id').val();
        var  nome = $('#nome').val();
        var  usuario = $('#usuario').val();


        $.post( "/usuario/pesquisar", { id:id, nome:nome, usuario:usuario }, function(  retorno, status )
        {

            var dataJson = JSON.parse(retorno);


            for(i = 0; i<dataJson.length;i++ )
            {

                t.row.add
                ([
                    dataJson[i].id,
                    dataJson[i].nome,
                    dataJson[i].usuario,
                    "<td> <button class='btn btn-danger btn-xs' type='submit'>Remover</button> <button class='btn btn-success btn-xs' type='submit'>Visualizar</button> <button class='btn btn-primary btn-xs' type='submit'>Copiar</button> </td> </tr>",

                ]).draw(false);
            }
            $("#pesqUser").html('Pesquisar');

        });


    });


    //============Pesquisa VENDAAAAAAAAAA==============
    $("#pesqVenda").click(function()
    {

        var t = $('#tabBuscaVenda').DataTable();
        t.clear().draw();

        $("#pesqVenda").html('Procurando....');

        var  documento = $('#documento').val();
        var  nome = $('#nome').val();
        var  cidade = $('#cidade').val();
        var  validadeSelo = $('#validadeSelo').val();


        $.post( "/venda/pesquisar", { documento:documento, nome:nome, cidade:cidade,validadeSelo:validadeSelo }, function(  retorno )
        {

            var dataJson = JSON.parse(retorno);

            for(i = 0; i<dataJson.length;i++ )
            {

                t.row.add
                ([
                    dataJson[i]['v.id'],
                    dataJson[i]['documento'],
                    dataJson[i]['nome'],
                    dataJson[i]['v.dataVenda'],
                    "<td> <button class='btn btn-danger btn-xs' type='submit'>Remover</button> <button class='btn btn-success btn-xs' type='submit'>Visualizar</button> <button class='btn btn-primary btn-xs' type='submit'>Copiar</button> </td> </tr>",

                ]).draw(false);

            }
            $("#pesqVenda").html('Pesquisar');


        });



    });

    //Pesquisa produto
    $("#pesqProd").click(function()
    {

        var t = $('#tabProd').DataTable();
        t.clear().draw();

        $("#pesqProd").html('Procurando....');

        var  codigo = $('#codigo').val();
        var  capacidadeExtintora = $('#capacidadeExtintora').val();
        var  dataReteste = $('#dataReteste').val();


        $.post( "/produto/pesquisar", { codigo:codigo, capacidadeExtintora:capacidadeExtintora, dataReteste:dataReteste }, function(  retorno, status ) {

            var dataJson = JSON.parse(retorno);
            for(i = 0; i<dataJson.length;i++ )
            {
                t.row.add
                ([
                    dataJson[i].codigo,
                    dataJson[i].agenteExtintor,
                    dataJson[i].capacidadeExtintora,
                    dataJson[i].carga,
                    "<td> <button class='btn btn-danger btn-xs' type='submit'>Remover</button> <button class='btn btn-success btn-xs' type='submit'>Visualizar</button> <button class='btn btn-primary btn-xs' type='submit'>Copiar</button> </td> </tr>",

                ]).draw(false);

            }
            $("#pesqProd").html('Pesquisar');

        });

    });

    //Pesquisa CLIENTE
    $("#pesqCliente").click(function(){

        var t = $('#tabClie').DataTable();
        t.clear().draw();

        $("#pesqCliente").html('Procurando....');

        var  documento = $('#documento').val();
        var  nome = $('#nome').val();
        var  razaoSocial = $('#razaoSocial').val();
        var  cidade = $('#cidade').val();


        $.post( "/cliente/pesquisar", { documento:documento, nome:nome, razaoSocial:razaoSocial,cidade:cidade }, function(  retorno, status ) {


            var dataJson = JSON.parse(retorno);
            for(i = 0; i<dataJson.length;i++ )
            {
                t.row.add
                ([
                    dataJson[i].documento,
                    dataJson[i].nome,
                    dataJson[i].razaoSocial,
                    dataJson[i].telefone,
                    "<td> <button class='btn btn-danger btn-xs' type='submit'>Remover</button> <button class='btn btn-success btn-xs' type='submit'>Visualizar</button> <button class='btn btn-primary btn-xs' type='submit'>Copiar</button> </td> </tr>",

                ]).draw(false);

            }
            $("#pesqCliente").html('Pesquisar');

        });

    });



    $(".codigo_produto").keypress(function(event)
    {
        //popula produto
        if(event.which == 13) {
            var id = event.target.id;
            var valor = document.getElementById(id).value;
            populaProduto(id,valor);
        }

    });


  /////POPULAR CLIENTE NA TABELA VENDA
    $("#documento_cliente").keypress(function(event)
    {
        //popula cliente
        if(event.which == 13)
        {
            pupulaCliente();
        }
    });

    $("#buscarCli").click(function()
    {
        pupulaCliente();

    });

}

function pupulaCliente()
{
    $("#buscarCli").html('Bus...');

    var  documento = $('#documento_cliente').val();


    $.post( "/cliente/visualizar", { documento:documento }, function(  retorno )
    {

        console.log(retorno);
        var dataJson = JSON.parse(retorno);
        // atribui os valores nos seus devidos unputs
        $('#id_cliente').val(dataJson.id);
        $('#nome').val(dataJson.nome);
        $('#razaoSocial').val(dataJson.razaoSocial);
        $('#inscricaoEstadual').val(dataJson.inscricaoEstadual);
        $('#telefone').val(dataJson.telefone);
        $('#email').val(dataJson.email);
        $('#cep').val(dataJson.cep);
        $('#cidade').val(dataJson.cidade);
        $('#bairro').val(dataJson.bairro);
        $('#rua').val(dataJson.rua);
        $('#numero').val(dataJson.numero);
        $('#complemento').val(dataJson.complemento);

        $("#buscarCli").html('Buscar');

    });

}

//====================== FUNÇÃO PARA POPULAR PRODUTOS  NA TABELA VENDA =================================
function populaProduto(variavelId, valor)
{
    //remove o texto do id e pega apenas os numeros
    num = apenasNumeros(variavelId);

    //concatena a o o nome do campo com a variavel
    //num = 10
    //agenteExtintor = '#age_' + num;
    //saida de agenteExtintor ficA >>>>> #age_10
    var agenteExtintor = '#age_' + num;
    var capacidadeExtintora = '#cap_' + num;
    var carga = '#car_' + num;



    $.post( "/produto/visualizar/", { codigo:valor}, function(retorno)
    {
        var dataJson = JSON.parse(retorno);
        console.log(dataJson);
        // atribui os valores nos seus devidos unputs
        $(agenteExtintor).val(dataJson.agenteExtintor);
        $(capacidadeExtintora).val(dataJson.capacidadeExtintora);
        $(carga).val(dataJson.carga);

    });
}

$(document).ready(executaScrpt);