<?php
namespace Application\Model;

class Item
{

    use  \Application\Model\Traids\getArrayCopy;
    use  \Application\Model\Traids\exchangeArray;

    public $id;
    public $id_venda;
    public $id_produto;
    public $quantidade;
    public $valor_unitario;
    public $valor_total;
    public $validadeSelo;
    public $dataReteste;




}





