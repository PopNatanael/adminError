<?php

namespace Frontend\Classs;

use Fig\Http\Message\RequestMethodInterface;
use Frontend\Classs\Controller\ClassController;
use Mezzio\Application;
use Psr\Container\ContainerInterface;

/**
 * Class RoutesDelegator
 * @package Frontend\Classs
 */
class RoutesDelegator
{
    /**
     * @param ContainerInterface $container
     * @param $serviceName
     * @param callable $callback
     * @return Application
     */
    public function __invoke(ContainerInterface $container, $serviceName, callable $callback)
    {

        /** @var Application $app */
        $app = $callback();

        $app->route(
            '/class/[{action}]',
            ClassController::class,
            [RequestMethodInterface::METHOD_GET, RequestMethodInterface::METHOD_POST],
            'class'
        );

        return $app;
    }
}
