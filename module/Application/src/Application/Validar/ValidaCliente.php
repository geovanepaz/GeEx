<?php

namespace Application\Validar;

use Zend\Validator\AbstractValidator;

class ValidaCliente extends AbstractValidator
{
    const NOME = 'nome';
    const RAZAOSOCIAL  = 'razaoSocial';
    const CIDADE  = 'cidade';

    protected $messageTemplates = [
        self::NOME => "O campo nome não foi preenchido",
        self::RAZAOSOCIAL  => "O campo Razaõ Social não coi preenchido",
        self::CIDADE  => "O campo Cidade não foi preenchido",
    ];

    public function isValid($value)
    {
        $this->setValue($value);

        $isValid = true;

        if (strlen($value->nome) < 1) {
            $this->error(self::NOME);
            $isValid = false;
        }

        if (strlen($value->razaoSocial) < 1) {
            $this->error(self::RAZAOSOCIAL);
            $isValid = false;
        }

        if (strlen($value->cidade) < 1) {
            $this->error(self::CIDADE);
            $isValid = false;
        }


        return $isValid;
    }

}