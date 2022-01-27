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
            'faysFourLinks' => Site\BlockLayout\FourLinks::class,
            'faysCol' => Site\BlockLayout\Col::class,
            'faysRow' => Site\BlockLayout\Row::class,
            'faysEnd' => Site\BlockLayout\End::class,
            'faysLink' => Site\BlockLayout\Link::class,
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
