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
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Construction 360 Ltd">
    <meta property="og:title" content="{{ $subService['meta_title'] ?? ($subService['title'] . ' | ' . $details['title'] . ' | Construction 360 Ltd') }}">
    <meta property="og:description" content="{{ $subService['meta_description'] ?? ($subService['desc'] ?? 'Professional ' . $subService['title'] . ' services by Construction 360 Ltd across the UK.') }}">
    <meta property="og:image" content="{{ !empty($details['image_url']) ? asset($details['image_url']) : asset('images/hero_construction.png') }}">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $subService['meta_title'] ?? ($subService['title'] . ' | ' . $details['title'] . ' | Construction 360 Ltd') }}">
    <meta property="twitter:description" content="{{ $subService['meta_description'] ?? ($subService['desc'] ?? 'Professional ' . $subService['title'] . ' services by Construction 360 Ltd across the UK.') }}">
    <meta property="twitter:image" content="{{ !empty($details['image_url']) ? asset($details['image_url']) : asset('images/hero_construction.png') }}">
@endsection

@section('content')
    @php
        $parentSlug = $details['slug'] ?? \Illuminate\Support\Str::slug($details['title']);
        $deliverables = $subService['deliverables'] ?? [];
        if (is_string($deliverables)) {
            $deliverables = array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n|,/', $deliverables))));
        }
        $siblings = $details['services_offered'] ?? [];
    @endphp

    {{-- Brand hero --}}
    <section class="bg-brand text-white" style="padding-top: 7.5rem;">
        <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 pb-14 lg:pb-16">
            <div class="max-w-3xl space-y-4">
                <div class="flex flex-wrap items-center gap-x-2 gap-y-1 text-[11px] font-semibold uppercase tracking-[0.14em] text-white/70">
                    <a href="{{ url('/') }}" class="hover:text-white transition-colors">Home</a>
                    <span>•</span>
                    <a href="{{ route('services.index') }}" class="hover:text-white transition-colors">Services</a>
                    <span>•</span>
                    <a href="{{ route('services.show', $parentSlug) }}" class="hover:text-white transition-colors">{{ $details['title'] }}</a>
                    <span>•</span>
                    <span class="text-white">{{ $subService['title'] }}</span>
                </div>

                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-bold tracking-tight leading-tight text-white">
                    {{ $subService['title'] }}
                </h1>
                <div class="h-[3px] w-14 bg-white"></div>
                <p class="text-sm sm:text-base text-white/85 font-medium">
                    Specialist scope of works under {{ $details['title'] }}
                </p>
            </div>
        </div>
    </section>

    {{-- Content --}}
    <section class="bg-white py-14 lg:py-20">
        <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-start">
                <div class="lg:col-span-8 space-y-6">
                    <p class="text-[11px] font-semibold uppercase tracking-[0.2em] text-brand">Scope & Specs</p>
                    <h2 class="text-2xl sm:text-3xl font-bold text-[#0f2a3a] tracking-tight leading-tight">
                        Technical Execution & Capabilities
                    </h2>
                    <p class="text-base text-[#5b6770] leading-relaxed">
                        {{ $subService['desc'] }}
                    </p>

                    @if(!empty($deliverables))
                        <div class="pt-6 mt-2 border-t border-black/5 space-y-4">
                            <h3 class="text-xs font-bold text-[#0f2a3a] uppercase tracking-[0.14em]">Scope Deliverables</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                                @foreach($deliverables as $deliverable)
                                    <div class="flex items-start gap-3 text-sm text-[#5b6770]">
                                        <svg class="h-5 w-5 text-brand shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span>{{ is_array($deliverable) ? ($deliverable['title'] ?? $deliverable['name'] ?? reset($deliverable)) : $deliverable }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="pt-4">
                        <a href="#" onclick="openTenderModal(); return false;"
                           class="inline-flex items-center gap-2 rounded-lg bg-brand hover:bg-brand-dark text-white px-6 py-3.5 text-xs font-bold uppercase tracking-[0.08em] transition-colors">
                            Get a fixed-price quote
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                        </a>
                    </div>
                </div>

                <aside class="lg:col-span-4">
                    <div class="rounded-2xl border border-black/8 bg-aqua-light p-6 sm:p-7 space-y-5">
                        <h3 class="text-lg font-bold text-[#0f2a3a] tracking-tight">Related Scopes</h3>
                        <div class="space-y-1">
                            @forelse($siblings as $sibling)
                                @php
                                    $sibSlug = $sibling['slug'] ?? \Illuminate\Support\Str::slug($sibling['title'] ?? '');
                                    $isCurrent = ($sibSlug === ($subService['slug'] ?? ''));
                                @endphp
                                @if(!$isCurrent && !empty($sibling['title']))
                                    <a href="{{ route('subservices.show', [$parentSlug, $sibSlug]) }}"
                                       class="flex items-center justify-between gap-3 rounded-lg px-3 py-2.5 text-sm font-semibold text-[#0f2a3a] hover:bg-white hover:text-brand transition-colors group">
                                        <span class="truncate">{{ $sibling['title'] }}</span>
                                        <svg class="h-4 w-4 text-[#9ca3af] group-hover:text-brand group-hover:translate-x-0.5 transition-all shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                @endif
                            @empty
                                <p class="text-sm text-[#6b7280]">No related scopes listed.</p>
                            @endforelse
                        </div>

                        <div class="pt-4 border-t border-black/5">
                            <a href="{{ route('services.show', $parentSlug) }}"
                               class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-[0.08em] text-brand hover:text-brand-dark transition-colors">
                                View all {{ $details['title'] }}
                                <span aria-hidden="true">→</span>
                            </a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    {{-- Bottom CTA --}}
    <section class="bg-brand text-white py-14 lg:py-16">
        <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
            <div class="max-w-xl space-y-2">
                <p class="text-[11px] font-semibold uppercase tracking-[0.2em] text-white/75">Project engagement</p>
                <h2 class="text-2xl sm:text-3xl font-bold tracking-tight text-white">Need this scope for your build?</h2>
                <p class="text-sm text-white/80">
                    Get in touch with our estimators. Share your requirements to review plans and receive clear costings.
                </p>
            </div>
            <a href="#" onclick="openTenderModal(); return false;"
               class="inline-flex shrink-0 items-center justify-center gap-2 rounded-lg px-6 py-3.5 text-xs font-bold uppercase tracking-[0.08em] text-brand bg-white hover:bg-aqua-light transition-colors">
                Submit project specifications
                <span aria-hidden="true">→</span>
            </a>
        </div>
    </section>
@endsection
