<?php
namespace Application\Model;

class Venda
{

    use  \Application\Model\Traids\getArrayCopy;
    use  \Application\Model\Traids\exchangeArray;

    public $id;
    public $id_cliente;
    public $valor_venda;
    public $valor_total;
    public $descontos;
    public $dataVenda;
}