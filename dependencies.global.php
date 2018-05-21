<?php

use Psr\Container\ContainerInterface;

return [
    'dependencies' => [
        'delegators' => [
            \Zend\Stratigility\Middleware\ErrorHandler::class => [
                \Repurchase\Infrastructure\Container\Application\Factory\BugsnagFactory::class,
            ],
        ]
    ],
];
