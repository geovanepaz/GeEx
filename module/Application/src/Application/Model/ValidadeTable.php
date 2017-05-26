<?php
/**
 * Created by PhpStorm.
 * User: Geovane Paz
 * Date: 18/02/2017
 * Time: 11:32
 */

namespace Application\Model;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;


class ValidadeTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }


    public function inserir($id_item,$validadeSelo,$dataReteste, $adapter)
    {

        $sql = new Sql($adapter);
        $insert = $sql->insert();
        $insert->into('validade');
        $insert->values([
            'id_item' => $id_item,
            'validadeSelo' => $validadeSelo,
            'dataReteste' => $dataReteste,
        ]);
        $stmt = $sql->prepareStatementForSqlObject($insert);
        return $stmt->execute();
    }


}