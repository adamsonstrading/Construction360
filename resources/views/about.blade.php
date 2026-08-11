@extends('layouts.public')

@section('title', ($content['about_page_title'] ?? 'About Us') . ' | Construction 360 Ltd')

@section('meta')
    <meta name="description" content="{{ $content['about_page_subtitle'] ?? ($content['about_mission'] ?? 'Learn about Construction 360 Ltd — our vision, mission, values and leadership across London and Essex.') }}">
    <meta name="robots" content="index, follow">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Construction 360 Ltd">
    <meta property="og:title" content="{{ $content['about_page_title'] ?? 'About Us' }} | Construction 360 Ltd">
    <meta property="og:description" content="{{ $content['about_page_subtitle'] ?? ($content['about_mission'] ?? 'Design-led construction across London and Essex.') }}">
    <meta property="og:image" content="{{ asset('images/hero_construction.png') }}">
@endsection

@section('content')
    {{-- Light hero --}}
    <section class="relative bg-white border-b border-black/5">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10" style="padding-top: 7.5rem; padding-bottom: 3.5rem;">
            <div class="max-w-3xl">
                <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-brand">
                    {{ $content['about_page_label'] ?? ($content['about_label'] ?? 'About Us') }}
                </p>
                <h1 class="mt-4 text-4xl sm:text-5xl lg:text-[3.25rem] font-bold tracking-tight leading-tight text-[#0f2a3a]">
                    {{ $content['about_page_title'] ?? 'About Us' }}
                </h1>
                <div class="mt-5 h-[3px] w-14 bg-brand"></div>
                <p class="mt-5 text-base sm:text-[15px] text-[#5b6770] leading-relaxed max-w-2xl">
                    {{ $content['about_page_subtitle'] ?? ($content['about_heading'] ?? 'We craft buildings people love to live and work in.') }}
                </p>
                <div class="mt-6 flex items-center gap-2 text-[11px] font-semibold uppercase tracking-[0.14em] text-[#6b7280]">
                    <a href="{{ url('/') }}" class="hover:text-brand transition-colors">Home</a>
                    <span>•</span>
                    <span class="text-[#0f2a3a]">About</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Mission statement band --}}
    <section class="relative bg-brand text-white py-16 lg:py-20">
        <div class="relative max-w-3xl mx-auto px-4 sm:px-6 text-center space-y-5">
            <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-white/80">
                {{ $content['about_label'] ?? 'Who we are' }}
            </p>
            <h2 class="text-3xl sm:text-4xl font-bold leading-snug text-white">
                {{ $content['about_heading'] ?? 'We craft buildings people love to live and work in' }}
            </h2>
            <div class="mx-auto w-14 h-[3px] bg-white"></div>
            <p class="text-sm sm:text-base text-white/80 leading-relaxed max-w-2xl mx-auto">
                {{ $content['about_mission'] ?? 'To guide clients from brief to completion with joined-up design, engineering and construction management that protects quality, budget and programme.' }}
            </p>
        </div>
    </section>

    {{-- Vision / Mission / Values --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
                <article class="rounded-2xl border border-black/8 bg-aqua-light p-7 sm:p-8 space-y-3">
                    <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-brand">
                        {{ $content['about_vision_label'] ?? 'Our vision' }}
                    </p>
                    <p class="text-sm sm:text-[15px] text-[#5b6770] leading-relaxed">
                        {{ $content['about_vision'] ?? 'To be the most trusted design-led construction partner for homes and workplaces across London and Essex.' }}
                    </p>
                </article>
                <article class="rounded-2xl border border-black/8 bg-aqua-light p-7 sm:p-8 space-y-3">
                    <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-brand">
                        {{ $content['about_mission_label'] ?? 'Our mission' }}
                    </p>
                    <p class="text-sm sm:text-[15px] text-[#5b6770] leading-relaxed">
                        {{ $content['about_mission'] ?? 'To guide clients from brief to completion with joined-up design, engineering and construction management that protects quality, budget and programme.' }}
                    </p>
                </article>
                <article class="rounded-2xl border border-black/8 bg-aqua-light p-7 sm:p-8 space-y-3">
                    <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-brand">
                        {{ $content['about_values_label'] ?? 'Our values' }}
                    </p>
                    <p class="text-sm sm:text-[15px] text-[#5b6770] leading-relaxed">
                        {{ $content['about_values'] ?? 'Transparency, disciplined programmes, and finishes that stand up to inspection.' }}
                    </p>
                </article>
            </div>
        </div>
    </section>

    {{-- Founder quote --}}
    @if(!empty($content['about_quote']))
        <section class="bg-aqua-light/70 border-y border-black/5 py-14 lg:py-20">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 text-center">
                <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-brand mb-5">From the studio</p>
                <blockquote class="font-heading text-2xl sm:text-3xl text-[#0f2a3a] leading-snug">
                    “{{ $content['about_quote'] }}”
                </blockquote>
                @if(!empty($content['about_quote_author']))
                    <footer class="mt-5 text-[11px] font-semibold uppercase tracking-[0.16em] text-brand">
                        {{ $content['about_quote_author'] }}
                    </footer>
                @endif
            </div>
        </section>
    @endif

    {{-- Why choose us (admin why_* fields) --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10">
            <div class="max-w-2xl mb-10 lg:mb-14">
                <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-brand">
                    {{ $content['assurances_label'] ?? 'Why choose us' }}
                </p>
                <h2 class="mt-3 text-3xl sm:text-4xl font-bold tracking-tight text-[#0f2a3a]">
                    {{ $content['assurances_title'] ?? 'Built on accountability' }}
                </h2>
                <div class="mt-4 h-[3px] w-14 bg-brand"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 lg:gap-8">
                @foreach([1, 2, 3, 4] as $i)
                    @php
                        $whyTitle = $content["why_{$i}_title"] ?? null;
                        $whyText = $content["why_{$i}_text"] ?? null;
                    @endphp
                    @if($whyTitle || $whyText)
                        <article class="border-t border-black/10 pt-5">
                            <span class="text-[11px] font-bold text-brand tracking-[0.14em]">0{{ $i }}</span>
                            <h3 class="mt-2 text-xl font-bold text-[#0f2a3a]">{{ $whyTitle }}</h3>
                            <p class="mt-2 text-sm text-[#5b6770] leading-relaxed">{{ $whyText }}</p>
                        </article>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    {{-- Leadership --}}
    <section id="leadership" class="bg-aqua-light py-16 sm:py-20 lg:py-24 scroll-mt-24">
        <div class="max-w-[1100px] mx-auto px-4 sm:px-6 lg:px-10">
            <div class="text-center mb-12 sm:mb-16">
                <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-brand mb-3">Team</p>
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

    {{-- CTA --}}
    <section class="relative bg-brand text-white py-16 lg:py-20 overflow-hidden">
        <div class="pointer-events-none absolute inset-0 bg-brand/20"></div>
        <div class="relative max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10 flex flex-col md:flex-row md:items-center md:justify-between gap-8">
            <div class="max-w-xl">
                <h2 class="font-heading text-3xl sm:text-4xl lg:text-[2.75rem] font-medium leading-tight">
                    {{ $content['pre_footer_cta_title'] ?? 'Ready to build with clarity and craft?' }}
                </h2>
                <p class="mt-3 text-sm text-white/55 max-w-lg">
                    {{ $content['pre_footer_cta_subtitle'] ?? 'Tell us about your space, timeline and ambitions.' }}
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
