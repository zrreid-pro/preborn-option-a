<x-layout>
    <h2>Donor List</h2>
    @foreach ($donors as $donor)
        <h5>Name: {{ $donor->name }}</h5>
        <ul>
            <li>Email: {{ $donor->email }}</li>
            <li>Phone Number: {{ $donor->phone_number }}</li>
        </ul>
    @endforeach

    {{ $donors->links() }}
</x-layout>