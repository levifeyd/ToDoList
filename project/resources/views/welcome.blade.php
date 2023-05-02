<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Library</title>
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="antialiased">
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Списки</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Войти</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Регистрация</a>
                @endif
            @endauth
        </div>
    @endif
    <div class="welcome" style="text-align: center">
        <h2>Добро пожаловать в приложение ToDoList</h2>
        <h3>Пожалуйста пройдите регистрацию или авторизацию</h3>
    </div>
</div>
</body>
<style>
    body {
        font-family: 'Nunito', sans-serif;
    }
    .text-sm{
        font-size:.875rem
    }
    .py-4{
        padding-top:1rem;
        padding-bottom:1rem
    }
    .px-6{
        padding-left:1.5rem;
        padding-right:1.5rem
    }
    .pt-8{
        padding-top:2rem}.fixed{position:fixed
                         }
    .relative{
        position:relative
    }
    .top-0{
        top:0
    }.right-0{right:0}
    .text-gray-700{--tw-text-opacity: 1;color:rgb(55 65 81 / var(--tw-text-opacity))}
    .underline{text-decoration:underline}
    @media (min-width:640px){
        .sm\:block{display:block}.sm\:items-center{align-items:center}
        .sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}
    }
</style>
</html>
