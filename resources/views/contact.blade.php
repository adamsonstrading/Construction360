@extends('layouts.public')

@section('title', 'Get in Touch | Construction 360 Ltd')

@section('meta')
    <meta name="description" content="Contact Construction 360 Ltd for professional construction services across the UK. Get in touch with our expert team for quotes, consultations and project enquiries.">
    <meta name="keywords" content="contact construction 360, construction quote uk, construction consultancy contact, building contractor enquiry">
    <meta name="robots" content="index, follow">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Construction 360 Ltd">
    <meta property="og:title" content="Get in Touch | Construction 360 Ltd">
    <meta property="og:description" content="Contact Construction 360 Ltd for professional construction services across the UK. Get in touch with our expert team for quotes, consultations and project enquiries.">
    <meta property="og:image" content="{{ asset('images/hero_construction.png') }}">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:title" content="Get in Touch | Construction 360 Ltd">
    <meta property="twitter:description" content="Contact Construction 360 Ltd for professional construction services across the UK.">
    <meta property="twitter:image" content="{{ asset('images/hero_construction.png') }}">
@endsection

@section('content')
    @php
        $inputClass = 'w-full rounded-xl border border-black/10 bg-[#fafafa] px-4 py-3.5 text-sm text-[#1a1a1a] placeholder:text-[#9ca3af] focus:outline-none focus:border-brand focus:ring-1 focus:ring-brand focus:bg-white transition-colors';
        $email = $content['header_email'] ?? 'info@construction360.co';
        $phone = $content['header_phone'] ?? '+442039309629';
        $phoneDisplay = $content['header_phone_display'] ?? ($content['header_phone'] ?? '0203 930 9629');
        $address = $content['contact_address'] ?? '73 Thrale Road, London, England, SW16 1NU';
        $mapUrl = $content['contact_map_url'] ?? 'https://www.google.com/maps/search/?api=1&query=73+Thrale+Road,+London,+England,+SW16+1NU';
        $mapEmbed = $content['contact_map_embed_url'] ?? 'https://maps.google.com/maps?q=73%20Thrale%20Road,%20London,%20England,%20SW16%201NU&t=&z=15&ie=UTF8&iwloc=&output=embed';
    @endphp

    {{-- Intro + estimate-style form --}}
    <section class="relative bg-white overflow-hidden" style="padding-top: 7.5rem;">
        <div class="pointer-events-none absolute inset-0 bg-brand/5"></div>
        <div class="relative max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10 pb-16 lg:pb-20">
            <div class="max-w-2xl mb-10 lg:mb-12">
                <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-brand">
                    {{ $content['contact_page_label'] ?? 'Contact Us' }}
                </p>
                <h1 class="mt-4 text-4xl sm:text-5xl lg:text-[3.25rem] font-bold tracking-tight leading-tight text-[#0f2a3a]">
                    {{ $content['contact_page_title'] ?? 'Get in touch' }}
                </h1>
                <div class="mt-5 h-[3px] w-14 bg-brand"></div>
                <p class="mt-5 text-sm sm:text-[15px] text-[#5b6770] leading-relaxed max-w-lg">
                    {{ $content['contact_page_subtitle'] ?? 'Our construction experts are here to help — from first brief to fixed-price quote across London and Essex.' }}
                </p>
                <div class="mt-5 flex items-center gap-2 text-[11px] font-semibold uppercase tracking-[0.14em] text-[#6b7280]">
                    <a href="{{ url('/') }}" class="hover:text-brand transition-colors">Home</a>
                    <span>•</span>
                    <span class="text-[#0f2a3a]">Contact Us</span>
                </div>
            </div>

            {{-- Brand panel + form (home estimate composition) --}}
            <div id="message-form" class="grid grid-cols-1 lg:grid-cols-12 gap-0 items-stretch rounded-[2rem] overflow-hidden shadow-[0_30px_80px_-40px_rgba(54,161,179,0.35)] border border-black/[0.04]">
                <div class="lg:col-span-4 bg-brand text-white p-8 lg:p-10 flex flex-col justify-between gap-8">
                    <div class="space-y-4">
                        <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-white/70">
                            {{ $content['contact_form_eyebrow'] ?? 'Leave a message' }}
                        </p>
                        <h2 class="font-heading text-3xl sm:text-4xl font-medium tracking-tight leading-tight">
                            {{ $content['contact_page_form_title'] ?? 'Tell us about your project' }}
                        </h2>
                        <p class="text-sm text-white/75 leading-relaxed">
                            Send a note and we’ll reply with clear next steps — usually within one working day.
                        </p>
                    </div>

                    <ul class="space-y-4 text-sm text-white/90">
                        <li>
                            <a href="mailto:{{ $email }}" class="group flex items-start gap-3 hover:text-white transition-colors">
                                <span class="mt-0.5 inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-white/10 text-[#f0d778]">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                                </span>
                                <span>
                                    <span class="block text-[10px] uppercase tracking-[0.16em] text-white/60 mb-0.5">Email</span>
                                    {{ $email }}
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="tel:{{ $phone }}" class="group flex items-start gap-3 hover:text-white transition-colors">
                                <span class="mt-0.5 inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-white/10 text-[#f0d778]">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.824-1.802-5.14-4.118-6.942-6.942l1.293-.97c.362-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v1.5z"/></svg>
                                </span>
                                <span>
                                    <span class="block text-[10px] uppercase tracking-[0.16em] text-white/60 mb-0.5">Phone</span>
                                    {{ $phoneDisplay }}
                                    <span class="block text-xs text-white/55 mt-0.5">Mon–Fri, 9am–6pm</span>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ $mapUrl }}" target="_blank" rel="noopener noreferrer" class="group flex items-start gap-3 hover:text-white transition-colors">
                                <span class="mt-0.5 inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-white/10 text-[#f0d778]">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                                </span>
                                <span>
                                    <span class="block text-[10px] uppercase tracking-[0.16em] text-white/60 mb-0.5">Office</span>
                                    {{ $address }}
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="lg:col-span-8 bg-[#f8fbfc] p-6 sm:p-8 lg:p-10">
                    @if(session('success'))
                        <div class="mb-5 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 flex items-start gap-2">
                            <svg class="h-5 w-5 text-emerald-600 shrink-0 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" id="contact-form" class="space-y-4">
                        @csrf
                        <input type="hidden" name="name" id="combined-name" value="{{ old('name') }}">

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="first_name" class="sr-only">First name</label>
                                <input type="text" id="first_name" required placeholder="First name" class="{{ $inputClass }}">
                            </div>
                            <div>
                                <label for="last_name" class="sr-only">Last name</label>
                                <input type="text" id="last_name" required placeholder="Last name" class="{{ $inputClass }}">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" required value="{{ old('email') }}" placeholder="Email" class="{{ $inputClass }}">
                            </div>
                            <div>
                                <label for="phone" class="sr-only">Phone</label>
                                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" placeholder="Phone number" class="{{ $inputClass }}">
                            </div>
                        </div>

                        <div>
                            <label for="message" class="sr-only">Message</label>
                            <textarea name="message" id="message" rows="5" required placeholder="Briefly describe your project or question"
                                      class="{{ $inputClass }} resize-y">{{ old('message') }}</textarea>
                        </div>

                        <div class="border border-black/10 rounded-xl p-3.5 bg-white flex items-center max-w-sm">
                            <div class="flex items-center gap-3">
                                <input type="checkbox" required id="turnstile-check"
                                       class="h-5 w-5 rounded border-black/20 text-brand focus:ring-brand focus:ring-offset-0 cursor-pointer">
                                <label for="turnstile-check" class="text-[11px] font-semibold text-[#5b6770] cursor-pointer select-none">
                                    Verify you are human
                                </label>
                            </div>
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-brand hover:bg-brand-dark text-white px-8 py-3.5 text-sm font-semibold uppercase tracking-[0.08em] transition-colors shadow-sm">
                                Send message <span aria-hidden="true">→</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- Visit us + map --}}
    <section class="bg-white border-t border-black/5 py-14 lg:py-20">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                <div class="lg:col-span-4 space-y-5">
                    <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-brand">Visit</p>
                    <h2 class="text-3xl sm:text-4xl font-bold tracking-tight text-[#0f2a3a]">
                        {{ $content['contact_location_label'] ?? 'Our London office' }}
                    </h2>
                    <div class="h-[3px] w-14 bg-brand"></div>
                    <p class="text-sm text-[#5b6770] leading-relaxed">
                        {{ $address }}
                    </p>
                    <p class="text-sm text-[#5b6770]">
                        Open Mon–Fri, 9am–6pm. Drop in by appointment or give us a call first.
                    </p>
                    <div class="flex flex-wrap gap-3 pt-2">
                        <a href="{{ $mapUrl }}" target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center gap-2 rounded-lg bg-brand hover:bg-brand-dark text-white px-5 py-3 text-xs font-bold uppercase tracking-[0.08em] transition-colors">
                            Get directions
                            <span aria-hidden="true">→</span>
                        </a>
                        <a href="tel:{{ $phone }}"
                           class="inline-flex items-center gap-2 rounded-lg border border-black/10 bg-white hover:border-brand text-[#0f2a3a] px-5 py-3 text-xs font-bold uppercase tracking-[0.08em] transition-colors">
                            Call us
                        </a>
                    </div>
                </div>

                <div class="lg:col-span-8">
                    <div class="relative overflow-hidden rounded-2xl border border-black/5 bg-[#0f2a3a]" style="aspect-ratio: 16 / 10; min-height: 280px;">
                        <iframe
                            src="{{ $mapEmbed }}"
                            class="absolute inset-0 w-full h-full border-0"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Construction 360 office location">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Bottom CTA --}}
    <section class="relative bg-brand text-white py-16 lg:py-20 overflow-hidden">
        <div class="pointer-events-none absolute inset-0 bg-brand/20"></div>
        <div class="relative max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10 flex flex-col md:flex-row md:items-center md:justify-between gap-8">
            <div class="max-w-xl">
                <h2 class="font-heading text-3xl sm:text-4xl lg:text-[2.75rem] font-medium leading-tight">
                    {{ $content['pre_footer_cta_title'] ?? 'Ready for a fixed-price quote?' }}
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const firstNameInput = document.getElementById('first_name');
            const lastNameInput = document.getElementById('last_name');
            const combinedNameInput = document.getElementById('combined-name');
            const form = document.getElementById('contact-form');

            if (combinedNameInput.value) {
                const parts = combinedNameInput.value.trim().split(' ');
                if (parts.length > 0) {
                    firstNameInput.value = parts[0];
                    if (parts.length > 1) {
                        lastNameInput.value = parts.slice(1).join(' ');
                    }
                }
            }

            function updateCombinedName() {
                const first = firstNameInput.value.trim();
                const last = lastNameInput.value.trim();
                combinedNameInput.value = (first + ' ' + last).trim();
            }

            firstNameInput.addEventListener('input', updateCombinedName);
            lastNameInput.addEventListener('input', updateCombinedName);

            form.addEventListener('submit', function() {
                updateCombinedName();
            });
        });
    </script>
@endsection
