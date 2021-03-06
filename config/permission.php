<?php

return [
    'roles' => [
        'super_admin' => [
            'guest' => [
                'setorial_reader',
                'auth_reader',
                'tesouro_reader'
            ],
            'auth_admin' => [
                'auth_reader'
            ],
            'setorial_admin' => [
                'setorial_reader'
            ], 
            'tesouro_admin' => [
                'tesouro_reader'
            ], 
        ]
    ],

    'permissions' => [
        'auth_admin' => [
            App\Models\User::class                  => ['Create', 'Update', 'Delete'],  
        ],
        'auth_reader' => [
            App\Models\User::class                  => ['Read'],  
        ],
        'setorial_admin' => [
            App\Models\Setor::class                 => ['Create', 'Update', 'Delete'],  
            App\Models\Subsetor::class              => ['Create', 'Update', 'Delete'],  
            App\Models\Segmento::class              => ['Create', 'Update', 'Delete'],  
            App\Models\Empresa::class               => ['Create', 'Update', 'Delete'],  
            App\Models\Indice::class                => ['Create', 'Update', 'Delete'], 
            App\Models\Ativo::class                 => ['Create', 'Update', 'Delete'],
        ],
        'setorial_reader' => [
            App\Models\Setor::class                 => ['Read'],  
            App\Models\Subsetor::class              => ['Read'],  
            App\Models\Segmento::class              => ['Read'],  
            App\Models\Empresa::class               => ['Read'],  
            App\Models\Indice::class                => ['Read'],
            App\Models\Ativo::class                 => ['Read']
        ],
        'tesouro_admin' => [
            App\Models\TesouroCategoria::class      => ['Create', 'Update', 'Delete'], 
            App\Models\TesouroTipo::class           => ['Create', 'Update', 'Delete'], 
            App\Models\TesouroTitulo::class         => ['Create', 'Update', 'Delete'], 
            App\Models\TesouroCotacao::class        => ['Create', 'Update', 'Delete']
        ],
        'tesouro_reader' => [
            App\Models\TesouroCategoria::class      => ['Read'], 
            App\Models\TesouroTipo::class           => ['Read'], 
            App\Models\TesouroTitulo::class         => ['Read'], 
            App\Models\TesouroCotacao::class        => ['Read']
        ], 
    ],

    'models' => [

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * Eloquent model should be used to retrieve your permissions. Of course, it
         * is often just the "Permission" model but you may use whatever you like.
         *
         * The model you want to use as a Permission model needs to implement the
         * `Spatie\Permission\Contracts\Permission` contract.
         */

        'permission' => Spatie\Permission\Models\Permission::class,

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * Eloquent model should be used to retrieve your roles. Of course, it
         * is often just the "Role" model but you may use whatever you like.
         *
         * The model you want to use as a Role model needs to implement the
         * `Spatie\Permission\Contracts\Role` contract.
         */

        'role' => Spatie\Permission\Models\Role::class,

    ],

    'table_names' => [

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your roles. We have chosen a basic
         * default value but you may easily change it to any table you like.
         */

        'roles' => 'public.acl_roles',

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your permissions. We have chosen a basic
         * default value but you may easily change it to any table you like.
         */

        'permissions' => 'public.acl_permissions',

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your models permissions. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'model_has_permissions' => 'public.acl_model_has_permissions',

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your models roles. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'model_has_roles' => 'public.acl_model_has_roles',

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your roles permissions. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'role_has_permissions' => 'public.acl_role_has_permissions',
    ],

    'column_names' => [

        /*
         * Change this if you want to name the related model primary key other than
         * `model_id`.
         *
         * For example, this would be nice if your primary keys are all UUIDs. In
         * that case, name this `model_uuid`.
         */
        'model_morph_key' => 'model_id',
    ],

    /*
     * By default all permissions will be cached for 24 hours unless a permission or
     * role is updated. Then the cache will be flushed immediately.
     */

    'cache_expiration_time' => 60 * 24,

    /*
     * When set to true, the required permission/role names are added to the exception
     * message. This could be considered an information leak in some contexts, so
     * the default setting is false here for optimum safety.
     */

    'display_permission_in_exception' => false,
];
