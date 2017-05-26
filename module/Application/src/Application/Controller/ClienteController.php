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
use Application\Validar\CpfCnpjValidator;
use Application\Validar\ValidaCliente;

class ClienteController extends AbstractActionController
{
    public $table;

    public function getTable()
    {
        if (!$this->table) {
            $sm = $this->getServiceLocator();
            $this->table = $sm->get('ClienteTable');
        }

        return $this->table;

    }

    public function cadastrarAction()
    {
        $req = $this->getRequest();
        if ($req->isPost()) {

            $table = $this->getTable();
            $form = $req->getPost();


            $validaCliente = new ValidaCliente();
            $validaCpfCnpj = new CpfCnpjValidator();
            $model  = new \Application\Model\Cliente();

            $model->exchangeArray($form);

            $formValid = $validaCliente->isValid($model);
            $cliExi = $table->visualizar($model->documento);
            $documento = $validaCpfCnpj->isValid($model->documento);

            if(! $formValid)
                return $this->response->setContent(json_encode($validaCliente->getMessages()));

            if( ! $documento)
                return $this->response->setContent(json_encode($validaCpfCnpj->getMessages()));

            if($cliExi)
                return $this->response->setContent(json_encode(['error' => 'cliente ja cadastrado']));





            $table->cadastrar($model);
            return $this->response;

        }

    }

    public function pesquisarAction()
    {

        $resultSet = [];
        $req = $this->getRequest();
        if ($req->isPost())
        {
            $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
            $documento = $this->params()->fromPost('documento');
            $nome = $this->params()->fromPost('nome');
            $razaoSocial = $this->params()->fromPost('razaoSocial');
            $cidade = $this->params()->fromPost('cidade');


            //VERIFICA SE O CAMPO $documento ESTA PREENCHIDO CASO SIM EFETUA  A PESQUISA PELO $documento
            if(!empty($documento))
                $resultSet = $this->getTable()->exibirDocumento($documento, $adapter);


            //VERIFICA SE O $nome capacidadeExtintora ESTA PREENCHIDO CASO SIM EFETUA  A PESQUISA PELa $nome
            if(!empty($nome))
                $resultSet = $this->getTable()->exibirNome($nome,$adapter);

            //VERIFICA SE O CAMPO $dataReteste ESTA PREENCHIDO CASO SIM EFETUA A PESQUISA PELa dataReteste
            if(!empty($razaoSocial))
                $resultSet = $this->getTable()->exibirRazaoSocial($razaoSocial,$adapter);

            //VERIFICA SE O CAMPO $cidade ESTA PREENCHIDO CASO SIM EFETUA A PESQUISA PELa $cidade
            if(!empty($cidade))
                $resultSet = $this->getTable()->exibirCidade($cidade,$adapter);

            $this->response->setContent(json_encode($resultSet));
            return $this->response;

        }




                return new ViewModel([
                    'resultSet' => $resultSet,
                ]);

    }


    public function visualizarAction()
    {

        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $documento = $this->params()->fromPost('documento');
        $table = $this->getTable();
        $resultSet = $table->visualizar($documento, $adapter);
        $this->response->setContent(json_encode($resultSet));
        return $this->response;

    }

}

