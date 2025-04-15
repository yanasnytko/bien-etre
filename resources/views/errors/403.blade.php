<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accès Interdit</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
    <div class="bg-white p-8 rounded shadow-lg text-center">
        <h1 class="text-4xl font-bold text-red-600 mb-4">Accès Interdit</h1>
        <p class="text-gray-700 mb-6">Vous n'êtes pas autorisé à effectuer cette opération.</p>
        <a href="{{ url()->previous() }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            Retour
        </a>
    </div>
</body>
</html>
