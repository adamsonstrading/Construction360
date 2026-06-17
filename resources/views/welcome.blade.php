@extends('layouts.public')

@section('title', $content['seo_meta_title'] ?? 'Integrated Construction & Premium Architectural Builds')

@section('meta')
    <meta name="description" content="{{ $content['seo_meta_description'] ?? ($content['hero_subtitle'] ?? 'We deliver 360-degree integration of design, structural planning, and premium quality construction management.') }}">
    <meta name="keywords" content="{{ $content['seo_meta_keywords'] ?? 'construction, architectural builds, structural engineering, commercial fit-outs, extensions, renovations, glazing, Essex, London' }}">
    <link rel="canonical" href="https://construction360.co">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://construction360.co">
    <meta property="og:title" content="{{ $content['seo_meta_title'] ?? ($content['hero_title'] ?? 'Integrated Construction & Premium Architectural Builds') }} | Construction 360 Ltd">
    <meta property="og:description" content="{{ $content['seo_meta_description'] ?? ($content['hero_subtitle'] ?? 'We deliver 360-degree integration of design, structural planning, and premium quality construction management.') }}">
    <meta property="og:image" content="{{ asset('images/hero_construction.png') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://construction360.co">
    <meta property="twitter:title" content="{{ $content['seo_meta_title'] ?? ($content['hero_title'] ?? 'Integrated Construction & Premium Architectural Builds') }} | Construction 360 Ltd">
    <meta property="twitter:description" content="{{ $content['seo_meta_description'] ?? ($content['hero_subtitle'] ?? 'We deliver 360-degree integration of design, structural planning, and premium quality construction management.') }}">
    <meta property="twitter:image" content="{{ asset('images/hero_construction.png') }}">

    <!-- Structured JSON-LD Data for local SEO -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "ConstructionBusiness",
      "name": "Construction 360 Ltd",
      "image": "{{ asset('images/hero_construction.png') }}",
      "url": "https://construction360.co",
      "email": "{{ $content['header_email'] ?? 'info@construction360.co' }}",
      "areaServed": "Essex, London, United Kingdom",
      "description": "{{ $content['hero_subtitle'] ?? 'Providing the highest standard of planning, design, and structural construction.' }}",
      "sameAs": [
        "https://www.360developmentsltd.com"
      ],
      "knowsAbout": [
        "Structural Engineering & Design",
        "Commercial fit-outs",
        "Extensions & Renovations",
        "Bespoke Window & Glazing Installations"
      ]
    }
    </script>
@endsection

@section('content')
    <!-- Competitor-Matched Hero Section -->
    <section id="hero" class="relative w-full min-h-[600px] lg:min-h-[850px] bg-white pt-8 lg:pt-12 pb-20 px-6 lg:px-8 overflow-hidden border-b border-slate-100">
        <!-- Abstract Structural Grid lines SVG Background (Minimalist) -->
        <div class="absolute inset-0 z-0 opacity-[0.03] pointer-events-none">
            <svg class="w-full h-full text-slate-800" fill="none" viewBox="0 0 100 100" preserveAspectRatio="none">
                <line x1="0" y1="20" x2="100" y2="20" stroke="currentColor" stroke-width="0.05" />
                <line x1="0" y1="40" x2="100" y2="40" stroke="currentColor" stroke-width="0.05" />
                <line x1="0" y1="60" x2="100" y2="60" stroke="currentColor" stroke-width="0.05" />
                <line x1="0" y1="80" x2="100" y2="80" stroke="currentColor" stroke-width="0.05" />
                <line x1="20" y1="0" x2="20" y2="100" stroke="currentColor" stroke-width="0.05" />
                <line x1="40" y1="0" x2="40" y2="100" stroke="currentColor" stroke-width="0.05" />
                <line x1="60" y1="0" x2="60" y2="100" stroke="currentColor" stroke-width="0.05" />
                <line x1="80" y1="0" x2="80" y2="100" stroke="currentColor" stroke-width="0.05" />
                <circle cx="50" cy="50" r="35" stroke="currentColor" stroke-width="0.08" stroke-dasharray="1 1" />
                <circle cx="50" cy="50" r="45" stroke="currentColor" stroke-width="0.05" />
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center pb-12 lg:pb-20 pt-4 lg:pt-8">
                <!-- Left Column: Content & Action Buttons -->
                <div class="lg:col-span-6 space-y-8">
                    <span class="text-xs font-bold uppercase tracking-widest text-[#84cc16]">Construction 360 Ltd</span>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-slate-950 font-heading leading-tight">
                        {{ $content['hero_title'] ?? 'Integrated Construction & Premium Architectural Builds' }}
                    </h1>
                    <p class="text-base sm:text-lg text-slate-600 leading-relaxed font-sans max-w-2xl">
                        {{ $content['hero_subtitle'] ?? 'Building your vision with geometric precision. Providing the highest standard of planning, design, and structural construction.' }}
                    </p>
                    <div class="flex flex-wrap gap-4 pt-2">
                        <a href="#" onclick="openTenderModal(); return false;" class="inline-flex items-center justify-center text-xs font-bold uppercase tracking-widest text-white bg-slate-950 hover:bg-slate-800 px-8 py-4 rounded-full shadow-lg transition-all duration-200">
                            Submit Tender Brief
                        </a>
                        <a href="#services" class="inline-flex items-center justify-center text-xs font-bold uppercase tracking-widest text-slate-700 border border-slate-200 bg-white hover:bg-slate-50 px-8 py-4 rounded-full shadow-sm transition-all duration-200">
                            Explore Services
                        </a>
                    </div>
                </div>

                <!-- Right Column: Image Container with CSCS badge -->
                <div class="lg:col-span-6 relative">
                    <!-- Image container -->
                    <div class="relative w-full aspect-[4/3] sm:aspect-[16/10] rounded-[30px] overflow-hidden border border-slate-200 bg-slate-100 shadow-xl group">
                        <img src="{{ asset('images/hero_construction.png') }}" alt="Construction 360 Ltd Build Site" class="w-full h-full object-cover group-hover:scale-103 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/20 to-transparent"></div>
                        
                        <!-- Floating Badge in bottom-left -->
                        <div class="absolute bottom-6 left-6 bg-slate-950/90 text-white backdrop-blur-sm px-4 py-2.5 rounded-lg border border-white/10 flex items-center space-x-2 shadow-lg">
                            <span class="h-2 w-2 rounded-full bg-[#84cc16] animate-pulse"></span>
                            <span class="text-[10px] font-bold uppercase tracking-wider">CSCS Approved / Safety Compliant</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us Section Redesign -->
    <section id="about" class="py-24 bg-white text-slate-900 border-b border-slate-100 scroll-mt-20 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Huge Heading spanning top -->
            <div class="mb-16">
                <h2 class="text-5xl sm:text-6xl lg:text-7xl font-extrabold text-[#0f284d] tracking-tighter leading-[1.05] max-w-3xl">
                    We build more than just structures,<br>we build dreams
                </h2>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-stretch">
                
                <!-- Left Column (Main Image) -->
                <div class="lg:col-span-4 h-full relative group rounded-2xl overflow-hidden shadow-sm border border-slate-200">
                    <img src="{{ asset('images/about_engineering.png') }}" alt="Construction 360 Building" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 min-h-[400px]">
                </div>

                <!-- Middle Column (Vision, Mission, Values) -->
                <div class="lg:col-span-4 space-y-10 py-4 flex flex-col justify-center pl-0 lg:pl-4">
                    <!-- Vision -->
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3 text-[#0f284d]">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                            </svg>
                            <h3 class="text-xl font-bold tracking-tight">Our vision</h3>
                        </div>
                        <p class="text-slate-600 text-sm leading-relaxed">
                            Shaping London's skyline through innovative design and exceptional construction.
                        </p>
                    </div>
                    
                    <!-- Mission -->
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3 text-[#0f284d]">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 01-5.84 7.36c-5.91.5-9.25-4.14-9.25-9.14A9 9 0 019.5 3a5.98 5.98 0 014.28 1.48m5.84 7.36l-3.32-3.32m3.32 3.32A7.95 7.95 0 0019.5 12c0-2.28-.95-4.34-2.48-5.8m0 0L14 3.14m3.02 3.08a7.96 7.96 0 00-6.1-2.45m0 0l-1.32 1.32" />
                            </svg>
                            <h3 class="text-xl font-bold tracking-tight">Our mission</h3>
                        </div>
                        <p class="text-slate-600 text-sm leading-relaxed">
                            To deliver outstanding residential and commercial developments across London, combining visionary design with meticulous craftsmanship and unwavering client commitment.
                        </p>
                    </div>

                    <!-- Values -->
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3 text-[#0f284d]">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="text-xl font-bold tracking-tight">Our values</h3>
                        </div>
                        <p class="text-slate-600 text-sm leading-relaxed">
                            Through Integrity, Excellence, Innovation, success along Partnership.
                        </p>
                    </div>
                </div>

                <!-- Right Column (Green Card & Overlapping Image) -->
                <div class="lg:col-span-4 relative mt-24 lg:mt-0 lg:pt-24 flex items-stretch">
                    <!-- Overlapping image placed absolutely relative to this column -->
                    <div class="absolute -top-16 left-1/2 -translate-x-1/2 w-[85%] z-10 mix-blend-multiply drop-shadow-2xl opacity-90 hidden sm:block">
                        <img src="{{ asset('images/about_overlap.png') }}" alt="Project cutout" class="w-full object-contain mix-blend-multiply drop-shadow-xl" style="mask-image: linear-gradient(to bottom, black 80%, transparent 100%); -webkit-mask-image: linear-gradient(to bottom, black 80%, transparent 100%);">
                    </div>

                    <div class="bg-[#84cc16] text-[#0f284d] rounded-2xl p-10 flex flex-col justify-between relative shadow-2xl w-full">
                        <!-- Content inside green card -->
                        <div class="pt-16 sm:pt-24 z-20 relative">
                            <p class="text-2xl sm:text-3xl font-extrabold tracking-tight leading-snug">
                                "With over 12 years of experience, we are committed to delivering premium quality & craftmanship."
                            </p>
                        </div>
                        
                        <div class="mt-16 flex items-end justify-between z-20 relative">
                            <span class="text-xs font-bold uppercase tracking-widest text-white">Founder & CEO</span>
                            
                            <!-- Stamp/Seal Graphic -->
                            <div class="w-16 h-16 rounded-full border border-[#0f284d]/20 flex items-center justify-center opacity-40 animate-spin-slow">
                                <svg viewBox="0 0 100 100" class="w-full h-full text-[#0f284d] fill-current">
                                    <path id="curve" d="M 50, 50 m -35, 0 a 35,35 0 1,1 70,0 a 35,35 0 1,1 -70,0" fill="transparent" />
                                    <text font-size="12" font-weight="bold" letter-spacing="2">
                                        <textPath href="#curve" startOffset="0%">• CONSTRUCTION 360 • LONDON</textPath>
                                    </text>
                                </svg>
                            </div>
                        </div>
                        
                        <!-- Accent graphics inside the card -->
                        <div class="absolute inset-0 opacity-10 pointer-events-none rounded-2xl overflow-hidden">
                            <svg class="absolute top-0 right-0 h-full w-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                                <polygon points="0,100 100,0 100,100" fill="currentColor"/>
                            </svg>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-28 bg-white border-b border-slate-100 scroll-mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mb-20">
                <div class="max-w-2xl">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-[#84cc16]">Marking Benchmarks</span>
                    <h2 class="text-4xl sm:text-5xl font-extrabold text-slate-950 mt-3 tracking-tighter leading-none">
                        Principle Contractor in construction
                    </h2>
                </div>
                <div>
                    <a href="#" onclick="openTenderModal(); return false;" class="inline-flex items-center text-xs font-bold uppercase tracking-widest text-slate-900 bg-[#84cc16] hover:bg-[#65a30d] hover:text-white px-6 py-3.5 rounded-full shadow-sm transition-all duration-200">
                        Ask for a quote
                    </a>
                </div>
            </div>

            <!-- Services Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($services as $idx => $srv)
                    @php
                        $slug = \Illuminate\Support\Str::slug($srv->title);
                        $num = str_pad($idx + 1, 2, '0', STR_PAD_LEFT);
                        // Map images based on service index
                        $imgMap = [
                            'service_design_planning.png',
                            'service_commercial.png',
                            'service_residential.png',
                            'service_facilities.png'
                        ];
                        $img = $imgMap[$idx % 4] ?? 'service_design_planning.png';
                    @endphp
                    <div class="bg-white border border-slate-150 shadow-sm rounded-2xl overflow-hidden hover:border-slate-350 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                        <div>
                            <!-- Card Image -->
                            <div class="h-48 w-full overflow-hidden bg-slate-100 relative group">
                                <img src="{{ asset('images/' . $img) }}" alt="{{ $srv->title }}" class="object-cover h-full w-full group-hover:scale-102 transition-transform duration-500">
                                <span class="absolute top-4 left-4 text-xs font-bold text-white bg-slate-950/80 px-2.5 py-1 rounded shadow-sm">{{ $num }}</span>
                            </div>
                            <!-- Card Body -->
                            <div class="p-6 space-y-3">
                                <h3 class="text-lg font-bold text-slate-950 font-sans tracking-tight">{{ $srv->title }}</h3>
                                <p class="text-xs text-slate-500 leading-relaxed font-sans line-clamp-4">{{ $srv->description }}</p>
                            </div>
                        </div>
                        <div class="p-6 pt-0 border-t border-slate-100 mt-4 flex items-center justify-between">
                            <a href="{{ route('services.show', $slug) }}" class="text-xs font-bold text-slate-900 hover:text-aqua transition-colors flex items-center group/btn evoke-link">
                                Explore Service
                                <svg class="ml-1.5 h-3.5 w-3.5 group-hover/btn:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="bg-white border border-slate-200 rounded-xl p-6">
                        <h3 class="text-base font-bold text-slate-900">Engineering Design</h3>
                        <p class="mt-2 text-sm text-slate-500">Premium structural calculations and engineering planning.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Projects Portfolio Section -->
    <section id="projects" class="py-28 bg-slate-50/50 border-b border-slate-100 scroll-mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end gap-8 mb-20">
                <div class="max-w-2xl">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-aqua">Selected Scopes</span>
                    <h2 class="text-4xl sm:text-5xl font-extrabold text-slate-950 mt-3 tracking-tighter leading-none">
                        Explore our diverse portfolio
                    </h2>
                </div>
                
                <!-- Filter Tabs -->
                <div class="flex flex-wrap gap-2 pt-4 lg:pt-0">
                    <button id="filter-btn-all" onclick="filterProjects('all')" class="px-5 py-2.5 rounded-full border border-slate-950 bg-slate-950 text-white text-xs font-bold uppercase tracking-widest transition-all focus:outline-none">
                        All Projects
                    </button>
                    <button id="filter-btn-completed" onclick="filterProjects('completed')" class="px-5 py-2.5 rounded-full border border-slate-200 text-slate-650 hover:border-slate-400 bg-white text-xs font-bold uppercase tracking-widest transition-all focus:outline-none">
                        Completed Projs.
                    </button>
                    <button id="filter-btn-under-construction" onclick="filterProjects('under-construction')" class="px-5 py-2.5 rounded-full border border-slate-200 text-slate-650 hover:border-slate-400 bg-white text-xs font-bold uppercase tracking-widest transition-all focus:outline-none">
                        Under Developm.
                    </button>
                </div>
            </div>

            <!-- Projects Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($projects as $proj)
                    @php
                        $slug = $proj->slug ?: \Illuminate\Support\Str::slug($proj->title);
                        $categoryClass = strtolower($proj->status); // completed or under-construction
                    @endphp
                    <div class="project-card bg-white border border-slate-150 rounded-2xl overflow-hidden hover:border-slate-350 transition-all duration-300 flex flex-col justify-between" data-category="{{ $categoryClass }}">
                        <div>
                            <!-- Cover Image -->
                            <div class="h-60 w-full overflow-hidden bg-slate-100 border-b border-slate-100 relative group">
                                @if($proj->image_url)
                                    <img src="{{ asset($proj->image_url) }}" alt="{{ $proj->title }}" class="object-cover h-full w-full group-hover:scale-105 transition-transform duration-700">
                                @else
                                    <div class="h-full w-full bg-slate-50 flex items-center justify-center">
                                        <svg class="h-10 w-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M6.429 9.75L2.25 12l4.179 2.25m11.142 0L21.75 12l-4.179-2.25M12 5.25L16.179 7.5 12 9.75 7.821 7.5 12 5.25zm0 9l4.179 2.25L12 18.75l-4.179-2.25 4.179-2.25zm0-4.5l4.179 2.25L12 14.25l-4.179-2.25 4.179-2.25z" />
                                        </svg>
                                    </div>
                                @endif
                                <span class="absolute top-4 left-4 text-[9px] font-bold text-slate-800 bg-white border border-slate-200 px-2.5 py-1 rounded shadow-sm uppercase tracking-wider">{{ $proj->category }}</span>
                                <span class="absolute top-4 right-4 text-[9px] font-bold text-white bg-slate-950/80 border border-white/10 px-2.5 py-1 rounded shadow-sm uppercase tracking-wider">
                                    {{ $proj->status === 'completed' ? 'Completed' : 'Under Dev' }}
                                </span>
                            </div>
                            <!-- Card Body -->
                            <div class="p-6 space-y-3">
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block">{{ $proj->location ? $proj->location . ' • ' : '' }}{{ $proj->year }}</span>
                                <h3 class="text-lg font-bold text-slate-950 tracking-tight leading-snug">
                                    <a href="{{ route('projects.show', $slug) }}" class="hover:text-aqua transition-colors">
                                        {{ $proj->title }}
                                    </a>
                                </h3>
                                <p class="text-xs text-slate-500 leading-relaxed font-sans line-clamp-3">{{ $proj->description }}</p>
                            </div>
                        </div>
                        <!-- View Details CTA -->
                        <div class="p-6 pt-0 border-t border-slate-100 mt-4 flex items-center justify-between">
                            <a href="{{ route('projects.show', $slug) }}" class="text-xs font-bold text-slate-900 hover:text-aqua transition-colors flex items-center group/btn evoke-link">
                                View Details
                                <svg class="ml-1.5 h-3.5 w-3.5 group-hover/btn:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-16 bg-slate-50 border border-slate-200 rounded-xl">
                        <p class="text-sm text-slate-500">No projects listed yet.</p>
                    </div>
                @endforelse
            </div>

            <!-- View All Projects CTA Button -->
            <div class="mt-16 text-center">
                <a href="{{ route('projects.index') }}" class="inline-flex items-center justify-center px-6 py-3.5 text-xs font-bold uppercase tracking-widest text-white bg-slate-950 hover:bg-slate-800 rounded-lg shadow-sm transition-all duration-200">
                    Explore Full Portfolio
                </a>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section id="why-choose-us" class="py-28 bg-white border-b border-slate-100 scroll-mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mb-20">
                <span class="text-[10px] font-bold uppercase tracking-widest text-aqua">Operational Assurances</span>
                <h2 class="text-4xl sm:text-5xl font-extrabold text-slate-950 mt-3 tracking-tighter leading-none">
                    An exceptional quality that can't be beaten
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Card 1: Operational Excellence -->
                <div class="bg-white border border-slate-150 rounded-2xl p-8 hover:border-slate-350 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="h-10 w-10 rounded-lg bg-sky-50 border border-sky-100 flex items-center justify-center text-aqua mb-6">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                            </svg>
                        </div>
                        <h3 class="text-base font-bold text-slate-900 font-sans tracking-tight">Operational Excellence</h3>
                        <p class="mt-3 text-xs sm:text-sm text-slate-500 leading-relaxed font-sans">
                            We hold full ISO and FORS accreditations, ensuring our processes are rigorous, compliant, and efficient.
                        </p>
                    </div>
                </div>

                <!-- Card 2: London Specialists -->
                <div class="bg-white border border-slate-150 rounded-2xl p-8 hover:border-slate-350 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="h-10 w-10 rounded-lg bg-sky-50 border border-sky-100 flex items-center justify-center text-aqua mb-6">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <h3 class="text-base font-bold text-slate-900 font-sans tracking-tight">London Specialists</h3>
                        <p class="mt-3 text-xs sm:text-sm text-slate-500 leading-relaxed font-sans">
                            Experts in London Landscape. With 25+ projects across Capital, we specialise in navigating the complexities of London.
                        </p>
                    </div>
                </div>

                <!-- Card 3: Quality Assurance -->
                <div class="bg-white border border-slate-150 rounded-2xl p-8 hover:border-slate-350 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="h-10 w-10 rounded-lg bg-sky-50 border border-sky-100 flex items-center justify-center text-aqua mb-6">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-base font-bold text-slate-900 font-sans tracking-tight">Quality Assurance</h3>
                        <p class="mt-3 text-xs sm:text-sm text-slate-500 leading-relaxed font-sans">
                            We refuse to cut corners, applying strict quality controls to ensure superior craftsmanship in every trade.
                        </p>
                    </div>
                </div>

                <!-- Card 4: Financial Clarity -->
                <div class="bg-white border border-slate-150 rounded-2xl p-8 hover:border-slate-350 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="h-10 w-10 rounded-lg bg-sky-50 border border-sky-100 flex items-center justify-center text-aqua mb-6">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-base font-bold text-slate-900 font-sans tracking-tight">Financial Clarity</h3>
                        <p class="mt-3 text-xs sm:text-sm text-slate-500 leading-relaxed font-sans">
                            Our detailed cost breakdowns and project management ensure you stay informed, in control, & confident in your investment throughout the build.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Client Testimonials Section -->
    <section class="py-28 bg-slate-50/50 border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-20">
                <span class="text-[10px] font-bold uppercase tracking-widest text-aqua">Client Feedback</span>
                <h2 class="text-4xl sm:text-5xl font-extrabold text-slate-950 mt-3 tracking-tighter leading-none">Verified Testimonials</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="relative bg-white rounded-2xl p-8 border border-slate-150 shadow-sm flex flex-col justify-between hover:border-slate-350 transition-all duration-300">
                    <span class="absolute top-2 left-4 text-7xl font-serif text-sky-100 pointer-events-none select-none">“</span>
                    <div class="relative z-10">
                        <p class="text-sm sm:text-base text-slate-700 italic leading-relaxed font-sans">
                            “{{ $content['testimonial_1_quote'] ?? 'Great company to do business with. Good standard of work and very reliable. Would definitely use again!' }}”
                        </p>
                    </div>
                    <div class="mt-8 border-t border-slate-100 pt-4">
                        <span class="block font-bold text-slate-950 text-sm tracking-wide">{{ $content['testimonial_1_author'] ?? 'Colin Ashworth' }}</span>
                        <span class="block text-[10px] text-slate-400 font-bold uppercase mt-0.5 tracking-wider">{{ $content['testimonial_1_role'] ?? 'Essex Homeowner' }}</span>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="relative bg-white rounded-2xl p-8 border border-slate-150 shadow-sm flex flex-col justify-between hover:border-slate-350 transition-all duration-300">
                    <span class="absolute top-2 left-4 text-7xl font-serif text-sky-100 pointer-events-none select-none">“</span>
                    <div class="relative z-10">
                        <p class="text-sm sm:text-base text-slate-700 italic font-sans">
                            “{{ $content['testimonial_2_quote'] ?? '360 developments managed our full commercial fit-out from planning drawings to final handover. Completed on time, within budget, and to absolute tolerances.' }}”
                        </p>
                    </div>
                    <div class="mt-8 border-t border-slate-100 pt-4">
                        <span class="block font-bold text-slate-950 text-sm tracking-wide">{{ $content['testimonial_2_author'] ?? 'David Vance' }}</span>
                        <span class="block text-[10px] text-slate-400 font-bold uppercase mt-0.5 tracking-wider">{{ $content['testimonial_2_role'] ?? 'Director, Vanguard Retail Group' }}</span>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="relative bg-white rounded-2xl p-8 border border-slate-150 shadow-sm flex flex-col justify-between hover:border-slate-350 transition-all duration-300">
                    <span class="absolute top-2 left-4 text-7xl font-serif text-sky-100 pointer-events-none select-none">“</span>
                    <div class="relative z-10">
                        <p class="text-sm sm:text-base text-slate-700 italic leading-relaxed font-sans">
                            “{{ $content['testimonial_3_quote'] ?? 'Superb execution on our double-height rear extension. The digital progress logs kept us updated at every stage, and the structural finish is second to none.' }}”
                        </p>
                    </div>
                    <div class="mt-8 border-t border-slate-100 pt-4">
                        <span class="block font-bold text-slate-950 text-sm tracking-wide">{{ $content['testimonial_3_author'] ?? 'Eleanor Finch' }}</span>
                        <span class="block text-[10px] text-slate-400 font-bold uppercase mt-0.5 tracking-wider">{{ $content['testimonial_3_role'] ?? 'Residential Client, Chelmsford' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Recognitions Marquee Section -->
    <section class="py-16 bg-slate-950 text-white overflow-hidden relative border-t border-b border-slate-900">
        <!-- Scrolling Marquee container -->
        <div class="relative w-full flex overflow-x-hidden">
            <!-- First marquee run -->
            <div class="animate-marquee whitespace-nowrap flex items-center space-x-12 pr-12 text-lg sm:text-xl font-bold uppercase tracking-widest text-slate-450 font-heading select-none">
                <span>Accreditations</span>
                <span class="text-aqua">•</span>
                <span>Memberships</span>
                <span class="text-[#84cc16]">•</span>
                <span>Incorporation 2013</span>
                <span class="text-aqua">•</span>
                <span>ISO 9001 Certified</span>
                <span class="text-[#84cc16]">•</span>
                <span>ISO 14001 Certified</span>
                <span class="text-aqua">•</span>
                <span>Fleet Operator Recognition Scheme</span>
                <span class="text-[#84cc16]">•</span>
                <span>Federation of Master Builders</span>
                <span class="text-aqua">•</span>
                <span>ConstructionLine Silver membership</span>
                <span class="text-[#84cc16]">•</span>
            </div>
            <!-- Second marquee run for seamless loop -->
            <div class="absolute top-0 left-0 animate-marquee2 whitespace-nowrap flex items-center space-x-12 pr-12 text-lg sm:text-xl font-bold uppercase tracking-widest text-slate-450 font-heading select-none">
                <span>Accreditations</span>
                <span class="text-aqua">•</span>
                <span>Memberships</span>
                <span class="text-[#84cc16]">•</span>
                <span>Incorporation 2013</span>
                <span class="text-aqua">•</span>
                <span>ISO 9001 Certified</span>
                <span class="text-[#84cc16]">•</span>
                <span>ISO 14001 Certified</span>
                <span class="text-aqua">•</span>
                <span>Fleet Operator Recognition Scheme</span>
                <span class="text-[#84cc16]">•</span>
                <span>Federation of Master Builders</span>
                <span class="text-aqua">•</span>
                <span>ConstructionLine Silver membership</span>
                <span class="text-[#84cc16]">•</span>
            </div>
        </div>
    </section>

    <!-- Corporate Team Section -->
    <section id="team" class="py-28 bg-white border-b border-slate-100 scroll-mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="max-w-3xl mb-20">
                <span class="text-[10px] font-bold uppercase tracking-widest text-[#84cc16]">{{ $content['team_section_label'] ?? 'Operational Leadership' }}</span>
                <h2 class="text-4xl sm:text-5xl font-extrabold text-slate-950 mt-3 tracking-tighter leading-none">{{ $content['team_section_title'] ?? 'Our Core Project Team' }}</h2>
                <p class="mt-4 text-sm sm:text-base text-slate-500 leading-relaxed font-sans max-w-xl">
                    {{ $content['team_section_subtitle'] ?? 'A dedicated team of design partners, IStructE engineers, and quantity surveyors coordinating structural execution with digital precision.' }}
                </p>
            </div>

            <!-- Team Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($team as $member)
                    <div class="bg-white border border-slate-150 rounded-2xl p-8 flex flex-col items-center text-center hover:border-slate-350 transition-all duration-300">
                        @php
                            $words = explode(' ', trim($member->name));
                            $initials = strtoupper(substr($words[0] ?? 'T', 0, 1) . (isset($words[1]) ? substr($words[1], 0, 1) : ''));
                        @endphp
                        <div class="h-28 w-28 rounded-full bg-slate-950 border-2 border-aqua flex items-center justify-center mb-6 shadow-md relative overflow-hidden select-none flex-shrink-0">
                            @if($member->image_url)
                                <img src="{{ asset($member->image_url) }}" alt="{{ $member->name }}" class="object-cover h-full w-full">
                            @else
                                <span class="text-2xl font-black tracking-wider font-sans text-white">{{ $initials }}</span>
                                <div class="absolute inset-0 bg-gradient-to-tr from-aqua/10 to-transparent"></div>
                            @endif
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 tracking-tight">{{ $member->name }}</h3>
                        <p class="text-[10px] font-bold text-aqua uppercase tracking-widest mt-1">{{ $member->role }}</p>
                        <p class="mt-4 text-xs text-slate-500 leading-relaxed font-sans max-w-xs">
                            {{ $member->description }}
                        </p>
                        
                        <!-- Accreditations row -->
                        <div class="mt-6 flex flex-wrap gap-1.5 justify-center">
                            @foreach(explode(',', $member->accreditations ?? '') as $badge)
                                @if(trim($badge))
                                    <span class="text-[9px] font-bold uppercase tracking-wider text-slate-650 bg-slate-100 px-2.5 py-1 rounded border border-slate-200">{{ trim($badge) }}</span>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-16 bg-slate-50 border border-slate-200 rounded-xl">
                        <p class="text-sm text-slate-500">No team members listed yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Blog Section -->
    <section id="blog" class="py-28 bg-slate-50/50 border-b border-slate-100 scroll-mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="max-w-3xl mb-20">
                <span class="text-[10px] font-bold uppercase tracking-widest text-[#84cc16]">Blueprints & Blue Skies</span>
                <h2 class="text-4xl sm:text-5xl font-extrabold text-slate-950 mt-3 tracking-tighter leading-none">
                    Discover inspiration and trends
                </h2>
            </div>

            <!-- Blog Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($blogs->take(3) as $blog)
                    <div class="bg-white border border-slate-150 shadow-sm rounded-2xl overflow-hidden flex flex-col justify-between hover:border-slate-350 transition-all duration-300">
                        <div>
                            <!-- Cover Image -->
                            <div class="h-56 w-full overflow-hidden bg-slate-100 relative">
                                @if($blog->image_url)
                                    <a href="{{ route('blog.show', $blog->slug) }}" class="block h-full w-full">
                                        <img src="{{ asset($blog->image_url) }}" alt="{{ $blog->title }}" class="object-cover h-full w-full hover:scale-102 transition-transform duration-500">
                                    </a>
                                @else
                                    <div class="h-full w-full bg-slate-50 flex items-center justify-center">
                                        <svg class="h-10 w-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                        </svg>
                                    </div>
                                @endif
                                <span class="absolute top-4 left-4 text-[9px] font-bold text-slate-800 bg-white border border-slate-150 px-2.5 py-1 rounded shadow-sm uppercase tracking-wider">
                                    {{ $blog->category ?? 'Uncategorized' }}
                                </span>
                            </div>
                            <div class="p-6 space-y-3">
                                <!-- Meta -->
                                <div class="flex items-center text-[10px] text-slate-400 font-bold uppercase tracking-wider space-x-2">
                                    <span class="text-slate-500">{{ $blog->author }}</span>
                                    <span>•</span>
                                    <span>{{ $blog->published_at ? $blog->published_at->format('M d, Y') : '' }}</span>
                                </div>
                                <!-- Title -->
                                <h3 class="text-lg font-bold text-slate-900 tracking-tight leading-snug hover:text-aqua transition-colors">
                                    <a href="{{ route('blog.show', $blog->slug) }}" class="text-left font-sans block">{{ $blog->title }}</a>
                                </h3>
                                <!-- Excerpt -->
                                <p class="text-xs text-slate-500 leading-relaxed line-clamp-3 font-sans">{{ $blog->excerpt }}</p>
                            </div>
                        </div>
                        <!-- Footer action -->
                        <div class="p-6 pt-0 border-t border-slate-100 mt-4 flex items-center justify-between">
                            <a href="{{ route('blog.show', $blog->slug) }}" class="text-xs font-bold text-slate-900 hover:text-aqua transition-colors flex items-center group/btn evoke-link">
                                Read Article
                                <svg class="ml-1 h-3.5 w-3.5 group-hover/btn:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-16 bg-slate-50 border border-slate-200 rounded-xl">
                        <p class="text-sm text-slate-500">No blog posts published yet.</p>
                    </div>
                @endforelse
            </div>

            <!-- View All Insights CTA Button -->
            <div class="mt-16 text-center">
                <a href="{{ route('blog.index') }}" class="inline-flex items-center justify-center px-6 py-3.5 text-xs font-bold uppercase tracking-widest text-white bg-slate-950 hover:bg-slate-800 rounded-lg shadow-sm transition-all duration-200">
                    view all posts
                </a>
            </div>
        </div>
    </section>


@endsection

@section('scripts-ready')
    // ScrollSpy active link highlighting
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('#desktop-nav .nav-link');
    const mobileLinks = document.querySelectorAll('#mobile-menu a');

    function changeActiveLink() {
        let index = sections.length;

        // Loop backward to find the active section
        while(--index && window.scrollY + 120 < sections[index].offsetTop) {}
        
        const activeSection = sections[index];
        const activeId = activeSection ? activeSection.getAttribute('id') : '';

        navLinks.forEach((link) => {
            const targetId = link.getAttribute('data-scroll');
            if (targetId === activeId) {
                link.classList.add('text-aqua');
                link.classList.remove('text-slate-700');
            } else {
                link.classList.remove('text-aqua');
                link.classList.add('text-slate-700');
            }
        });

        mobileLinks.forEach((link) => {
            const targetId = link.getAttribute('data-scroll');
            if (targetId === activeId) {
                link.classList.add('text-aqua');
                link.classList.remove('text-slate-700');
            } else {
                link.classList.remove('text-aqua');
                link.classList.add('text-slate-700');
            }
        });
    }

    changeActiveLink();
    window.addEventListener('scroll', changeActiveLink);
@endsection

@section('scripts')
    <script>
        // Project filtering logic
        function filterProjects(category) {
            const cards = document.querySelectorAll('.project-card');
            const buttons = document.querySelectorAll('#projects button');
            
            // Update buttons active style
            buttons.forEach(btn => {
                if(btn.id === 'filter-btn-' + category) {
                    btn.className = "px-5 py-2.5 rounded-full border border-slate-950 bg-slate-950 text-white text-xs font-bold uppercase tracking-widest transition-all focus:outline-none";
                } else {
                    btn.className = "px-5 py-2.5 rounded-full border border-slate-200 text-slate-650 hover:border-slate-400 bg-white text-xs font-bold uppercase tracking-widest transition-all focus:outline-none";
                }
            });

            // Filter cards
            cards.forEach(card => {
                const cardCategory = card.getAttribute('data-category');
                if (category === 'all' || cardCategory === category) {
                    card.classList.remove('hidden');
                    card.style.display = 'flex';
                } else {
                    card.classList.add('hidden');
                    card.style.display = 'none';
                }
            });
        }
    </script>
@endsection
