//====================== VARIAVEIS GLOBAIS  =================================
//posição do array
// este contador que altera o nome do ID dos produtos na view extincendio/venda/vender ex; age_0, age_1
//estes numeros são variaveis graças aos >> pos
//esta alteração é feita na função  FUNÇÃO PARA ADD E REMOVER PRODUTO
var pos =1;
//conta o numero de linha, que a tabela venda de produtos tem.
var linhastable = 1;

//===CAPUTURA O EVENTO DO TECLADO E CASO TENHA  APERTADO A TECLA ENTER EXECUTA DETERMINADA FUNÇAO, DEPENDENDE EM QUAL CAMPO FOI FEITO O COMANDO =================================
$(document).ready(function() {

    //traduz as tabelas de pesguizas todas
    $('.table').DataTable({
        "language": {
            "lengthMenu": "Mostrando _MENU_ registros por página",
            "zeroRecords": "Nada encontrado",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "Nenhum registro disponível",
            "infoFiltered": "(filtrado de _MAX_ registros no total)"


        }
    });

});


//====================== FUNÇÃO PARA linhas na tabea e poder inserir mai produtos PRODUTOS =================================
(function($) {
    AddTableRow = function() {
        var newRow = $("<tr>");
        var cols = "";
        cols += '<td><input  id="idp_'+pos+'" name="produto['+ pos + '][id_produto]" type="text" value="" placeholder="Codigo produto" class="form-control input-md codigo_produto" ></td>';
        cols += '<td><input id="age_'+pos+'" name="produto['+ pos + '][agenteExtintor]" value="" type="text" placeholder="Agente Extintor" class="form-control input-md" ></td>';
        cols += '<td> <input id="cap_'+pos+'" name="produto['+ pos + '][capacidadeExtintora]" value="" type="text" placeholder="Capacidade Extintora" class="form-control input-md"></td>';
        cols += '<td> <input id="car_'+pos+'" name="produto['+ pos + '][carga]" type="text[]" value="" placeholder="Carga" class="form-control input-md"></td>';
        cols += '<td><input  id="sel_'+pos+'" name="produto['+ pos + '][validadeSelo]" value="" class="form-control input-md data data-completa" type="text" placeholder="yyy/mm/aa" ></td>';
        cols += '<td><input id="ret_'+pos+'" name="produto['+ pos + '][dataReteste]" value=""  type="text" placeholder="Ano" class="form-control input-md data data-ano" ></td>';
        cols += '<td><input id="qua_'+pos+'" name="produto['+ pos + '][quantidade]" onblur="calculaTotalItem(this)" value="" type="text" placeholder="Quantidade" class="form-control input-md"></td>';
        cols += '<td><input id="uni_'+pos+'" name="produto['+ pos + '][valor_unitario]" onblur="calculaTotalItem(this)" value="" type="text" placeholder="Valor Unitario" class="form-control input-md" ></td>';
        cols += '<td><input id="tot_'+pos+'" name="produto['+ pos + '][valor_total]" onblur="calculaTotalItem(this)" value="" type="text" placeholder="Valor Total" class="form-control input-md"></td>';
        cols += '<td>';
        cols += '<button onclick="remove(this)" type="button" class="btn btn-danger">Remover</button>';
        cols += '</td>';

        newRow.append(cols);
        $("#products-table").append(newRow);
        pos++;
        linhastable++;
        calendario();
        executaScrpt();
    };
})(jQuery);


//====================== remove as linhas da tabela =================================
(function($) {
    remove = function(item) {

        var tr = $(item).closest('tr');
        if(linhastable<=1) return false;
        tr.fadeOut(400, function() {

            tr.remove();
            calculaTotalVenda();
            linhastable--;
        });

        return false;
    }
})(jQuery);

//====================== remove os numeros das strings =================================
function apenasNumeros(string)
{
    var numsStr = string.replace(/[^0-9]/g,'');
    return parseInt(numsStr);

}

//====================== Calcular total =================================
function calculaTotalItem(a)
{
    var id = a.id;
    var num = apenasNumeros(id);
    var idQuantidade = '#qua_' + num;
    var idUnitario = '#uni_' + num;
    var idTotal = '#tot_' + num;

    var resultado  = $(idUnitario).val() * $(idQuantidade).val();
    $(idTotal).val(resultado);
    calculaTotalVenda();
}



//Função para aparecer os calendarios
function calendario() {

    $('#validadeSelo').datetimepicker({
        viewMode: 'years',
        format: 'YYYY/MM'
    });

    $('.data-ano').datetimepicker({
        viewMode: 'years',
        format: 'YYYY'
    });
    $('.data-completa').datetimepicker({
        viewMode: 'years',
        format: 'YYYY/MM/DD'

    });
    
}
$(document).ready(calendario);


$(document).ready(function(){


    $('.glyphicon-eur').click(calculaTotalVenda = function()
    {
        var form = $('#itensProduto').serializeArray();

        var length = form.length;
        var acumulador = parseInt(form[8]["value"] ); //form na posição 8 é o valor total do item
        var descontos = $('#descontos').val();

        //so entra no for se tiver mais de um item
        for(var i = 9; i<length-2; i = i+9)
        {
            var ValorTotalItem = parseInt(form[8 +i]["value"] );
            acumulador =  parseInt(acumulador + ValorTotalItem );
        }

        acumulador = parseInt(acumulador - descontos);
        $('#valor_total').val(' ');
        $('#valor_total').val(acumulador);

    });


});


