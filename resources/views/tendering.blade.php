@extends('layouts.public')

@section('title', ($content['tendering_title'] ?? 'Official Tendering Standard') . ' | Construction 360 Ltd')

@section('meta')
    <meta name="description" content="{{ \Illuminate\Support\Str::limit(strip_tags($content['tendering_notice'] ?? 'Official tendering and procurement standards for Construction 360 Ltd.'), 160) }}">
    <meta name="robots" content="index, follow">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Construction 360 Ltd">
    <meta property="og:title" content="{{ $content['tendering_title'] ?? 'Official Tendering Standard' }} | Construction 360 Ltd">
    <meta property="og:image" content="{{ asset($content['hero_image'] ?? 'images/hero_construction.png') }}">
@endsection

@section('content')
    {{-- Light hero --}}
    <section class="relative bg-white border-b border-black/5">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10" style="padding-top: 7.5rem; padding-bottom: 3.5rem;">
            <div class="max-w-3xl">
                <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-brand">
                    {{ $content['digital_tenders_only_label'] ?? 'Procurement' }}
                </p>
                <h1 class="mt-4 text-4xl sm:text-5xl lg:text-[3.25rem] font-bold tracking-tight leading-tight text-[#0f2a3a]">
                    {{ $content['tendering_title'] ?? 'Official Tendering & Procurement Standards' }}
                </h1>
                <div class="mt-5 h-[3px] w-14 bg-brand"></div>
                <div class="mt-6 flex items-center gap-2 text-[11px] font-semibold uppercase tracking-[0.14em] text-[#6b7280]">
                    <a href="{{ url('/') }}" class="hover:text-brand transition-colors">Home</a>
                    <span>•</span>
                    <span class="text-[#0f2a3a]">Tendering standard</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Notice band --}}
    <section class="bg-brand text-white py-10 lg:py-12">
        <div class="max-w-[900px] mx-auto px-4 sm:px-6 lg:px-10">
            <div class="flex items-start gap-4">
                <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-white/15 text-white">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                    </svg>
                </span>
                <div class="space-y-3 min-w-0">
                    <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-white/80">
                        Official tendering standard
                    </p>
                    <div class="text-sm sm:text-[15px] text-white/90 leading-relaxed space-y-3 [&_strong]:text-white [&_a]:text-white [&_a]:underline">
                        {!! $content['tendering_notice'] ?? '' !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Content --}}
    <section class="bg-white py-14 lg:py-20">
        <div class="max-w-[900px] mx-auto px-4 sm:px-6 lg:px-10">
            <div class="rounded-2xl border border-black/8 bg-aqua-light p-8 sm:p-10 lg:p-12">
                <div class="prose prose-slate max-w-none text-sm sm:text-[15px] text-[#5b6770] leading-relaxed space-y-6 whitespace-pre-wrap [&_strong]:text-[#0f2a3a] [&_h2]:text-[#0f2a3a] [&_h3]:text-[#0f2a3a]">
                    {{ $content['tendering_content'] ?? '' }}
                </div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="bg-brand text-white py-16 lg:py-20">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">
                <div class="max-w-xl space-y-3">
                    <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-white/80">
                        {{ $content['service_cta_label'] ?? 'Project engagement' }}
                    </p>
                    <h2 class="text-2xl sm:text-3xl font-bold leading-tight">
                        {{ $content['tendering_cta_title'] ?? 'Ready to submit your tender brief?' }}
                    </h2>
                    <p class="text-sm text-white/75 leading-relaxed">
                        {{ $content['tendering_cta_subtitle'] ?? 'Upload your specifications electronically and our coordinators will respond within 24 business hours.' }}
                    </p>
                </div>
                <div class="flex flex-wrap gap-3 shrink-0">
                    <a href="#" onclick="openTenderModal(); return false;"
                       class="inline-flex items-center gap-2 rounded-lg bg-white text-brand px-6 py-3.5 text-xs font-bold uppercase tracking-[0.08em] hover:bg-aqua-light transition-colors">
                        {{ $content['cta_submit_tender_label'] ?? 'Submit tender brief' }}
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                    </a>
                    <a href="{{ route('contact.index') }}"
                       class="inline-flex items-center gap-2 rounded-lg border border-white/30 text-white px-6 py-3.5 text-xs font-bold uppercase tracking-[0.08em] hover:border-white hover:bg-white/10 transition-colors">
                        {{ $content['cta_book_consult_label'] ?? 'Contact us' }}
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
