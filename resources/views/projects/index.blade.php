@extends('layouts.public')

@section('title', 'Project Portfolio | Architectural Builds & Fit-Outs | Construction 360 Ltd')

@section('meta')
    <meta name="description" content="Browse Construction 360 Ltd's project portfolio showcasing completed residential, commercial and industrial builds across the UK including extensions, fit-outs and structural projects.">
    <meta name="keywords" content="construction projects uk, building portfolio, completed projects construction, uk construction company portfolio, architectural builds">
    <meta name="robots" content="index, follow">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Construction 360 Ltd">
    <meta property="og:title" content="Project Portfolio | Construction 360 Ltd">
    <meta property="og:description" content="Browse Construction 360 Ltd's project portfolio showcasing completed residential, commercial and industrial builds across the UK.">
    <meta property="og:image" content="{{ asset('images/hero_construction.png') }}">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:title" content="Project Portfolio | Construction 360 Ltd">
    <meta property="twitter:description" content="Browse Construction 360 Ltd's project portfolio showcasing completed builds across the UK.">
    <meta property="twitter:image" content="{{ asset('images/hero_construction.png') }}">
@endsection

@section('content')
    {{-- Light hero — matches home page --}}
    <section class="relative bg-white border-b border-black/5">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10" style="padding-top: 7.5rem; padding-bottom: 3.5rem;">
            <div class="max-w-3xl">
                <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-brand">
                    {{ $content['projects_page_label'] ?? 'Portfolio' }}
                </p>
                <h1 class="mt-4 text-4xl sm:text-5xl lg:text-[3.25rem] font-bold tracking-tight leading-tight text-[#0f2a3a]">
                    {{ $content['projects_page_title'] ?? 'Our Projects' }}
                </h1>
                <div class="mt-5 h-[3px] w-14 bg-brand"></div>
                <p class="mt-5 text-base sm:text-[15px] text-[#5b6770] leading-relaxed max-w-2xl">
                    {{ $content['projects_page_subtitle'] ?? 'A curated selection of our high-spec residential builds, commercial workspace designs, and structural renovations across London and Essex.' }}
                </p>
                <div class="mt-6 flex items-center gap-2 text-[11px] font-semibold uppercase tracking-[0.14em] text-[#6b7280]">
                    <a href="{{ url('/') }}" class="hover:text-brand transition-colors">Home</a>
                    <span>•</span>
                    <span class="text-[#0f2a3a]">Projects</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Filters + grid --}}
    <section class="bg-white py-12 lg:py-16 min-h-[60vh]">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10">
            <form action="{{ route('projects.index') }}" method="GET"
                  class="mb-10 lg:mb-12 grid grid-cols-1 sm:grid-cols-12 gap-4 sm:gap-5 items-end border-b border-black/5 pb-8">
                <div class="sm:col-span-3">
                    <label for="filter-type" class="block text-[10px] font-bold uppercase tracking-widest text-[#6b7280] mb-2">Sector / Type</label>
                    <select name="type" id="filter-type" onchange="this.form.submit()"
                            class="w-full bg-white border border-black/10 rounded-lg px-4 py-3 text-xs font-semibold text-[#0f2a3a] focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent transition-all">
                        <option value="">All Sectors</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ request('type') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="sm:col-span-3">
                    <label for="filter-status" class="block text-[10px] font-bold uppercase tracking-widest text-[#6b7280] mb-2">Project Status</label>
                    <select name="status" id="filter-status" onchange="this.form.submit()"
                            class="w-full bg-white border border-black/10 rounded-lg px-4 py-3 text-xs font-semibold text-[#0f2a3a] focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent transition-all">
                        <option value="">All Statuses</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="under-construction" {{ request('status') === 'under-construction' ? 'selected' : '' }}>Under Construction</option>
                        <option value="upcoming" {{ request('status') === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                    </select>
                </div>

                <div class="sm:col-span-3">
                    <label for="filter-location" class="block text-[10px] font-bold uppercase tracking-widest text-[#6b7280] mb-2">Location</label>
                    <select name="location" id="filter-location" onchange="this.form.submit()"
                            class="w-full bg-white border border-black/10 rounded-lg px-4 py-3 text-xs font-semibold text-[#0f2a3a] focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent transition-all">
                        <option value="">All Locations</option>
                        @foreach($locations as $loc)
                            <option value="{{ $loc }}" {{ request('location') === $loc ? 'selected' : '' }}>{{ $loc }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="sm:col-span-3 flex gap-3">
                    <button type="submit" class="flex-grow bg-brand hover:bg-brand-dark text-white text-xs font-bold uppercase tracking-[0.08em] py-3 rounded-lg transition-colors">
                        Filter
                    </button>
                    @if(request()->anyFilled(['type', 'status', 'location']))
                        <a href="{{ route('projects.index') }}" class="inline-flex items-center justify-center bg-white hover:border-brand border border-black/10 text-[#0f2a3a] px-4 py-3 rounded-lg text-xs font-bold uppercase tracking-[0.08em] transition-colors">
                            Reset
                        </a>
                    @endif
                </div>
            </form>

            @if($projects->isEmpty())
                <div class="text-center py-20">
                    <svg class="mx-auto h-12 w-12 text-brand/40" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-4 text-lg font-bold text-[#0f2a3a] tracking-tight">No projects found</h3>
                    <p class="mt-2 text-sm text-[#6b7280] max-w-sm mx-auto">
                        Try loosening your filters or resetting the form to view other projects in our portfolio.
                    </p>
                    <div class="mt-6">
                        <a href="{{ route('projects.index') }}" class="inline-flex items-center px-5 py-2.5 bg-brand hover:bg-brand-dark text-white text-xs font-bold uppercase tracking-[0.08em] rounded-lg transition-colors">
                            Clear Filters
                        </a>
                    </div>
                </div>
            @else
                {{-- Portrait overlay cards — same language as homepage portfolio --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 lg:gap-5">
                    @foreach($projects as $proj)
                        @php
                            $slug = $proj->slug ?: \Illuminate\Support\Str::slug($proj->title);
                            $imgUrl = asset($proj->image_url ?: 'images/hero_architecture.png');
                            $locParts = array_filter(array_map('trim', explode(',', (string) ($proj->location ?: ''))));
                            $loc = $locParts ? end($locParts) : ($proj->category ?: 'London');
                            $statusRaw = strtolower((string) ($proj->status ?? ''));
                            $statusLabel = in_array($statusRaw, ['completed', 'complete'], true) ? 'Complete' : str_replace('-', ' ', $proj->status ?: 'In progress');
                        @endphp
                        <a href="{{ route('projects.show', $slug) }}"
                           class="group relative aspect-[3/4] rounded-2xl overflow-hidden border border-black/5 bg-[#0f2a3a]">
                            <img
                                src="{{ $imgUrl }}"
                                alt="{{ $proj->title }}"
                                class="absolute inset-0 h-full w-full object-cover object-center transition-transform duration-700 group-hover:scale-105"
                            >
                            <div class="absolute inset-0 bg-black/50 group-hover:bg-black/45 transition-colors duration-500"></div>
                            <div class="absolute bottom-0 inset-x-0 p-5 lg:p-6">
                                <span class="block text-[10px] font-semibold uppercase tracking-[0.18em] text-white/85 mb-1.5">
                                    {{ strtoupper($loc) }} — {{ strtoupper($statusLabel) }}
                                </span>
                                <h2 class="text-[1.25rem] sm:text-[1.35rem] font-bold text-white leading-snug drop-shadow-sm">
                                    {{ $proj->title }}
                                </h2>
                                @if(!empty($proj->category))
                                    <span class="mt-2 block text-[11px] text-white/70">{{ $proj->category }}</span>
                                @endif
                                <span class="mt-3 inline-flex text-[13px] font-semibold text-white/90 group-hover:text-[#f0d778] transition-colors">
                                    View →
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- Bottom CTA — matches home pre-footer --}}
    <section class="relative bg-brand text-white py-16 lg:py-20 overflow-hidden">
        <div class="pointer-events-none absolute inset-0 bg-brand/20"></div>
        <div class="relative max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10 flex flex-col md:flex-row md:items-center md:justify-between gap-8">
            <div class="max-w-xl">
                <h2 class="font-heading text-3xl sm:text-4xl lg:text-[2.75rem] font-medium leading-tight">
                    {{ $content['pre_footer_cta_title'] ?? 'Ready to start your project?' }}
                </h2>
                <p class="mt-3 text-sm text-white/55 max-w-lg">
                    {{ $content['pre_footer_cta_subtitle'] ?? 'Tell us about your space, timeline and ambitions — we’ll respond with clear next steps.' }}
                </p>
            </div>
            <a href="#" onclick="openTenderModal(); return false;"
               class="inline-flex shrink-0 items-center gap-2 rounded-lg px-8 py-3.5 text-xs font-bold uppercase tracking-[0.08em] text-brand bg-white hover:bg-aqua-light transition-colors shadow-lg">
                {{ $content['cta_get_free_quote_label'] ?? 'Get a free quote' }}
                <span aria-hidden="true">→</span>
            </a>
        </div>
    </section>
@endsection
