<!DOCTYPE html>

<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="{{ asset('./css/dashboard/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('./css/dashboard/sb-admin-2.min.css') }}">
        <title>RBPlanejamento - 404</title>
        <style>
            html, body {
                height: 100%;
            }

            body {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .error-container {
                margin-bottom: 10%;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="error-container">
            <div class="error mx-auto" data-text="404">404</div>
            <p class="lead text-gray-800 mb-4">Página Não Encontrada</p>
            <p class="text-gray-500 mb-2">Desculpe, a página que você solicitou não foi encontrada...</p>
            <a href="{{route('dashboard.content')}}">&larr; Voltar para o Dashboard</a>
        </div>
    </body>
</html>
