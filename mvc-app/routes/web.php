<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TarefaController;

Route::get('/', [TarefaController::class, 'index'])
    ->name('tarefas.index');

Route::post('/tarefas', [TarefaController::class, 'store'])
    ->name('tarefas.store');

Route::patch('/tarefas/{tarefa}/concluir', [TarefaController::class, 'concluir'])
    ->name('tarefas.concluir');

Route::delete('/tarefas/{tarefa}', [TarefaController::class, 'destroy'])
    ->name('tarefas.destroy');