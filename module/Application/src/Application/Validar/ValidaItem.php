<?php
/**
 * Created by PhpStorm.
 * User: Geovane Paz
 * Date: 05/04/2017
 * Time: 16:35
 */

namespace Application\Validar;

use Zend\Validator\AbstractValidator;
use Zend\Validator\Date;
use Zend\Validator\NotEmpty;


class ValidaItem extends AbstractValidator
{

    const VALIDADESELO = 'validadeSelo';
    const DATARETESTE  = 'dataReteste';
    const VALORTOTAL  = 'valorTotal';

    protected $messageTemplates = [
        self::VALIDADESELO => " O campo validade do Selo não foi preenchido com um valor valido ",
        self::DATARETESTE  => " O campo data reteste não foi preenchido com um valor valido ",
        self::VALORTOTAL  => " O campo valor total não foi preenchido ou não é um valor valido ",
    ];



    public function isValid($value)
    {
        $this->setValue($value);

        $isValid = true;


        $date = new Date(['format' => 'Y/m/d']);
        $ano = new Date(['format' => 'Y']);
        $notEmpty = new NotEmpty(NotEmpty::STRING + NotEmpty::INTEGER);

        if ( ! $date->isValid($value['validadeSelo'])) {
            $this->error(self::VALIDADESELO);
            $isValid = false;
        }

        if ( ! $ano->isValid($value['dataReteste'])) {
            $this->error(self::DATARETESTE);
            $isValid = false;
        }
//
        if ( ! $notEmpty( $value['valor_total'] + $value['valor_total'])) {
            $this->error(self::VALORTOTAL);
            $isValid = false;
        }


        return $isValid;
    }

}