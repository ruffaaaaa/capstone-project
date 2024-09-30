<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unauthorized Access</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> <!-- Tailwind CSS if you're using it -->
</head>
<body class="bg-gray-100 text-center py-16">
    <div class="container mx-auto">
        <h1 class="text-4xl font-bold text-red-600">Unauthorized</h1>
        <p class="text-lg mt-4">You do not have permission to access this page.</p>
        <a href="{{ route('login') }}" class="mt-8 inline-block bg-blue-500 text-white px-4 py-2 rounded">Go to Login</a>
    </div>
</body>
</html>