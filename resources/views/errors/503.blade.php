<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ config('app.name', 'Sito in manutenzione') }}</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <style>
        html {
            height: 100%;
        }
        body {
            min-height: 100%;
            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
            background-size: 400% 400%;
            animation: gradient 20s ease infinite;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
    </style>
</head>
<body class="content-center">
    <div class="flex flex-col items-center w-full md:w-auto">
        <x-jet-authentication-card-logo/>
        <div class="rounded-3xl bg-opacity-25 bg-white w-full md:w-auto py-5">
            <h1 class="text-8xl lg:text-3xl text-center px-4 uppercase">Torneremo presto!</h1>
            <div class="break-words text-5xl lg:text-base pt-4 px-5 lg:max-w-xs">
                <p>Ci scusiamo per il disagio procuratoti ma al momento non siamo disponibili per manutenzione dei nostri sistemi!</p>
            </div>
        </div>
    </div>
</body>
</html>
