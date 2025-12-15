<x-layout>
    <h2>Campaign List</h2>
    @foreach ($campaigns as $campaign)
        <h5>Name: {{ $campaign->name }}</h5>
        <ul>
            <li>Current Amount: {{ $campaign->current_total }}</li>
            <li>Goal Amount: {{ $campaign->goal_amount }}</li>
            <li>Start Date: {{ $campaign->starts_at }}</li>
            <li>End Date: {{ $campaign->ends_at }}</li>
            <li>Campaign Status: {{ $campaign->status }}</li>
        </ul>
    @endforeach

    {{ $campaigns->links() }}
</x-layout>