@extends('layouts.public')

@section('title', ($content['services_page_title'] ?? 'Our Services') . ' | Construction 360 Ltd')

@section('meta')
    <meta name="description" content="{{ $content['services_page_subtitle'] ?? 'Design-led construction services across London and Essex — from pre-construction through delivery.' }}">
    <meta name="robots" content="index, follow">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Construction 360 Ltd">
    <meta property="og:title" content="{{ $content['services_page_title'] ?? 'Our Services' }} | Construction 360 Ltd">
    <meta property="og:description" content="{{ $content['services_page_subtitle'] ?? 'Design-led construction services across London and Essex.' }}">
    <meta property="og:image" content="{{ asset($content['hero_image'] ?? 'images/hero_construction.png') }}">
@endsection

@section('content')
    {{-- Light hero — matches About / Contact --}}
    <section class="relative bg-white border-b border-black/5">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10" style="padding-top: 7.5rem; padding-bottom: 3.5rem;">
            <div class="max-w-3xl">
                <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-brand">
                    {{ $content['services_page_label'] ?? 'Services' }}
                </p>
                <h1 class="mt-4 text-4xl sm:text-5xl lg:text-[3.25rem] font-bold tracking-tight leading-tight text-[#0f2a3a]">
                    {{ $content['services_page_title'] ?? 'Design to delivery' }}
                </h1>
                <div class="mt-5 h-[3px] w-14 bg-brand"></div>
                <p class="mt-5 text-base sm:text-[15px] text-[#5b6770] leading-relaxed max-w-2xl">
                    {{ $content['services_page_subtitle'] ?? 'We engage early in the project lifecycle to solve structural challenges, manage risk, and deliver premium builds across every discipline.' }}
                </p>
                <div class="mt-6 flex items-center gap-2 text-[11px] font-semibold uppercase tracking-[0.14em] text-[#6b7280]">
                    <a href="{{ url('/') }}" class="hover:text-brand transition-colors">Home</a>
                    <span>•</span>
                    <span class="text-[#0f2a3a]">Services</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Services list --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10 space-y-20 lg:space-y-28">
            @foreach($services as $index => $srv)
                @php
                    $slug = \Illuminate\Support\Str::slug($srv->title);
                    $imageUrl = asset($srv->image_url);
                @endphp
                <article class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 xl:gap-20 items-center {{ $index % 2 !== 0 ? 'lg:[&>*:first-child]:order-2' : '' }}">
                    <div class="relative overflow-hidden rounded-2xl border border-black/5 bg-[#0f2a3a] group">
                        <a href="{{ route('services.show', $slug) }}" class="block">
                            <img
                                src="{{ $imageUrl }}"
                                alt="{{ $srv->title }}"
                                class="w-full h-[280px] sm:h-[360px] lg:h-[400px] object-cover group-hover:scale-[1.03] transition-transform duration-700"
                            >
                        </a>
                    </div>

                    <div class="space-y-5">
                        <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-brand">
                            Service {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                        </p>
                        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold tracking-tight text-[#0f2a3a] leading-tight">
                            <a href="{{ route('services.show', $slug) }}" class="hover:text-brand transition-colors">
                                {{ $srv->title }}
                            </a>
                        </h2>
                        <div class="h-[3px] w-14 bg-brand"></div>
                        <p class="text-sm sm:text-[15px] text-[#5b6770] leading-relaxed">
                            {{ $srv->description }}
                        </p>
                        <a href="{{ route('services.show', $slug) }}"
                           class="inline-flex items-center gap-2 text-[11px] font-bold uppercase tracking-[0.12em] text-brand hover:text-brand-dark transition-colors">
                            Explore service
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    {{-- CTA --}}
    <section class="bg-brand text-white py-16 lg:py-20">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10 text-center space-y-5">
            <h2 class="text-2xl sm:text-3xl font-bold leading-tight">
                {{ $content['pre_footer_cta_title'] ?? 'Ready to build with clarity and craft?' }}
            </h2>
            <p class="text-sm text-white/75 max-w-lg mx-auto">
                {{ $content['pre_footer_cta_subtitle'] ?? 'Tell us about your space, timeline and ambitions.' }}
            </p>
            <a href="#" onclick="openTenderModal(); return false;"
               class="inline-flex items-center gap-2 rounded-lg bg-white text-brand px-6 py-3.5 text-xs font-bold uppercase tracking-[0.08em] hover:bg-aqua-light transition-colors">
                {{ $content['cta_get_free_quote_label'] ?? 'Get your free quote' }}
            </a>
        </div>
    </section>
@endsection
