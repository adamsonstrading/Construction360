@extends('layouts.public')

@if(!empty($project->meta_title))
    @section('meta_title', $project->meta_title)
@else
    @section('title', $project->title . ' | Projects | Construction 360 Ltd')
@endif

@if(!empty($project->meta_description) || !empty($project->meta_keywords))
    @section('meta')
        @if(!empty($project->meta_description))
            <meta name="description" content="{{ $project->meta_description }}">
        @endif
        @if(!empty($project->meta_keywords))
            <meta name="keywords" content="{{ $project->meta_keywords }}">
        @endif
    @endsection
@endif

@section('content')
    <!-- Breadcrumbs & Navigation -->
    <nav class="bg-slate-50 border-b border-slate-100 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center space-x-2 text-xs font-bold uppercase tracking-widest text-slate-400">
                <a href="{{ url('/') }}" class="hover:text-aqua transition-colors">Home</a>
                <span>/</span>
                <a href="{{ route('projects.index') }}" class="hover:text-aqua transition-colors">Projects</a>
                <span>/</span>
                <span class="text-slate-600">{{ $project->title }}</span>
            </div>
        </div>
    </nav>

    <!-- Project Details Content -->
    <section class="bg-white py-20 lg:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Project Header -->
            <div class="max-w-3xl mb-12 lg:mb-16">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-aqua">{{ $project->category }}</span>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-slate-950 mt-3 tracking-tighter leading-none font-sans">
                    {{ $project->title }}
                </h1>
            </div>

            <!-- Split Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-start">
                
                <!-- Left Column (Main Image, Description) -->
                <div class="lg:col-span-8 space-y-12">
                    <!-- Large Cover Image -->
                    <div class="bg-white border border-slate-150 rounded-2xl p-2.5 shadow-lg overflow-hidden">
                        <img src="{{ asset($project->image_url ?: 'images/hero_architecture.png') }}" 
                             alt="{{ $project->title }}" 
                             class="w-full h-auto max-h-[550px] object-cover rounded-xl">
                    </div>

                    <!-- Project Overview -->
                    <div class="space-y-6">
                        <h2 class="text-xl sm:text-2xl font-bold text-slate-950 tracking-tight font-sans">
                            {{ $content['project_overview_title'] ?? 'Project Overview' }}
                        </h2>
                        <div class="text-sm sm:text-base text-slate-650 leading-relaxed font-sans space-y-4">
                            @php
                                $paragraphs = explode("\n", $project->description);
                            @endphp
                            @foreach($paragraphs as $p)
                                @if(trim($p) !== '')
                                    <p>{{ trim($p) }}</p>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <!-- Project Timeline/Phases (Premium touch) -->
                    <div class="border-t border-slate-100 pt-10 space-y-6">
                        <h3 class="text-lg font-bold text-slate-950 tracking-tight font-sans">
                            {{ $content['project_scopes_title'] ?? 'Development Scopes' }}
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-xs">
                            <div class="bg-slate-50 rounded-xl p-6 border border-slate-150 space-y-2">
                                <span class="text-aqua font-bold">PHASE 1</span>
                                <h4 class="font-bold text-slate-900 font-sans">Structural & Framework</h4>
                                <p class="text-slate-500 leading-relaxed">Establish initial framing coordinates, load-bearing assessments, and secure local building control approvals.</p>
                            </div>
                            <div class="bg-slate-50 rounded-xl p-6 border border-slate-150 space-y-2">
                                <span class="text-aqua font-bold">PHASE 2</span>
                                <h4 class="font-bold text-slate-900 font-sans">Shell & Insulation</h4>
                                <p class="text-slate-500 leading-relaxed">Installation of custom glazing specifications, fire barriers, thermal insulation, and external brickwork finishes.</p>
                            </div>
                            <div class="bg-slate-50 rounded-xl p-6 border border-slate-150 space-y-2">
                                <span class="text-aqua font-bold">PHASE 3</span>
                                <h4 class="font-bold text-slate-900 font-sans">Handover & Audit</h4>
                                <p class="text-slate-500 leading-relaxed">Final mechanical certifications, snagging audit compliance checks, and handover of 10-year structural warranty.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column (Sidebar Metadata & CTA) -->
                <div class="lg:col-span-4 lg:sticky lg:top-28 space-y-8">
                    <!-- Metadata card -->
                    <div class="bg-white border border-slate-150 rounded-2xl p-6 sm:p-8 shadow-md space-y-6">
                        <h3 class="text-xs font-bold uppercase tracking-widest text-slate-400 border-b border-slate-100 pb-4">
                            {{ $content['project_specifications_title'] ?? 'Project Specifications' }}
                        </h3>
                        
                        <div class="space-y-4">
                            <!-- Location -->
                            <div class="flex justify-between items-baseline text-xs">
                                <span class="font-bold text-slate-400 uppercase tracking-widest">Location</span>
                                <span class="font-bold text-slate-800 text-right">{{ $project->location }}</span>
                            </div>
                            
                            <!-- Sector -->
                            <div class="flex justify-between items-baseline text-xs">
                                <span class="font-bold text-slate-400 uppercase tracking-widest">Sector</span>
                                <span class="font-bold text-slate-800 text-right">{{ $project->category }}</span>
                            </div>

                            <!-- Year -->
                            <div class="flex justify-between items-baseline text-xs">
                                <span class="font-bold text-slate-400 uppercase tracking-widest">Completed</span>
                                <span class="font-bold text-slate-800 text-right">{{ $project->year }}</span>
                            </div>

                            <!-- Status -->
                            <div class="flex justify-between items-baseline text-xs">
                                <span class="font-bold text-slate-400 uppercase tracking-widest">Status</span>
                                <span class="font-bold text-aqua uppercase tracking-wider text-right">
                                    {{ str_replace('-', ' ', $project->status) }}
                                </span>
                            </div>
                        </div>

                        <!-- Sidebar Action -->
                        <div class="pt-4">
                            <button type="button" onclick="openTenderModal()"
                                    class="w-full inline-flex items-center justify-center px-5 py-3.5 text-xs font-bold uppercase tracking-widest text-white bg-slate-950 hover:bg-slate-800 rounded-lg shadow-sm transition-colors">
                                Enquire about this build
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Projects Section -->
    @if(!$related->isEmpty())
        <section class="bg-slate-50 border-t border-slate-100 py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Title -->
                <div class="mb-12">
                    <span class="text-xs font-bold uppercase tracking-[0.2em] text-aqua">{{ $content['project_related_label'] ?? 'PORTFOLIO' }}</span>
                    <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-950 mt-2 tracking-tighter font-sans">
                        {{ $content['project_related_title'] ?? 'Related Projects' }}
                    </h2>
                </div>

                <!-- Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($related as $relProj)
                        @php
                            $relSlug = $relProj->slug ?: \Illuminate\Support\Str::slug($relProj->title);
                            $relImg = asset($relProj->image_url ?: 'images/hero_architecture.png');
                        @endphp
                        <div class="group bg-white border border-slate-150 rounded-2xl overflow-hidden hover:border-slate-300 transition-all flex flex-col justify-between">
                            <div>
                                <div class="relative h-48 overflow-hidden bg-slate-100 border-b border-slate-100">
                                    <a href="{{ route('projects.show', $relSlug) }}" class="block h-full w-full">
                                        <img src="{{ $relImg }}" alt="{{ $relProj->title }}" 
                                             class="object-cover h-full w-full group-hover:scale-105 transition-transform duration-700">
                                    </a>
                                </div>
                                <div class="p-6 space-y-2">
                                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest block">{{ $relProj->location }}</span>
                                    <h3 class="text-base font-bold text-slate-950 tracking-tight leading-snug group-hover:text-aqua transition-colors font-sans">
                                        <a href="{{ route('projects.show', $relSlug) }}">
                                            {{ $relProj->title }}
                                        </a>
                                    </h3>
                                </div>
                            </div>
                            <div class="p-6 pt-0 border-t border-slate-100 mt-2 flex items-center justify-between">
                                <a href="{{ route('projects.show', $relSlug) }}" 
                                   class="text-xs font-bold text-slate-900 hover:text-aqua transition-colors flex items-center group/btn evoke-link">
                                    View details
                                    <svg class="ml-1.5 h-3.5 w-3.5 group-hover/btn:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
