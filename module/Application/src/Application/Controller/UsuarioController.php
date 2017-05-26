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

class UsuarioController extends AbstractActionController
{
    public $table;

    public function getTable()
    {
        if (!$this->table) {
            $sm = $this->getServiceLocator();
            $this->table = $sm->get('UsuarioTable');
        }

        return $this->table;

    }

    public function cadastrarAction()
    {
        $req = $this->getRequest();
        if ($req->isPost()){
            $result = $req->getPost();
            $model  = new \Application\Model\Usuario();
            $model->exchangeArray($result);
            $table = $this->getTable();
            $table->cadastrar($model);;
        }

    }

    public function pesquisarAction()
    {

        $resultSet = [];
        $req = $this->getRequest();
        if ($req->isPost()){

            $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
            $id = $this->params()->fromPost('id');
            $nome = $this->params()->fromPost('nome');
            $usuario = $this->params()->fromPost('usuario');

            //VERIFICA SE O CAMPO $documento ESTA PREENCHIDO CASO SIM EFETUA  A PESQUISA PELO $documento
            if(!empty($id))
                $resultSet = $this->getTable()->exibirId($id, $adapter);


            //VERIFICA SE O $nome capacidadeExtintora ESTA PREENCHIDO CASO SIM EFETUA  A PESQUISA PELa $nome
            if(!empty($nome))
                $resultSet = $this->getTable()->exibirNome($nome,$adapter);

            //VERIFICA SE O CAMPO $dataReteste ESTA PREENCHIDO CASO SIM EFETUA A PESQUISA PELa dataReteste
            if(!empty($usuario))
                $resultSet = $this->getTable()->exibirUsuario($usuario,$adapter);


                $this->response->setContent(json_encode($resultSet));
                return $this->response;

        }


        return new ViewModel([
            'resultSet' => $resultSet,
        ]);
    }


}

