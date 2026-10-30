<?php
//Ele recebe as solicitações do sistema e 
//coordena o que deve acontecer com as tarefas.
namespace App\Http\Controllers;

use App\Models\Tarefa;
use Illuminate\Http\Request;

class TarefaController extends Controller
{
//listar tarefas
    public function index()
    {
        $tarefas = Tarefa::latest()->get();

        return view('tarefas.index', compact('tarefas'));
    }
//cadastrar tarefa
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
//concluir tarefa
    public function concluir(Tarefa $tarefa)
    {
        $tarefa->update([
            'concluida' => true,
        ]);

        return redirect()->route('tarefas.index')
            ->with('sucesso', 'Tarefa concluída com sucesso!');
    }
//deletar tarefa
    public function destroy(Tarefa $tarefa)
{
    $tarefa->delete();

    return redirect()->route('tarefas.index')
        ->with('sucesso', 'Tarefa excluída com sucesso!');
}
//faz comunicação entre solicitações do usuário, Model e View.
}