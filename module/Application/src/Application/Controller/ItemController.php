<?php
/**
 * Created by PhpStorm.
 * User: Geovane Paz
 * Date: 22/02/2017
 * Time: 10:22
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ItemController extends AbstractActionController
{
    public $table;

    public function getTable()
    {
        if (!$this->table) {
            $sm = $this->getServiceLocator();
            $this->table = $sm->get('ItemTable');
        }

        return $this->table;

    }

    public function inserirAction()
    {
        $req = $this->getRequest();
        if ($req->isPost()){
            $resultSet = $this->params()->fromPost('form');
            $id_venda = $this->params()->fromPost('id_venda');
            $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
            $table = $this->getTable();
            $count = count($resultSet);

            for($i=0; $i<$count; $i = $i + 10) {

                $table->inserir($id_venda, $resultSet[0 + $i]["value"], $resultSet[6 + $i]["value"], $resultSet[8 + $i]["value"], $adapter);
            }

            return $this->response;

        }


    }

}

