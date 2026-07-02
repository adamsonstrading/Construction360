@extends('layouts.public')

@if(!empty($subService['meta_title']))
    @section('meta_title', $subService['meta_title'])
@else
    @section('title', $subService['title'] . ' | ' . $details['title'] . ' | Construction 360 Ltd')
@endif

@section('meta')
    <meta name="description" content="{{ $subService['meta_description'] ?? ($subService['desc'] ?? 'Professional ' . $subService['title'] . ' services by Construction 360 Ltd across the UK.') }}">
    <meta name="keywords" content="{{ $subService['meta_keywords'] ?? '' }}">
    <meta name="robots" content="index, follow">
    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Construction 360 Ltd">
    <meta property="og:title" content="{{ $subService['meta_title'] ?? ($subService['title'] . ' | ' . $details['title'] . ' | Construction 360 Ltd') }}">
    <meta property="og:description" content="{{ $subService['meta_description'] ?? ($subService['desc'] ?? 'Professional ' . $subService['title'] . ' services by Construction 360 Ltd across the UK.') }}">
    <meta property="og:image" content="{{ !empty($details['image_url']) ? asset($details['image_url']) : asset('images/hero_construction.png') }}">
    <!-- Twitter Card -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $subService['meta_title'] ?? ($subService['title'] . ' | ' . $details['title'] . ' | Construction 360 Ltd') }}">
    <meta property="twitter:description" content="{{ $subService['meta_description'] ?? ($subService['desc'] ?? 'Professional ' . $subService['title'] . ' services by Construction 360 Ltd across the UK.') }}">
    <meta property="twitter:image" content="{{ !empty($details['image_url']) ? asset($details['image_url']) : asset('images/hero_construction.png') }}">
@endsection

@section('content')
    <!-- Services Dark Hero Banner -->
    <section class="bg-slate-950 py-24 text-white relative overflow-hidden border-b border-slate-900">
        <!-- Grid Watermark -->
        <div class="absolute inset-0 z-0 opacity-[0.03] pointer-events-none">
            <svg class="w-full h-full text-white" fill="none" viewBox="0 0 100 100" preserveAspectRatio="none">
                <line x1="0" y1="25" x2="100" y2="25" stroke="currentColor" stroke-width="0.05" />
                <line x1="0" y1="50" x2="100" y2="50" stroke="currentColor" stroke-width="0.05" />
                <line x1="0" y1="75" x2="100" y2="75" stroke="currentColor" stroke-width="0.05" />
                <line x1="25" y1="0" x2="25" y2="100" stroke="currentColor" stroke-width="0.05" />
                <line x1="50" y1="0" x2="50" y2="100" stroke="currentColor" stroke-width="0.05" />
                <line x1="75" y1="0" x2="75" y2="100" stroke="currentColor" stroke-width="0.05" />
            </svg>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-3xl space-y-4">
                <div class="flex items-center space-x-2 text-xs font-bold uppercase tracking-widest text-slate-400">
                    <a href="{{ url('/') }}" class="hover:text-white transition-colors">Home</a>
                    <span>/</span>
                    <a href="{{ route('services.index') }}" class="hover:text-white transition-colors">Services</a>
                    <span>/</span>
                    <a href="{{ route('services.show', Str::slug($details['title'])) }}" class="hover:text-white transition-colors">{{ $details['title'] }}</a>
                    <span>/</span>
                    <span class="text-white">{{ $subService['title'] }}</span>
                </div>
                <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tighter leading-none mt-6">
                    {{ $subService['title'] }}
                </h1>
                <p class="text-xs sm:text-sm text-slate-400 font-medium">Specialist Scope of works under {{ $details['title'] }}</p>
            </div>
        </div>
    </section>

    <!-- Sub-Service Details -->
    <section class="bg-white py-20 lg:py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-start">
                <!-- Left Details -->
                <div class="lg:col-span-8 space-y-6">
                    <span class="text-[10px] font-bold text-aqua uppercase tracking-[0.2em] block">SCOPE & SPECS</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-950 tracking-tight leading-tight font-sans">
                        Technical Execution & Capabilities
                    </h2>
                    <p class="text-sm sm:text-base text-slate-650 leading-relaxed font-sans pt-2">
                        {{ $subService['desc'] }}
                    </p>

                    <!-- Core Deliverables checklist -->
                    <div class="pt-6 space-y-4 border-t border-slate-100 mt-8">
                        <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider">Scope Deliverables</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($subService['deliverables'] as $deliverable)
                                <div class="flex items-center space-x-3 text-xs sm:text-sm text-slate-600">
                                    <svg class="h-5 w-5 text-aqua" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>{{ $deliverable }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar details -->
                <div class="lg:col-span-4 bg-slate-50 border border-slate-150 rounded-2xl p-6 sm:p-8 space-y-6">
                    <h3 class="text-lg font-bold text-slate-950 tracking-tight font-sans">
                        Related Scopes
                    </h3>
                    <div class="space-y-3">
                        @foreach($details['services_offered'] as $sibling)
                            @if($sibling['slug'] !== $subService['slug'])
                                <a href="{{ route('subservices.show', [$details['slug'], $sibling['slug']]) }}" 
                                   class="block text-xs sm:text-sm font-semibold text-slate-600 hover:text-aqua transition-colors flex items-center justify-between group">
                                    <span class="truncate pr-4">{{ $sibling['title'] }}</span>
                                    <svg class="h-4 w-4 text-slate-400 group-hover:text-aqua group-hover:translate-x-0.5 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom Contact/Tender CTA card -->
    <section class="bg-slate-50 border-t border-slate-100 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-slate-950 text-white rounded-3xl p-10 sm:p-14 border border-slate-900 shadow-xl flex flex-col sm:flex-row justify-between items-center gap-8">
                <div class="space-y-4 text-center sm:text-left">
                    <span class="text-[10px] font-bold text-aqua uppercase tracking-[0.2em] block">PROJECT ENGAGEMENT</span>
                    <h3 class="text-2xl sm:text-3xl font-bold tracking-tight text-white font-sans">
                        Need this scope for your build?
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-400 font-sans max-w-lg">
                        Get in touch with our technical estimators. Submit your project requirements to review compliance plans and receive costings.
                    </p>
                </div>
                <div class="flex-shrink-0">
                    <a href="#" onclick="openTenderModal(); return false;" class="inline-flex items-center justify-center px-6 py-3.5 text-xs font-bold uppercase tracking-widest text-slate-950 bg-white hover:bg-slate-100 rounded-lg shadow-md transition-all">
                        Submit Project Specifications
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
