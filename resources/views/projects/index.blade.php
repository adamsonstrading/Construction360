@extends('layouts.public')

@section('title', 'Project Portfolio | Architectural Builds & Fit-Outs')

@section('content')
    <!-- Projects Hero Section -->
    <section class="bg-white py-20 border-b border-slate-100 relative overflow-hidden">
        <!-- Abstract grid watermark -->
        <div class="absolute inset-0 z-0 opacity-[0.02] pointer-events-none">
            <svg class="w-full h-full text-slate-900" fill="none" viewBox="0 0 100 100" preserveAspectRatio="none">
                <line x1="0" y1="20" x2="100" y2="20" stroke="currentColor" stroke-width="0.05" />
                <line x1="0" y1="60" x2="100" y2="60" stroke="currentColor" stroke-width="0.05" />
                <line x1="33" y1="0" x2="33" y2="100" stroke="currentColor" stroke-width="0.05" />
                <line x1="66" y1="0" x2="66" y2="100" stroke="currentColor" stroke-width="0.05" />
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-3xl">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-aqua">{{ $content['projects_page_label'] ?? 'PORTFOLIO' }}</span>
                <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold text-slate-950 mt-4 tracking-tighter leading-none font-sans">
                    {{ $content['projects_page_title'] ?? 'Our Projects' }}
                </h1>
                <p class="mt-6 text-base sm:text-lg text-slate-550 leading-relaxed font-sans">
                    {{ $content['projects_page_subtitle'] ?? 'A curated selection of our high-spec residential builds, commercial workspace designs, and structural renovations across London and Essex.' }}
                </p>
            </div>
        </div>
    </section>

    <!-- Project Filtering & Grid -->
    <section class="bg-slate-50/50 py-16 min-h-[60vh]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Filter Bar Form -->
            <div class="bg-white border border-slate-150 rounded-2xl p-6 sm:p-8 mb-12 shadow-sm">
                <form action="{{ route('projects.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-12 gap-6 items-end">
                    <!-- Category Select -->
                    <div class="sm:col-span-3">
                        <label for="filter-type" class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-2.5">Sector / Type</label>
                        <select name="type" id="filter-type" onchange="this.form.submit()"
                                class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-xs font-bold text-slate-700 focus:outline-none focus:ring-2 focus:ring-aqua focus:border-transparent transition-all">
                            <option value="">All Sectors</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ request('type') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Status Select -->
                    <div class="sm:col-span-3">
                        <label for="filter-status" class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-2.5">Project Status</label>
                        <select name="status" id="filter-status" onchange="this.form.submit()"
                                class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-xs font-bold text-slate-700 focus:outline-none focus:ring-2 focus:ring-aqua focus:border-transparent transition-all">
                            <option value="">All Statuses</option>
                            <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="under-construction" {{ request('status') === 'under-construction' ? 'selected' : '' }}>Under Construction</option>
                            <option value="upcoming" {{ request('status') === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                        </select>
                    </div>

                    <!-- Location Select -->
                    <div class="sm:col-span-3">
                        <label for="filter-location" class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-2.5">Location</label>
                        <select name="location" id="filter-location" onchange="this.form.submit()"
                                class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-xs font-bold text-slate-700 focus:outline-none focus:ring-2 focus:ring-aqua focus:border-transparent transition-all">
                            <option value="">All Locations</option>
                            @foreach($locations as $loc)
                                <option value="{{ $loc }}" {{ request('location') === $loc ? 'selected' : '' }}>{{ $loc }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Action buttons -->
                    <div class="sm:col-span-3 flex gap-3">
                        <button type="submit" class="flex-grow bg-slate-950 hover:bg-slate-800 text-white text-xs font-bold uppercase tracking-widest py-3 rounded-lg transition-colors">
                            Filter
                        </button>
                        @if(request()->anyFilled(['type', 'status', 'location']))
                            <a href="{{ route('projects.index') }}" class="inline-flex items-center justify-center bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 py-3 rounded-lg text-xs font-bold uppercase tracking-widest transition-colors">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Projects Grid -->
            @if($projects->isEmpty())
                <div class="text-center py-20 bg-white border border-slate-150 rounded-2xl shadow-sm">
                    <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-4 text-base font-bold text-slate-900 tracking-tight">No projects found</h3>
                    <p class="mt-2 text-xs sm:text-sm text-slate-500 max-w-sm mx-auto">
                        Try loosening your filters or resetting the form to view other properties in our portfolio.
                    </p>
                    <div class="mt-6">
                        <a href="{{ route('projects.index') }}" class="inline-flex items-center px-4 py-2.5 border border-slate-200 text-xs font-bold uppercase tracking-widest text-slate-700 hover:border-slate-800 hover:text-slate-950 rounded-lg transition-all">
                            Clear Filters
                        </a>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-10">
                    @foreach($projects as $proj)
                        @php
                            $slug = $proj->slug ?: \Illuminate\Support\Str::slug($proj->title);
                            // Set a fallback project image
                            $imgUrl = asset($proj->image_url ?: 'images/hero_architecture.png');
                        @endphp
                        <div class="group bg-white border border-slate-150 rounded-2xl overflow-hidden hover:border-slate-350 hover:shadow-md transition-all duration-300 flex flex-col justify-between">
                            <div>
                                <!-- Image Panel with Badge Overlays -->
                                <div class="relative h-64 overflow-hidden border-b border-slate-100 bg-slate-50">
                                    <a href="{{ route('projects.show', $slug) }}" class="block h-full w-full">
                                        <img src="{{ $imgUrl }}" alt="{{ $proj->title }}" 
                                             class="object-cover h-full w-full group-hover:scale-105 transition-transform duration-700">
                                    </a>
                                    
                                    <!-- Status Overlay Badge -->
                                    <span class="absolute top-4 left-4 text-[9px] font-bold text-slate-950 bg-white/95 backdrop-blur-sm border border-slate-250 px-3 py-1.5 rounded-md shadow-sm uppercase tracking-wider">
                                        {{ str_replace('-', ' ', $proj->status) }}
                                    </span>

                                    <!-- Category Overlay Badge -->
                                    <span class="absolute top-4 right-4 text-[9px] font-bold text-white bg-aqua/90 backdrop-blur-sm px-3 py-1.5 rounded-md shadow-sm uppercase tracking-wider">
                                        {{ $proj->category }}
                                    </span>
                                </div>

                                <!-- Card Content -->
                                <div class="p-6 sm:p-8 space-y-4">
                                    <!-- Location & Year -->
                                    <div class="flex items-center text-[10px] font-bold text-slate-400 uppercase tracking-widest space-x-2">
                                        <!-- Pin Icon -->
                                        <svg class="h-3.5 w-3.5 text-aqua flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                        </svg>
                                        <span class="truncate">{{ $proj->location }}</span>
                                        <span>•</span>
                                        <span>{{ $proj->year }}</span>
                                    </div>

                                    <!-- Project Title -->
                                    <h3 class="text-xl font-extrabold text-slate-950 tracking-tight leading-snug group-hover:text-aqua transition-colors font-sans">
                                        <a href="{{ route('projects.show', $slug) }}">
                                            {{ $proj->title }}
                                        </a>
                                    </h3>

                                    <!-- Excerpt Description -->
                                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed font-sans line-clamp-3">
                                        {{ $proj->description }}
                                    </p>
                                </div>
                            </div>

                            <!-- Footer Details CTA -->
                            <div class="p-6 sm:p-8 pt-0 mt-2 border-t border-slate-100 flex items-center justify-between">
                                <a href="{{ route('projects.show', $slug) }}" 
                                   class="text-xs font-bold text-slate-900 hover:text-aqua transition-colors flex items-center group/btn evoke-link">
                                    View details
                                    <svg class="ml-2 h-4 w-4 group-hover/btn:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
