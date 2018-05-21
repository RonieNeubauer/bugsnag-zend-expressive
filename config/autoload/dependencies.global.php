<?php

return [
    'dependencies' => [
        'delegators' => [
            \Zend\Stratigility\Middleware\ErrorHandler::class => [
                \Repurchase\Infrastructure\Container\Application\Factory\BugsnagFactory::class,
            ],
        ]
    ],
];
