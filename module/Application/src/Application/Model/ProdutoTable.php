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
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;

class ProdutoTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }


    public function cadastrar(Produto $model)
    {

        $this->tableGateway->insert($model->getArrayCopy());
    }

    //encontra apenas o registro especifico
    public function visualizar($codigo)
    {
        $result = $this->tableGateway->select(['codigo' => $codigo]);
        return $result->current();
    }

    public function exibirCodigo($codigo, $adapter)
    {
        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from('produto');
        $select->where->like('codigo' , $codigo . '%'   );

        $stmt = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            $resultSet = new ResultSet;
            $resultSet->initialize($result);

            return $resultSet->toArray();
        }
    }

    public function exibirCapacidadeExtintora($capacidadeExtintora,$adapter)
    {
        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from('produto');
        $select->where->like('capacidadeExtintora' , $capacidadeExtintora . '%'   );

        $stmt = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            $resultSet = new ResultSet;
            $resultSet->initialize($result);

            return $resultSet->toArray();
        }


    }

    //terminar codigo;
    public function exibirDataReteste()
    {

    }


    public function listar($adapter)
    {
        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from('produto');

        $stmt = $sql->prepareStatementForSqlObject($select);
        return $stmt->execute();



    }

}