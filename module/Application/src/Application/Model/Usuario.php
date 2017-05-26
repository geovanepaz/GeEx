<?php
namespace Application\Model;

class Usuario
{

    use  \Application\Model\Traids\getArrayCopy;
    use  \Application\Model\Traids\exchangeArray;

    public $id;
    public $nome;
    public $usuario;
    public $senha;

}