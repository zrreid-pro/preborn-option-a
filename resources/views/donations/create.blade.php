<x-layout>
    <form action="{{ route('donations.store') }}" method="POST">
        @csrf
        <h2>Create a New Donation</h2>

        <label for="donor_id">Donor Name:</label>
        <select id="donor_id" name="donor_id" required>
            <option value="" disabled selected>Select a Donor</option>
            @foreach($donors as $donor)
                <option value="{{ $donor->id }}" {{ $donor->id == old('donor_id') ? 'selected' : '' }}>
                    {{ $donor->name }}
                </option>
            @endforeach
        </select>
        <br>

        <label for="campaign_id">Campaign Name:</label>
        <select id="campaign_id" name="campaign_id">
            <option value="" selected>Select a Campaign</option>
            @foreach($campaigns as $campaign)
                <option value="{{ $campaign->id }}" {{ $campaign->id == old('campaign_id') ? 'selected' : '' }}>
                    {{ $campaign->name }}
                </option>
            @endforeach
        </select>
        <br>

        <label for="amount">Donation Amount:</label>
        <input
            type="number"
            id="amount"
            name="amount"
            value="{{ old('amount') }}"
        >
        <br>

        <label for="method_enum">Donation Method:</label>
        <select id="method_enum" name="method_enum" required>
            <option value="" disabled selected>Select a Payment Method</option>
            @foreach($methods as $method)
                <option value="{{ $method }}" {{ $method == old('method_enum') ? 'selected' : '' }}>
                    {{ $method }}
                </option>
            @endforeach
        </select>
        <br>

        <label for="received_at">Delivery Date:</label>
        <input
            type="date"
            id="received_at"
            name="received_at"
            value={{ old('received_at') }}
        >
        <br>

        <button type="submit">Create Donation</button>

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