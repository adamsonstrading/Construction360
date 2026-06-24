@extends('layouts.public')

@section('title', 'Our Services | Design & Construction Specialists')

@section('content')
    <!-- Services Hero Section -->
    <section class="bg-white py-20 border-b border-slate-100 relative overflow-hidden">
        <!-- Minimal Grid Watermark -->
        <div class="absolute inset-0 z-0 opacity-[0.02] pointer-events-none">
            <svg class="w-full h-full text-slate-900" fill="none" viewBox="0 0 100 100" preserveAspectRatio="none">
                <line x1="0" y1="25" x2="100" y2="25" stroke="currentColor" stroke-width="0.05" />
                <line x1="0" y1="50" x2="100" y2="50" stroke="currentColor" stroke-width="0.05" />
                <line x1="0" y1="75" x2="100" y2="75" stroke="currentColor" stroke-width="0.05" />
                <line x1="25" y1="0" x2="25" y2="100" stroke="currentColor" stroke-width="0.05" />
                <line x1="50" y1="0" x2="50" y2="100" stroke="currentColor" stroke-width="0.05" />
                <line x1="75" y1="0" x2="75" y2="100" stroke="currentColor" stroke-width="0.05" />
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-3xl">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-aqua">{{ $content['services_page_label'] ?? 'Services' }}</span>
                <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold text-slate-950 mt-4 tracking-tighter leading-none font-sans">
                    {{ $content['services_page_title'] ?? 'Design to Delivery' }}
                </h1>
                <p class="mt-6 text-base sm:text-lg text-slate-550 leading-relaxed font-sans">
                    {{ $content['services_page_subtitle'] ?? 'We engage as early as possible in the lifecycle of a project to solve complex structural challenges, manage development risk, and exceed architectural standards.' }}
                </p>
            </div>
        </div>
    </section>

    <!-- Services Alternating Split Grid -->
    <section class="bg-white py-24 lg:py-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-28 lg:space-y-40">
            @foreach($services as $index => $srv)
                @php
                    $slug = \Illuminate\Support\Str::slug($srv->title);
                    $imageUrl = asset($srv->image_url);
                @endphp
                <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-24 {{ $index % 2 !== 0 ? 'lg:flex-row-reverse' : '' }}">
                    <!-- Image Panel -->
                    <div class="w-full lg:w-1/2">
                        <div class="relative bg-white border border-slate-150 rounded-2xl p-2.5 shadow-md group overflow-hidden">
                            <a href="{{ route('services.show', $slug) }}" class="block overflow-hidden rounded-xl">
                                <img src="{{ $imageUrl }}" alt="{{ $srv->title }}" class="w-full h-[300px] sm:h-[400px] object-cover rounded-xl group-hover:scale-[1.03] transition-transform duration-700">
                            </a>
                            <!-- Aqua line overlay effect -->
                            <div class="absolute bottom-2.5 left-2.5 right-2.5 h-1 bg-aqua scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left rounded-b-xl"></div>
                        </div>
                    </div>

                    <!-- Copy Content Panel -->
                    <div class="w-full lg:w-1/2 space-y-6">
                        <div class="flex items-baseline space-x-3">
                            <span class="text-xl font-bold font-sans text-aqua">0{{ $index + 1 }}</span>
                            <span class="h-[1px] w-8 bg-slate-200"></span>
                        </div>
                        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-950 tracking-tight font-sans">
                            <a href="{{ route('services.show', $slug) }}" class="hover:text-aqua transition-colors">
                                {{ $srv->title }}
                            </a>
                        </h2>
                        <p class="text-sm sm:text-base text-slate-500 leading-relaxed font-sans">
                            {{ $srv->description }}
                        </p>
                        
                        <div class="pt-4">
                            <a href="{{ route('services.show', $slug) }}" class="inline-flex items-center text-xs font-bold uppercase tracking-widest text-slate-900 hover:text-aqua transition-colors group evoke-link">
                                Read more
                                <svg class="ml-2 h-4 w-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>


@endsection
