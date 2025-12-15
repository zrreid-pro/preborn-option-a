<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quick Donation API</title>
    @vite('resources/css/app.css')
</head>
<body>
    <header>
        <nav>
            <h1>Quick Donation API</h1>
            <a href="{{ route('donors.create') }}" class="button">Create Donor</a>
            <a href="{{ route('campaigns.create') }}" class="button">Create Campaign</a>
            <a href="{{ route('donations.create') }}" class="button">Create Donation</a>
        </nav>
    </header>
    
    <main class="container">
        {{ $slot }}
    </main>
</body>
</html>