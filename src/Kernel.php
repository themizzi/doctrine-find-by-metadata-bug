<?php declare(strict_types=1);

namespace App;

use App\Command\CreateEntityACommand;
use App\Command\CreateEntityBCommand;
use App\Command\FindEntityBByNewEntityCCommand;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;

/**
 * Class Kernel
 * @author  Joe Mizzi <themizzi@me.com>
 */
class Kernel extends \Symfony\Component\HttpKernel\Kernel
{
    use MicroKernelTrait;

    /**
     * Returns an array of bundles to register.
     *
     * @return iterable|\Symfony\Component\HttpKernel\Bundle\BundleInterface An iterable of bundle instances
     */
    public function registerBundles()
    {
        return [
            new FrameworkBundle(),
            new DoctrineBundle()
        ];
    }

    /**
     * Add or import routes into your application.
     *
     *     $routes->import('config/routing.yml');
     *     $routes->add('/admin', 'App\Controller\AdminController::dashboard', 'admin_dashboard');
     *
     * @param \Symfony\Component\Routing\RouteCollectionBuilder $routes
     */
    protected function configureRoutes(\Symfony\Component\Routing\RouteCollectionBuilder $routes)
    {

    }

    /**
     * Configures the container.
     *
     * You can register extensions:
     *
     *     $c->loadFromExtension('framework', array(
     *         'secret' => '%secret%'
     *     ));
     *
     * Or services:
     *
     *     $c->register('halloween', 'FooBundle\HalloweenProvider');
     *
     * Or parameters:
     *
     *     $c->setParameter('halloween', 'lot of fun');
     *
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $c
     * @param \Symfony\Component\Config\Loader\LoaderInterface $loader
     */
    protected function configureContainer(
        \Symfony\Component\DependencyInjection\ContainerBuilder $c,
        \Symfony\Component\Config\Loader\LoaderInterface $loader
    ) {
        $c->setParameter('kernel.secret', 'S3CR3T');
        $c->loadFromExtension('doctrine', [
            'orm' => [
                'default_entity_manager' => 'default',
                'naming_strategy' => 'doctrine.orm.naming_strategy.underscore',
                'auto_mapping' => true,
                'auto_generate_proxy_classes' => $this->isDebug(),
                'mappings' => [
                    'default' => [
                        'type' => 'annotation',
                        'dir' => $this->getProjectDir().'/src/Entity',
                        'prefix' => 'App\Entity',
                    ],
                ],
            ],
            'dbal' => [
                'driver' => 'pdo_sqlite',
                'url' => 'sqlite:///var/database.sqlite'
            ],
        ]);
        $c->register(CreateEntityACommand::class, CreateEntityACommand::class)
            ->setAutoconfigured(true)
            ->setAutowired(true);
        $c->register(CreateEntityBCommand::class, CreateEntityBCommand::class)
            ->setAutowired(true)
            ->setAutoconfigured(true);
        $c->register(FindEntityBByNewEntityCCommand::class, FindEntityBByNewEntityCCommand::class)
            ->setAutoconfigured(true)
            ->setAutowired(true);
    }
}