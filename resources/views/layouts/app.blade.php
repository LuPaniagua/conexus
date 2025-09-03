<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Minha Aplicação</title>
     <style>
        /* Reset Universal para remover margens e garantir o layout correto */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            margin: 0 !important;
            padding: 0 !important;
            display: flex;
            flex-direction: column;
            height: 100vh; /* Garantir que o body ocupe 100% da altura da tela */
        }

        main {
            flex: 1; /* Faz com que o conteúdo principal ocupe todo o espaço disponível */
        }

        /* Ajustes de estilo adicionais */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background: #f0f0f0;
        }

        /* Outras regras de estilo que você já tem */

    </style>
    </head>
<body>
@include('layouts.partials.header') 
    <main>
        @yield('content')
    </main>

    @include('layouts.partials.footer')

    </body>
</html>