<?php

return [
    '__name' => 'site-user-verification',
    '__version' => '0.0.1',
    '__git' => 'git@github.com:getmim/site-user-verification.git',
    '__license' => 'MIT',
    '__author' => [
        'name' => 'Iqbal Fauzi',
        'email' => 'iqbalfawz@gmail.com',
        'website' => 'https://iqbalfn.com/'
    ],
    '__files' => [
        'app/site-user-verification' => ['install','remove'],
        'modules/site-user-verification' => ['install','update','remove'],
        'theme/site/me/verification' => ['install','update']
    ],
    '__dependencies' => [
        'required' => [
            [
                'lib-user' => NULL
            ],
            [
                'lib-user-verification' => NULL
            ]
        ],
        'optional' => []
    ],
    'autoload' => [
        'classes' => [
            'SiteUserVerification\\Controller' => [
                'type' => 'file',
                'base' => 'app/site-user-verification/controller'
            ],
            'SiteUserVerification\\Library' => [
                'type' => 'file',
                'base' => 'modules/site-user-verification/library'
            ]
        ],
        'files' => []
    ],
    'routes' => [
        'site' => [
            'siteMeVerify' => [
                'path' => [
                    'value' => '/me/verify'
                ],
                'handler' => 'SiteUserVerification\\Controller\\Verification::verify',
                'method' => 'GET|POST'
            ]
        ]
    ]
];