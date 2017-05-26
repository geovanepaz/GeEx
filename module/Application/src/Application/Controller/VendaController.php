<?php
/**
 * Created by PhpStorm.
 * User: Geovane Paz
 * Date: 22/02/2017
 * Time: 10:22
 */

namespace Application\Controller;

use Application\Model\Item;
use Application\Model\Venda;
use Application\Validar\ValidaItem;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class VendaController extends AbstractActionController
{
    public $table;


    public function getTable()
    {
        if (!$this->table) {
            $sm = $this->getServiceLocator();
            $this->table = $sm->get('VendaTable');
        }

        return $this->table;

    }

    public function venderAction()
    {
        $req = $this->getRequest();
        if ($req->isPost()) {

            $form = $req->getPost();

            $validaItem = new ValidaItem();
            $item  = new Item();
            $venda = new Venda();
            $itemTable = $this->getServiceLocator()->get('ItemTable');
            $produtoTable = $this->getServiceLocator()->get('ProdutoTable');
            $clienteTable = $this->getServiceLocator()->get('ClienteTable');

            $venda->exchangeArray($form);

           $isCliente =  $clienteTable->visualizarId($venda->id_cliente);

            if( ! $isCliente){

                $this->response->setContent(
                    json_encode([
                        'error' => 'Cliente não encontrado,'
                                       . ' verifique se ele esta cadastrado ou foi preenchido corretamente'
                    ])
                );

                return $this->response;
            }


            $table = $this->getTable();
            $id_venda = $table->vender($venda);

            foreach ($form->produto as $prod) {
                $codigo = $prod['id_produto'];

                if ( ! $produtoTable->visualizar($codigo)) {

                    $this->response->setContent(
                        json_encode(['error' => 'O produto de codigo: '. $codigo.' não existe '])
                    );

                    return $this->response;
                }

                if ( ! $validaItem->isValid($prod)) {
                    $this->response->setContent(json_encode($validaItem->getMessages()));
                    return $this->response;
                }
            }

            foreach ($form->produto as $prod) {
                $item->id_venda= $id_venda;
                $item->exchangeArray($prod);
                $itemTable->insert($item);
            }

            return $this->response;
        }

    }

    public function pesquisarAction()
    {
        $resultSet = [];
        $req = $this->getRequest();
        if ($req->isPost()) {
            $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
            $documento = $this->params()->fromPost('documento');
            $nome = $this->params()->fromPost('nome');
            $validadeSelo = $this->params()->fromPost('validadeSelo');
            $cidade = $this->params()->fromPost('cidade');

            //aletrando as dadas para o primeiro dia do mes e o ultimo
            $inicio = $validadeSelo . '/01';
            $fim = $validadeSelo . '/31';



            if (!empty($documento))
                $resultSet = $this->getTable()->exibirDocumento($documento, $adapter);

            if (!empty($nome))
                $resultSet = $this->getTable()->exibirNome($nome,$adapter);

            if (!empty($validadeSelo))
                $resultSet = $this->getTable()->exibirValidadeSelo($inicio,$fim, $adapter);

            if (!empty($cidade))
                $resultSet = $this->getTable()->exibirCidade($cidade,$adapter);

            $this->response->setContent(json_encode($resultSet));
            return $this->response;
        }

        return new ViewModel([
            'resultSet' => $resultSet,
        ]);
    }
}

