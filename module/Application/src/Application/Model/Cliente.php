<?php
namespace Application\Model;

class Cliente
{

    use  \Application\Model\Traids\getArrayCopy;
    use  \Application\Model\Traids\exchangeArray;

    public $id;
    public $documento;
    public $nome;
    public $razaoSocial;
    public $inscricaoEstadual;
    public $telefone;
    public $email;
    public $cep;
    public $cidade;
    public $rua;
    public $numero;
    public $bairro;
    public $complemento;
}









