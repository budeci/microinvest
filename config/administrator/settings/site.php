<?php

return [
    'title' => 'Site',

    'model' => 'Keyhunter\Administrator\Model\Settings',

    'rules' => [
        'admin::email'   => 'required|email',
        'support::email' => 'required|email'
    ],

    'edit_fields' => [
        'admin::email' => ['type' => 'email'],
        'support::email' => ['type' => 'email'],
        'support::mobile' => ['type' => 'text'],
        'support::home' => ['type' => 'text'],
        'support::program' => ['type' => 'text'],
        'support::adress' => ['type' => 'text'],
        'support::contacts' => ['type' => 'text'],
        'support::banc' => ['type' => 'textarea'],
        'support::facebook' => ['type' => 'text'],
        'support::linkedin' => ['type' => 'text'],
        'support::viber' => ['type' => 'text'],


        'site::down' => [
            'type' => 'select',
            'options' => [
                1 => 'enable',
                0 => 'disable'
            ]
        ]
    ]
];