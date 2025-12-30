<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Logs - {{ ucfirst(str_replace('_', ' ', auth()->user()->role)) }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800" 
      x-data="{ 
          expanded: true, 
          modalOpen: false, 
          isEdit: false, 
          formAction: '{{ route('logs.store') }}', 
          formData: { date: '', summary: '' } 
      }">

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
                        <button @click="expanded = !expanded" class="group w-full flex justify-center items-center focus:outline-none p-1 rounded hover:bg-indigo-50 transition" title="Expand Sidebar">
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
                        <div x-show="!expanded" class="absolute left-14 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity z-50 pointer-events-none whitespace-nowrap" x-cloak>Dashboard</div>
                    </a>

                    <a href="{{ route('logs.index') }}" class="flex items-center py-3 rounded-lg font-medium transition-all duration-200 group {{ request()->routeIs('logs.*') ? 'bg-[#E6E1FF] text-[#5B3AFF]' : 'text-gray-900 hover:bg-[#E6E1FF] hover:text-[#5B3AFF]' }}" :class="expanded ? 'px-4 gap-3' : 'justify-center px-0'">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        <span x-show="expanded" class="whitespace-nowrap">Daily Logs</span>
                        <div x-show="!expanded" class="absolute left-14 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity z-50 pointer-events-none whitespace-nowrap" x-cloak>Daily Logs</div>
                    </a>

                    @if(auth()->user()->role !== 'staff')
                        <a href="{{ route('verification.index') }}" class="flex items-center py-3 rounded-lg font-medium transition-all duration-200 group {{ request()->routeIs('verification.*') ? 'bg-[#E6E1FF] text-[#5B3AFF]' : 'text-gray-900 hover:bg-[#E6E1FF] hover:text-[#5B3AFF]' }}" :class="expanded ? 'px-4 gap-3' : 'justify-center px-0'">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                            <span x-show="expanded" class="whitespace-nowrap">Staff List</span>
                            <div x-show="!expanded" class="absolute left-14 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity z-50 pointer-events-none whitespace-nowrap" x-cloak>Staff List</div>
                        </a>

                        <a href="{{ route('verification.index') }}" class="flex items-center py-3 rounded-lg font-medium transition-all duration-200 group hover:bg-[#E6E1FF] hover:text-[#5B3AFF]" :class="expanded ? 'px-4 gap-3' : 'justify-center px-0'">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>
                            <span x-show="expanded" class="whitespace-nowrap">Verification</span>
                            <div x-show="!expanded" class="absolute left-14 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity z-50 pointer-events-none whitespace-nowrap" x-cloak>Verify</div>
                        </a>
                    @endif
                </nav>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center py-3 text-gray-900 font-medium hover:bg-[#E6E1FF] hover:text-[#5B3AFF] rounded-lg transition duration-200 w-full group" :class="expanded ? 'px-4 gap-3' : 'justify-center px-0'">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                    <span x-show="expanded" class="whitespace-nowrap">Logout</span>
                    <div x-show="!expanded" class="absolute left-14 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity z-50 pointer-events-none whitespace-nowrap" x-cloak>Logout</div>
                </button>
            </form>
        </aside>

        <main class="flex-1 overflow-y-auto p-8">
            
            <header class="flex justify-between items-center mb-8">
                <button @click="modalOpen = true; isEdit = false; formData = {date: '', summary: ''}; formAction = '{{ route('logs.store') }}'" 
                        class="bg-[#5B3AFF] hover:bg-indigo-600 text-white px-5 py-2.5 rounded-lg flex items-center gap-2 font-medium shadow-sm transition text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Add New Log
                </button>

                <div class="border border-indigo-100 rounded-full px-5 py-2 bg-white text-gray-800 font-medium shadow-sm text-sm">
                    Hi {{ ucwords(str_replace('_', ' ', auth()->user()->role)) }}!
                </div>
            </header>

            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 text-green-700 rounded-r shadow-sm text-sm">
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            @if(session('error'))
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 text-red-700 rounded-r shadow-sm text-sm">
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
                <div class="bg-indigo-50 p-1 rounded-lg flex gap-1">
                    @php $status = request('status', 'all'); @endphp
                    <a href="{{ route('logs.index', array_merge(request()->query(), ['status' => 'all'])) }}" class="px-3 py-1.5 rounded text-xs font-medium transition {{ $status == 'all' ? 'bg-[#E6E1FF] text-[#5B3AFF] shadow-sm' : 'text-gray-500 hover:text-gray-700' }}">All Logs</a>
                    <a href="{{ route('logs.index', array_merge(request()->query(), ['status' => 'pending'])) }}" class="px-3 py-1.5 rounded text-xs font-medium transition {{ $status == 'pending' ? 'bg-[#E6E1FF] text-[#5B3AFF] shadow-sm' : 'text-gray-500 hover:text-gray-700' }}">Pending</a>
                    <a href="{{ route('logs.index', array_merge(request()->query(), ['status' => 'approved'])) }}" class="px-3 py-1.5 rounded text-xs font-medium transition {{ $status == 'approved' ? 'bg-[#E6E1FF] text-[#5B3AFF] shadow-sm' : 'text-gray-500 hover:text-gray-700' }}">Approved</a>
                    <a href="{{ route('logs.index', array_merge(request()->query(), ['status' => 'rejected'])) }}" class="px-3 py-1.5 rounded text-xs font-medium transition {{ $status == 'rejected' ? 'bg-[#E6E1FF] text-[#5B3AFF] shadow-sm' : 'text-gray-500 hover:text-gray-700' }}">Rejected</a>
                </div>

                <form action="{{ route('logs.index') }}" method="GET" class="relative w-full md:w-72">
                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                    <input type="hidden" name="direction" value="{{ request('direction') }}">
                    <input type="hidden" name="status" value="{{ request('status') }}">
                    
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search activity..." 
                           class="w-full pl-9 pr-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#5B3AFF] focus:border-transparent text-xs">
                    <svg class="w-4 h-4 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </form>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-indigo-50/50 text-gray-600 font-semibold border-b border-gray-100 text-xs tracking-wider">
                            <tr>
                                <th class="px-4 py-3">Full Name</th>
                                <th class="px-4 py-3">Role</th>
                                <th class="px-4 py-3">Log Date</th> 
                                <th class="px-4 py-3">Activity Summary</th>
                                <th class="px-4 py-3">Status</th>
                                
                                @if(auth()->user()->role !== 'kepala_dinas')
                                    <th class="px-4 py-3">Verified By</th>
                                @endif
                                
                                <th class="px-4 py-3">Verification Note</th>
                                
                                <th class="px-4 py-3">
                                    <a href="{{ route('logs.index', array_merge(request()->query(), ['sort' => 'created_at', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc'])) }}" 
                                       class="flex items-center gap-1 hover:text-[#5B3AFF] transition">
                                        Created At
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 {{ request('sort') == 'created_at' ? 'text-[#5B3AFF]' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            @if(request('direction') == 'asc')
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                            @else
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            @endif
                                        </svg>
                                    </a>
                                </th>

                                <th class="px-4 py-3">Updated At</th>
                                <th class="px-4 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 text-xs">
                            @forelse($logs as $log)
                            <tr class="hover:bg-gray-50/50 transition duration-150">
                                <td class="px-4 py-3 font-medium text-gray-900">{{ auth()->user()->user_name }}</td>
                                <td class="px-4 py-3 text-gray-500">{{ ucwords(str_replace('_', ' ', auth()->user()->role)) }}</td>
                                <td class="px-4 py-3 text-gray-900 font-medium">{{ $log->log_date->format('Y-m-d') }}</td>
                                <td class="px-4 py-3 text-gray-700 leading-relaxed">{{ $log->activity_summary }}</td>
                                <td class="px-4 py-3">
                                    @if($log->status == 'pending')
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">Pending</span>
                                    @elseif($log->status == 'approved')
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-[#E6E1FF] text-[#5B3AFF]">Approved</span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-700">Rejected</span>
                                    @endif
                                </td>
                                
                                @if(auth()->user()->role !== 'kepala_dinas')
                                    <td class="px-4 py-3 text-gray-500">
                                        {{ $log->verifier->user_name ?? '-' }}
                                    </td>
                                @endif

                                <td class="px-4 py-3 text-gray-500 italic">
                                    {{ $log->verification_note ?? '-' }}
                                </td>
                                
                                <td class="px-4 py-3 text-gray-500">{{ $log->created_at->format('Y-m-d H:i') }}</td>
                                <td class="px-4 py-3 text-gray-500">{{ $log->updated_at->format('Y-m-d H:i') }}</td>

                                <td class="px-4 py-3 text-center">
                                    @if($log->status == 'pending')
                                        <div class="flex justify-center items-center gap-2">
                                            <button @click="modalOpen = true; isEdit = true; formData = { date: '{{ $log->log_date->format('Y-m-d') }}', summary: '{{ addslashes($log->activity_summary) }}' }; formAction = '{{ route('logs.update', $log->id_logs) }}'" 
                                                    class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 p-1.5 rounded transition" title="Edit">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                            </button>
                                            
                                            <form action="{{ route('logs.destroy', $log->id_logs) }}" method="POST" onsubmit="return confirm('Delete this log?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 p-1.5 rounded transition" title="Delete">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <div class="flex justify-center gap-2 opacity-30 cursor-not-allowed">
                                            <span class="p-1.5 bg-gray-100 rounded"><svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg></span>
                                            <span class="p-1.5 bg-gray-100 rounded"><svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></span>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="px-6 py-8 text-center text-gray-400 italic">
                                    No logs found. Start by creating a new one.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <div x-show="modalOpen" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 transition-opacity" x-transition.opacity x-cloak>
        <div class="bg-white rounded-xl shadow-xl w-full max-w-lg mx-4 transform transition-all" @click.away="modalOpen = false">
            
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 rounded-t-xl flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-800" x-text="isEdit ? 'Edit Daily Log' : 'Add New Daily Log'"></h3>
                <button @click="modalOpen = false" class="text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>

            <form :action="formAction" method="POST" class="p-6 space-y-4">
                @csrf
                <input type="hidden" name="_method" :value="isEdit ? 'PUT' : 'POST'">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Log Date</label>
                    <input type="date" name="log_date" x-model="formData.date" required min="{{ date('Y-m-d') }}"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#5B3AFF] focus:border-transparent outline-none text-sm">
                    <p class="text-xs text-gray-500 mt-1">One log per day allowed.</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Activity Summary</label>
                    <textarea name="activity_summary" rows="4" x-model="formData.summary" required placeholder="Describe your activities..."
                              class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#5B3AFF] focus:border-transparent outline-none text-sm"></textarea>
                </div>

                <div class="pt-2 flex justify-end gap-3">
                    <button type="button" @click="modalOpen = false" class="px-4 py-2 text-sm text-gray-600 font-medium hover:bg-gray-100 rounded-lg transition">Cancel</button>
                    <button type="submit" class="px-5 py-2 text-sm bg-[#5B3AFF] hover:bg-indigo-600 text-white font-medium rounded-lg shadow-sm transition">Submit</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>