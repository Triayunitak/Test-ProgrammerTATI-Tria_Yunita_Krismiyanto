<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff List - {{ ucfirst(str_replace('_', ' ', auth()->user()->role)) }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } [x-cloak] { display: none !important; } </style>
</head>
<body class="bg-gray-50 text-gray-800" x-data="{ expanded: true, notiOpen: false }">

    <div class="flex h-screen overflow-hidden">
        <aside class="bg-white border-r border-gray-100 flex flex-col justify-between py-6 transition-all duration-300 ease-in-out" :class="expanded ? 'w-64 px-4' : 'w-20 px-2'">
            <div>
                <div class="flex items-center mb-10 h-10 transition-all duration-300" :class="expanded ? 'justify-between px-2' : 'justify-center'">
                    <template x-if="expanded">
                        <div class="flex justify-between items-center w-full">
                            <img src="{{ asset('LOGO-TEXT.png') }}" alt="LOGAREA" class="h-8 w-auto object-contain">
                            <button @click="expanded = !expanded" class="text-gray-400 hover:text-[#5B3AFF] p-1 rounded hover:bg-indigo-50 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" /></svg>
                            </button>
                        </div>
                    </template>
                    <template x-if="!expanded">
                        <button @click="expanded = !expanded" class="group flex justify-center items-center"><img src="{{ asset('LOGO ONLY.png') }}" class="h-8 group-hover:hidden"><svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#5B3AFF] hidden group-hover:block" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" /></svg></button>
                    </template>
                </div>
                <nav class="space-y-2">
                    <a href="{{ route('dashboard') }}" class="flex items-center py-3 rounded-lg font-medium text-gray-900 hover:bg-[#E6E1FF] hover:text-[#5B3AFF] transition-all" :class="expanded ? 'px-4 gap-3' : 'justify-center px-0'"><svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg><span x-show="expanded">Dashboard</span></a>
                    <a href="{{ route('logs.index') }}" class="flex items-center py-3 rounded-lg font-medium text-gray-900 hover:bg-[#E6E1FF] hover:text-[#5B3AFF] transition-all" :class="expanded ? 'px-4 gap-3' : 'justify-center px-0'"><svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg><span x-show="expanded">Daily Logs</span></a>
                    <a href="{{ route('verification.staff') }}" class="flex items-center py-3 rounded-lg font-medium bg-[#E6E1FF] text-[#5B3AFF] transition-all" :class="expanded ? 'px-4 gap-3' : 'justify-center px-0'"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg><span x-show="expanded">Staff List</span></a>
                    <a href="{{ route('verification.index') }}" class="flex items-center py-3 rounded-lg font-medium text-gray-900 hover:bg-[#E6E1FF] hover:text-[#5B3AFF] transition-all" :class="expanded ? 'px-4 gap-3' : 'justify-center px-0'"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg><span x-show="expanded">Verification Logs</span></a>
                </nav>
            </div>
            <form action="{{ route('logout') }}" method="POST">@csrf<button type="submit" class="flex items-center py-3 text-gray-900 font-medium hover:bg-[#E6E1FF] hover:text-[#5B3AFF] rounded-lg transition duration-200 w-full group" :class="expanded ? 'px-4 gap-3' : 'justify-center px-0'"><svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg><span x-show="expanded">Logout</span></button></form>
        </aside>
        <main class="flex-1 overflow-y-auto p-8">
            <header class="flex justify-between items-center mb-10">
                <h1 class="text-2xl font-bold text-black">Staff List</h1>
                <div class="border border-indigo-100 rounded-full px-6 py-2 bg-white text-gray-800 font-medium text-sm">
                    Hi {{ ucwords(str_replace('_', ' ', auth()->user()->role)) }}!
                </div>
            </header>

            <div class="mb-6">
                <form action="{{ route('verification.staff') }}" method="GET" class="relative w-full md:w-72">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search staff..." 
                           class="w-full pl-9 pr-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-[#5B3AFF] focus:border-transparent text-xs text-black outline-none">
                    <svg class="w-4 h-4 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                </form>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden text-black">
                <table class="w-full text-left text-[12px]">
                    <thead class="bg-indigo-50/50 text-gray-600 font-bold border-b border-gray-100 uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-4 text-black font-bold uppercase">Full Name</th>
                            <th class="px-6 py-4 text-black font-bold uppercase">Role</th>
                            <th class="px-6 py-4 text-black font-bold uppercase">Email</th>
                            <th class="px-6 py-4 text-black font-bold uppercase">Created At</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($subordinates as $sub)
                        <tr class="hover:bg-indigo-50/30 transition duration-150">
                            <td class="px-6 py-4 font-semibold text-black">{{ $sub->user_name }}</td>
                            <td class="px-6 py-4 text-black font-medium">{{ ucwords(str_replace('_', ' ', $sub->role)) }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $sub->email_user }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $sub->created_at->format('d M Y H:i') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="px-6 py-12 text-center text-gray-400 italic">No staff members found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>