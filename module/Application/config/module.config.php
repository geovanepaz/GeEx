<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            'produto-cadastrar' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/produto/cadastrar[/]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Produto',
                        'action'     => 'cadastrar',
                    ),
                ),
            ),

            'produto-pesquisar' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/produto/pesquisar[/]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Produto',
                        'action'     => 'pesquisar',
                    ),
                ),
            ),
            'produto-visualizar' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/produto/visualizar[/]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Produto',
                        'action'     => 'visualizar',
                    ),
                ),
            ),

            'cliente-cadastrar' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/cliente/cadastrar[/]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Cliente',
                        'action'     => 'cadastrar',
                    ),
                ),
            ),

            'cliente-pesquisar' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/cliente/pesquisar[/]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\cliente',
                        'action'     => 'pesquisar',
                    ),
                ),
            ),

            //somente para teste
            'cliente-visualizar' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/cliente/visualizar',
                    'defaults' => array(
                        'controller' => 'Application\Controller\cliente',
                        'action'     => 'visualizar',
                    ),
                ),
            ),

            'usuario-cadastrar' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/usuario/cadastrar[/]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Usuario',
                        'action'     => 'cadastrar',
                    ),
                ),
            ),
            'usuario-pesquisar' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/usuario/pesquisar[/]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\usuario',
                        'action'     => 'pesquisar',
                    ),
                ),
            ),

            'venda-vender' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/venda/vender[/]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\venda',
                        'action'     => 'vender',
                    ),
                ),
            ),

            'venda-pesquisar' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/venda/pesquisar[/]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\venda',
                        'action'     => 'pesquisar',
                    ),
                ),
            ),

            'item-inserir' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/item/inserir[/]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Item',
                        'action'     => 'inserir',
                    ),
                ),
            ),

            'validade-inserir' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/validade/inserir[/]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Validade',
                        'action'     => 'inserir',
                    ),
                ),
            ),

        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => Controller\IndexController::class,
            'Application\Controller\Produto' => Controller\ProdutoController::class,
            'Application\Controller\Cliente' => Controller\ClienteController::class,
            'Application\Controller\Usuario' => Controller\UsuarioController::class,
            'Application\Controller\Venda' => Controller\VendaController::class,
            'Application\Controller\Item' => Controller\ItemController::class,
            'Application\Controller\Validade' => Controller\ValidadeController::class,

        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
