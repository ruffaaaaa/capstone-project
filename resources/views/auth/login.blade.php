
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-[#E5EFE8] text-white">
            <div class="w-full sm:max-w-md mt-7 px-7 py-16 border-4 border-green-700 bg-white dark:bg-white-800 shadow-md overflow-hidden sm:rounded-lg">
                <div class="flex flex-col items-center">
                    <a href="/" class="-mt-8">
                        <img src="/images/lsu-logo 2.png" class="w-20 h-30" />
                        <h1 class="text-l text-green-600 text-center font-bold">ADMIN</h1>
                    </a>
                </div>

                <div class="mb-4">
                    {{ session('status') }}
                </div>

                <form method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="login" class="block text-sm font-medium text-gray-700">Email or Username</label>
                        <input id="login" type="text" name="login" value="{{ old('login') }}" autocomplete="current-login" required autofocus class="block w-full mt-1 px-3 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-gray-700">
                        @if ($errors->has('login'))
                            <p class="text-red-500 mt-2">{{ $errors->first('login') }}</p>
                        @endif
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input id="password" type="password" name="password" autocomplete="off" required autocomplete="current-password" class="block w-full mt-1 px-3 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-gray-700">
                        @if ($errors->has('password'))
                            <p class="text-red-500 mt-2">{{ $errors->first('password') }}</p>
                        @endif
                    </div>

                    <div class="flex items-center justify-center">
                        <button type="submit" class="ml-3 py-2 px-4 bg-green-600 hover:bg-green-700 text-white rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 focus:ring-offset-gray-800">Log in</button>
                    </div>
                    <a href="/" class="text-center text-black text-xs block mt-2 hover:text-green">Back to the Home Page</a>
                </form>

            </div>
        </div>
    </body>
</html>
