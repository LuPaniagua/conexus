<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Perfil</title>
    {{-- Adicione seu CSS aqui --}}
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    * {
        font-family: 'Poppins', sans-serif;
        box-sizing: border-box;
        
    }

    body {
        background: linear-gradient(90deg, #40E0D0, #8f7af6);
        margin: 0;
        padding: 0;
    }
    .container {
        max-width: 800px;
        margin: 50px auto;
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        
    }
    .input-group {
        margin-bottom: 20px;
    }

    .input-group label {
        display: block;
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 8px;
    }

    .input-group input[type="text"],
    .input-group input[type="email"],
    .input-group input[type="password"] {
        width: 99%;
        padding: 12px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 1rem;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .input-group input:focus {
        outline: none;
        border-color: #6c57d4;
        box-shadow: 0 0 0 3px rgba(108, 87, 212, 0.2);
    }
    h1 {
        
         background: linear-gradient(135deg, rgba(20, 175, 160, 0.9), rgba(108, 87, 212, 0.9)), url('https://images.unsplash.com/photo-1516542959825-7c185260a12a?q=80&w=1974&auto=format&fit=crop') no-repeat center center;
        background-size: cover;
        padding: 100px 20px;
        text-align: center;
        color: #fff;
    }
</style>
<body>
    <div class="container">
        <h1>Editar Perfil de Usuário</h1>

        {{-- Bloco para exibir mensagem de sucesso --}}
        @if (session('success'))
            <div style="color: green;">{{ session('success') }}</div>
        @endif

        {{-- Bloco para exibir erros de validação --}}
        @if ($errors->any())
            <div style="color: red;">
                <strong>Opa! Algo deu errado.</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- O atributo enctype é ESSENCIAL para upload de arquivos --}}
        <form method="POST" action="{{ route('perfil.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="input-group">
                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="input-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="input-group">
                <label for="telefone">Telefone:</label>
                <input type="text" id="telefone" name="telefone" value="{{ old('telefone', $user->telefone) }}">
            </div>

            <div class="input-group">
                <label for="cidade">Cidade:</label>
                <input type="text" id="cidade" name="cidade" value="{{ old('cidade', $user->cidade) }}">
            </div>

            <hr>
            <p>Deixe os campos de senha em branco para não alterá-la.</p>
            
            <div class="input-group">
                <label for="password">Nova Senha:</label>
                <input type="password" id="password" name="password">
            </div>

            <div class="input-group">
                <label for="password_confirmation">Confirmar Nova Senha:</label>
                <input type="password" id="password_confirmation" name="password_confirmation">
            </div>

            <hr>

            <div>
                <label for="profile_image">Foto de Perfil:</label>
                <input type="file" id="profile_image" name="profile_image">
                @if ($user->profile_image)
                    <p>Imagem atual:</p>
                    <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Foto de Perfil" width="100">
                @endif
            </div>

            <br>
            <button type="submit">Salvar Alterações</button>
        </form>
    </div>
</body>
</html>