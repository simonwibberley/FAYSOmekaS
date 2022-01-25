<?php
namespace FaysModule;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

return [
    // need this boilerplate to render partials
    'view_manager' => [
        'template_path_stack' => [
            dirname(__DIR__) . '/view',
        ]
    ],
    'block_layouts' => [
        'factories' => [
            'faysHomeLayout' => Service\BlockLayout\HomeLayoutFactory::class,
            'faysTwoColLayout' => Service\BlockLayout\TwoColLayoutFactory::class
        ],
        'invokables' => [
//            'faysHomeLayout' => Site\BlockLayout\HomeLayout::class
        ]
    ],
    'view_helpers' => [
        'factories' => [
        ],
        'invokables' => [
        ]
    ]
];

?>
