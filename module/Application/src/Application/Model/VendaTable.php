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


class VendaTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function  vender(Venda $model){

         $this->tableGateway->insert($model->getArrayCopy());
         return $this->tableGateway->lastInsertValue;

    }



    public function exibirDocumento($documento, $adapter)
    {
        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->columns(['v.id', 'v.dataVenda'], false);
        $select->from(['v' => 'venda']);
        $select->where(['documento' => $documento]);

        $select->join(
            ['c' => 'cliente'], //esta trabalhando com a tabela
            'c.id = v.id_cliente'
        );

        $stmt = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            $resultSet = new ResultSet;
            $resultSet->initialize($result);

            return $resultSet->toArray();
        }
    }

    public function exibirNome($nome, $adapter)
    {
        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->columns(['v.id', 'v.dataVenda'], false);
        $select->from(['v'=>'venda']);
        $select->where->like('nome' , $nome . '%'   );
        $select->join(
            ['c' => 'cliente'], //esta trabalhando com a tabela
            'c.id = v.id_cliente'
        );

        $stmt = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            $resultSet = new ResultSet;
            $resultSet->initialize($result);

            return $resultSet->toArray();
        }

    }

    public function exibirCidade($cidade, $adapter)
    {
        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->columns(['v.id', 'v.dataVenda'], false);
        $select->from(['v'=>'venda']);
        $select->where->like('cidade' , $cidade . '%'   );
        $select->join(
            ['c' => 'cliente'], //esta trabalhando com a tabela
            'c.id = v.id_cliente'
        );

        $stmt = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            $resultSet = new ResultSet;
            $resultSet->initialize($result);

            return $resultSet->toArray();
        }

    }

    public function exibirValidadeSelo($inicio,$fim, $adapter)
    {
        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->columns(['v.id','v.dataVenda'], false);
        $select->from(['i'=>'item' ]);
        $select->where->between('validadeSelo', $inicio, $fim );
        $select->join(
            ['v' => 'venda',], //esta trabalhando com a tabela
            'i.id_venda = v.id'
        );
        $select->join(
            ['c' => 'cliente',], //esta trabalhando com a tabela
            'v.id_cliente = c.id'
        );

        $stmt = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            $resultSet = new ResultSet;
            $resultSet->initialize($result);

            return $resultSet->toArray();
        }

    }
}