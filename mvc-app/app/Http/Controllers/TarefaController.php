<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use Illuminate\Http\Request;

class TarefaController extends Controller
{
    public function index()
    {
        $tarefas = Tarefa::latest()->get();

        return view('tarefas.index', compact('tarefas'));
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'titulo' => 'required|string|max:255',
        ]);

        Tarefa::create([
            'titulo' => $dados['titulo'],
            'concluida' => false,
        ]);

        return redirect()->to(url('/'));
    }

    public function concluir(Tarefa $tarefa)
    {
        $tarefa->update([
            'concluida' => true,
        ]);

        return redirect()->route('tarefas.index')
            ->with('sucesso', 'Tarefa concluída com sucesso!');
    }

    public function destroy(Tarefa $tarefa)
{
    $tarefa->delete();

    return redirect()->route('tarefas.index')
        ->with('sucesso', 'Tarefa excluída com sucesso!');
}

}