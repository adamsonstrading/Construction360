<!DOCTYPE html>
<html lang="en" class="scroll-smooth h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    @hasSection('meta_title')
        <title>@yield('meta_title')</title>
    @else
        <title>@yield('title', 'Integrated Construction & Premium Architectural Builds') | Construction 360 Ltd</title>
    @endif
    <link rel="canonical" href="{{ url()->current() }}">
    @if(!empty($content['google_site_verification']))
        <meta name="google-site-verification" content="{{ $content['google_site_verification'] }}">
    @endif
    
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
    <!-- JSON-LD Local Business Schema -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "LocalBusiness",
      "name": "Construction 360 Ltd",
      "image": "{{ asset('favicon.svg') }}",
      "@@id": "{{ url('/') }}",
      "url": "{{ url('/') }}",
      "telephone": "{{ $content['contact_phone'] ?? '' }}",
      "email": "{{ $content['header_email'] ?? 'info@construction360.co' }}",
      "address": {
        "@@type": "PostalAddress",
        "streetAddress": "{{ $content['footer_address'] ?? 'Essex, London' }}",
        "addressLocality": "Essex",
        "addressCountry": "GB"
      },
      "geo": {
        "@@type": "GeoCoordinates",
        "latitude": 51.545,
        "longitude": 0.478
      },
      "openingHoursSpecification": {
        "@@type": "OpeningHoursSpecification",
        "dayOfWeek": [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday"
        ],
        "opens": "08:00",
        "closes": "17:00"
      },
      "sameAs": [
        "{{ $content['social_facebook'] ?? '#' }}",
        "{{ $content['social_instagram'] ?? '#' }}",
        "{{ $content['social_linkedin'] ?? '#' }}"
      ]
    }
    </script>
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

    <!-- Header Top Bar (Responsive info & social links) - Kept outside sticky header so it scrolls away -->
    <div class="w-full max-w-7xl mx-auto px-6 sm:px-8 pt-3 pb-1 hidden sm:flex items-center justify-between text-[11px] sm:text-xs font-semibold text-slate-650 tracking-wide font-sans select-none relative z-20">
        <!-- Left Info: Social Links -->
        <div class="flex items-center space-x-3.5 relative z-30">
            <a href="{{ !empty($content['social_facebook']) ? $content['social_facebook'] : 'https://www.facebook.com/people/Construction-360/61590797767639/' }}" target="_blank" aria-label="Facebook" class="hover:opacity-80 transition-opacity block p-1">
                <svg class="h-5 w-5" fill="#1877F2" viewBox="0 0 24 24">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
            </a>
            <a href="{{ !empty($content['social_instagram']) ? $content['social_instagram'] : 'https://www.instagram.com/Construction360.co' }}" target="_blank" aria-label="Instagram" class="hover:opacity-80 transition-opacity block p-1">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <linearGradient id="ig-gradient-top" x1="12" y1="24" x2="12" y2="0" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#FEC564"/>
                            <stop offset="0.328" stop-color="#FF5252"/>
                            <stop offset="0.646" stop-color="#C21975"/>
                            <stop offset="1" stop-color="#4C5FD7"/>
                        </linearGradient>
                    </defs>
                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm3.975-11.413a1.44 1.44 0 100 2.88 1.44 1.44 0 000-2.88z" fill="url(#ig-gradient-top)"/>
                </svg>
            </a>
            <a href="{{ !empty($content['social_linkedin']) ? $content['social_linkedin'] : 'https://www.linkedin.com/company/construction-360' }}" target="_blank" aria-label="LinkedIn" class="hover:opacity-80 transition-opacity block p-1">
                <svg class="h-5 w-5" fill="#0A66C2" viewBox="0 0 24 24">
                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                </svg>
            </a>
            <a href="{{ !empty($content['social_whatsapp']) ? $content['social_whatsapp'] : 'https://wa.me/447500896792' }}" target="_blank" aria-label="WhatsApp" class="hover:opacity-80 transition-opacity block p-1">
                <svg class="h-5 w-5" fill="#25D366" viewBox="0 0 24 24">
                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 11.957.01c3.178 0 6.165 1.237 8.411 3.487 2.247 2.25 3.481 5.24 3.479 8.423-.004 6.549-5.341 11.888-11.9 11.888-2.006 0-3.971-.51-5.714-1.485L0 24zm6.549-3.82c1.684.997 3.518 1.523 5.4 1.527h.005c5.485 0 9.948-4.603 9.95-10.158 0-2.692-1.049-5.223-2.955-7.13C17.098 2.513 14.562 1.46 11.87 1.46h-.003C6.381 1.46 1.921 6.062 1.92 11.619c0 1.986.518 3.927 1.503 5.632l-.988 3.606 3.671-.977zm11.01-6.196c-.302-.15-1.786-.88-2.062-.98-.276-.1-.478-.15-.679.15-.2.3-.777.98-.952 1.18-.176.2-.352.23-.654.08-.302-.15-1.276-.47-2.43-1.5-1.258-1.12-1.806-1.57-1.98-1.87-.174-.3-.02-.46.13-.61.134-.13.3-.35.45-.53.15-.18.2-.3.3-.5.1-.2.05-.38-.025-.53-.075-.15-.68-1.66-.93-2.27-.244-.59-.49-.51-.67-.52-.18-.01-.39-.01-.6-.01-.2 0-.53.07-.81.38-.28.3-.106 1.04-.106 2.54 0 1.5 1.09 2.94 1.24 3.14.15.2 2.14 3.27 5.18 4.58.72.31 1.28.5 1.72.64.73.23 1.4.2 1.92.12.58-.09 1.8-.74 2.05-1.45.25-.71.25-1.32.17-1.45-.07-.12-.27-.2-.57-.35z"/>
                </svg>
            </a>
        </div>

        <!-- Right Info: Email & Phone -->
        <div class="flex items-center space-x-5">
            <a href="mailto:{{ $content['header_email'] ?? 'info@construction360.co' }}" class="flex items-center gap-1.5 hover:text-[#328f95] transition-colors duration-250">
                <svg class="h-4 w-4 text-[#328f95] flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                </svg>
                <span>{{ $content['header_email'] ?? 'info@construction360.co' }}</span>
            </a>
            <span class="text-slate-200">|</span>
            <a href="tel:{{ $content['header_phone'] ?? '+4402039309629' }}" class="flex items-center gap-1.5 hover:text-[#328f95] transition-colors duration-250">
                <svg class="h-4 w-4 text-[#328f95] flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.824-1.802-5.14-4.118-6.942-6.942l1.293-.97c.362-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v1.5z" />
                </svg>
                <span>{{ $content['header_phone'] ?? '+440203 930 9629' }}</span>
            </a>
        </div>
    </div>

    <!-- Header Navigation -->
    <header class="sticky top-0 z-50 bg-transparent transition-all duration-350 py-3 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto bg-white border border-slate-150 rounded-full shadow-lg h-20 px-6 sm:px-8 flex items-center justify-between">
            <!-- Logo Section -->
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="flex items-center group">
                    @include('partials.logo', ['idSuffix' => 'nav', 'class' => 'max-h-12 w-auto max-w-[200px]', 'icon_only' => false, 'color_mode' => 'light'])
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

            <!-- Desktop Right: Button -->
            <div class="hidden lg:flex items-center">
                <!-- Pill-shape Button matching competitor green color -->
                <a href="#" onclick="openTenderModal(); return false;" class="inline-flex items-center justify-center px-6 py-3 text-xs font-bold uppercase tracking-widest text-white bg-[#328f95] hover:bg-[#266b70] rounded-full shadow-sm transition-all duration-200">
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
                <a href="#" onclick="openTenderModal(); return false;" class="block text-center py-3 text-xs font-bold uppercase tracking-widest text-white bg-[#328f95] hover:bg-[#266b70] rounded-full shadow-sm">
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
            <span class="text-[10px] font-bold uppercase tracking-widest text-[#328f95]">{{ $content['pre_footer_cta_title'] ?? 'Your Execution Partner' }}</span>
            <h2 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white tracking-tighter leading-none font-heading">
                {{ $content['pre_footer_cta_title'] ?? 'Your Execution Partner' }}
            </h2>
            <p class="text-sm sm:text-base text-slate-300 leading-relaxed font-sans max-w-xl mx-auto">
                {{ $content['pre_footer_cta_subtitle'] ?? "Whether you're exploring our premium architectural builds or envisioning a custom structural solution, we are here to bring your vision to life." }}
            </p>
            <div class="pt-4 flex justify-center">
                <a href="#" onclick="openTenderModal(); return false;" class="inline-flex w-32 h-32 rounded-full bg-[#328f95] hover:bg-[#266b70] text-white font-bold text-xs tracking-wider uppercase items-center justify-center text-center transition-all duration-300 shadow-xl shadow-[#328f95]/10 hover:scale-105">
                    <span class="px-3">{!! nl2br(e($content['cta_get_free_quote_label'] ?? "Get Your\nFree\nQuote")) !!}</span>
                </a>
            </div>
        </div>

        <!-- Overlapping Footer Card -->
        <footer class="bg-white rounded-[30px] lg:rounded-[40px] shadow-2xl relative z-10 -mt-16 mx-4 sm:mx-6 lg:mx-8 max-w-7xl xl:mx-auto pt-16 pb-12 mb-8 border border-slate-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-12 items-start">
                    
                    <!-- Column 1: Brand & Tagline -->
                    <div class="md:col-span-3 space-y-6">
                        <a href="{{ url('/') }}" class="block -mt-6">
                            @include('partials.logo', ['idSuffix' => 'foot', 'class' => 'w-full max-w-[220px] max-h-20 object-contain object-left-top', 'icon_only' => false, 'color_mode' => 'light'])
                        </a>
                        <p class="text-xs sm:text-sm text-slate-500 leading-relaxed font-sans font-medium">
                            {{ $content['footer_description'] ?? 'Delivering 360-degree integration of premium architectural builds, structural planning, and design-build management.' }}
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
                            <a href="mailto:{{ $content['header_email'] ?? 'info@construction360.co' }}" class="text-base sm:text-lg lg:text-xl font-extrabold text-slate-900 hover:text-[#328f95] transition-colors tracking-tight font-sans leading-none">
                                {{ $content['header_email'] ?? 'info@construction360.co' }}
                            </a>
                            <svg class="h-5 w-5 text-[#328f95] flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                        </div>

                        <!-- Phone detail row -->
                        <div class="border-b border-slate-150 pb-3.5 flex items-center justify-between">
                            <a href="tel:{{ $content['header_phone'] ?? '+4402039309629' }}" class="text-base sm:text-lg lg:text-xl font-extrabold text-slate-900 hover:text-[#328f95] transition-colors tracking-tight font-sans leading-none">
                                {{ $content['header_phone'] ?? '+440203 930 9629' }}
                            </a>
                            <svg class="h-5 w-5 text-[#328f95] flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.824-1.802-5.14-4.118-6.942-6.942l1.293-.97c.362-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v1.5z" />
                            </svg>
                        </div>

                        <!-- Digital Tenders highlight row -->
                        <div class="border-b border-slate-150 pb-3.5 flex items-center justify-between">
                            <span class="text-base sm:text-lg lg:text-xl font-extrabold text-slate-900 tracking-tight font-sans leading-none">
                                {{ $content['digital_tenders_only_label'] ?? 'Digital Tenders Only' }}
                            </span>
                            <svg class="h-5 w-5 text-[#328f95] flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                            </svg>
                        </div>

                        <!-- Address -->
                        <p class="text-xs sm:text-sm text-slate-550 font-sans leading-relaxed font-medium">
                            {{ $content['contact_address'] ?? '73 Thrale Road, London, England, SW16 1NU' }}
                        </p>

                        <!-- Social Media Links -->
                        <div class="flex flex-wrap items-center gap-x-5 gap-y-2 pt-2">
                            <a href="{{ !empty($content['social_facebook']) ? $content['social_facebook'] : 'https://www.facebook.com/people/Construction-360/61590797767639/' }}" target="_blank" aria-label="Facebook" class="hover:opacity-80 transition-opacity">
                                <!-- Original Facebook Icon -->
                                <svg class="h-6 w-6" fill="#1877F2" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <a href="{{ !empty($content['social_instagram']) ? $content['social_instagram'] : 'https://www.instagram.com/Construction360.co' }}" target="_blank" aria-label="Instagram" class="hover:opacity-80 transition-opacity">
                                <!-- Original Instagram Icon -->
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <defs>
                                        <linearGradient id="ig-gradient" x1="12" y1="24" x2="12" y2="0" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#FEC564"/>
                                            <stop offset="0.328" stop-color="#FF5252"/>
                                            <stop offset="0.646" stop-color="#C21975"/>
                                            <stop offset="1" stop-color="#4C5FD7"/>
                                        </linearGradient>
                                    </defs>
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm3.975-11.413a1.44 1.44 0 100 2.88 1.44 1.44 0 000-2.88z" fill="url(#ig-gradient)"/>
                                </svg>
                            </a>
                            <a href="{{ !empty($content['social_linkedin']) ? $content['social_linkedin'] : 'https://www.linkedin.com/company/construction-360' }}" target="_blank" aria-label="LinkedIn" class="hover:opacity-80 transition-opacity">
                                <!-- Original LinkedIn Icon -->
                                <svg class="h-6 w-6" fill="#0A66C2" viewBox="0 0 24 24">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                            </a>
                            <a href="{{ !empty($content['social_whatsapp']) ? $content['social_whatsapp'] : 'https://wa.me/447500896792' }}" target="_blank" aria-label="WhatsApp" class="hover:opacity-80 transition-opacity">
                                <svg class="h-6 w-6" fill="#25D366" viewBox="0 0 24 24">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 11.957.01c3.178 0 6.165 1.237 8.411 3.487 2.247 2.25 3.481 5.24 3.479 8.423-.004 6.549-5.341 11.888-11.9 11.888-2.006 0-3.971-.51-5.714-1.485L0 24zm6.549-3.82c1.684.997 3.518 1.523 5.4 1.527h.005c5.485 0 9.948-4.603 9.95-10.158 0-2.692-1.049-5.223-2.955-7.13C17.098 2.513 14.562 1.46 11.87 1.46h-.003C6.381 1.46 1.921 6.062 1.92 11.619c0 1.986.518 3.927 1.503 5.632l-.988 3.606 3.671-.977zm11.01-6.196c-.302-.15-1.786-.88-2.062-.98-.276-.1-.478-.15-.679.15-.2.3-.777.98-.952 1.18-.176.2-.352.23-.654.08-.302-.15-1.276-.47-2.43-1.5-1.258-1.12-1.806-1.57-1.98-1.87-.174-.3-.02-.46.13-.61.134-.13.3-.35.45-.53.15-.18.2-.3.3-.5.1-.2.05-.38-.025-.53-.075-.15-.68-1.66-.93-2.27-.244-.59-.49-.51-.67-.52-.18-.01-.39-.01-.6-.01-.2 0-.53.07-.81.38-.28.3-.106 1.04-.106 2.54 0 1.5 1.09 2.94 1.24 3.14.15.2 2.14 3.27 5.18 4.58.72.31 1.28.5 1.72.64.73.23 1.4.2 1.92.12.58-.09 1.8-.74 2.05-1.45.25-.71.25-1.32.17-1.45-.07-.12-.27-.2-.57-.35z"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                </div>

                <!-- Muted Copyright bar with competitor design line -->
                <div class="border-t border-slate-150 mt-16 pt-8 flex flex-col items-center justify-center text-center text-[10px] sm:text-xs text-slate-600 font-semibold font-sans tracking-wide space-y-1">
                    <span>{{ $content['footer_company_registration'] ?? 'This Company is Registered in England and Wales. Company number 17277526' }}</span>
                    <span>Construction 360 Ltd &copy; 2026 - All Rights reserved.</span>
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
    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/447500896792" target="_blank" aria-label="Chat on WhatsApp" class="fixed bottom-6 left-6 z-50 flex items-center justify-center w-14 h-14 bg-[#25D366] text-white rounded-full shadow-lg hover:bg-[#128C7E] hover:scale-110 transition-all duration-300">
        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M12.031 21.014c-1.636-.002-3.238-.42-4.664-1.21L2.247 21.52l1.758-5.003c-.868-1.468-1.325-3.14-1.322-4.862C2.686 5.86 7.378 1.168 13.167 1.17c2.81.002 5.454 1.096 7.441 3.084 1.986 1.988 3.08 4.633 3.078 7.444-.004 5.797-4.695 10.49-10.485 10.493l-1.17-.177zm5.556-7.585c-.305-.152-1.802-.888-2.08-.99-.279-.101-.482-.153-.686.152-.204.305-.788.99-.966 1.194-.178.204-.356.23-.661.077-.305-.153-1.286-.474-2.453-1.516-.906-.811-1.517-1.815-1.696-2.12-.178-.306-.02-.472.133-.625.138-.138.305-.357.458-.535.153-.178.204-.305.305-.509.102-.204.051-.382-.025-.535-.077-.152-.686-1.654-.94-2.264-.247-.593-.497-.513-.686-.523-.178-.01-.382-.01-.585-.01-.204 0-.535.076-.814.382-.279.305-1.067 1.042-1.067 2.54 0 1.498 1.093 2.946 1.246 3.149.153.204 2.148 3.28 5.203 4.597.727.313 1.294.5 1.738.641.73.232 1.393.199 1.916.12.585-.088 1.802-.736 2.056-1.448.254-.712.254-1.323.178-1.448-.076-.126-.279-.203-.584-.356z"/>
        </svg>
    </a>

    @yield('scripts')
</body>
</html>
