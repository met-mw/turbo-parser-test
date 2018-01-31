<?php
return [
    'controllers' => [
        'factories' => [
            'Text\\V1\\Rpc\\Processor\\Controller' => \Text\V1\Rpc\Processor\ProcessorControllerFactory::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            \Text\Service\TextService::class => \Text\Factory\Service\TextServiceFactory::class
        ],
    ],
    'router' => [
        'routes' => [
            'text.rpc.processor' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/api/v1/text-processor',
                    'defaults' => [
                        'controller' => 'Text\\V1\\Rpc\\Processor\\Controller',
                        'action' => 'processor',
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'text.rpc.processor',
        ],
    ],
    'zf-rpc' => [
        'Text\\V1\\Rpc\\Processor\\Controller' => [
            'service_name' => 'Processor',
            'http_methods' => [
                0 => 'POST',
            ],
            'route_name' => 'text.rpc.processor',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'Text\\V1\\Rpc\\Processor\\Controller' => 'Json',
        ],
        'accept_whitelist' => [
            'Text\\V1\\Rpc\\Processor\\Controller' => [
                0 => 'application/vnd.text.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
        ],
        'content_type_whitelist' => [
            'Text\\V1\\Rpc\\Processor\\Controller' => [
                0 => 'application/vnd.text.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
];
