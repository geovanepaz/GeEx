<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\ResultSet;

use Application\Model\Produto;
use Application\Model\ProdutoTable;
use Application\Model\Cliente;
use Application\Model\ClienteTable;
use Application\Model\Usuario;
use Application\Model\UsuarioTable;
use Application\Model\Venda;
use Application\Model\VendaTable;
use Application\Model\Item;
use Application\Model\ItemTable;
use Application\Model\Validade;
use Application\Model\ValidadeTable;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'ProdutoTable' => function($sm) {
                    $tableGateway = $sm->get('ProdutoTableGateway');
                    $table = new ProdutoTable($tableGateway);
                    return $table;
                },
                'ProdutoTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Produto());
                    return new TableGateway('produto', $dbAdapter, null,
                        $resultSetPrototype);
                },
                'ClienteTable' => function($sm) {
                    $tableGateway = $sm->get('ClienteTableGateway');
                    $table = new ClienteTable($tableGateway);
                    return $table;
                },
                'ClienteTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Cliente());
                    return new TableGateway('cliente', $dbAdapter, null,
                        $resultSetPrototype);
                },

                'UsuarioTable' => function($sm) {
                    $tableGateway = $sm->get('UsuarioTableGateway');
                    $table = new UsuarioTable($tableGateway);
                    return $table;
                },
                'UsuarioTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Usuario());
                    return new TableGateway('usuario', $dbAdapter, null,
                        $resultSetPrototype);
                },
                'VendaTable' => function($sm) {
                    $tableGateway = $sm->get('VendaTableGateway');
                    $table = new VendaTable($tableGateway);
                    return $table;
                },
                'VendaTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Venda());
                    return new TableGateway('venda', $dbAdapter, null,
                        $resultSetPrototype);
                },

                'ItemTable' => function($sm) {
                    $tableGateway = $sm->get('ItemTableGateway');
                    $table = new ItemTable($tableGateway);
                    return $table;
                },

                'ItemTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Item());
                    return new TableGateway('item', $dbAdapter, null,
                        $resultSetPrototype);
                },

                'ValidadeTable' => function($sm) {
                    $tableGateway = $sm->get('ValidadeTableGateway');
                    $table = new ValidadeTable($tableGateway);
                    return $table;
                },

                'ValidadeTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Validade());
                    return new TableGateway('validade', $dbAdapter, null,
                        $resultSetPrototype);
                },
            )
        );
    }

}
