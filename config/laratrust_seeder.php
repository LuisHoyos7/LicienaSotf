<?php

return [
    'role_structure' => [

        'estudiante' => [
            'estudiantes' => 'c,r,u,d',
            
        ],
        'administrador' => [
            'users' => 'c,r,u', 
            'estudiantes' => 'c,r,u,d', 
            
        ],
        'docente' => [
            'estudiantes' => 'c,r,u,d', 
            
        ],
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
