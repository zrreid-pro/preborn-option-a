<x-layout>
    <form action="{{ route('campaigns.store') }}" method="POST">
        @csrf
        <h2>Create a New Campaign</h2>

        <label for="name">Campaign Name:</label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name') }}"
            required
        >
        <br>

        <label for="goal_amount">Donation Goal:</label>
        <input
            type="number"
            id="goal_amount"
            name="goal_amount"
            value="{{ old('goal_amount') }}"
            required
        >
        <br>

        <label for="starts_at">Start Date:</label>
        <input
            type="date"
            id="starts_at"
            name="starts_at"
            value="{{ old('starts_at') }}"
            required
        >
        <br>

        <label for="ends_at">End Date:</label>
        <input
            type="date"
            id="ends_at"
            name="ends_at"
            value="{{ old('ends_at') }}"
            required
        >
        <br>

        <button type="submit">Create Campaign</button>

        <!-- validation errors -->
        @if($errors->any())
            <ul class="px-4 py-2 bg-red-100">
                @foreach ($errors->all() as $error)
                    <li class="my-2 text-red-500">{{ $error }}</li>                
                @endforeach
            </ul>
        @endif

    </form>
</x-layout>