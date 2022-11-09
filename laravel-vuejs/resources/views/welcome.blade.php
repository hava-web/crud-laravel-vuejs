<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <style type="module" src="{{ asset('js/app.js') }}" defer></style>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body >
       <div id="app">
        
       </div>
    </body>
</html>
