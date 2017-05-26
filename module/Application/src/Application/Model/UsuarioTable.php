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



class UsuarioTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }


    public function cadastrar(Usuario $model)
    {

        $this->tableGateway->insert($model->getArrayCopy());
    }

    //encontra apenas o registro especifico
    public function visualizar($codigo,$adapter)
    {
        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from('usuario');
        $select->where(['id' => $codigo]);

        $stmt = $sql->prepareStatementForSqlObject($select);
        return $stmt->execute();

    }

    public function exibirId($id, $adapter)
    {
        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from('usuario');
         $select->where->like('id' , $id . '%'   );

        $stmt = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            $resultSet = new ResultSet;
            $resultSet->initialize($result);

            return $resultSet->toArray();
        }


    }

    public function exibirNome($nome,$adapter)
    {
        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from('usuario');
        $select->where->like('usuario' , $nome . '%'   );

        $stmt = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            $resultSet = new ResultSet;
            $resultSet->initialize($result);

            return $resultSet->toArray();
        }


    }

    //terminar codigo;
    public function exibirUsuario($usuario,$adapter)
    {
        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from('usuario');
        $select->where->like('usuario' , $usuario . '%'   );

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
        $select->from('produto');

        $stmt = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            $resultSet = new ResultSet;
            $resultSet->initialize($result);

            return $resultSet->toArray();
        }



    }

}