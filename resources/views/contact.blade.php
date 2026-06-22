@extends('layouts.public')

@section('title', 'Get in Touch | Construction 360 Ltd')

@section('content')
    <!-- Hero Header Block (Deep Blue Theme) -->
    <section class="bg-[#031d2e] pt-28 pb-32 text-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-8">
                <!-- Left Side: Title & Breadcrumbs -->
                <div class="space-y-4">
                    <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold tracking-tight leading-none font-sans">
                        {{ $content['contact_page_title'] ?? 'Get in touch' }}
                    </h1>
                    <div class="flex items-center space-x-2 text-xs font-bold text-slate-355 tracking-wider">
                        <a href="{{ url('/') }}" class="hover:text-aqua transition-colors">Home</a>
                        <span>•</span>
                        <span class="text-aqua">{{ $content['contact_page_title'] ?? 'Get in touch' }}</span>
                    </div>
                </div>
                
                <!-- Right Side: Subtitle description -->
                <div class="max-w-md md:text-right">
                    <p class="text-sm sm:text-base text-slate-300 leading-relaxed font-sans">
                        {{ $content['contact_page_subtitle'] ?? 'Our global construction experts are here to help you in this ever-changing market.' }}
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Decorative subtle background accents -->
        <div class="absolute -right-32 -bottom-32 w-96 h-96 rounded-full bg-aqua/5 blur-3xl pointer-events-none"></div>
        <div class="absolute -left-32 -top-32 w-96 h-96 rounded-full bg-sky-500/5 blur-3xl pointer-events-none"></div>
    </section>

    <!-- Overlapping Info Cards Section -->
    <section class="bg-white pb-12 relative z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- 3-Column Grid Overlapping Hero slightly -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 -mt-16">
                
                <!-- Card 1: Support Email -->
                <div class="bg-white border border-slate-150 rounded-3xl p-8 shadow-lg hover:shadow-xl hover:border-slate-250 transition-all flex flex-col justify-between min-h-[240px]">
                    <div class="space-y-4">
                        <!-- Icon -->
                        <div class="h-10 w-10 rounded-xl bg-sky-50 border border-sky-100 flex items-center justify-center text-aqua">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-extrabold text-slate-900 font-sans">{{ $content['contact_support_email_label'] ?? 'Support email' }}</h3>
                            <a href="mailto:{{ $content['header_email'] ?? 'info@construction360.co' }}" class="text-xs font-semibold text-slate-500 hover:text-aqua transition-colors font-sans block mt-1 underline decoration-aqua decoration-2">
                                {{ $content['header_email'] ?? 'info@construction360.co' }}
                            </a>
                        </div>
                    </div>
                    <div class="pt-6">
                        <a href="mailto:{{ $content['header_email'] ?? 'info@construction360.co' }}" 
                           class="w-full py-2.5 px-6 rounded-full text-xs font-bold uppercase tracking-wider text-white bg-[#328f95] hover:bg-[#266b70] transition-all block text-center">
                            Email Us
                        </a>
                    </div>
                </div>

                <!-- Card 2: Mobile Number -->
                <div class="bg-white border border-slate-150 rounded-3xl p-8 shadow-lg hover:shadow-xl hover:border-slate-250 transition-all flex flex-col justify-between min-h-[240px]">
                    <div class="space-y-4">
                        <!-- Phone Icon -->
                        <div class="h-10 w-10 rounded-xl bg-sky-50 border border-sky-100 flex items-center justify-center text-aqua">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-extrabold text-slate-900 font-sans">{{ $content['contact_mobile_label'] ?? 'Mobile Number' }}</h3>
                            <span class="text-xs font-semibold text-slate-500 font-sans block mt-1">
                                {{ $content['header_phone'] ?? '+440203 930 9629' }}
                            </span>
                            <p class="text-slate-500 text-xs font-sans mt-1">Mon-Fri, 9am to 6pm</p>
                        </div>
                    </div>
                    <div class="pt-6">
                        <a href="tel:{{ $content['header_phone'] ?? '+4402039309629' }}" 
                           class="w-full py-2.5 px-6 rounded-full text-xs font-bold uppercase tracking-wider text-white bg-[#328f95] hover:bg-[#266b70] transition-all block text-center">
                            Call Now
                        </a>
                    </div>
                </div>

                <!-- Card 3: Location -->
                <div class="bg-white border border-slate-150 rounded-3xl p-8 shadow-lg hover:shadow-xl hover:border-slate-250 transition-all flex flex-col justify-between min-h-[240px]">
                    <div class="space-y-4">
                        <!-- Icon -->
                        <div class="h-10 w-10 rounded-xl bg-sky-50 border border-sky-100 flex items-center justify-center text-aqua">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25s-7.5-4.108-7.5-11.25a5 5 0 1115 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-extrabold text-slate-900 font-sans">{{ $content['contact_location_label'] ?? 'Location' }}</h3>
                            <p class="text-xs text-slate-550 font-semibold font-sans mt-1 leading-relaxed line-clamp-2">
                                {{ $content['contact_address'] ?? '73 Thrale Road, London, England, SW16 1NU' }}
                            </p>
                        </div>
                    </div>
                    <div class="pt-6">
                        <a href="{{ $content['contact_map_url'] ?? 'https://www.google.com/maps/search/?api=1&query=73+Thrale+Road,+London,+England,+SW16+1NU' }}" target="_blank" rel="noopener noreferrer"
                           class="w-full py-2.5 px-6 rounded-full text-xs font-bold uppercase tracking-wider text-white bg-[#328f95] hover:bg-[#266b70] transition-all block text-center">
                            Visit Us
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Leave a Message Form & Embedded Map Section -->
    <section class="bg-white py-16 lg:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
                
                <!-- Left Side: Contact Form (6 columns) -->
                <div id="message-form" class="lg:col-span-6 space-y-8">
                    <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-slate-955 leading-tight font-sans">
                        {{ $content['contact_page_form_title'] ?? 'Leave a message' }}
                    </h2>

                    <!-- Success Alert -->
                    @if(session('success'))
                        <div class="bg-emerald-50 border border-emerald-250 text-emerald-850 p-4 rounded-xl text-sm flex items-start">
                            <svg class="mr-2.5 h-5 w-5 text-emerald-600 flex-shrink-0 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span class="font-sans font-medium text-emerald-800">{{ session('success') }}</span>
                        </div>
                    @endif

                    <!-- Validation Errors -->
                    @if($errors->any())
                        <div class="bg-red-50 border border-red-200 text-red-850 p-4 rounded-xl text-sm">
                            <ul class="list-disc pl-5 space-y-1 font-sans">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Form -->
                    <form action="{{ route('contact.store') }}" method="POST" id="contact-form" class="space-y-6">
                        @csrf
                        
                        <!-- Combined name placeholder (hidden) -->
                        <input type="hidden" name="name" id="combined-name" value="{{ old('name') }}">
                        
                        <!-- Mock Cloudflare Turnstile Block -->
                        <div class="border border-slate-200 rounded-lg p-3 bg-slate-50 flex items-center justify-between max-w-sm">
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" required id="turnstile-check"
                                       class="h-5.5 w-5.5 rounded border-slate-300 text-[#008080] focus:ring-aqua focus:ring-offset-0 cursor-pointer">
                                <label for="turnstile-check" class="text-[11px] font-bold text-slate-600 font-sans cursor-pointer select-none">
                                    Verify you are human
                                </label>
                            </div>
                        </div>

                        <!-- Name Inputs (split like competitor) -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="first_name" class="block text-xs font-bold uppercase tracking-wider text-slate-550">First Name*</label>
                                <input type="text" id="first_name" required placeholder="John"
                                       class="mt-2.5 block w-full px-4.5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-aqua focus:border-transparent text-xs sm:text-sm transition-all font-sans font-medium">
                            </div>
                            <div>
                                <label for="last_name" class="block text-xs font-bold uppercase tracking-wider text-slate-550">Last Name*</label>
                                <input type="text" id="last_name" required placeholder="Doe"
                                       class="mt-2.5 block w-full px-4.5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-aqua focus:border-transparent text-xs sm:text-sm transition-all font-sans font-medium">
                            </div>
                        </div>

                        <!-- Email Input -->
                        <div>
                            <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-550">Email*</label>
                            <input type="email" name="email" id="email" required value="{{ old('email') }}" placeholder="johndoe@company.com"
                                   class="mt-2.5 block w-full px-4.5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-aqua focus:border-transparent text-xs sm:text-sm transition-all font-sans font-medium">
                        </div>

                        <!-- Message Input -->
                        <div>
                            <label for="message" class="block text-xs font-bold uppercase tracking-wider text-slate-550">Message...</label>
                            <textarea name="message" id="message" rows="5" required placeholder="Describe your architectural requirements or request guidelines..."
                                      class="mt-2.5 block w-full px-4.5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-aqua focus:border-transparent text-xs sm:text-sm transition-all font-sans font-medium">{{ old('message') }}</textarea>
                        </div>

                        <!-- Submit Button with green circle arrow -->
                        <div class="pt-2">
                            <button type="submit"
                                    class="inline-flex items-center space-x-6 pl-8 pr-2.5 py-2.5 border border-slate-200 rounded-full text-slate-900 hover:border-slate-800 transition-all font-sans text-xs font-bold bg-white group hover:bg-slate-50">
                                <span>Submit</span>
                                <span class="h-8 w-8 rounded-full bg-[#328f95] text-white flex items-center justify-center group-hover:bg-[#266b70] transition-colors">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </form>

                    <!-- Mock Architect Thumbnails under form (Competitor detail) -->
                    <div class="flex items-center gap-4 pt-4">
                        <div class="h-16 w-24 rounded-2xl overflow-hidden border border-slate-200 bg-slate-100 shadow-sm flex-shrink-0">
                            <img src="{{ asset('images/project_haydons.png') }}" alt="Residential development project" class="h-full w-full object-cover">
                        </div>
                        <div class="h-16 w-24 rounded-2xl overflow-hidden border border-slate-200 bg-slate-100 shadow-sm flex-shrink-0">
                            <img src="{{ asset('images/project_streatham.png') }}" alt="Commercial conversion project" class="h-full w-full object-cover">
                        </div>
                    </div>
                </div>

                <!-- Right Side: Google Map Iframe (6 columns) -->
                <div class="lg:col-span-6 h-full lg:sticky lg:top-28">
                    <div class="bg-white border border-slate-200 rounded-3xl p-2.5 shadow-md h-full overflow-hidden">
                        <iframe 
                            src="{{ $content['contact_map_embed_url'] ?? 'https://maps.google.com/maps?q=73%20Thrale%20Road,%20London,%20England,%20SW16%201NU&t=&z=15&ie=UTF8&iwloc=&output=embed' }}" 
                            class="w-full h-[320px] sm:h-[450px] lg:h-[540px] rounded-2xl border-0 shadow-inner" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Small Javascript to combine split name fields before submission -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const firstNameInput = document.getElementById('first_name');
            const lastNameInput = document.getElementById('last_name');
            const combinedNameInput = document.getElementById('combined-name');
            const form = document.getElementById('contact-form');
            
            // Populate split fields if combined name is populated from old()
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
