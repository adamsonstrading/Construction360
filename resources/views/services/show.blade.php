@extends('layouts.public')

@if(!empty($details['meta_title']))
    @section('meta_title', $details['meta_title'])
@else
    @section('title', $details['title'] . ' Services UK | Construction 360 Ltd')
@endif

@section('meta')
    <meta name="description" content="{{ $details['meta_description'] ?? ($details['about'] ?? 'Professional ' . $details['title'] . ' services across the UK by Construction 360 Ltd.') }}">
    <meta name="keywords" content="{{ $details['meta_keywords'] ?? '' }}">
    <meta name="robots" content="index, follow">
    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Construction 360 Ltd">
    <meta property="og:title" content="{{ $details['meta_title'] ?? ($details['title'] . ' Services UK | Construction 360 Ltd') }}">
    <meta property="og:description" content="{{ $details['meta_description'] ?? ($details['about'] ?? 'Professional ' . $details['title'] . ' services across the UK by Construction 360 Ltd.') }}">
    <meta property="og:image" content="{{ !empty($details['image_url']) ? asset($details['image_url']) : asset('images/hero_construction.png') }}">
    <!-- Twitter Card -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $details['meta_title'] ?? ($details['title'] . ' Services UK | Construction 360 Ltd') }}">
    <meta property="twitter:description" content="{{ $details['meta_description'] ?? ($details['about'] ?? 'Professional ' . $details['title'] . ' services across the UK by Construction 360 Ltd.') }}">
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
                    <span class="text-white">{{ $details['title'] }}</span>
                </div>
                <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tighter leading-none mt-6">
                    {{ $details['title'] }}
                </h1>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="bg-white py-20 lg:py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-center">
                <!-- Left: Copy -->
                <div class="lg:col-span-6 space-y-6">
                    <span class="text-[10px] font-bold text-aqua uppercase tracking-[0.2em] block">{{ $content['service_about_label'] ?? 'ABOUT THE SERVICE' }}</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-950 tracking-tight leading-tight font-sans">
                        Full-Spectrum {{ $details['title'] }} Solutions
                    </h2>
                    <p class="text-sm sm:text-base text-slate-650 leading-relaxed font-sans pt-2">
                        {{ $details['about'] }}
                    </p>
                </div>
                
                <!-- Right: Large image card -->
                <div class="lg:col-span-6">
                    <div class="bg-white border border-slate-150 rounded-2xl p-2.5 shadow-xl hover:shadow-2xl transition-all duration-300">
                        <img src="{{ asset($details['image_url']) }}" alt="{{ $details['title'] }}" class="w-full h-auto rounded-xl object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Detailed Sub-Services Offered -->
    <section class="bg-slate-50/50 py-24 lg:py-28 border-y border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-16">
                <span class="text-[10px] font-bold text-aqua uppercase tracking-[0.2em] block">{{ $content['service_scopes_label'] ?? 'SCOPES & DELIVERABLES' }}</span>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-950 mt-2 tracking-tighter font-sans">
                    {{ $content['service_scopes_title'] ?? 'Specialist Sub-Services' }}
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($details['services_offered'] as $idx => $subService)
                    <div class="bg-white border border-slate-150 rounded-2xl p-8 shadow-sm flex flex-col justify-between hover:border-slate-350 hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 relative overflow-hidden group">
                        <!-- Top Accent Line -->
                        <div class="absolute top-0 left-0 right-0 h-[3px] bg-slate-100 group-hover:bg-[#008080] transition-colors duration-300"></div>

                        <div class="space-y-4 pt-2">
                            <!-- Card Header: Title & Index Badge -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <span class="h-2 w-2 rounded-full bg-[#008080] flex-shrink-0"></span>
                                    <h3 class="text-base sm:text-lg font-bold text-slate-950 tracking-tight font-sans">
                                        {{ $subService['title'] }}
                                    </h3>
                                </div>
                                <span class="text-[9px] font-bold text-slate-400 font-mono tracking-widest uppercase bg-slate-50 border border-slate-150 px-2 py-0.5 rounded flex-shrink-0">
                                    SCOPE {{ str_pad($idx + 1, 2, '0', STR_PAD_LEFT) }}
                                </span>
                            </div>
                            
                            <!-- Description -->
                            <p class="text-xs sm:text-sm text-slate-650 leading-relaxed font-sans pt-1">
                                {{ $subService['desc'] }}
                            </p>
                        </div>

                        <!-- Card Footer: Explore Link -->
                        <div class="pt-6 border-t border-slate-100 mt-6">
                            <a href="{{ route('subservices.show', [$slug, $subService['slug']]) }}" class="text-xs font-bold text-slate-900 group-hover:text-[#008080] transition-colors inline-flex items-center gap-1 group/btn">
                                Explore Technical Scope
                                <svg class="h-3.5 w-3.5 text-slate-400 group-hover/btn:text-[#008080] group-hover/btn:translate-x-0.5 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Why Choose Us Grid -->
    <section class="bg-white py-24 lg:py-28 border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-16">
                <span class="text-[10px] font-bold text-aqua uppercase tracking-[0.2em] block">{{ $content['service_why_choose_us_label'] ?? 'CAPABILITIES' }}</span>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-950 mt-2 tracking-tighter font-sans">
                    {{ $content['service_why_choose_us_title'] ?? 'Why Choose Us' }}
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($details['why_choose_us'] as $item)
                    <div class="bg-white border border-slate-150 rounded-xl p-8 shadow-sm flex flex-col justify-between hover:border-slate-350 hover:-translate-y-1 hover:shadow-md transition-all duration-300">
                        <div class="space-y-4">
                            <!-- Bullet Indicator -->
                            <div class="h-1 w-8 bg-aqua rounded-full"></div>
                            <h3 class="text-base font-bold text-slate-950 tracking-tight font-sans">
                                {{ $item['title'] }}
                            </h3>
                            <p class="text-xs sm:text-sm text-slate-500 leading-relaxed font-sans">
                                {{ $item['desc'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- FAQ Accordion Section -->
    <section class="bg-white py-24 lg:py-28">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-[10px] font-bold text-aqua uppercase tracking-[0.2em] block">{{ $content['service_faqs_label'] ?? 'COMMON INQUIRIES' }}</span>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-950 mt-2 tracking-tighter font-sans">
                    {{ $content['service_faqs_title'] ?? 'Frequently Asked Questions' }}
                </h2>
            </div>

            <!-- Accordion List -->
            <div class="space-y-4 border-t border-slate-100 pt-4">
                @foreach($details['faqs'] as $index => $faq)
                    <div class="border-b border-slate-100 py-3 last:border-b-0">
                        <button type="button" 
                                onclick="toggleAccordion({{ $index }})" 
                                class="w-full flex items-center justify-between text-left py-4 text-slate-950 hover:text-aqua focus:outline-none transition-colors group">
                            <span class="text-sm sm:text-base font-bold tracking-tight font-sans pr-4">
                                {{ $faq['q'] }}
                            </span>
                            <!-- Plus/Minus Icon -->
                            <div class="flex-shrink-0 w-8 h-8 rounded-full border border-slate-200 group-hover:border-aqua flex items-center justify-center transition-colors">
                                <svg id="icon-{{ $index }}" class="h-4 w-4 text-slate-500 group-hover:text-aqua transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </div>
                        </button>
                        
                        <!-- Panel Body (Expandable) -->
                        <div id="panel-{{ $index }}" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                            <div class="pb-6 pt-2 text-xs sm:text-sm text-slate-500 leading-relaxed font-sans max-w-3xl">
                                {!! $faq['a'] !!}
                            </div>
                        </div>
                    </div>
                @endforeach
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
                        Ready to brief our engineers?
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-400 font-sans max-w-lg">
                        Submit your project specifications or plans electronically. Our coordinators will review your design files and contact you with full costings.
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

    <script>
        function toggleAccordion(index) {
            const panel = document.getElementById('panel-' + index);
            const icon = document.getElementById('icon-' + index);
            
            // Check if open
            if (panel.style.maxHeight && panel.style.maxHeight !== '0px') {
                // Close
                panel.style.maxHeight = '0px';
                icon.style.transform = 'rotate(0deg)';
            } else {
                // Close all others first
                document.querySelectorAll('[id^="panel-"]').forEach((p, idx) => {
                    if (idx !== index) {
                        p.style.maxHeight = '0px';
                        const otherIcon = document.getElementById('icon-' + idx);
                        if (otherIcon) otherIcon.style.transform = 'rotate(0deg)';
                    }
                });
                
                // Open
                panel.style.maxHeight = panel.scrollHeight + 'px';
                icon.style.transform = 'rotate(45deg)'; // Rotates plus to make a close X icon
            }
        }
    </script>
@endsection
