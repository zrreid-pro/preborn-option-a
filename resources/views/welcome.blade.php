<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quick Donation API</title>
    @vite('resources/css/app.css')
</head>
<body>
    <a href="{{ route('main') }}" class="button">Log In</a>    
</body>
</html>