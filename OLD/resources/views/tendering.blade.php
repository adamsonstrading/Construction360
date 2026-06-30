@extends('layouts.public')

@section('title', $content['tendering_title'] ?? 'Official Tendering Standard')

@section('content')
<main class="flex-grow py-20 bg-slate-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumbs & Title -->
        <nav class="text-xs font-bold uppercase tracking-wider text-aqua mb-3">
            <a href="{{ url('/') }}" class="hover:underline">Home</a> &nbsp;/&nbsp; <span class="text-slate-400">Tendering Standard</span>
        </nav>
        <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight mb-8">{{ $content['tendering_title'] ?? 'Official Tendering & Procurement Standards' }}</h1>
        
        <!-- Premium notice block as requested -->
        <div class="bg-slate-900 border border-slate-800 text-white rounded-2xl p-6 sm:p-8 shadow-xl space-y-4 mb-10 relative overflow-hidden">
            <!-- Geometric arc watermark background -->
            <div class="absolute -right-6 -bottom-6 opacity-[0.03] pointer-events-none">
                <svg class="h-28 w-28 text-white" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <line x1="12" y1="88" x2="88" y2="12" stroke="currentColor" stroke-width="6.5" />
                    <circle cx="50" cy="50" r="32" stroke="currentColor" stroke-width="6.5" fill="none" />
                </svg>
            </div>
            
            <div class="relative z-10 space-y-4">
                <div class="flex items-center space-x-3 text-aqua">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.3-2.5-1.3-3.268 0L2.73 15.682c-.77 1.3.258 3 1.732 3z" />
                    </svg>
                    <h3 class="text-lg font-bold tracking-tight text-white uppercase tracking-wider">Official Tendering Standard</h3>
                </div>
                {!! $content['tendering_notice'] ?? '' !!}
            </div>
        </div>

        <!-- Tendering details -->
        <div class="bg-white border border-slate-200 rounded-2xl p-8 sm:p-10 shadow-sm prose prose-slate max-w-none text-slate-650 text-sm sm:text-base space-y-6 whitespace-pre-wrap">{{ $content['tendering_content'] ?? '' }}</div>
    </div>
</main>
@endsection
