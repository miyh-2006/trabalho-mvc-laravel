<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Tarefas</title>

   <style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        padding: 40px 20px;
        font-family: Arial, sans-serif;
        background: #f1f5f9;
        color: #1e293b;
    }

    .container {
        max-width: 650px;
        margin: auto;
        padding: 30px;
        background: white;
        border-radius: 16px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    }

    h1 {
        margin-top: 0;
        text-align: center;
        color: #4338ca;
    }

    .descricao {
        text-align: center;
        color: #64748b;
    }

    .form-cadastro {
        display: flex;
        gap: 10px;
        margin: 25px 0;
    }

    input {
        flex: 1;
        min-width: 0;
        padding: 12px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
    }

    button {
        padding: 10px 14px;
        border: none;
        border-radius: 8px;
        background: #4f46e5;
        color: white;
        cursor: pointer;
        white-space: nowrap;
    }

    .tarefa {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        padding: 15px 0;
        border-bottom: 1px solid #e2e8f0;
    }

    .botoes-tarefa {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 8px;
        flex-shrink: 0;
    }

    .botoes-tarefa form {
        display: flex;
        margin: 0;
    }

    .concluida {
        color: #16a34a;
        text-decoration: line-through;
    }

    .mensagem {
        padding: 12px;
        border-radius: 8px;
        background: #dcfce7;
        color: #166534;
    }

    .erro {
        color: #dc2626;
        font-size: 14px;
    }

    .vazio {
        text-align: center;
        color: #64748b;
    }

    @media (max-width: 480px) {
        .form-cadastro {
            flex-direction: column;
        }

        .tarefa {
            flex-direction: row;
            align-items: center;
            gap: 8px;
        }

        .botoes-tarefa {
            gap: 5px;
        }

        .botoes-tarefa button {
            padding: 8px;
            font-size: 12px;
        }
    }
</style>
            
</head>

<body>
    <main class="container">
        <h1>Gerenciador de Tarefas</h1>

        <p class="descricao">
            Organize suas atividades de maneira simples.
        </p>

        @if (session('sucesso'))
            <p class="mensagem">{{ session('sucesso') }}</p>
        @endif

        @if ($errors->any())
            <p class="erro">{{ $errors->first() }}</p>
        @endif

        <form class="form-cadastro"
            action="/tarefas"
            method="POST">

            @csrf

            <input
                type="text"
                name="titulo"
                placeholder="Digite uma nova tarefa..."
                value="{{ old('titulo') }}"
                required
                maxlength="255"
            >

            <button type="submit">Cadastrar</button>
        </form>

        <h2>Minhas tarefas</h2>

   @forelse ($tarefas as $tarefa)
    <div class="tarefa">
        <span class="{{ $tarefa->concluida ? 'concluida' : '' }}">
            {{ $tarefa->titulo }}
        </span>

        <div class="botoes-tarefa">
            @if (!$tarefa->concluida)
                <form action="{{ route('tarefas.concluir', $tarefa) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit">Concluir</button>
                </form>
            @else
                <strong>Concluída ✓</strong>
            @endif

            <form
                action="{{ route('tarefas.destroy', $tarefa) }}"
                method="POST"
                onsubmit="return confirm('Tem certeza que deseja excluir esta tarefa?')">
                @csrf
                @method('DELETE')
                <button type="submit">Excluir</button>
            </form>
        </div>
    </div>
@empty
    <p class="vazio">
        Nenhuma tarefa cadastrada. Adicione a primeira!
    </p>
@endforelse

    </main>
</body>
</html>