<?php

return [
    'frontend' => [
        'test'        => 'Rocket\Pages\Controller\TestController',
        'page/(:num)' => 'Rocket\Pages\Controller\PageController'
    ],
    'admin'    => []
];
