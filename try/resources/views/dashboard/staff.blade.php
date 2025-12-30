<x-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Staff Dashboard</h1>
        <p>Welcome, {{ auth()->user()->user_name }} (Staff)</p>
        <!-- Content from image.png will go here later -->
        <a href="{{ route('daily_logs.index') }}" class="text-blue-500 hover:underline">View Daily Logs</a>
    </div>
</x-layout>
