<?php
namespace Application\Model;

class Produto
{

    use  \Application\Model\Traids\getArrayCopy;
    use  \Application\Model\Traids\exchangeArray;

    public $codigo;
    public $agenteExtintor;
    public $capacidadeExtintora;
    public $carga;
    public $validadeSelo;
    public $dataReteste;
    public $valorUnitario;
}