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


class ItemTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function insert(Item $model)
    {

       return $this->tableGateway->insert($model->getArrayCopy());
    }

    public function inserir($id_venda,$id_produto,$quantidade,$valor_unitario,$valo_total,$validadeSelo,$dataReteste, $adapter)
    {

        $sql = new Sql($adapter);
        $insert = $sql->insert();
        $insert->into('item');
        $insert->values([
            'id_venda' => $id_venda,
            'id_produto' => $id_produto,
            'quantidade' => $quantidade,
            'valor_unitario' => $valor_unitario,
            'valo_total' => $valo_total,
            'validadeSelo' => $validadeSelo,
            'dataReteste' => $dataReteste,
        ]);
        $stmt = $sql->prepareStatementForSqlObject($insert);
        $stmt->execute();
    }


}