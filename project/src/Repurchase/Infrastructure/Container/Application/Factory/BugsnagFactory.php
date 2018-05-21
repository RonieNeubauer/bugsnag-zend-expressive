<?php

namespace Repurchase\Infrastructure\Container\Application\Factory;
use Repurchase\Application\Listener\BugsnagListener;
use Psr\Container\ContainerInterface;
use Zend\Stratigility\Middleware\ErrorHandler;

class BugsnagFactory
{
    /**
     * @param ContainerInterface $container
     * @param $serviceName
     * @param callable $callback
     * @return ErrorHandler
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container, $serviceName, callable $callback): ErrorHandler
    {
        /** @var ErrorHandler $errorHandler */
        $errorHandler = $callback();
        $bugsnag = $container->get('bugsnag');
        $listener = new BugsnagListener($bugsnag);
        $errorHandler->attachListener($listener);
        return $errorHandler;
    }
}
