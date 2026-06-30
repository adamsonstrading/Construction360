<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Dashboard') | Construction 360 Admin</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Vite CSS & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js (Optional but we can use vanilla JS for lightweight interactions) -->
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>
<body class="h-full flex">

    @php
        $newQueriesCount = \App\Models\ContactQuery::where('status', 'new')->count();
    @endphp

    <!-- Sidebar -->
    <aside class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0 bg-slate-900 border-r border-slate-800">
        <div class="flex flex-col flex-1 min-h-0">
            <!-- Sidebar Header -->
            <div class="flex items-center h-16 flex-shrink-0 px-4 bg-slate-950 border-b border-slate-800">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3">
                    @include('partials.logo', ['idSuffix' => 'side', 'class' => 'h-9 w-9'])
                    <span class="text-white font-bold text-lg tracking-wider font-sans">CONSTRUCTION<span class="text-[#008080]">360</span></span>
                </a>
            </div>

            <!-- Sidebar Navigation -->
            <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors group {{ request()->routeIs('admin.dashboard') ? 'bg-[#008080] text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('admin.content.edit') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors group {{ request()->routeIs('admin.content.*') ? 'bg-[#008080] text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.content.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                    </svg>
                    Site Content Manager
                </a>

                <a href="{{ route('admin.services.index') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors group {{ request()->routeIs('admin.services.*') ? 'bg-[#008080] text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.services.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766l.002-.001a1.56 1.56 0 011.83 1.83c-.14.468-.382.89-.766 1.207l-3.03 2.496zm-7.494-.001c-.496-.496-.496-1.3 0-1.796l8.502-8.502a1.27 1.27 0 011.797 0L19.121 9.8c.496.496.496 1.3 0 1.796l-8.502 8.502a1.27 1.27 0 01-1.796 0L3.926 15.17z" />
                    </svg>
                    Service Grid CRUD
                </a>

                <a href="{{ route('admin.blogs.index') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors group {{ request()->routeIs('admin.blogs.*') ? 'bg-[#008080] text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.blogs.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5-3h3m-3 3h3m-7.5-3v12a1.5 1.5 0 001.5 1.5h15a1.5 1.5 0 001.5-1.5v-12a1.5 1.5 0 00-1.5-1.5h-15a1.5 1.5 0 00-1.5 1.5zM11.25 15h7.5m-7.5-3h7.5M3.75 12h3m-3 3h3" />
                    </svg>
                    Blog Post CRUD
                </a>

                <a href="{{ route('admin.projects.index') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors group {{ request()->routeIs('admin.projects.*') ? 'bg-[#008080] text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.projects.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75L2.25 12l4.179 2.25m11.142 0L21.75 12l-4.179-2.25M12 5.25L16.179 7.5 12 9.75 7.821 7.5 12 5.25zm0 9l4.179 2.25L12 18.75l-4.179-2.25 4.179-2.25zm0-4.5l4.179 2.25L12 14.25l-4.179-2.25 4.179-2.25z" />
                    </svg>
                    Project Portfolio CRUD
                </a>

                <a href="{{ route('admin.team.index') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-colors group {{ request()->routeIs('admin.team.*') ? 'bg-[#008080] text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.team.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.109A11.386 11.386 0 0110.089 20c-2.202 0-4.254-.622-6.002-1.701V18.17a4.125 4.125 0 015.24-3.793M15 11.622a5.25 5.25 0 11-6.75-6.75m6.75 6.75a5.25 5.25 0 01-6.75-6.75m3.75 1.5H9" />
                    </svg>
                    Team Members CRUD
                </a>

                <a href="{{ route('admin.queries.index') }}" class="flex items-center justify-between px-3 py-2.5 text-sm font-medium rounded-lg transition-colors group {{ request()->routeIs('admin.queries.*') ? 'bg-[#008080] text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <span class="flex items-center">
                        <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.queries.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                        Incoming Queries
                    </span>
                    @if($newQueriesCount > 0)
                        <span class="px-2 py-0.5 text-xs font-semibold rounded-full bg-[#F59E0B] text-slate-900 group-hover:bg-amber-400 transition-colors">
                            {{ $newQueriesCount }}
                        </span>
                    @endif
                </a>
            </nav>

            <!-- Sidebar Footer User Panel -->
            <div class="flex-shrink-0 p-4 bg-slate-950 border-t border-slate-850">
                <div class="flex items-center space-x-3">
                    <div class="bg-[#008080] h-9 w-9 rounded-full flex items-center justify-center text-white font-semibold shadow-inner">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->name ?? 'Admin' }}</p>
                        <p class="text-xs text-slate-400 truncate">{{ Auth::user()->email ?? 'admin@construction360.co' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content Wrapper -->
    <div class="md:pl-64 flex flex-col flex-1 w-full min-w-0">
        <!-- Top Navigation -->
        <header class="flex items-center justify-between h-16 bg-white border-b border-slate-200 px-4 md:px-8 z-10">
            <!-- Mobile Sidebar Toggle -->
            <button type="button" id="mobile-sidebar-toggle" class="md:hidden p-2 text-slate-500 hover:text-slate-600 focus:outline-none">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <!-- Page Title -->
            <div class="flex-1 md:flex-none">
                <h2 class="text-xl font-bold text-slate-800 tracking-tight">@yield('page_title', 'Admin Dashboard')</h2>
            </div>

            <!-- Top bar Actions -->
            <div class="flex items-center space-x-4">
                <a href="{{ route('landing') }}" target="_blank" class="hidden sm:inline-flex items-center text-xs font-semibold text-slate-600 hover:text-[#008080] transition-colors">
                    <svg class="mr-1.5 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                    View Public Site
                </a>

                <!-- User Dropdown Menu -->
                <div class="relative inline-block text-left" id="user-dropdown-container">
                    <button type="button" id="user-dropdown-btn" class="flex items-center space-x-2 focus:outline-none p-1.5 rounded-lg hover:bg-slate-50 transition-colors">
                        <div class="bg-[#008080] h-8 w-8 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                            {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                        </div>
                        <span class="hidden md:inline text-sm font-medium text-slate-700">{{ Auth::user()->name ?? 'Admin' }}</span>
                        <svg class="h-4 w-4 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- Dropdown Panel (hidden by default) -->
                    <div id="user-dropdown-panel" class="hidden absolute right-0 mt-2 w-48 rounded-lg bg-white shadow-lg border border-slate-200 py-1 focus:outline-none origin-top-right">
                        <div class="px-4 py-2 border-b border-slate-100">
                            <p class="text-xs text-slate-400">Logged in as</p>
                            <p class="text-sm font-semibold text-slate-800 truncate">{{ Auth::user()->email ?? 'admin@construction360.co' }}</p>
                        </div>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-slate-50 font-medium transition-colors flex items-center">
                                <svg class="mr-2 h-4 w-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Mobile Drawer Sidebar (hidden by default) -->
        <div id="mobile-sidebar" class="hidden fixed inset-0 z-40 flex">
            <!-- Overlay -->
            <div id="mobile-sidebar-overlay" class="fixed inset-0 bg-slate-900 bg-opacity-70 transition-opacity"></div>
            <!-- Drawer -->
            <div class="relative flex-1 flex flex-col max-w-xs w-full bg-slate-900 border-r border-slate-800 transition-transform">
                <!-- Close Button -->
                <div class="absolute top-0 right-0 -mr-12 pt-2">
                    <button type="button" id="mobile-sidebar-close" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <!-- Content -->
                <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                    <div class="flex-shrink-0 flex items-center px-4">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3">
                            @include('partials.logo', ['idSuffix' => 'sidetop', 'class' => 'h-9 w-9'])
                            <span class="text-white font-bold text-lg tracking-wider">CONSTRUCTION<span class="text-[#008080]">360</span></span>
                        </a>
                    </div>
                    <nav class="mt-5 px-2 space-y-1">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-2 text-base font-medium rounded-md text-white bg-slate-800">
                            Dashboard
                        </a>
                        <a href="{{ route('admin.content.edit') }}" class="flex items-center px-3 py-2 text-base font-medium rounded-md text-slate-300 hover:bg-slate-800 hover:text-white">
                            Site Content Manager
                        </a>
                        <a href="{{ route('admin.services.index') }}" class="flex items-center px-3 py-2 text-base font-medium rounded-md text-slate-300 hover:bg-slate-800 hover:text-white">
                            Service Grid CRUD
                        </a>
                        <a href="{{ route('admin.blogs.index') }}" class="flex items-center px-3 py-2 text-base font-medium rounded-md {{ request()->routeIs('admin.blogs.*') ? 'text-white bg-slate-800' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                            Blog Post CRUD
                        </a>
                        <a href="{{ route('admin.projects.index') }}" class="flex items-center px-3 py-2 text-base font-medium rounded-md {{ request()->routeIs('admin.projects.*') ? 'text-white bg-slate-800' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                            Project Portfolio CRUD
                        </a>
                        <a href="{{ route('admin.team.index') }}" class="flex items-center px-3 py-2 text-base font-medium rounded-md {{ request()->routeIs('admin.team.*') ? 'text-white bg-slate-800' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                            Team Members CRUD
                        </a>
                        <a href="{{ route('admin.queries.index') }}" class="flex items-center justify-between px-3 py-2 text-base font-medium rounded-md text-slate-300 hover:bg-slate-800 hover:text-white">
                            <span>Incoming Queries</span>
                            @if($newQueriesCount > 0)
                                <span class="px-2 py-0.5 text-xs font-semibold rounded-full bg-[#F59E0B] text-slate-900">
                                    {{ $newQueriesCount }}
                                </span>
                            @endif
                        </a>
                    </nav>
                </div>
                <!-- User Footer Panel -->
                <div class="flex-shrink-0 flex border-t border-slate-850 p-4 bg-slate-950">
                    <div class="flex items-center">
                        <div class="bg-[#008080] h-9 w-9 rounded-full flex items-center justify-center text-white font-semibold">
                            {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-white">{{ Auth::user()->name ?? 'Admin' }}</p>
                            <p class="text-xs font-medium text-slate-400 group-hover:text-slate-300">{{ Auth::user()->email ?? 'admin@construction360.co' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Body Content Area -->
        <main class="flex-1 overflow-y-auto px-4 py-8 md:px-8 bg-slate-50">
            @if(session('success'))
                <div class="mb-6 rounded-lg bg-emerald-50 border border-emerald-200 p-4 text-sm text-emerald-800 shadow-sm flex items-center">
                    <svg class="mr-2.5 h-5 w-5 text-emerald-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Scripts for Interactivity -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Dropdown Menu Toggle
            const dropBtn = document.getElementById('user-dropdown-btn');
            const dropPanel = document.getElementById('user-dropdown-panel');
            
            if (dropBtn && dropPanel) {
                dropBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    dropPanel.classList.toggle('hidden');
                });
                
                document.addEventListener('click', function() {
                    dropPanel.classList.add('hidden');
                });
            }

            // Mobile Sidebar Toggles
            const openToggle = document.getElementById('mobile-sidebar-toggle');
            const closeToggle = document.getElementById('mobile-sidebar-close');
            const mobileSidebar = document.getElementById('mobile-sidebar');
            const sidebarOverlay = document.getElementById('mobile-sidebar-overlay');

            if (openToggle && mobileSidebar) {
                openToggle.addEventListener('click', function() {
                    mobileSidebar.classList.remove('hidden');
                });
            }

            if (closeToggle && mobileSidebar) {
                closeToggle.addEventListener('click', function() {
                    mobileSidebar.classList.add('hidden');
                });
            }

            if (sidebarOverlay && mobileSidebar) {
                sidebarOverlay.addEventListener('click', function() {
                    mobileSidebar.classList.add('hidden');
                });
            }
        });
    </script>
</body>
</html>
