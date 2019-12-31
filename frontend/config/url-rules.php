<?php

return [
    [
        'pattern' => '',
        'route'   => 'main/index',
    ],
    [
        'pattern' => '/receipts/view/<id:\d+>',
        'route'   => 'receipts/view',
    ],
    [
        'pattern' => '/receipts',
        'route'   => 'receipts/index',
    ],
];
