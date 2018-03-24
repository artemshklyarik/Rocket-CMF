<?php

return [
    'frontend' => [
        'index'     => 'Core\Rocket\Pages\Controller\HomePageController',
        'page/{id}' => 'Core\Rocket\Pages\Controller\PageController'
    ],
    'admin'    => []
];
