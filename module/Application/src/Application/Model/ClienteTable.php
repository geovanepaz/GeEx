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
use Zend\Db\Sql\Select;


class ClienteTable
{
    protected $tableGateway;

    public $t;
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }


    public function cadastrar(Cliente $model)
    {

         $this->tableGateway->insert($model->getArrayCopy());

    }


    public function visualizar($documento)
    {
        $result = $this->tableGateway->select(['documento' => $documento]);
        return $result->current();
    }

    public function visualizarId($id)
    {
        $result = $this->tableGateway->select(['id' => $id]);
        return $result->current();
    }

    public function exibirDocumento($documento, $adapter)
    {

        return $this->tableGateway->select(['documento' => $documento])->toArray();

    }

    public function exibirNome($nome,$adapter)
    {



        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from('cliente');
        $select->where->like('nome' , $nome . '%'   );

        $stmt = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if ($result instanceof ResultInterface && $result->isQueryResult())
        {
            $resultSet = new ResultSet;
            $resultSet->initialize($result);

            return $resultSet->toArray();
        }


    }

    //terminar codigo;
    public function exibirRazaoSocial($razaoSocial,$adapter)
    {
        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from('cliente');
        $select->where->like('razaoSocial' , $razaoSocial . '%'   );

        $stmt = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if ($result instanceof ResultInterface && $result->isQueryResult())
        {
            $resultSet = new ResultSet;
            $resultSet->initialize($result);

            return $resultSet->toArray();
        }

    }

    public function exibirCidade($cidade,$adapter)
    {
        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from('cliente');
        $select->where->like('cidade' , $cidade . '%'   );

        $stmt = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if ($result instanceof ResultInterface && $result->isQueryResult()) {

            $resultSet = new ResultSet;
            $resultSet->initialize($result);
            return $resultSet->toArray();
        }

    }


    public function listar($adapter)
    {
        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from('cliente');

        $stmt = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if ($result instanceof ResultInterface && $result->isQueryResult())
        {

            $resultSet = new ResultSet;
            $resultSet->initialize($result);
            return $resultSet->toArray();
        }


    }

}