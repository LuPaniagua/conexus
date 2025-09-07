<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultas</title>
    <link rel="stylesheet" href="{{ asset('css/salas-criadas.css') }}">
</head>
<body>
    <a class="back-button" href="{{ route('perfil.show')}}" >&#8592;</a>
    <div class="container">
        <h1>Consultas Criadas</h1>
 
<<<<<<< HEAD
        <div class="card">
            <div class="info">
                <p><strong>Tema:</strong> Autismo</p>
                <p><strong>Doutor:</strong> Luan</p>
                <p><strong>Data e horário:</strong> 25/08/2025 às 17:00</p>
                <p><strong>Descrição:</strong> Iremos conversar sobre autismo</p>
            </div>
            <div class="actions">
                <a class="editar" href="{{ route('salas.create') }}">✏️ Editar</a>
                <button class="entrar">🚪 Entrar</button>
            </div>
        </div>
 
        <div class="card">
            <div class="info">
                <p><strong>Tema:</strong> Autismo</p>
                <p><strong>Doutor:</strong> Luan</p>
                <p><strong>Data e horário:</strong> 25/08/2025 às 17:00</p>
                <p><strong>Descrição:</strong> Iremos conversar sobre autismo</p>
            </div>
            <div class="actions">
                <a class="editar" href="{{ route('salas.create') }}">✏️ Editar</a>
                <div class="mensagem">
                    Você poderá entrar a partir de 5 minutos antes da conversa começar 😊
                </div>
            </div>
        </div>
=======
        @foreach($salas as $sala)
<div class="card">
    <div class="info">
        <p><strong>Tema:</strong> {{ $sala->tema }}</p>
        <p><strong>Doutor:</strong> {{ $sala->nome_medico }}</p>
        <p><strong>Data e horário:</strong> {{ \Carbon\Carbon::parse($sala->data)->format('d/m/Y') }} às {{ \Carbon\Carbon::parse($sala->hora)->format('H:i') }}</p>
        <p><strong>Descrição:</strong> {{ $sala->descricao }}</p>
    </div>
    <div class="actions">
        <a class="editar" href="{{ route('salas.edit', $sala->id) }}">✏️ Editar</a>
        <button class="entrar">🚪 Entrar</button>
    </div>
</div>
@endforeach
>>>>>>> 025c1fb (07/09/2025)
    </div>
</body>
</html>