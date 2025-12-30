<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - {{ ucfirst(str_replace('_', ' ', auth()->user()->role)) }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-white text-gray-800" x-data="{ expanded: true, notiOpen: false, hasUnread: true, role: '{{ auth()->user()->role }}' }">

    <div class="flex h-screen overflow-hidden">
        
        <aside class="bg-white border-r border-gray-100 flex flex-col justify-between py-6 transition-all duration-300 ease-in-out"
               :class="expanded ? 'w-64 px-4' : 'w-20 px-2'">
            
            <div>
                <div class="flex items-center mb-10 h-10 transition-all duration-300"
                     :class="expanded ? 'justify-between px-2' : 'justify-center'">
                    
                    <template x-if="expanded">
                        <div class="flex justify-between items-center w-full">
                            <img src="{{ asset('LOGO-TEXT.png') }}" alt="LOGAREA" class="h-8 w-auto object-contain">
                            <button @click="expanded = !expanded" class="text-gray-400 hover:text-[#5B3AFF] focus:outline-none p-1 rounded hover:bg-indigo-50 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" />
                                </svg>
                            </button>
                        </div>
                    </template>

                    <template x-if="!expanded">
                        <button @click="expanded = !expanded" class="group w-full flex justify-center items-center focus:outline-none p-1 rounded hover:bg-indigo-50 transition">
                            <img src="{{ asset('LOGO ONLY.png') }}" alt="Logo" class="h-8 w-auto object-contain block group-hover:hidden transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-[#5B3AFF] hidden group-hover:block transition-all">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" />
                            </svg>
                        </button>
                    </template>
                </div>

                <nav class="space-y-2">
                    <a href="{{ route('dashboard') }}" class="flex items-center py-3 rounded-lg font-medium transition-all duration-200 group {{ request()->routeIs('dashboard') ? 'bg-[#E6E1FF] text-[#5B3AFF]' : 'text-gray-900 hover:bg-[#E6E1FF] hover:text-[#5B3AFF]' }}" :class="expanded ? 'px-4 gap-3' : 'justify-center px-0'">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6z" /></svg>
                        <span x-show="expanded" class="whitespace-nowrap transition-opacity duration-300">Dashboard</span>
                    </a>

                    <a href="{{ route('logs.index') }}" class="flex items-center py-3 rounded-lg font-medium transition-all duration-200 group {{ request()->routeIs('logs.*') ? 'bg-[#E6E1FF] text-[#5B3AFF]' : 'text-gray-900 hover:bg-[#E6E1FF] hover:text-[#5B3AFF]' }}" :class="expanded ? 'px-4 gap-3' : 'justify-center px-0'">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        <span x-show="expanded" class="whitespace-nowrap">Daily Logs</span>
                    </a>

                    @if(auth()->user()->role !== 'staff')
                        <a href="{{ route('verification.index') }}" class="flex items-center py-3 rounded-lg font-medium transition-all duration-200 group {{ request()->routeIs('verification.index') ? 'bg-[#E6E1FF] text-[#5B3AFF]' : 'text-gray-900 hover:bg-[#E6E1FF] hover:text-[#5B3AFF]' }}" :class="expanded ? 'px-4 gap-3' : 'justify-center px-0'">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                            <span x-show="expanded" class="whitespace-nowrap">Staff List</span>
                        </a>

                        <a href="{{ route('verification.index') }}" class="flex items-center py-3 rounded-lg font-medium transition-all duration-200 group hover:bg-[#E6E1FF] hover:text-[#5B3AFF]" :class="expanded ? 'px-4 gap-3' : 'justify-center px-0'">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>
                            <span x-show="expanded" class="whitespace-nowrap">Verification Logs</span>
                        </a>
                    @endif
                </nav>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center py-3 text-gray-900 font-medium hover:bg-[#E6E1FF] hover:text-[#5B3AFF] rounded-lg transition duration-200 w-full group" :class="expanded ? 'px-4 gap-3' : 'justify-center px-0'">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                    <span x-show="expanded" class="whitespace-nowrap">Logout</span>
                </button>
            </form>
        </aside>

        <main class="flex-1 overflow-y-auto p-8 bg-gray-50">
            <header class="flex justify-between items-center mb-8 relative">
                <div class="relative" x-data="{ notiOpen: false }">
                    <button @click="notiOpen = !notiOpen" @click.away="notiOpen = false" class="text-gray-900 hover:text-[#5B3AFF] transition-colors duration-200 relative p-1">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <span class="absolute top-0 right-0 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white"></span>
                        @endif
                    </button>

                    <div x-show="notiOpen" x-cloak x-transition 
                        class="absolute left-0 mt-2 w-80 bg-white border border-gray-100 shadow-xl rounded-2xl z-50 overflow-hidden text-xs text-black">
                        <div class="p-3 border-b font-bold flex justify-between items-center">
                            <span>Notifications ({{ auth()->user()->unreadNotifications->count() }})</span>
                            @if(auth()->user()->unreadNotifications->count() > 0)
                            <form action="{{ route('notifications.markAllRead') }}" method="POST">
                                @csrf
                                <button type="submit" class="text-[10px] text-[#5B3AFF] hover:underline uppercase font-bold">Mark all read</button>
                            </form>
                            @endif
                        </div>
                        
                        <div class="max-h-64 overflow-y-auto">
                            @forelse(auth()->user()->notifications->take(15) as $notification)
                                <div class="p-3 border-b transition {{ $notification->read_at ? 'bg-white opacity-50' : 'bg-indigo-50/30' }}">
                                    <p class="font-semibold {{ $notification->read_at ? 'text-gray-600' : 'text-indigo-700' }}">
                                        {{ $notification->data['title'] }}
                                    </p>
                                    <p class="text-gray-600 mt-0.5">{{ $notification->data['message'] }}</p>
                                    @if(isset($notification->data['note']))
                                        <p class="mt-1 text-[10px] italic text-red-500">"{{ $notification->data['note'] }}"</p>
                                    @endif
                                    <p class="text-[9px] text-gray-400 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                                </div>
                            @empty
                                <div class="p-6 text-center text-gray-400 italic">No notifications</div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="border border-indigo-100 rounded-full px-6 py-2 bg-white text-gray-800 font-medium shadow-sm text-sm">
                    Hi {{ ucwords(str_replace('_', ' ', auth()->user()->role)) }}!
                </div>
            </header>

            <h1 class="text-2xl font-bold mb-6 text-black">Summary</h1>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="space-y-6">
                    <div class="bg-white border border-indigo-50 rounded-2xl p-6 shadow-sm h-96 relative text-black">
                        <h2 class="text-lg font-bold mb-4">Pie Chart Approval</h2>
                        <div class="absolute right-6 top-16 text-xs space-y-2">
                            <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-yellow-400"></span> Pending</div>
                            <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-red-400"></span> Rejected</div>
                            <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-indigo-500"></span> Approved</div>
                        </div>
                        <div class="flex items-center justify-center h-64"><canvas id="pieChart"></canvas></div>
                    </div>
                    <div class="bg-white border border-indigo-50 rounded-2xl p-6 shadow-sm">
                        <h2 class="text-lg font-bold mb-4 text-black">Notes</h2>
                        <div class="bg-indigo-50 rounded-xl p-4 text-gray-500 text-sm">Tidak ada catatan reject saat ini.</div>
                    </div>
                </div>
                <div class="space-y-6">
                    <div class="bg-white border border-indigo-50 rounded-2xl p-6 shadow-sm"><h2 class="text-lg font-bold mb-2 text-black">Reminder</h2><p class="text-gray-800 text-sm">Please remember to submit 1 daily activity log summary every day.</p></div>
                    <div class="bg-white border border-indigo-50 rounded-2xl p-6 shadow-sm h-[28rem]"><h2 class="text-lg font-bold mb-4 text-black">Graphic Chart by Year</h2><div class="h-80 w-full"><canvas id="lineChart"></canvas></div></div>
                </div>
            </div>
        </main>
    </div>

    <script>
        const userRole = "{{ auth()->user()->role }}";
        const yearsLabels = ["2020", "2021", "2022", "2023", "2024", "2025"];
        
        let pData = (userRole === 'kepala_dinas') ? [0, 0, 50] : [15, 5, 25];
        new Chart(document.getElementById('pieChart'), {
            type: 'pie',
            data: {
                labels: ['Pending', 'Rejected', 'Approved'],
                datasets: [{ data: pData, backgroundColor: ['#FBBF24', '#F87171', '#818CF8'], borderWidth: 0 }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } }
        });

        const lineDatasets = [{ label: 'Approved', data: [10, 50, 150, 250, 400], borderColor: '#818CF8', fill: true, tension: 0.3 }];
        if(userRole !== 'kepala_dinas') {
            lineDatasets.push({ label: 'Rejected', data: [2, 10, 5, 15, 20], borderColor: '#F87171', fill: true, tension: 0.3 });
        }
        new Chart(document.getElementById('lineChart'), {
            type: 'line',
            data: { labels: yearsLabels, datasets: lineDatasets },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: true, position: 'bottom' } } }
        });
    </script>
</body>
</html>