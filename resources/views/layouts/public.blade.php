<!DOCTYPE html>
<html lang="en" class="scroll-smooth h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <title>@yield('title', 'Integrated Construction & Premium Architectural Builds') | Construction 360 Ltd</title>
    
    <!-- Meta tags -->
    @hasSection('meta')
        @yield('meta')
    @else
        <meta name="description" content="{{ $content['seo_meta_description'] ?? 'Construction 360 Ltd delivers 360-degree integration of design, structural planning, and premium quality construction management.' }}">
        <meta name="keywords" content="{{ $content['seo_meta_keywords'] ?? 'construction, architectural builds, structural engineering, commercial fit-outs, extensions, renovations, glazing, Essex, London' }}">
    @endif
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Vite CSS & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FFFFFF;
            color: #1E293B;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
        }
        .text-teal {
            color: #008080;
        }
        .bg-teal {
            background-color: #008080;
        }
        .border-teal {
            border-color: #008080;
        }
        .bg-construction {
            background-color: #1E293B;
        }
    </style>
    @yield('styles')
</head>
<body class="antialiased min-h-screen flex flex-col relative overflow-x-hidden">

    <!-- Global Success Toast -->
    @if(session('success'))
        <div id="global-success-toast" class="fixed top-5 right-5 z-[200] max-w-sm bg-slate-900 border border-slate-800 text-white p-4 rounded-xl shadow-2xl flex items-start space-x-3 transition-all duration-500 translate-y-0 opacity-100">
            <div class="p-1 bg-[#008080] rounded-lg text-white">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <div class="flex-grow space-y-1">
                <h4 class="text-xs font-bold uppercase tracking-wider text-[#38BDF8]">Submission Successful</h4>
                <p class="text-xs text-slate-350 leading-relaxed">{{ session('success') }}</p>
            </div>
            <button type="button" onclick="document.getElementById('global-success-toast').remove()" class="text-slate-400 hover:text-white transition-colors focus:outline-none">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <script>
            setTimeout(() => {
                const toast = document.getElementById('global-success-toast');
                if (toast) {
                    toast.classList.add('translate-y-[-20px]', 'opacity-0');
                    setTimeout(() => toast.remove(), 500);
                }
            }, 6000);
        </script>
    @endif

    <!-- Header Navigation -->
    <header class="sticky top-0 z-50 bg-transparent transition-all duration-350 py-4 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto bg-white border border-slate-150 rounded-full shadow-lg h-20 px-6 sm:px-8 flex items-center justify-between">
            <!-- Logo Section -->
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="flex items-center group">
                    @include('partials.logo', ['idSuffix' => 'nav', 'class' => 'h-54 w-auto max-w-[200px]', 'icon_only' => false, 'color_mode' => 'light'])
                </a>
                <!-- Vertical Separator Line -->
                <div class="hidden lg:block h-8 w-[1px] bg-slate-200 mx-6"></div>
            </div>

            <!-- Desktop Nav Links (Competitor Matched) -->
            <nav id="desktop-nav" class="hidden lg:flex items-center space-x-6">
                <a href="{{ url('/') }}" class="nav-link text-xs font-bold uppercase tracking-widest text-slate-700 hover:text-aqua transition-colors evoke-link">Home</a>
                <a href="{{ url('/?scroll=about') }}" class="nav-link text-xs font-bold uppercase tracking-widest text-slate-700 hover:text-aqua transition-colors evoke-link" data-scroll="about">Who We Are</a>
                <a href="{{ route('services.index') }}" class="nav-link text-xs font-bold uppercase tracking-widest text-slate-700 hover:text-aqua transition-colors evoke-link">Our Services</a>
                <a href="{{ route('projects.index') }}" class="nav-link text-xs font-bold uppercase tracking-widest text-slate-700 hover:text-aqua transition-colors evoke-link">Projects</a>
                <a href="{{ route('blog.index') }}" class="nav-link text-xs font-bold uppercase tracking-widest text-slate-700 hover:text-aqua transition-colors evoke-link">News</a>
                <a href="{{ route('contact.index') }}" class="nav-link text-xs font-bold uppercase tracking-widest text-slate-700 hover:text-aqua transition-colors evoke-link">Contact</a>
            </nav>

            <!-- Desktop Right: Mail Link & Button -->
            <div class="hidden lg:flex items-center space-x-6">
                <!-- Mail Link (Replaces number) -->
                <a href="mailto:{{ $content['header_email'] ?? 'info@construction360.co' }}" class="flex items-center text-xs font-bold text-slate-700 hover:text-aqua transition-colors group">
                    <span class="underline decoration-aqua decoration-2 underline-offset-4">{{ $content['header_email'] ?? 'info@construction360.co' }}</span>
                </a>

                <!-- Pill-shape Button matching competitor green color -->
                <a href="#" onclick="openTenderModal(); return false;" class="inline-flex items-center justify-center px-6 py-3 text-xs font-bold uppercase tracking-widest text-slate-900 bg-[#84cc16] hover:bg-[#65a30d] hover:text-white rounded-full shadow-sm transition-all duration-200">
                    Get In Touch
                </a>
            </div>

            <!-- Mobile menu button -->
            <button id="menu-toggle" type="button" class="lg:hidden p-2 text-slate-700 hover:text-slate-950 focus:outline-none">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Mobile Drawer Links (hidden by default) -->
        <div id="mobile-menu" class="hidden lg:hidden mt-2 bg-white border border-slate-150 rounded-2xl p-6 space-y-4 shadow-xl">
            <a href="{{ url('/') }}" class="block text-sm font-bold uppercase tracking-widest text-slate-700 hover:text-aqua transition-colors">Home</a>
            <a href="{{ url('/?scroll=about') }}" class="block text-sm font-bold uppercase tracking-widest text-slate-700 hover:text-aqua transition-colors" data-scroll="about">Who We Are</a>
            <a href="{{ route('services.index') }}" class="block text-sm font-bold uppercase tracking-widest text-slate-700 hover:text-aqua transition-colors">Our Services</a>
            <a href="{{ route('projects.index') }}" class="block text-sm font-bold uppercase tracking-widest text-slate-700 hover:text-aqua transition-colors">Projects</a>
            <a href="{{ route('blog.index') }}" class="block text-sm font-bold uppercase tracking-widest text-slate-700 hover:text-aqua transition-colors">News</a>
            <a href="{{ route('contact.index') }}" class="block text-sm font-bold uppercase tracking-widest text-slate-700 hover:text-aqua transition-colors">Contact</a>
            <div class="pt-4 border-t border-slate-100 flex flex-col space-y-3">
                <a href="mailto:{{ $content['header_email'] ?? 'info@construction360.co' }}" class="text-xs font-bold text-slate-700 hover:text-aqua flex items-center">
                    <span>{{ $content['header_email'] ?? 'info@construction360.co' }}</span>
                </a>
                <a href="#" onclick="openTenderModal(); return false;" class="block text-center py-3 text-xs font-bold uppercase tracking-widest text-slate-900 bg-[#84cc16] hover:bg-[#65a30d] hover:text-white rounded-full shadow-sm">
                    Get In Touch
                </a>
            </div>
        </div>
    </header>

    @yield('content')

    <!-- Pre-Footer & Overlapping Footer Wrapper -->
    <div class="relative bg-slate-950 overflow-hidden w-full pt-16">
        <!-- Background Image for the whole wrapper -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/hero_architecture.png') }}" alt="Footer Background" class="w-full h-full object-cover opacity-25">
            <div class="absolute inset-0 bg-gradient-to-b from-slate-950/70 via-slate-900/50 to-slate-950/80"></div>
        </div>

        <!-- Giant outline watermark brand text "C360" in background -->
        <div class="absolute inset-0 flex items-center justify-center pointer-events-none select-none z-5 overflow-hidden">
            <span class="text-[12rem] sm:text-[20rem] lg:text-[28rem] font-black tracking-widest text-white/5 opacity-80 leading-none">C360</span>
        </div>

        <!-- Pre-Footer CTA Content -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center py-20 lg:py-28 space-y-6">
            <span class="text-[10px] font-bold uppercase tracking-widest text-[#84cc16]">Your Execution Partner</span>
            <h2 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white tracking-tighter leading-none font-heading">
                Your Execution Partner
            </h2>
            <p class="text-sm sm:text-base text-slate-300 leading-relaxed font-sans max-w-xl mx-auto">
                Whether you're exploring our premium architectural builds or envisioning a custom structural solution, we are here to bring your vision to life.
            </p>
            <div class="pt-4 flex justify-center">
                <a href="#" onclick="openTenderModal(); return false;" class="inline-flex w-32 h-32 rounded-full bg-[#84cc16] hover:bg-[#65a30d] text-slate-950 hover:text-white font-bold text-xs tracking-wider uppercase items-center justify-center text-center transition-all duration-300 shadow-xl shadow-[#84cc16]/10 hover:scale-105">
                    <span class="px-3">Get Your<br>Free<br>Quote</span>
                </a>
            </div>
        </div>

        <!-- Overlapping Footer Card -->
        <footer class="bg-white rounded-[30px] lg:rounded-[40px] shadow-2xl relative z-10 -mt-16 mx-4 sm:mx-6 lg:mx-8 max-w-7xl xl:mx-auto pt-16 pb-12 mb-8 border border-slate-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-12 items-start">
                    
                    <!-- Column 1: Brand & Tagline -->
                    <div class="md:col-span-3 space-y-6">
                        <a href="{{ url('/') }}" class="flex items-center">
                            @include('partials.logo', ['idSuffix' => 'foot', 'class' => 'h-54 w-auto max-w-[200px]', 'icon_only' => false, 'color_mode' => 'light'])
                        </a>
                        <p class="text-xs sm:text-sm text-slate-500 leading-relaxed font-sans">
                            Real experience. Real quality. London’s trusted construction partner.
                        </p>
                    </div>

                    <!-- Column 2: Bounded Middle Navigation Links -->
                    <div class="md:col-span-5 grid grid-cols-2 gap-x-4 gap-y-3.5 md:border-l md:border-r border-slate-150 px-0 md:px-8 lg:px-12">
                        <div class="space-y-3">
                            <a href="{{ url('/?scroll=about') }}" class="block text-xs sm:text-sm font-bold text-slate-700 hover:text-aqua transition-colors font-sans py-0.5">About Us</a>
                            <a href="{{ route('tendering') }}" class="block text-xs sm:text-sm font-bold text-slate-700 hover:text-aqua transition-colors font-sans py-0.5">Tendering Standard</a>
                            <a href="{{ url('/?scroll=why-choose-us') }}" class="block text-xs sm:text-sm font-bold text-slate-700 hover:text-aqua transition-colors font-sans py-0.5">Why Choose Us</a>
                            <a href="{{ route('services.index') }}" class="block text-xs sm:text-sm font-bold text-slate-700 hover:text-aqua transition-colors font-sans py-0.5">Our Services</a>
                            <a href="{{ url('/?scroll=team') }}" class="block text-xs sm:text-sm font-bold text-slate-700 hover:text-aqua transition-colors font-sans py-0.5">Our Team</a>
                        </div>
                        <div class="space-y-3">
                            <a href="{{ route('contact.index') }}" class="block text-xs sm:text-sm font-bold text-slate-700 hover:text-aqua transition-colors font-sans py-0.5">Contact</a>
                            <a href="{{ route('privacy') }}" class="block text-xs sm:text-sm font-bold text-slate-700 hover:text-aqua transition-colors font-sans py-0.5">Privacy Policy</a>
                            <a href="{{ route('terms') }}" class="block text-xs sm:text-sm font-bold text-slate-700 hover:text-aqua transition-colors font-sans py-0.5">Terms & Conditions</a>
                            <a href="{{ route('blog.index') }}" class="block text-xs sm:text-sm font-bold text-slate-700 hover:text-aqua transition-colors font-sans py-0.5">News & Updates</a>
                        </div>
                    </div>

                    <!-- Column 3: Contact details & Social Row -->
                    <div class="md:col-span-4 space-y-5 md:pl-6">
                        <!-- Email detail row -->
                        <div class="border-b border-slate-150 pb-3.5 flex items-center justify-between">
                            <a href="mailto:{{ $content['header_email'] ?? 'info@construction360.co' }}" class="text-base sm:text-lg lg:text-xl font-extrabold text-slate-900 hover:text-aqua transition-colors tracking-tight font-sans leading-none">
                                {{ $content['header_email'] ?? 'info@construction360.co' }}
                            </a>
                            <svg class="h-5 w-5 text-aqua flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                        </div>

                        <!-- Digital Tenders highlight row -->
                        <div class="border-b border-slate-150 pb-3.5 flex items-center justify-between">
                            <span class="text-base sm:text-lg lg:text-xl font-extrabold text-slate-900 tracking-tight font-sans leading-none">
                                Digital Tenders Only
                            </span>
                            <svg class="h-5 w-5 text-aqua flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                            </svg>
                        </div>

                        <!-- Address -->
                        <p class="text-xs sm:text-sm text-slate-550 font-sans leading-relaxed font-medium">
                            {{ $content['contact_address'] ?? '6a, Kingfisher House, Restmor Way, Hackbridge, Wallington SM6 7AH' }}
                        </p>

                        <!-- Social Media Links -->
                        <div class="flex flex-wrap items-center gap-x-5 gap-y-2 text-xs font-bold text-slate-500 font-sans tracking-wide pt-2">
                            <a href="{{ $content['social_facebook'] ?? 'https://www.facebook.com/people/Construction-360/61590797767639/' }}" class="hover:text-aqua flex items-center space-x-1.5 transition-colors">
                                <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1V12h3v3h-3v6.8c4.56-.93 8-4.96 8-9.8z"/></svg>
                                <span>Facebook</span>
                            </a>
                            <a href="{{ $content['social_instagram'] ?? 'https://www.instagram.com/Construction360.co' }}" class="hover:text-aqua flex items-center space-x-1.5 transition-colors">
                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9a6 6 0 016-6h6a6 6 0 016 6v6a6 6 0 01-6 6H9a6 6 0 01-6-6V9z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 15a3 3 0 100-6 3 3 0 000 6zM16.5 7.5h.01"/></svg>
                                <span>Instagram</span>
                            </a>
                            <a href="{{ $content['social_linkedin'] ?? 'https://www.linkedin.com/company/construction-360' }}" class="hover:text-aqua flex items-center space-x-1.5 transition-colors">
                                <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.779-1.75-1.75s.784-1.75 1.75-1.75 1.75.779 1.75 1.75-.784 1.75-1.75 1.75zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                                <span>Linkedin</span>
                            </a>
                        </div>
                    </div>

                </div>

                <!-- Muted Copyright bar with competitor design line -->
                <div class="border-t border-slate-150 mt-16 pt-8 text-center text-[10px] sm:text-xs text-slate-400 font-sans tracking-wide">
                    Construction 360 Ltd © 2026 - All Rights reserved.
                </div>
            </div>
        </footer>
    </div>

    <!-- Tender Brief Popup Modal Overlay -->
    <div id="tender-brief-modal" class="hidden fixed inset-0 z-[100] flex items-center justify-center px-4 overflow-y-auto">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm transition-opacity" onclick="closeTenderModal()"></div>
        <!-- Modal Card -->
        <div class="relative bg-white border border-slate-200 rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto shadow-2xl flex flex-col z-10 transition-transform">
            <!-- Modal Header -->
            <div class="sticky top-0 bg-white/95 backdrop-blur-md px-6 py-4 border-b border-slate-150 flex items-center justify-between z-20">
                <div class="flex items-center space-x-2">
                    <span class="h-2.5 w-2.5 rounded-full bg-aqua animate-pulse"></span>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-800">Submit Project Brief</span>
                </div>
                <button type="button" onclick="closeTenderModal()" class="p-1.5 rounded-lg text-slate-400 hover:text-slate-650 hover:bg-slate-50 transition-colors focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <!-- Modal Body Content (Form) -->
            <div class="p-6 sm:p-8 space-y-6">
                <div class="text-center max-w-md mx-auto">
                    <h3 class="text-xl font-extrabold text-slate-900 tracking-tight">Instant Tender Submission</h3>
                    <p class="mt-2 text-xs text-slate-500">Provide details of your architectural scopes. Our structural coordinators will compile specs and respond within 24 hours.</p>
                </div>
                
                <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <input type="hidden" name="is_modal" value="1">
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="modal-name" class="block text-xs font-bold uppercase tracking-wider text-slate-500">Contact Full Name</label>
                            <input type="text" name="name" id="modal-name" required placeholder="John Doe"
                                class="mt-2 block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 placeholder-slate-450 focus:outline-none focus:ring-2 focus:ring-aqua focus:border-transparent text-sm transition-all">
                        </div>
                        <div>
                            <label for="modal-email" class="block text-xs font-bold uppercase tracking-wider text-slate-500">Contact Email Address</label>
                            <input type="email" name="email" id="modal-email" required placeholder="johndoe@company.com"
                                class="mt-2 block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 placeholder-slate-450 focus:outline-none focus:ring-2 focus:ring-aqua focus:border-transparent text-sm transition-all">
                        </div>
                    </div>

                    <div>
                        <label for="modal-subject" class="block text-xs font-bold uppercase tracking-wider text-slate-500">Subject / Project Category</label>
                        <input type="text" name="subject" id="modal-subject" placeholder="e.g. Structural Framing Tender"
                            class="mt-2 block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 placeholder-slate-450 focus:outline-none focus:ring-2 focus:ring-aqua focus:border-transparent text-sm transition-all">
                    </div>

                    <div>
                        <label for="modal-message" class="block text-xs font-bold uppercase tracking-wider text-slate-500">Project Specifications & Scope</label>
                        <textarea name="message" id="modal-message" rows="4" required placeholder="Provide a detailed description of architectural scopes, location, estimated schedule, or materials requirements..."
                            class="mt-2 block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 placeholder-slate-450 focus:outline-none focus:ring-2 focus:ring-aqua focus:border-transparent text-sm transition-all"></textarea>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full py-3.5 px-6 rounded-lg text-sm font-bold text-white bg-aqua hover:bg-aqua-dark shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-aqua focus:ring-offset-2 focus:ring-offset-white transition-colors">
                            Submit Tender Specifications
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openTenderModal() {
            const modal = document.getElementById('tender-brief-modal');
            if (modal) {
                modal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            }
        }

        function closeTenderModal() {
            const modal = document.getElementById('tender-brief-modal');
            if (modal) {
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (menuToggle && mobileMenu) {
                menuToggle.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
                
                // Close mobile menu when clicking any anchor links inside
                document.querySelectorAll('#mobile-menu a').forEach(link => {
                    link.addEventListener('click', () => {
                        mobileMenu.classList.add('hidden');
                    });
                });
            }

            // 1. Intercept navigation links on the homepage to scroll smoothly
            const isHomepage = window.location.pathname === '/' || window.location.pathname === '' || window.location.pathname.endsWith('/index.php');
            
            document.querySelectorAll('a[data-scroll]').forEach(link => {
                link.addEventListener('click', function(e) {
                    if (isHomepage) {
                        const targetId = this.getAttribute('data-scroll');
                        const targetElement = document.getElementById(targetId);
                        if (targetElement) {
                            e.preventDefault();
                            targetElement.scrollIntoView({ behavior: 'smooth' });
                        }
                    }
                });
            });

            // 2. Intercept hash-only links on the homepage (like CTA buttons) to scroll smoothly
            document.querySelectorAll('a[href^="#"]').forEach(link => {
                link.addEventListener('click', function(e) {
                    const targetId = this.getAttribute('href').substring(1);
                    if (targetId) {
                        const targetElement = document.getElementById(targetId);
                        if (targetElement) {
                            e.preventDefault();
                            targetElement.scrollIntoView({ behavior: 'smooth' });
                        }
                    }
                });
            });

            // 3. Handle query parameters on page load for cross-page navigation
            const urlParams = new URLSearchParams(window.location.search);
            const scrollToSection = urlParams.get('scroll');
            const shouldOpenTender = urlParams.get('open-tender') === '1' || scrollToSection === 'contact';
            
            if (shouldOpenTender) {
                openTenderModal();
                // Clean URL query parameters to keep address bar pristine (hash-free)
                window.history.replaceState({}, document.title, window.location.pathname);
            } else if (scrollToSection) {
                const targetElement = document.getElementById(scrollToSection);
                if (targetElement) {
                    setTimeout(() => {
                        targetElement.scrollIntoView({ behavior: 'smooth' });
                    }, 250);
                }
                // Clean URL query parameters to keep address bar pristine (hash-free)
                window.history.replaceState({}, document.title, window.location.pathname);
            }

            @yield('scripts-ready')
        });
    </script>
    @yield('scripts')
</body>
</html>
