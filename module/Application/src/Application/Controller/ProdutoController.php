<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;



class ProdutoController extends AbstractActionController
{
    public $table;

    public function getTable(){
        if(!$this->table){
            $sm = $this->getServiceLocator();
            $this->table = $sm->get('ProdutoTable');
        }

        return $this->table;
    }

    public function cadastrarAction()
    {
        /* ======== TEMM QUE ARRUMAR   NÃO PODE FICAR DADOS  */
        $dados =[];
        $req = $this->getRequest();
        if ($req->isPost()){
            $dados = $req->getPost();
            $model  = new \Application\Model\Produto();
            $model->exchangeArray($dados);

            $table = $this->getTable();
            $table->cadastrar($model);
        }


        return new ViewModel([
            'dados' => $dados,
        ]);

    }

    public function pesquisarAction()
    {

        $resultSet = [];
        $req = $this->getRequest();
        if ($req->isPost()){
            $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
            $codigo = $this->params()->fromPost('codigo');
            $capacidadeExtintora = $this->params()->fromPost('capacidadeExtintora');
            $dataReteste = $this->params()->fromPost('dataReteste');

            //VERIFICA SE O CAMPO CODIGO ESTA PREENCHIDO CASO SIM EFETUA  A PESQUISA PELO CODIGO
            if(!empty($codigo)) {
                $resultSet = $this->getTable()->exibirCodigo($codigo, $adapter);
            }

            //VERIFICA SE O CAMPO capacidadeExtintora ESTA PREENCHIDO CASO SIM EFETUA  A PESQUISA PELa capacidadeExtintora
            if(!empty($capacidadeExtintora))
                $resultSet = $this->getTable()->exibirCapacidadeExtintora($capacidadeExtintora,$adapter);

            //VERIFICA SE O CAMPO $dataReteste ESTA PREENCHIDO CASO SIM EFETUA A PESQUISA PELa dataReteste
            if(!empty($dataReteste))
                $resultSet = $this->getTable()->exibirCapacidadeExtintora($capacidadeExtintora,$adapter);

            $this->response->setContent(json_encode($resultSet));
            return $this->response;

        }


        return new ViewModel([
            'resultSet' => $resultSet,
        ]);
    }

    public function visualizarAction()
    {
        $codigo = $this->params()->fromPost('codigo');
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $table = $this->getTable();
        $resultSet = $table->visualizar($codigo);
        $this->response->setContent(json_encode($resultSet));
        return $this->response;

    }

}
