<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - {{ ucfirst(str_replace('_', ' ', auth()->user()->role)) }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .bg-primary-soft { background-color: #E0E7FF; }
        .text-primary { color: #4338CA; }
        .btn-purple { background-color: #6366F1; }
    </style>
</head>
<body class="bg-white text-gray-800">

    <div class="flex h-screen overflow-hidden">
        
        <aside class="w-64 bg-white border-r border-gray-100 flex flex-col justify-between py-6 px-4">
            <div>
                <div class="flex items-center gap-2 px-2 mb-10">
                    <div class="w-8 h-8 bg-blue-600 rounded-tr-lg rounded-bl-lg flex items-center justify-center">
                        <div class="w-3 h-3 bg-white rounded-full"></div>
                    </div>
                    <span class="text-xl font-bold text-blue-600 tracking-wide">LOGAREA</span>
                </div>

                <nav class="space-y-2">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 bg-indigo-100 text-indigo-700 rounded-lg font-medium">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        Dashboard
                    </a>

                    <a href="{{ route('logs.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 rounded-lg font-medium transition">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Daily Logs
                    </a>

                    @if(auth()->user()->role !== 'staff')
                        <a href="{{ route('verification.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 rounded-lg font-medium transition">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Staff List
                        </a>

                        <a href="{{ route('verification.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 rounded-lg font-medium transition">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                            Verification Logs
                        </a>
                    @endif
                </nav>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center gap-3 px-4 py-3 text-gray-900 font-medium hover:text-red-600 transition w-full">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </button>
            </form>
        </aside>

        <main class="flex-1 overflow-y-auto p-8">
            <header class="flex justify-between items-center mb-8">
                <button class="text-gray-900 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </button>

                <div class="border border-indigo-100 rounded-full px-6 py-2 bg-white text-gray-800 font-medium shadow-sm">
                    Hi {{ ucwords(str_replace('_', ' ', auth()->user()->role)) }}!
                </div>
            </header>

            <h1 class="text-2xl font-bold mb-6 text-black">Summary</h1>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <div class="space-y-6">
                    <div class="bg-white border border-indigo-50 rounded-2xl p-6 shadow-sm h-96 relative">
                        <h2 class="text-lg font-bold mb-4 text-black">Pie Chart Approval</h2>
                        <div class="absolute right-6 top-16 text-xs space-y-2">
                            <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-yellow-400"></span> Pending</div>
                            <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-red-400"></span> Rejected</div>
                            <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-indigo-500"></span> Approved</div>
                        </div>
                        <div class="flex items-center justify-center h-64">
                            <canvas id="pieChart"></canvas>
                        </div>
                    </div>

                    <div class="bg-white border border-indigo-50 rounded-2xl p-6 shadow-sm">
                        <h2 class="text-lg font-bold mb-4 text-black">Notes</h2>
                        
                        @if($rejectedLogs->count() > 0)
                            <div class="space-y-3">
                                @foreach($rejectedLogs as $log)
                                <div class="bg-indigo-50 rounded-xl p-4 flex flex-col gap-1">
                                    <span class="bg-red-400 text-white text-xs font-bold px-2 py-0.5 rounded-full w-max">Rejected</span>
                                    <p class="text-gray-700 text-sm mt-1">{{ $log->verification_note ?? 'Missing some entries' }}</p>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="bg-indigo-50 rounded-xl p-4">
                                <p class="text-gray-500 text-sm">Tidak ada catatan reject saat ini.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white border border-indigo-50 rounded-2xl p-6 shadow-sm">
                        <h2 class="text-lg font-bold mb-2 text-black">Reminder</h2>
                        <p class="text-gray-800 text-sm">
                            Please remember to submit 1 daily activity log summary every day.
                        </p>
                    </div>

                    <div class="bg-white border border-indigo-50 rounded-2xl p-6 shadow-sm h-[28rem]">
                        <h2 class="text-lg font-bold mb-4 text-black">Graphic Chart by Year</h2>
                        <div class="h-80 w-full">
                            <canvas id="lineChart"></canvas>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <script>
        
        const statsPending = <?php echo $stats['pending']; ?>;
        const statsRejected = <?php echo $stats['rejected']; ?>;
        const statsApproved = <?php echo $stats['approved']; ?>;

        // Ambil array tahun (JSON)
        const yearsLabels = <?php echo json_encode($years); ?>;
        
        // Data Dummy untuk grafik
        const dummyData = [0, 5, 10, 25, 120, 350]; 

        // === 1. CONFIG PIE CHART ===
        const ctxPie = document.getElementById('pieChart').getContext('2d');
        new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: ['Pending', 'Rejected', 'Approved'],
                datasets: [{
                    data: [statsPending, statsRejected, statsApproved],
                    backgroundColor: [
                        '#FBBF24', // Pending (Kuning)
                        '#F87171', // Rejected (Merah)
                        '#818CF8'  // Approved (Ungu Muda)
                    ],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                }
            }
        });

        // === 2. CONFIG LINE CHART ===
        const ctxLine = document.getElementById('lineChart').getContext('2d');
        new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: yearsLabels,
                datasets: [{
                    label: 'Approved Logs',
                    data: dummyData,
                    borderColor: '#818CF8',
                    backgroundColor: 'rgba(129, 140, 248, 0.2)', 
                    borderWidth: 2,
                    pointBackgroundColor: '#C7D2FE',
                    pointBorderColor: '#818CF8',
                    pointRadius: 4,
                    fill: true,
                    tension: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 400,
                        ticks: { stepSize: 80 },
                        grid: { borderDash: [4, 4], color: '#E5E7EB' }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
    </script>
</body>
</html>