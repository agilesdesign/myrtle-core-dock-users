<?php
return [
    \Myrtle\Core\Docks\UsersDock::class => [
        'access-admin' => 'Access Administrative Routes',
        'admin' => 'Administrator',
        'create' => 'Create',
        'delete' => 'Delete',
        'edit' => 'Edit',
        'view' => 'View',
        'activate' => 'Activate',
        'deactivate' => 'Deactivate',
        \Myrtle\Core\Users\Models\User::class => [
            \Myrtle\Core\Addresses\Models\Address::class => [
                'create' => 'Create Addresses',
                'edit' => 'Edit Addresses',
                'delete' => 'Delete Addresses',
                'view' => 'View Addresses',
                'own-create' => 'Create Own Addresses',
                'own-edit' => 'Edit Own Addresses',
                'own-delete' => 'Delete Own Addresses',
            ],
            \Persons\Models\PersonBiograph::class => [
                'edit' => 'Edit Biograph',
                'view' => 'View Biograph',
                'own-edit' => 'Edit Own Biograph',
            ],
            \Myrtle\Core\Users\Models\UserEmail::class => [
                'create' => 'Create Emails',
                'edit' => 'Edit Emails',
                'delete' => 'Delete Emails',
                'view' => 'View Emails',
                'own-create' => 'Create Own Emails',
                'own-edit' => 'Edit Own Emails',
                'own-delete' => 'Delete Own Emails',
            ],
            \Myrtle\Core\Phones\Models\Phone::class => [
                'create' => 'Create Phones',
                'edit' => 'Edit Phones',
                'delete' => 'Delete Phones',
                'view' => 'View Phones',
                'own-create' => 'Create Own Phones',
                'own-edit' => 'Edit Own Phones',
                'own-delete' => 'Delete Own Phones',
            ],
        ]
    ],
    \Myrtle\Core\Users\Models\User::class => [
        'delete' => 'Delete',
        'edit' => 'Edit',
        'view' => 'View',
        \Myrtle\Core\Addresses\Models\Address::class => [
            'create' => 'Create Addresses',
            'edit' => 'Edit Addresses',
            'delete' => 'Delete Addresses',
            'view' => 'View Addresses',
        ],
        \Persons\Models\PersonBiograph::class => [
            'edit' => 'Edit Biograph',
            'view' => 'View Biograph',
        ],
        \Myrtle\Core\Users\Models\UserEmail::class => [
            'create' => 'Create Emails',
            'edit' => 'Edit Emails',
            'delete' => 'Delete Emails',
            'view' => 'View Emails',
        ],
        \Myrtle\Core\Phones\Models\Phone::class => [
            'create' => 'Create Phones',
            'edit' => 'Edit Phones',
            'view' => 'View Phones',
        ],
    ],
];