@extends('layouts.public')

@section('title', $content['privacy_title'] ?? 'Privacy Policy')

@section('content')
<main class="flex-grow py-20 bg-slate-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumbs & Title -->
        <nav class="text-xs font-bold uppercase tracking-wider text-aqua mb-3">
            <a href="{{ url('/') }}" class="hover:underline">Home</a> &nbsp;/&nbsp; <span class="text-slate-400">Privacy Policy</span>
        </nav>
        <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight mb-8">{{ $content['privacy_title'] ?? 'Privacy Policy & Correspondence Standards' }}</h1>
        
        <!-- Premium notice block as requested -->
        <div class="bg-white border border-slate-200 rounded-2xl p-6 sm:p-8 shadow-sm space-y-4 mb-10">
            <div class="flex items-center space-x-3 text-aqua">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                <h3 class="text-lg font-bold tracking-tight text-slate-950">Correspondence Log Integrity</h3>
            </div>
            {!! $content['privacy_notice'] ?? '' !!}
        </div>

        <!-- Privacy details -->
        <div class="bg-white border border-slate-200 rounded-2xl p-8 sm:p-10 shadow-sm prose prose-slate max-w-none text-slate-650 text-sm sm:text-base space-y-6 whitespace-pre-wrap">{{ $content['privacy_content'] ?? '' }}</div>
    </div>
</main>
@endsection
