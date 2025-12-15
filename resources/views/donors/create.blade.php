<x-layout>
    <form action="{{ route('donors.store') }}" method="POST">
        @csrf
        <h2>Create a New Donor</h2>

        <label for="name">Donor Name:</label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name') }}"
            required
        >
        <br>

        <label for="email">Donor Email:</label>
        <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email') }}"
            required
        >
        <br>

        <label for="phone_number">Donor Phone Number:</label>
        <input
            type="text"
            id="phone_number"
            name="phone_number"
            value="{{ old('phone_number') }}"
        >
        <br>

        <button type="submit">Create Donor</button>

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