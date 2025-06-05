<?php

return [
    'required' => 'El campo :attribute es obligatorio.',
    'email' => 'El :attribute debe ser un correo válido.',
    'unique' => 'El :attribute ya ha sido registrado.',
    'min' => [
        'string' => 'La :attribute debe tener al menos :min caracteres.',
    ],
    'max' => [
        'string' => 'La :attribute no debe tener más de :max caracteres.',
    ],
    'confirmed' => 'La confirmación de :attribute no coincide.',
    // Puedes agregar más validaciones si lo necesitas

    'attributes' => [
        'name' => 'nombre',
        'email' => 'correo electrónico',
        'password' => 'contraseña',
        'telefono' => 'teléfono',
    ],
];
