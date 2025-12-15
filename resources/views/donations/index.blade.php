<x-layout>
    <h2>Donation List</h2>
    @foreach ($donations as $donation)
        <h5>-Donation-</h5>
        <ul>
            <li>Donor Name: {{ $donation->donor->name }}</li>
            <li>Campaign Name: {{ $donation->campaign->name }}</li>
            <li>Amount: {{ $donation->amount }}</li>
            <li>Payment Method: {{ $donation->method_enum }}</li>
            <li>Date Received: {{ $donation->received_at }}</li>
        </ul>
    @endforeach

    {{ $donations->links() }}
</x-layout>