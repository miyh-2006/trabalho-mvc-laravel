<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    protected $fillable = [
        'titulo',
        'concluida',
    ];

    protected function casts(): array
    {
        return [
            'concluida' => 'boolean',
        ];
    }
}