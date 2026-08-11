@extends('layouts.public')

@section('title', $content['seo_meta_title'] ?? 'Design-led construction for London & Essex')

@section('meta')
    <meta name="description" content="{{ $content['seo_meta_description'] ?? ($content['hero_subtitle'] ?? 'Construction 360 Ltd delivers design, structural planning and premium builds as one accountable journey across London and Essex.') }}">
    <meta name="keywords" content="{{ $content['seo_meta_keywords'] ?? 'construction, architectural builds, structural engineering, commercial fit-outs, extensions, renovations, glazing, Essex, London' }}">
    <link rel="canonical" href="https://construction360.co">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://construction360.co">
    <meta property="og:title" content="{{ $content['seo_meta_title'] ?? 'Design-led construction for London & Essex' }} | Construction 360 Ltd">
    <meta property="og:description" content="{{ $content['seo_meta_description'] ?? ($content['hero_subtitle'] ?? 'Design-led construction across London and Essex.') }}">
    <meta property="og:image" content="{{ asset('images/hero_construction.png') }}">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:title" content="{{ $content['seo_meta_title'] ?? 'Design-led construction for London & Essex' }} | Construction 360 Ltd">
    <meta property="twitter:description" content="{{ $content['seo_meta_description'] ?? ($content['hero_subtitle'] ?? 'Design-led construction across London and Essex.') }}">
    <meta property="twitter:image" content="{{ asset('images/hero_construction.png') }}">
@endsection

@section('content')
    {{-- Light two-column hero --}}
    <section id="hero" class="relative bg-white">
        <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8" style="padding-top: 7.5rem; padding-bottom: 3.5rem;">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-12 xl:gap-16 items-center">
                {{-- LEFT: copy --}}
                <div class="max-w-xl lg:max-w-none">
                    <div class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.18em] text-[#6b7280]">
                        <svg class="h-3.5 w-3.5 text-brand shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                        </svg>
                        <span>{{ $content['hero_badge'] ?? 'London · Est. 2013 · Fixed prices' }}</span>
                    </div>

                    <h1 class="mt-5 text-4xl xl:text-5xl font-bold tracking-tight leading-tight text-[#0f2a3a]">
                        <span class="block">
                            {{ trim(($content['hero_line_1'] ?? '') . ' ' . ($content['hero_line_2'] ?? '')) ?: 'Design-led construction built with care' }}
                        </span>
                        <span class="block mt-1 text-brand">
                            {{ trim(($content['hero_line_3'] ?? '') . ' ' . ($content['hero_line_4'] ?? '')) ?: 'Across London & Essex' }}
                        </span>
                    </h1>

                    <div class="mt-5 h-[3px] w-14 bg-brand"></div>

                    <p class="mt-5 text-base text-[#5b6770] leading-relaxed max-w-lg">
                        {{ $content['hero_subtitle'] ?? 'One accountable team from brief to handover — transparent pricing, disciplined programmes, and finishes that stand up to inspection.' }}
                    </p>

                    <div class="mt-7 flex flex-wrap items-center gap-3">
                        <a href="#enquiry" class="inline-flex items-center gap-2 rounded-lg bg-brand hover:bg-brand-dark text-white px-5 py-3.5 text-xs font-bold uppercase tracking-[0.08em] transition-colors">
                            {{ $content['cta_submit_tender_label'] ?? 'Get Your Fixed-Price Quote' }}
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                        </a>
                        <a href="tel:{{ $content['header_phone'] ?? '+442039309629' }}" class="inline-flex items-center gap-2 rounded-lg border border-[#d1d5db] bg-white hover:border-brand hover:text-brand text-[#0f2a3a] px-5 py-3.5 text-xs font-bold uppercase tracking-[0.06em] transition-colors">
                            <svg class="h-4 w-4 text-brand" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.824-1.802-5.14-4.118-6.942-6.942l1.293-.97c.362-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v1.5z"/></svg>
                            {{ $content['cta_book_consult_label'] ?? 'Book a Free Consultation' }}
                        </a>
                    </div>

                    @php
                        $heroStats = [
                            [
                                'value' => $content['stat_1_value'] ?? '120+',
                                'label' => $content['stat_1_label'] ?? 'Projects Delivered',
                                'icon' => 'M2.25 21h19.5M4.5 21V8.25l7.5-4.5 7.5 4.5V21M9 21v-6h6v6',
                            ],
                            [
                                'value' => $content['stat_2_value'] ?? '25+',
                                'label' => $content['stat_2_label'] ?? 'In-House Specialists',
                                'icon' => 'M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z',
                            ],
                            [
                                'value' => $content['stat_3_value'] ?? '12+',
                                'label' => $content['stat_3_label'] ?? 'Years of Delivery',
                                'icon' => 'M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z',
                            ],
                            [
                                'value' => $content['stat_4_value'] ?? '24h',
                                'label' => $content['stat_4_label'] ?? 'Quote Response',
                                'icon' => 'M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z',
                            ],
                        ];
                    @endphp

                    <div class="mt-9 grid grid-cols-2 sm:grid-cols-4 gap-5">
                        @foreach($heroStats as $stat)
                            <div class="flex items-start gap-2.5">
                                <svg class="h-5 w-5 text-brand shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $stat['icon'] }}"/>
                                </svg>
                                <div>
                                    <div class="text-2xl font-bold text-[#0f2a3a] tracking-tight leading-none">{{ $stat['value'] }}</div>
                                    <div class="mt-1.5 text-[11px] font-semibold uppercase tracking-[0.08em] text-[#6b7280] leading-snug">{{ $stat['label'] }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- RIGHT: media --}}
                <div class="relative w-full">
                    <div class="relative w-full overflow-hidden rounded-2xl bg-[#0f2a3a]" style="aspect-ratio: 5 / 4; min-height: 320px;">
                        <img
                            id="hero-intro-poster"
                            src="{{ asset('images/hero_construction.png') }}"
                            alt="Construction site across London and Essex"
                            class="absolute inset-0 w-full h-full object-cover"
                        >
                        <video
                            id="hero-intro-video"
                            class="absolute inset-0 w-full h-full object-cover hidden"
                            muted
                            playsinline
                            preload="metadata"
                        >
                            <source src="{{ asset('con360.mp4') }}" type="video/mp4">
                        </video>

                        <button
                            type="button"
                            id="hero-intro-play"
                            class="absolute bottom-5 right-5 z-10 inline-flex items-center gap-3 rounded-xl bg-white px-3.5 py-2.5 shadow-lg hover:shadow-xl transition-shadow text-left"
                            aria-label="Watch our intro video"
                        >
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-brand text-white shrink-0">
                                <svg class="h-4 w-4 ml-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5.14v13.72L19 12 8 5.14z"/></svg>
                            </span>
                            <span>
                                <span class="block text-[11px] font-bold uppercase tracking-[0.1em] text-[#0f2a3a]">{{ $content['hero_watch_label'] ?? 'Watch Our Intro' }}</span>
                                <span class="block text-[11px] text-[#6b7280] mt-0.5">{{ $content['hero_watch_sub'] ?? '60 sec overview' }}</span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        (function () {
            const playBtn = document.getElementById('hero-intro-play');
            const video = document.getElementById('hero-intro-video');
            const poster = document.getElementById('hero-intro-poster');
            if (!playBtn || !video) return;

            playBtn.addEventListener('click', function () {
                if (poster) poster.classList.add('hidden');
                playBtn.classList.add('hidden');
                video.classList.remove('hidden');
                video.setAttribute('controls', 'controls');
                video.play().catch(function () {});
            });
        })();
    </script>

    {{-- Reviews strip --}}
    <section class="relative bg-brand">
        <div class="relative max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10 py-12 lg:py-16">
            <div class="flex flex-col lg:flex-row lg:items-center gap-8 lg:gap-10">
                <div class="lg:w-48 xl:w-56 shrink-0 space-y-2 text-white">
                    <div class="flex items-center gap-3">
                        <span class="text-3xl sm:text-4xl font-bold leading-none tracking-tight">{{ $content['reviews_score'] ?? '4.9' }}</span>
                        <div class="flex items-center gap-1 text-[#f0d778]" aria-label="5 stars">
                            @for($i = 0; $i < 5; $i++)
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                    </div>
                    <p class="text-base sm:text-lg font-medium text-white">{{ $content['reviews_score_sub'] ?? 'from client reviews' }}</p>
                </div>

                <div class="flex-1 grid grid-cols-1 sm:grid-cols-3 gap-4 min-w-0">
                    @foreach([
                        [$content['testimonial_1_quote'] ?? 'Reliable, careful and genuinely communicative. The finish exceeded what we expected.', $content['testimonial_1_author'] ?? 'Colin Ashworth'],
                        [$content['testimonial_2_quote'] ?? 'From drawing to opening day without drama — on time and tightly controlled.', $content['testimonial_2_author'] ?? 'David Vance'],
                        [$content['testimonial_3_quote'] ?? 'The structure and detailing were handled with real expertise throughout.', $content['testimonial_3_author'] ?? 'Eleanor Finch'],
                    ] as $t)
                        <blockquote class="rounded-2xl bg-white border border-black/[0.04] p-5 shadow-sm hover:-translate-y-1 hover:shadow-lg transition-all duration-300">
                            <p class="font-heading text-lg text-[#1a1a1a] leading-snug">“{{ $t[0] }}”</p>
                            <footer class="mt-3 text-[11px] font-semibold uppercase tracking-[0.12em] text-brand">{{ $t[1] }}</footer>
                        </blockquote>
                    @endforeach
                </div>

                <div class="lg:w-40 xl:w-44 shrink-0 flex lg:justify-end">
                    <a href="{{ route('contact.index') }}" class="inline-flex text-[12px] font-bold uppercase tracking-[0.14em] text-white hover:text-white/85 whitespace-nowrap">
                        {{ $content['reviews_link_label'] ?? 'Read all reviews' }} →
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Estimate form --}}
    @include('partials.estimate-form')

    {{-- Quick service shortcuts (moved out of hero) --}}
    <section class="bg-white py-14 lg:py-16 border-b border-black/5">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10">
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-8">
                <div>
                    <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-brand mb-2">Start here</p>
                    <h2 class="text-3xl sm:text-4xl font-bold text-[#0f2a3a]">Popular project paths</h2>
                </div>
                <a href="{{ route('services.index') }}" class="text-[12px] font-bold uppercase tracking-[0.14em] text-[#1a1a1a] hover:text-brand">All services →</a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3">
                @php $heroCards = ($services ?? collect())->take(6); @endphp
                @forelse($heroCards as $idx => $srv)
                    @php $slug = \Illuminate\Support\Str::slug($srv->title); @endphp
                    <a href="{{ route('services.show', $slug) }}" class="group relative overflow-hidden rounded-2xl min-h-[140px] flex flex-col justify-end p-4 text-white {{ $idx % 2 === 0 ? 'bg-brand' : 'bg-brand-dark' }} hover:scale-[1.02] transition-transform duration-300 shadow-md">
                        @if($srv->image_url)
                            <img src="{{ asset($srv->image_url) }}" alt="" class="absolute inset-0 w-full h-full object-cover opacity-35 group-hover:opacity-50 group-hover:scale-110 transition-all duration-700">
                        @endif
                        <div class="absolute inset-0 bg-black/40"></div>
                        <span class="relative text-[10px] font-bold uppercase tracking-[0.16em] text-white/70">0{{ $idx + 1 }}</span>
                        <span class="relative font-heading text-xl leading-snug mt-1">{{ $srv->title }}</span>
                        <span class="relative text-[12px] mt-2 opacity-80 group-hover:opacity-100">Explore →</span>
                    </a>
                @empty
                    @foreach(['Pre-Construction','Structure','Interiors','MEP','Foundations','External'] as $idx => $label)
                        <a href="{{ route('services.index') }}" class="rounded-2xl min-h-[140px] flex flex-col justify-end p-4 text-white {{ $idx % 2 === 0 ? 'bg-brand' : 'bg-brand-dark' }}">
                            <span class="font-heading text-xl">{{ $label }}</span>
                        </a>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

    {{-- Selected work / portfolio (Linx-style) --}}
    <section id="projects" class="bg-brand text-white py-20 lg:py-28 scroll-mt-24 relative overflow-hidden">
        <div class="absolute inset-0 pointer-events-none bg-brand/10"></div>
        <div class="relative max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10">
            <div class="text-center max-w-2xl mx-auto mb-10 lg:mb-14 space-y-4">
                <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-white/80">
                    {{ $content['projects_label'] ?? 'Real projects' }}
                </p>
                <h2 class="font-heading text-4xl sm:text-5xl lg:text-[3.25rem] font-medium tracking-tight text-white leading-tight">
                    {{ $content['projects_title'] ?? 'Watch real projects come together' }}
                </h2>
                <p class="text-sm sm:text-[15px] text-white/80 leading-relaxed">
                    {{ $content['projects_subtitle'] ?? 'See the work behind the finish — on-site progress, walkthroughs and delivery from start to handover.' }}
                </p>
                <div class="inline-flex items-center gap-2.5 rounded-full bg-white/10 border border-white/20 px-4 py-2">
                    <span class="flex items-center gap-0.5 text-[#f0d778]">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </span>
                    <span class="text-[12px] text-white/85">{{ $content['projects_reviews_badge'] ?? 'Trusted by homeowners across London & Essex' }}</span>
                </div>
            </div>

            <div class="relative px-0 sm:px-6 lg:px-8">
                <button type="button" id="projects-prev" aria-label="Previous projects"
                    class="absolute left-0 top-1/2 -translate-y-1/2 z-20 hidden sm:flex h-11 w-11 items-center justify-center rounded-full bg-white text-[#0f2a3a] shadow-lg hover:scale-105 transition-transform">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/></svg>
                </button>
                <button type="button" id="projects-next" aria-label="Next projects"
                    class="absolute right-0 top-1/2 -translate-y-1/2 z-20 hidden sm:flex h-11 w-11 items-center justify-center rounded-full bg-white text-[#0f2a3a] shadow-lg hover:scale-105 transition-transform">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                </button>

                <div id="projects-carousel" class="flex gap-4 overflow-x-auto pb-2 snap-x snap-mandatory scroll-smooth [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                    @forelse($projects->take(8) as $proj)
                        @php
                            $slug = $proj->slug ?: \Illuminate\Support\Str::slug($proj->title);
                            $imgUrl = asset($proj->image_url ?: 'images/hero_architecture.png');
                        @endphp
                        <a href="{{ route('projects.show', $slug) }}"
                           class="group snap-start relative shrink-0 w-[78vw] sm:w-[240px] lg:w-[260px] aspect-[3/4] rounded-2xl overflow-hidden border border-white/20 bg-[#0f2a3a]">
                            <img
                                src="{{ $imgUrl }}"
                                alt="{{ $proj->title }}"
                                class="absolute inset-0 h-full w-full object-cover object-center transition-transform duration-700 group-hover:scale-105"
                            >
                            {{-- Solid overlay for readable text (no half/half layout) --}}
                            <div class="absolute inset-0 bg-black/50"></div>
                            <div class="absolute bottom-0 inset-x-0 p-5">
                                <span class="block text-[10px] font-semibold uppercase tracking-[0.18em] text-white/85 mb-1.5">
                                    {{ $proj->category ?: 'Real project' }}
                                </span>
                                <h3 class="text-[1.25rem] sm:text-[1.35rem] font-bold text-white leading-snug drop-shadow-sm">
                                    {{ $proj->title }}
                                </h3>
                                <span class="mt-3 inline-flex text-[13px] font-semibold text-white/90 group-hover:text-[#f0d778] transition-colors">
                                    View →
                                </span>
                            </div>
                        </a>
                    @empty
                        <p class="text-white/70 text-sm">Projects coming soon.</p>
                    @endforelse
                </div>
            </div>

            <div class="mt-10 text-center">
                <a href="{{ route('projects.index') }}" class="text-[13px] font-semibold text-white/80 hover:text-white transition-colors">
                    {{ $content['cta_explore_portfolio_label'] ?? 'View full portfolio' }} →
                </a>
            </div>
        </div>
    </section>

    {{-- Client stories --}}
    <section class="bg-white py-20 lg:py-28 border-t border-black/5">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10">
            <div class="text-center max-w-2xl mx-auto mb-12 lg:mb-14 space-y-4">
                <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-brand">
                    {{ $content['client_stories_label'] ?? 'Client stories' }}
                </p>
                <h2 class="text-4xl sm:text-5xl font-bold tracking-tight text-[#0f2a3a]">
                    {{ $content['client_stories_title'] ?? 'Hear from our clients' }}
                </h2>
            </div>
                
            @php
                $storyProjects = $projects->count() > 2
                    ? $projects->skip(2)->take(2)
                    : $projects->take(2);
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 lg:gap-7 max-w-5xl mx-auto">
                @forelse($storyProjects as $story)
                    @php
                        $slug = $story->slug ?: \Illuminate\Support\Str::slug($story->title);
                        $locParts = array_filter(array_map('trim', explode(',', (string) ($story->location ?: ''))));
                        $loc = $locParts ? end($locParts) : ($story->category ?: 'London');
                        $statusLabel = in_array($story->status ?? '', ['completed', 'complete'], true) ? 'Complete' : 'In progress';
                    @endphp
                    <a href="{{ route('projects.show', $slug) }}" class="group relative aspect-[3/4] rounded-2xl overflow-hidden border border-black/5">
                        @if($story->image_url)
                            <img src="{{ asset($story->image_url) }}" alt="{{ $story->title }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        @else
                            <div class="absolute inset-0 bg-[#0f2a3a]"></div>
                        @endif
                        <div class="absolute inset-0 bg-black/55"></div>
                        <div class="absolute bottom-0 inset-x-0 p-6 lg:p-8">
                            <span class="text-[10px] uppercase tracking-[0.22em] text-white/80">{{ strtoupper($loc) }} — {{ strtoupper($statusLabel) }}</span>
                            <h3 class="text-2xl sm:text-[1.75rem] font-bold text-white mt-2.5 leading-snug">{{ $story->title }}</h3>
                            @if($story->description)
                                <p class="mt-2 text-sm text-white/70 line-clamp-2">{{ $story->description }}</p>
                            @endif
                        </div>
                    </a>
                @empty
                    <p class="text-[#6b7280] text-sm col-span-2 text-center">Client stories coming soon.</p>
                @endforelse
            </div>

            <div class="mt-10 text-center">
                <a href="{{ route('projects.index') }}" class="text-[13px] font-semibold text-brand hover:text-brand-dark transition-colors">
                    {{ $content['client_stories_link'] ?? 'View full case studies' }} →
                </a>
            </div>
        </div>
    </section>

    {{-- 4. About statement --}}
    <section id="about" class="relative bg-brand py-20 lg:py-28 scroll-mt-24 text-white">
        <div class="relative max-w-3xl mx-auto px-4 sm:px-6 text-center space-y-6">
            <span class="text-[11px] font-semibold uppercase tracking-[0.28em] text-white/80">{{ $content['about_label'] ?? 'Who we are' }}</span>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold leading-snug text-white">
                {{ $content['about_heading'] ?? 'We craft buildings people love to live and work in' }}
            </h2>
            <div class="mx-auto w-14 h-[3px] bg-white"></div>
            <p class="text-sm sm:text-base text-white/80 leading-relaxed max-w-2xl mx-auto">
                {{ $content['about_mission'] ?? 'To guide clients from brief to completion with joined-up design, engineering and construction management that protects quality, budget and programme.' }}
            </p>
            <div class="pt-4">
                <a href="{{ route('about') }}" class="inline-flex items-center gap-2 rounded-lg bg-white text-brand px-6 py-3 text-xs font-bold uppercase tracking-[0.08em] hover:bg-aqua-light transition-colors">
                    Learn more about us →
                </a>
            </div>
        </div>
    </section>

    {{-- How your project works --}}
    @php
        $processDesign = [
            [
                'step' => '01',
                'title' => 'Free consultation',
                'duration' => '1 hour',
                'body' => 'We listen to your brief, budget and constraints, then outline the clearest path from idea to site.',
                'icon' => 'phone',
            ],
            [
                'step' => '02',
                'title' => 'Surveys & design',
                'duration' => '2–4 weeks',
                'body' => 'Measured surveys, design options and early engineering input so decisions are grounded and buildable.',
                'icon' => 'pencil',
            ],
            [
                'step' => '03',
                'title' => 'Planning & approvals',
                'duration' => '4–12 weeks',
                'body' => 'We manage planning, building control and partner submissions so permissions stay on the critical path.',
                'icon' => 'document',
            ],
            [
                'step' => '04',
                'title' => 'Costing & programme',
                'duration' => '1–2 weeks',
                'body' => 'Transparent budgets, procurement and a sequenced programme before any mobilisation begins.',
                'icon' => 'clipboard',
            ],
            [
                'step' => '05',
                'title' => 'Construction delivery',
                'duration' => 'Project based',
                'body' => 'Principal contracting with weekly reporting, quality checkpoints and accountable site leadership.',
                'icon' => 'building',
            ],
            [
                'step' => '06',
                'title' => 'Handover & aftercare',
                'duration' => 'Ongoing',
                'body' => 'Snag-free handover packs, warranties and a team that stays reachable after practical completion.',
                'icon' => 'check',
            ],
        ];
        $processBuild = [
            [
                'step' => '01',
                'title' => 'Free consultation',
                'duration' => '1 hour',
                'body' => 'Share your drawings and aspirations — we confirm scope, risks and whether we are the right contractor.',
                'icon' => 'phone',
            ],
            [
                'step' => '02',
                'title' => 'Drawings & scope review',
                'duration' => '3–5 days',
                'body' => 'We stress-test your pack for buildability, packages and missing information before pricing.',
                'icon' => 'search',
            ],
            [
                'step' => '03',
                'title' => 'Fixed quotation',
                'duration' => '1–2 weeks',
                'body' => 'A clear tender with allowances, exclusions and a realistic programme you can take to decision.',
                'icon' => 'clipboard',
            ],
            [
                'step' => '04',
                'title' => 'Pre-start & mobilisation',
                'duration' => '1–2 weeks',
                'body' => 'Contracts, site logistics, temporary works and neighbour liaison so day one runs cleanly.',
                'icon' => 'document',
            ],
            [
                'step' => '05',
                'title' => 'Construction delivery',
                'duration' => 'Project based',
                'body' => 'Disciplined site delivery with scheduled updates, cost control and quality at every stage.',
                'icon' => 'building',
            ],
            [
                'step' => '06',
                'title' => 'Handover & aftercare',
                'duration' => 'Ongoing',
                'body' => 'Commissioning, certification and responsive aftercare when you need us after handover.',
                'icon' => 'check',
            ],
        ];
        $processIcons = [
            'phone' => '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/>',
            'pencil' => '<path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>',
            'document' => '<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>',
            'clipboard' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z"/>',
            'building' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/>',
            'search' => '<path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>',
            'check' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
        ];
    @endphp

    <section id="process" class="bg-aqua-light py-20 lg:py-28 scroll-mt-24">
        <div class="max-w-[1100px] mx-auto px-4 sm:px-6 lg:px-10">
            <div class="text-center max-w-2xl mx-auto mb-10 space-y-4">
                <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-[#9ca3af]">
                    {{ $content['process_label'] ?? 'Our simple 6-step process' }}
                </p>
                <h2 class="text-4xl sm:text-5xl font-bold text-[#0f2a3a] leading-tight">
                    {{ $content['process_title'] ?? 'How your project works — start to finish' }}
                </h2>
                <p class="text-sm sm:text-[15px] text-[#6b7280] leading-relaxed">
                    {{ $content['process_subtitle'] ?? 'Whether you need full design & build support or already have plans, we keep every stage clear and accountable.' }}
                </p>
            </div>

            <div class="flex flex-col items-center gap-3 mb-10">
                <div id="process-toggle" class="inline-flex rounded-full border border-black/10 p-1 bg-[#f7f7f5]" role="tablist" aria-label="Project pathway">
                    <button type="button" data-process="design" role="tab" aria-selected="true"
                        class="process-tab is-active inline-flex items-center gap-2 rounded-full px-5 py-2.5 text-[12px] font-semibold transition-all text-white bg-brand">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">{!! $processIcons['pencil'] !!}</svg>
                        Design &amp; Build
                    </button>
                    <button type="button" data-process="build" role="tab" aria-selected="false"
                        class="process-tab inline-flex items-center gap-2 rounded-full px-5 py-2.5 text-[12px] font-semibold transition-all text-[#1a1a1a] bg-transparent">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">{!! $processIcons['building'] !!}</svg>
                        Build only
                    </button>
                </div>
                <p id="process-caption" class="inline-flex items-center gap-1.5 text-[12px] text-[#6b7280]">
                    <svg class="h-3.5 w-3.5 text-brand shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                    <span data-caption-design>{{ $content['process_caption_design'] ?? 'Full turnkey service — concept to completion' }}</span>
                    <span data-caption-build class="hidden">{{ $content['process_caption_build'] ?? 'You bring the plans — we deliver the build' }}</span>
                        </p>
                    </div>

            @foreach (['design' => $processDesign, 'build' => $processBuild] as $pathKey => $steps)
                <div id="process-grid-{{ $pathKey }}" class="process-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-5 {{ $pathKey === 'build' ? 'hidden' : '' }}">
                    @foreach ($steps as $step)
                        <article class="group rounded-2xl border border-black/[0.06] bg-[#fafafa] hover:bg-white p-6 lg:p-7 flex flex-col min-h-[230px] hover:border-brand/25 hover:shadow-[0_20px_40px_-28px_rgba(26,26,26,0.35)] transition-all duration-300">
                            <div class="flex items-start justify-between gap-3 mb-5">
                                <span class="text-[11px] font-semibold uppercase tracking-[0.18em] text-brand">Step {{ $step['step'] }}</span>
                                <span class="flex h-9 w-9 items-center justify-center rounded-full bg-white border border-black/5 text-brand/70 group-hover:bg-brand group-hover:text-white group-hover:border-brand transition-colors">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">{!! $processIcons[$step['icon']] !!}</svg>
                                </span>
                            </div>
                            <h3 class="font-heading text-2xl text-[#1a1a1a] font-medium leading-snug">{{ $step['title'] }}</h3>
                            <p class="mt-2 inline-flex items-center gap-1.5 text-[11px] uppercase tracking-[0.12em] text-[#9ca3af]">
                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $step['duration'] }}
                            </p>
                            <p class="mt-3 text-sm text-[#6b7280] leading-relaxed flex-1">{{ $step['body'] }}</p>
                        </article>
                    @endforeach
                </div>
            @endforeach

            <div class="mt-12 text-center">
                <a href="#" onclick="openTenderModal(); return false;"
                    class="inline-flex items-center gap-2 rounded-lg bg-brand px-8 py-3.5 text-xs font-bold uppercase tracking-[0.08em] text-white hover:bg-brand-dark transition-colors">
                    {{ $content['process_cta'] ?? 'Start your project today' }}
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                </a>
            </div>
                        </div>
    </section>

    {{-- What we do --}}
    @php
        $whatWeDoMeta = [
            'Pre-Construction' => [
                'label' => 'Pre-construction',
                'title' => 'Surveys, design & planning',
                'from' => 'Enquire for pricing',
                'blurb' => 'Early consultancy that de-risks the brief — surveys, design coordination and a clear route to site.',
            ],
            'Structural Works' => [
                'label' => 'Structure',
                'title' => 'Structural works & frames',
                'from' => 'Enquire for pricing',
                'blurb' => 'Concrete, steel, masonry and timber systems engineered for lasting performance.',
            ],
            'Interior Works' => [
                'label' => 'Interiors',
                'title' => 'Interiors & fit-out',
                'from' => 'Enquire for pricing',
                'blurb' => 'Precise finishes, partitions and joinery that turn shell and core into lived-in space.',
            ],
            'External Works' => [
                'label' => 'External',
                'title' => 'External works & landscape',
                'from' => 'Enquire for pricing',
                'blurb' => 'Hard landscaping, paving and outdoor construction that completes the setting.',
            ],
        ];
        $whatWeDoCards = collect($whatWeDoMeta)->map(function ($meta, $title) use ($services) {
            $srv = ($services ?? collect())->first(fn ($s) => $s->title === $title);
            return array_merge($meta, [
                'image' => $srv?->image_url,
                'slug' => $srv ? \Illuminate\Support\Str::slug($srv->title) : null,
                'fallback_title' => $title,
            ]);
        })->values();
    @endphp

    <section id="services" class="bg-white py-20 lg:py-28 scroll-mt-24 border-t border-black/[0.04]">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10">
            <div class="text-center max-w-2xl mx-auto mb-12 lg:mb-14 space-y-4">
                <div class="flex items-center justify-center gap-4">
                    <span class="hidden sm:block h-px w-16 bg-black/10"></span>
                    <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-[#9ca3af]">
                        {{ $content['services_label'] ?? 'What we do' }}
                    </p>
                    <span class="hidden sm:block h-px w-16 bg-black/10"></span>
                </div>
                <h2 class="text-4xl sm:text-5xl lg:text-[3.25rem] font-bold leading-tight text-[#0f2a3a]">
                    {{ $content['services_title_line1'] ?? 'One team.' }}
                    <span class="text-brand">{{ $content['services_title_line2'] ?? 'Every discipline.' }}</span>
                </h2>
                <p class="text-sm sm:text-[15px] text-[#6b7280] leading-relaxed">
                    {{ $content['services_subtitle'] ?? 'From pre-construction through structure, interiors and external works — one accountable team across every trade.' }}
                </p>
                </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-5">
                @foreach ($whatWeDoCards as $card)
                    @php
                        $href = $card['slug'] ? route('services.show', $card['slug']) : route('services.index');
                    @endphp
                    <a href="{{ $href }}" class="group relative aspect-[3/4.2] rounded-2xl overflow-hidden bg-[#1c1c1c] shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-500">
                        @if($card['image'])
                            <img src="{{ asset($card['image']) }}" alt="{{ $card['title'] }}" class="absolute inset-0 w-full h-full object-cover opacity-90 group-hover:opacity-100 group-hover:scale-105 transition-all duration-700">
                        @endif
                        <div class="absolute inset-0 bg-black/55"></div>
                        <div class="absolute bottom-0 inset-x-0 p-5 lg:p-6 space-y-2">
                            <span class="block text-[10px] font-semibold uppercase tracking-[0.2em] text-brand">{{ $card['label'] }}</span>
                            <h3 class="font-heading text-2xl text-white leading-snug">{{ $card['title'] }}</h3>
                            <p class="text-[10px] font-semibold uppercase tracking-[0.14em] text-white/70">{{ $card['from'] }}</p>
                            <p class="text-[13px] text-white/65 leading-relaxed line-clamp-3 pt-1">{{ $card['blurb'] }}</p>
                        </div>
                    </a>
                @endforeach
                    </div>

            <div class="mt-12 text-center space-y-4">
                <p class="text-sm text-[#6b7280]">{{ $content['services_cta_prompt'] ?? 'Looking for something specific?' }}</p>
                <a href="{{ route('services.index') }}"
                    class="inline-flex items-center gap-2 rounded-lg bg-brand px-7 py-3.5 text-xs font-bold uppercase tracking-[0.08em] text-white hover:bg-brand-dark transition-colors">
                    {{ $content['cta_explore_services_label'] ?? 'Explore all services' }}
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                </a>
            </div>
        </div>
    </section>

    {{-- 7. Sectors --}}
    <section id="sectors" class="bg-aqua-light py-20 lg:py-28 scroll-mt-24">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10">
            <div class="max-w-2xl mb-12 space-y-3">
                <span class="section-eyebrow">{{ $content['sectors_label'] ?? 'Where we work' }}</span>
                <h2 class="text-4xl sm:text-5xl font-bold text-[#0f2a3a]">{{ $content['sectors_title'] ?? 'Build typologies we know deeply' }}</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-5">
                @foreach($sectors as $sector)
                    <div class="rounded-2xl bg-white border border-black/[0.04] p-6 lg:p-7 hover:border-brand/25 hover:shadow-md transition-all duration-300">
                        <h3 class="font-heading text-2xl text-brand">{{ $sector['title'] }}</h3>
                        <p class="mt-2.5 text-sm text-[#6b7280] leading-relaxed">{{ $sector['desc'] }}</p>
                    </div>
                @endforeach
                    </div>
                </div>
    </section>

    {{-- Trusted partners / authorised suppliers --}}
    <section id="partners" class="bg-white py-16 lg:py-20 border-t border-black/5">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-10">
            <div class="text-center mb-8 lg:mb-10 space-y-2">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-[#0f2a3a]">
                    {{ $content['partners_title'] ?? 'Our Trusted Partners' }}
                </h2>
                <p class="text-[11px] sm:text-xs font-semibold uppercase tracking-[0.3em] text-brand">
                    {{ $content['partners_subtitle'] ?? 'Authorised suppliers' }}
                </p>
            </div>

            @if($partners->isNotEmpty())
                <div class="grid grid-cols-3 md:grid-cols-5 lg:grid-cols-6 gap-3 md:gap-4">
                    @foreach ($partners as $partner)
                        <div class="bg-white rounded-xl shadow-sm border border-black/[0.03] aspect-[3/2] flex items-center justify-center p-3 md:p-4 hover:shadow-md hover:border-brand/20 transition-all duration-300">
                            @if($partner->image_url)
                                <img
                                    src="{{ asset($partner->image_url) }}"
                                    alt="{{ $partner->name }}"
                                    class="max-h-12 md:max-h-14 w-auto max-w-full object-contain"
                                    loading="lazy"
                                >
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- 11. Our Leadership Team — NAB-style layout --}}
    <section id="leadership" class="bg-aqua-light py-16 sm:py-20 lg:py-24 scroll-mt-24">
        <div class="max-w-[1100px] mx-auto px-4 sm:px-6 lg:px-10">
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold uppercase tracking-[0.04em] text-[#0f2a3a]">
                    {{ $content['leadership_section_title'] ?? 'Our Leadership Team' }}
                </h2>
                <div class="mx-auto mt-3 sm:mt-4 h-[4px] w-[4.5rem] bg-brand"></div>
            </div>

            <div class="space-y-16 sm:space-y-20">
                @forelse($team as $member)
                    @php
                        $words = preg_split('/\s+/', trim($member->name)) ?: [];
                        $initials = strtoupper(substr($words[0] ?? 'T', 0, 1) . (isset($words[1]) ? substr($words[1], 0, 1) : ''));
                        $image = $member->image_url ?? null;
                        if ($image && !str_starts_with($image, 'http') && !str_starts_with($image, '/')) {
                            $image = asset($image);
                        } elseif ($image && str_starts_with($image, '/')) {
                            $image = asset(ltrim($image, '/'));
                        }
                        $paragraphs = preg_split("/\n\s*\n/", trim((string) ($member->description ?? ''))) ?: [];
                    @endphp
                    <article class="flex flex-col md:flex-row md:items-center gap-8 md:gap-12 lg:gap-16">
                        <div class="shrink-0 flex justify-center md:justify-start">
                            <div class="h-[180px] w-[180px] sm:h-[210px] sm:w-[210px] lg:h-[230px] lg:w-[230px] rounded-full overflow-hidden bg-[#e8e8e8] border border-[#d9d9d9] shadow-[0_2px_8px_rgba(0,0,0,0.06)]">
                                @if($image)
                                    <img src="{{ $image }}" alt="{{ $member->name }}" class="h-full w-full object-cover object-top">
                                @else
                                    <div class="h-full w-full flex items-center justify-center bg-brand text-white text-4xl font-semibold tracking-tight">
                                        {{ $initials }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="flex-1 min-w-0 text-center md:text-left">
                            <h3 class="text-[1.65rem] sm:text-[1.85rem] font-bold text-[#0f2a3a] leading-tight">{{ $member->name }}</h3>
                            <div class="mx-auto md:mx-0 mt-2.5 h-[3px] w-14 bg-brand"></div>
                            <p class="mt-3 text-[1.05rem] sm:text-lg font-bold uppercase tracking-[0.02em] text-[#0f2a3a]">{{ $member->role }}</p>
                            <div class="mt-4 space-y-4 text-[15px] sm:text-[16px] text-[#777777] leading-[1.7] max-w-[640px] mx-auto md:mx-0">
                                @foreach($paragraphs as $paragraph)
                                    @if(trim($paragraph) !== '')
                                        <p>{{ trim($paragraph) }}</p>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </article>
                @empty
                    <p class="text-center text-sm text-[#777777]">Leadership profiles will appear here once team members are added in the admin.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- 12. Insights --}}
    <section id="blog" class="bg-white py-20 lg:py-28 scroll-mt-24">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10">
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-12">
                <div class="space-y-3">
                    <span class="section-eyebrow">{{ $content['blog_label'] ?? 'Insights' }}</span>
                <h2 class="text-4xl sm:text-5xl font-bold text-[#0f2a3a]">{{ $content['blog_title'] ?? 'Notes from the studio and site' }}</h2>
                </div>
                <a href="{{ route('blog.index') }}" class="text-[11px] font-semibold uppercase tracking-[0.14em] text-brand">{{ $content['cta_view_all_posts_label'] ?? 'View all insights' }} →</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($blogs->take(3) as $blog)
                    <article class="group">
                        <div class="aspect-[16/10] overflow-hidden bg-aqua-light mb-5 rounded-2xl">
                                @if($blog->image_url)
                                <a href="{{ route('blog.show', $blog->slug) }}">
                                    <img src="{{ asset($blog->image_url) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                </a>
                                @endif
                        </div>
                        <span class="text-[10px] uppercase tracking-[0.16em] text-[#9ca3af]">{{ $blog->published_at ? $blog->published_at->format('M d, Y') : '' }}</span>
                        <h3 class="font-heading text-2xl text-[#1a1a1a] mt-2 leading-snug">
                            <a href="{{ route('blog.show', $blog->slug) }}" class="hover:text-brand transition-colors">{{ $blog->title }}</a>
                        </h3>
                        <p class="mt-2 text-sm text-[#6b7280] line-clamp-2">{{ $blog->excerpt }}</p>
                    </article>
                @empty
                    <p class="text-sm text-[#6b7280] col-span-3">No posts yet.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Black CTA bar --}}
    <section class="relative bg-brand text-white py-16 lg:py-20 overflow-hidden">
        <div class="pointer-events-none absolute inset-0 bg-brand/20"></div>
        <div class="relative max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10 flex flex-col md:flex-row md:items-center md:justify-between gap-8">
            <div class="max-w-xl">
                <h2 class="font-heading text-3xl sm:text-4xl lg:text-[2.75rem] font-medium leading-tight">{{ $content['pre_footer_cta_title'] ?? 'Ready to build with clarity and craft?' }}</h2>
                <p class="mt-3 text-sm text-white/55 max-w-lg">{{ $content['pre_footer_cta_subtitle'] ?? 'Tell us about your space, timeline and ambitions.' }}</p>
            </div>
            <a href="#" onclick="openTenderModal(); return false;" class="inline-flex shrink-0 items-center gap-2 rounded-lg px-8 py-3.5 text-xs font-bold uppercase tracking-[0.08em] text-brand bg-white hover:bg-aqua-light transition-colors shadow-lg">
                {{ $content['cta_get_free_quote_label'] ?? 'Book a consultation' }}
                <span aria-hidden="true">→</span>
            </a>
        </div>
    </section>
@endsection

@section('scripts-ready')
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('#desktop-nav .nav-link');
    function changeActiveLink() {
        let index = sections.length;
        while (--index && window.scrollY + 120 < sections[index].offsetTop) {}
        const activeId = sections[index] ? sections[index].getAttribute('id') : '';
        navLinks.forEach((link) => {
            const targetId = link.getAttribute('data-scroll');
            if (targetId && targetId === activeId) {
                link.classList.add('is-active');
            } else {
                link.classList.remove('is-active');
            }
        });
    }
    changeActiveLink();
    window.addEventListener('scroll', changeActiveLink);

    const projectsCarousel = document.getElementById('projects-carousel');
    const projectsPrev = document.getElementById('projects-prev');
    const projectsNext = document.getElementById('projects-next');
    if (projectsCarousel && projectsPrev && projectsNext) {
        const scrollByCard = (dir) => {
            const card = projectsCarousel.querySelector('a');
            const amount = card ? card.getBoundingClientRect().width + 16 : 280;
            projectsCarousel.scrollBy({ left: dir * amount, behavior: 'smooth' });
        };
        projectsPrev.addEventListener('click', () => scrollByCard(-1));
        projectsNext.addEventListener('click', () => scrollByCard(1));
    }

    const processTabs = document.querySelectorAll('.process-tab');
    const captionDesign = document.querySelector('[data-caption-design]');
    const captionBuild = document.querySelector('[data-caption-build]');
    processTabs.forEach((tab) => {
        tab.addEventListener('click', () => {
            const path = tab.getAttribute('data-process');
            processTabs.forEach((t) => {
                const active = t === tab;
                t.setAttribute('aria-selected', active ? 'true' : 'false');
                t.classList.toggle('is-active', active);
                t.classList.toggle('text-white', active);
                t.classList.toggle('bg-brand', active);
                t.classList.toggle('text-[#1a1a1a]', !active);
                t.classList.toggle('bg-transparent', !active);
            });
            document.querySelectorAll('.process-grid').forEach((grid) => {
                grid.classList.toggle('hidden', grid.id !== `process-grid-${path}`);
            });
            if (captionDesign && captionBuild) {
                captionDesign.classList.toggle('hidden', path !== 'design');
                captionBuild.classList.toggle('hidden', path !== 'build');
            }
        });
    });
@endsection
