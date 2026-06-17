<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-950">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <title>Admin Login | Construction 360</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Vite CSS & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>
<body class="h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8 relative overflow-hidden">
    
    <!-- Geometric Background Decorative SVGs -->
    <div class="absolute inset-0 z-0 opacity-15 pointer-events-none">
        <svg class="absolute -top-1/4 -left-1/4 w-full h-full text-slate-800" fill="none" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <line x1="0" y1="0" x2="100" y2="100" stroke="currentColor" stroke-width="0.5" stroke-dasharray="2 2" />
            <line x1="100" y1="0" x2="0" y2="100" stroke="currentColor" stroke-width="0.5" stroke-dasharray="2 2" />
            <circle cx="50" cy="50" r="30" stroke="currentColor" stroke-width="0.75" />
            <polygon points="50,10 90,30 90,70 50,90 10,70 10,30" stroke="currentColor" stroke-width="0.5" fill="none" />
        </svg>
        <svg class="absolute -bottom-1/4 -right-1/4 w-full h-full text-slate-800" fill="none" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <polygon points="50,5 95,27.5 95,72.5 50,95 5,72.5 5,27.5" stroke="currentColor" stroke-width="0.5" fill="none" />
            <circle cx="50" cy="50" r="40" stroke="currentColor" stroke-width="0.5" stroke-dasharray="5 5" />
        </svg>
    </div>

    <div class="sm:mx-auto sm:w-full sm:max-w-md z-10">
        <!-- Logo and Heading -->
        <div class="flex flex-col items-center">
            @include('partials.logo', ['idSuffix' => 'log', 'class' => 'h-16 w-16'])
            <h2 class="mt-6 text-center text-3xl font-extrabold text-white tracking-wider">CONSTRUCTION<span class="text-[#008080]">360</span></h2>
            <p class="mt-2 text-center text-sm text-slate-400">
                Admin Control Portal
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-slate-900 py-8 px-4 border border-slate-800 shadow-2xl rounded-2xl sm:px-10">
                <!-- Errors block -->
                @if($errors->any())
                    <div class="mb-4 bg-red-950 border border-red-800 rounded-lg p-3 text-sm text-red-300">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="space-y-6" action="{{ route('login') }}" method="POST">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-300">
                            Email address
                        </label>
                        <div class="mt-1.5">
                            <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                                class="appearance-none block w-full px-3 py-2.5 bg-slate-950 border border-slate-800 rounded-lg shadow-sm placeholder-slate-500 text-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold text-slate-300">
                            Password
                        </label>
                        <div class="mt-1.5">
                            <input id="password" name="password" type="password" autocomplete="current-password" required
                                class="appearance-none block w-full px-3 py-2.5 bg-slate-950 border border-slate-800 rounded-lg shadow-sm placeholder-slate-500 text-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm">
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember" name="remember" type="checkbox"
                                class="h-4 w-4 text-[#008080] focus:ring-[#008080] border-slate-800 bg-slate-950 rounded">
                            <label for="remember" class="ml-2 block text-sm text-slate-400">
                                Remember me
                            </label>
                        </div>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-md text-sm font-bold text-white bg-[#008080] hover:bg-[#006666] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-slate-900 focus:ring-[#008080] transition-colors">
                            Access Dashboard
                        </button>
                    </div>
                </form>

                <div class="mt-6 flex justify-center text-xs">
                    <a href="{{ route('landing') }}" class="text-slate-500 hover:text-[#008080] transition-colors flex items-center">
                        <svg class="mr-1 h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to public homepage
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
