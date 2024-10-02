<?php

/**
 * Common responses
 * 
 * This file returns a list of common responses that can be used in the application
 * 
 * @package config
 */

return [

    'success' => [
        'delete' => [
            'status' => 200,
            'message' => 'Se ha eliminado correctamente',
            'title' => 'Eliminado'
        ],
        'create' => [
            'status' => 201,
            'message' => 'Se ha creado correctamente',
            'title' => 'Creado'
        ],
        'update' => [
            'status' => 200,
            'message' => 'Se ha actualizado correctamente',
            'title' => 'Actualizado'
        ],
    ],

    'error' => [
        'delete' => [
            'status' => 500,
            'message' => 'No se pudo eliminar el recurso',
            'title' => 'Error'
        ],
        'create' => [
            'status' => 500,
            'message' => 'No fue posible crear el recurso',
            'title' => 'Error'
        ],
        'update' => [
            'status' => 500,
            'message' => 'El recurso se ha actualizado correctamente',
            'title' => 'Error'
        ],
    ],

];