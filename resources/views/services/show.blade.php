@extends('layouts.public')

@if(!empty($details['meta_title']))
    @section('meta_title', $details['meta_title'])
@else
    @section('title', $details['title'] . ' | Construction 360 Ltd')
@endif

@section('meta')
    <meta name="description" content="{{ $details['meta_description'] ?? ($details['about'] ?? 'Professional ' . $details['title'] . ' services across London and Essex by Construction 360 Ltd.') }}">
    <meta name="keywords" content="{{ $details['meta_keywords'] ?? '' }}">
    <meta name="robots" content="index, follow">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Construction 360 Ltd">
    <meta property="og:title" content="{{ $details['meta_title'] ?? ($details['title'] . ' | Construction 360 Ltd') }}">
    <meta property="og:description" content="{{ $details['meta_description'] ?? ($details['about'] ?? 'Professional ' . $details['title'] . ' services across London and Essex by Construction 360 Ltd.') }}">
    <meta property="og:image" content="{{ !empty($details['image_url']) ? asset($details['image_url']) : asset('images/hero_construction.png') }}">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $details['meta_title'] ?? ($details['title'] . ' | Construction 360 Ltd') }}">
    <meta property="twitter:description" content="{{ $details['meta_description'] ?? ($details['about'] ?? 'Professional ' . $details['title'] . ' services across London and Essex by Construction 360 Ltd.') }}">
    <meta property="twitter:image" content="{{ !empty($details['image_url']) ? asset($details['image_url']) : asset('images/hero_construction.png') }}">
@endsection

@section('content')
    {{-- Brand hero — matches sub-service & site theme --}}
    <section class="bg-brand text-white" style="padding-top: 7.5rem;">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10 pb-14 lg:pb-16">
            <div class="max-w-3xl space-y-4">
                <div class="flex flex-wrap items-center gap-x-2 gap-y-1 text-[11px] font-semibold uppercase tracking-[0.14em] text-white/70">
                    <a href="{{ url('/') }}" class="hover:text-white transition-colors">Home</a>
                    <span>•</span>
                    <a href="{{ route('services.index') }}" class="hover:text-white transition-colors">Services</a>
                    <span>•</span>
                    <span class="text-white">{{ $details['title'] }}</span>
                </div>

                <h1 class="text-3xl sm:text-5xl lg:text-[3.25rem] font-bold tracking-tight leading-tight text-white">
                    {{ $details['title'] }}
                </h1>
                <div class="h-[3px] w-14 bg-white"></div>
                @if(!empty($details['about']))
                    <p class="text-sm sm:text-base text-white/85 leading-relaxed max-w-2xl line-clamp-3">
                        {{ \Illuminate\Support\Str::limit(strip_tags($details['about']), 180) }}
                    </p>
                @endif
            </div>
        </div>
    </section>

    {{-- About the service --}}
    <section class="bg-white py-14 lg:py-20">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 xl:gap-16 items-center">
                <div class="lg:col-span-6 space-y-5">
                    <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-brand">
                        {{ $content['service_about_label'] ?? 'About the service' }}
                    </p>
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold tracking-tight leading-tight text-[#0f2a3a]">
                        Full-spectrum {{ $details['title'] }} solutions
                    </h2>
                    <div class="h-[3px] w-14 bg-brand"></div>
                    <p class="text-sm sm:text-[15px] text-[#5b6770] leading-relaxed">
                        {{ $details['about'] }}
                    </p>
                </div>

                <div class="lg:col-span-6">
                    <div class="rounded-xl overflow-hidden bg-[#ece8e1] shadow-[0_20px_44px_-28px_rgba(15,42,58,0.55)]">
                        <img
                            src="{{ asset($details['image_url']) }}"
                            alt="{{ $details['title'] }}"
                            style="display:block;width:100%;height:340px;object-fit:cover;object-position:center;"
                        >
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Sub-services / scopes --}}
    @if(!empty($details['services_offered']))
        <section class="bg-aqua-light py-16 lg:py-24 border-y border-black/[0.04]">
            <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10">
                <div class="max-w-2xl mb-10 lg:mb-14 space-y-3">
                    <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-brand">
                        {{ $content['service_scopes_label'] ?? 'Scopes & deliverables' }}
                    </p>
                    <h2 class="text-3xl sm:text-4xl font-bold tracking-tight text-[#0f2a3a]">
                        {{ $content['service_scopes_title'] ?? 'Specialist sub-services' }}
                    </h2>
                    <div class="h-[3px] w-14 bg-brand"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 lg:gap-6">
                    @foreach($details['services_offered'] as $idx => $subService)
                        <article class="group rounded-2xl border border-black/8 bg-white p-6 sm:p-8 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 flex flex-col">
                            <div class="flex items-start justify-between gap-4 mb-4">
                                <div class="flex items-center gap-3 min-w-0">
                                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-brand/10 text-brand text-[11px] font-bold">
                                        {{ str_pad($idx + 1, 2, '0', STR_PAD_LEFT) }}
                                    </span>
                                    <h3 class="text-lg sm:text-xl font-bold text-[#0f2a3a] leading-snug">
                                        {{ $subService['title'] }}
                                    </h3>
                                </div>
                            </div>

                            <p class="text-sm text-[#5b6770] leading-relaxed flex-1">
                                {{ $subService['desc'] }}
                            </p>

                            <div class="mt-6 pt-5 border-t border-black/5">
                                <a href="{{ route('subservices.show', [$slug, $subService['slug']]) }}"
                                   class="inline-flex items-center gap-2 text-[11px] font-bold uppercase tracking-[0.12em] text-brand hover:text-brand-dark transition-colors">
                                    Explore scope
                                    <svg class="h-3.5 w-3.5 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                                    </svg>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Why choose us --}}
    @if(!empty($details['why_choose_us']))
        <section class="bg-white py-16 lg:py-24">
            <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10">
                <div class="max-w-2xl mb-10 lg:mb-14 space-y-3">
                    <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-brand">
                        {{ $content['service_why_choose_us_label'] ?? 'Capabilities' }}
                    </p>
                    <h2 class="text-3xl sm:text-4xl font-bold tracking-tight text-[#0f2a3a]">
                        {{ $content['service_why_choose_us_title'] ?? 'Why choose us' }}
                    </h2>
                    <div class="h-[3px] w-14 bg-brand"></div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 lg:gap-6">
                    @foreach($details['why_choose_us'] as $item)
                        <article class="rounded-2xl border border-black/8 bg-aqua-light p-6 sm:p-7 space-y-3 hover:border-brand/20 transition-colors">
                            <div class="h-[3px] w-10 bg-brand rounded-full"></div>
                            <h3 class="text-base font-bold text-[#0f2a3a] leading-snug">
                                {{ $item['title'] }}
                            </h3>
                            <p class="text-sm text-[#5b6770] leading-relaxed">
                                {{ $item['desc'] }}
                            </p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- FAQs --}}
    @if(!empty($details['faqs']))
        <section class="bg-aqua-light py-16 lg:py-24 border-t border-black/[0.04]">
            <div class="max-w-[800px] mx-auto px-4 sm:px-6 lg:px-10">
                <div class="text-center mb-10 lg:mb-14 space-y-3">
                    <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-brand">
                        {{ $content['service_faqs_label'] ?? 'Common inquiries' }}
                    </p>
                    <h2 class="text-3xl sm:text-4xl font-bold tracking-tight text-[#0f2a3a]">
                        {{ $content['service_faqs_title'] ?? 'Frequently asked questions' }}
                    </h2>
                    <div class="mx-auto h-[3px] w-14 bg-brand"></div>
                </div>

                <div class="space-y-3">
                    @foreach($details['faqs'] as $index => $faq)
                        <div class="rounded-2xl border border-black/8 bg-white overflow-hidden">
                            <button type="button"
                                    onclick="toggleServiceFaq({{ $index }})"
                                    class="w-full flex items-center justify-between gap-4 text-left px-5 sm:px-6 py-4 sm:py-5 hover:bg-[#fafafa] transition-colors group">
                                <span class="text-sm sm:text-base font-semibold text-[#0f2a3a] leading-snug pr-2">
                                    {{ $faq['q'] }}
                                </span>
                                <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-black/10 text-brand group-hover:border-brand/30 transition-colors">
                                    <svg id="faq-icon-{{ $index }}" class="h-4 w-4 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                                    </svg>
                                </span>
                            </button>
                            <div id="faq-panel-{{ $index }}" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                                <div class="px-5 sm:px-6 pb-5 sm:pb-6 text-sm text-[#5b6770] leading-relaxed border-t border-black/5 pt-4">
                                    {!! $faq['a'] !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- CTA — matches homepage pre-footer --}}
    <section class="bg-brand text-white py-16 lg:py-20">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">
                <div class="max-w-xl space-y-3">
                    <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-white/80">
                        {{ $content['service_cta_label'] ?? 'Project engagement' }}
                    </p>
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold leading-tight">
                        {{ $content['service_cta_title'] ?? 'Ready to brief our team?' }}
                    </h2>
                    <p class="text-sm text-white/75 leading-relaxed">
                        {{ $content['service_cta_subtitle'] ?? 'Tell us about your project scope and we will respond with clear next steps and a fixed-price pathway.' }}
                    </p>
                </div>
                <div class="flex flex-wrap gap-3 shrink-0">
                    <a href="#" onclick="openTenderModal(); return false;"
                       class="inline-flex items-center gap-2 rounded-lg bg-white text-brand px-6 py-3.5 text-xs font-bold uppercase tracking-[0.08em] hover:bg-aqua-light transition-colors">
                        {{ $content['cta_submit_tender_label'] ?? 'Get your fixed-price quote' }}
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                    </a>
                    <a href="{{ route('contact.index') }}"
                       class="inline-flex items-center gap-2 rounded-lg border border-white/30 text-white px-6 py-3.5 text-xs font-bold uppercase tracking-[0.08em] hover:border-white hover:bg-white/10 transition-colors">
                        {{ $content['cta_book_consult_label'] ?? 'Book a consultation' }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    <script>
        function toggleServiceFaq(index) {
            const panel = document.getElementById('faq-panel-' + index);
            const icon = document.getElementById('faq-icon-' + index);
            if (!panel || !icon) return;

            const isOpen = panel.style.maxHeight && panel.style.maxHeight !== '0px';

            document.querySelectorAll('[id^="faq-panel-"]').forEach((p, idx) => {
                p.style.maxHeight = '0px';
                const otherIcon = document.getElementById('faq-icon-' + idx);
                if (otherIcon) otherIcon.style.transform = 'rotate(0deg)';
            });

            if (!isOpen) {
                panel.style.maxHeight = panel.scrollHeight + 'px';
                icon.style.transform = 'rotate(45deg)';
            }
        }
    </script>
@endsection
