<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quick Donation API</title>
    @vite('resources/css/app.css')
</head>
<body>
    <form action="{{ Route('login.login') }}" method="POST">
        @csrf
        <input 
            type="text"
            id="name"
            name="name"
            value="Tester"
            hidden
        >
        <input 
            type="password"
            id="password"
            name="password"
            value="password"
            hidden
        >
        <button type="submit">Log In</button>
    </form>
</body>
</html>