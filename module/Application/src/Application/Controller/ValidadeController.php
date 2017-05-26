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

class ValidadeController extends AbstractActionController
{
    public $table;

    public function getTable()
    {
        if (!$this->table) {
            $sm = $this->getServiceLocator();
            $this->table = $sm->get('ValidadeTable');
        }

        return $this->table;

    }

    public function inserirAction()
    {
        $req = $this->getRequest();
        if ($req->isPost()){
            $resultSet = $this->params()->fromPost('form');
            $id_item = $this->params()->fromPost('id_item');
            $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
            $table = $this->getTable();
            $count = count($resultSet);


            for($i=0; $i<$count; $i = $i + 10) {

                $table->inserir(102, $resultSet[4 + $i]["value"], $resultSet[5 + $i]["value"],$adapter);
            }

            return $this->response;

        }


    }

}

