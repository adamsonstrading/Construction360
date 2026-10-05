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

    <!-- Robots -->
    <meta name="robots" content="index, follow">
    <meta name="author" content="Construction 360 Ltd">

    <!-- Global Open Graph fallback (overridden per-page via @section('meta')) -->
    @hasSection('meta')
    @else
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Construction 360 Ltd">
    <meta property="og:title" content="@yield('title', $content['seo_meta_title'] ?? 'Integrated Construction & Premium Architectural Builds') | Construction 360 Ltd">
    <meta property="og:description" content="{{ $content['seo_meta_description'] ?? 'Construction 360 Ltd delivers 360-degree integration of design, structural planning, and premium quality construction management.' }}">
    <meta property="og:image" content="{{ asset('images/hero_construction.png') }}">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', $content['seo_meta_title'] ?? 'Integrated Construction & Premium Architectural Builds') | Construction 360 Ltd">
    <meta property="twitter:description" content="{{ $content['seo_meta_description'] ?? 'Construction 360 Ltd delivers 360-degree integration of design, structural planning, and premium quality construction management.' }}">
    <meta property="twitter:image" content="{{ asset('images/hero_construction.png') }}">
    @endif

    <!-- Vite CSS & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Google reCAPTCHA v2 -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <style>
        body {
            font-family: system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', 'Noto Sans', 'Liberation Sans', Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
            background-color: #f5f1ea;
            color: #1a1a1a;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .font-heading {
            font-family: system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', 'Noto Sans', 'Liberation Sans', Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
        }

        .text-teal {
            color: #36a1b3;
        }

        .bg-teal {
            background-color: #36a1b3;
        }

        .border-teal {
            border-color: #36a1b3;
        }

        .bg-construction {
            background-color: #184851;
        }

        /* Site Top Utility Bar (Social links) */
        #site-topbar {
            background-color: #41a1b2 !important;
            color: #ffffff !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15) !important;
            font-size: 12px !important;
            font-weight: 500 !important;
            line-height: 1 !important;
            display: block !important;
            width: 100% !important;
        }

        #site-topbar .topbar-inner {
            max-width: 1440px;
            margin: 0 auto;
            padding: 0 1rem;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        @media (min-width: 640px) {
            #site-topbar .topbar-inner {
                padding: 0 1.5rem;
            }
        }

        @media (min-width: 1024px) {
            #site-topbar .topbar-inner {
                padding: 0 2rem;
            }
        }

        #site-topbar .topbar-social-wrap {
            display: flex;
            align-items: center;
            gap: 0.85rem;
        }

        #site-topbar .topbar-social-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.14em;
            color: rgba(255, 255, 255, 0.85);
            font-weight: 700;
        }

        #site-topbar .topbar-social-links {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        #site-topbar .topbar-social-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            border-radius: 9999px;
            background-color: rgba(255, 255, 255, 0.2);
            color: #ffffff !important;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
        }

        #site-topbar .topbar-social-icon svg {
            width: 14px;
            height: 14px;
            fill: currentColor;
        }

        #site-topbar .topbar-social-icon:hover {
            transform: translateY(-1.5px) scale(1.08);
            background-color: #ffffff;
        }

        #site-topbar .topbar-social-icon.facebook:hover {
            background-color: #ffffff;
            color: #1877F2 !important;
        }

        #site-topbar .topbar-social-icon.instagram:hover {
            background-color: #ffffff;
            color: #E4405F !important;
        }

        #site-topbar .topbar-social-icon.linkedin:hover {
            background-color: #ffffff;
            color: #0A66C2 !important;
        }

        #site-topbar .topbar-social-icon.whatsapp:hover {
            background-color: #ffffff;
            color: #25D366 !important;
        }

        @media (max-width: 639px) {
            #site-topbar .topbar-inner {
                height: 36px;
                padding: 0 0.875rem;
            }

            #site-topbar .topbar-social-icon {
                width: 26px;
                height: 26px;
            }

            #site-topbar .topbar-social-icon svg {
                width: 13px;
                height: 13px;
            }
        }

        /* Responsive Auto-adjusting Mega Menu */
        #site-header .nav-mega-menu {
            display: none;
            position: absolute;
            left: 0;
            right: 0;
            top: 100%;
            z-index: 70;
            padding: 0.75rem 1.5rem 0;
            margin: 0;
        }

        #site-header .nav-dropdown--mega:hover .nav-mega-menu,
        #site-header .nav-dropdown--mega:focus-within .nav-mega-menu,
        #site-header .nav-dropdown--mega.is-open .nav-mega-menu {
            display: block;
        }

        #site-header .nav-mega-inner {
            background: #ffffff;
            border: 1px solid rgba(0, 0, 0, 0.08);
            border-radius: 1.5rem;
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.12), 0 4px 16px rgba(0, 0, 0, 0.04);
            padding: 2.25rem 2.5rem 1.5rem;
            max-width: 1440px;
            margin: 0 auto;
            max-height: calc(85vh - 85px);
            overflow-y: auto;
            overscroll-behavior: contain;
        }

        #site-header .nav-mega-inner::-webkit-scrollbar {
            width: 6px;
        }

        #site-header .nav-mega-inner::-webkit-scrollbar-track {
            background: #f8fafc;
            border-radius: 9999px;
        }

        #site-header .nav-mega-inner::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 9999px;
        }

        #site-header .nav-mega-inner::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        #site-header .nav-mega-grid {
            display: grid !important;
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
            gap: 2.25rem 2.5rem !important;
            width: 100% !important;
            align-items: stretch !important;
        }

        @media (min-width: 1280px) {
            #site-header .nav-mega-grid {
                grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
                gap: 2.5rem 3rem !important;
            }
        }

        #site-header .nav-mega-col {
            display: flex !important;
            flex-direction: column !important;
            min-width: 0 !important;
        }

        #site-header .nav-mega-heading {
            display: inline-block;
            margin-bottom: 0.85rem;
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: #36a1b3;
            transition: color 0.15s ease;
            white-space: normal;
            line-height: 1.35;
        }

        #site-header .nav-mega-heading:hover {
            color: #247583;
        }

        #site-header .nav-mega-list {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: 0.2rem;
        }

        #site-header .nav-mega-list a {
            display: block;
            padding: 0.28rem 0.5rem;
            margin: 0 -0.5rem;
            font-size: 0.8125rem;
            font-weight: 500;
            line-height: 1.35;
            color: #1f2937;
            border-radius: 0.375rem;
            transition: all 0.15s ease;
            white-space: normal;
        }

        #site-header .nav-mega-list a:hover {
            color: #36a1b3;
            background: #f0f9fa;
            padding-left: 0.75rem;
        }

        #site-header .nav-mega-more {
            display: inline-block;
            color: #36a1b3 !important;
            font-size: 0.75rem !important;
            font-weight: 700 !important;
            margin-top: 0.35rem;
            padding: 0.2rem 0;
        }

        #site-header .nav-mega-more:hover {
            color: #247583 !important;
            text-decoration: underline;
        }

        #site-header .nav-mega-footer {
            margin-top: 1.5rem;
            padding-top: 1.25rem;
            border-top: 1px solid rgba(0, 0, 0, 0.06);
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        #site-header .nav-mega-footer a {
            display: inline-flex;
            align-items: center;
            font-size: 0.8125rem;
            font-weight: 700;
            color: #1a1a1a;
            transition: color 0.15s ease;
        }

        #site-header .nav-mega-footer a:hover {
            color: #36a1b3;
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

<body class="antialiased min-h-screen flex flex-col relative overflow-x-hidden bg-white">

    <!-- Global Success Toast -->
    @if(session('success'))
    <div id="global-success-toast" class="fixed top-5 right-5 z-[200] max-w-sm bg-brand-deep border border-white/10 text-white p-4 shadow-2xl flex items-start space-x-3 transition-all duration-500 translate-y-0 opacity-100">
        <div class="p-1 bg-brand text-white">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
        </div>
        <div class="flex-grow space-y-1">
            <h4 class="text-xs font-semibold uppercase tracking-[0.18em] text-gold">Submission Successful</h4>
            <p class="text-xs text-white/70 leading-relaxed">{{ session('success') }}</p>
        </div>
        <button type="button" onclick="document.getElementById('global-success-toast').remove()" class="text-white/50 hover:text-white transition-colors focus:outline-none">
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

    <!-- Site Header — Solid white bar with top utility bar -->
    <header id="site-header" class="fixed top-0 inset-x-0 z-50 transition-shadow duration-300">
        <!-- Site Top Bar — Social links -->
        <div id="site-topbar">
            <div class="topbar-inner">
                <!-- Right Info: Social Media Links -->
                <div class="topbar-social-wrap">
                    <span class="topbar-social-label">Follow Us:</span>
                    <div class="topbar-social-links">
                        <a href="{{ !empty($content['social_facebook']) ? $content['social_facebook'] : 'https://www.facebook.com/people/Construction-360/61590797767639/' }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook" class="topbar-social-icon facebook" title="Facebook">
                            <svg viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                        <a href="{{ !empty($content['social_instagram']) ? $content['social_instagram'] : 'https://www.instagram.com/Construction360.co' }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram" class="topbar-social-icon instagram" title="Instagram">
                            <svg viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>
                        <a href="{{ !empty($content['social_linkedin']) ? $content['social_linkedin'] : 'https://www.linkedin.com/company/construction-360' }}" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn" class="topbar-social-icon linkedin" title="LinkedIn">
                            <svg viewBox="0 0 24 24">
                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                            </svg>
                        </a>
                        <a href="{{ !empty($content['social_whatsapp']) ? $content['social_whatsapp'] : 'https://wa.me/447500896792' }}" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp" class="topbar-social-icon whatsapp" title="WhatsApp">
                            <svg viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 11.957.01c3.178 0 6.165 1.237 8.411 3.487 2.247 2.25 3.481 5.24 3.479 8.423-.004 6.549-5.341 11.888-11.9 11.888-2.006 0-3.971-.51-5.714-1.485L0 24zm6.549-3.82c1.684.997 3.518 1.523 5.4 1.527h.005c5.485 0 9.948-4.603 9.95-10.158 0-2.692-1.049-5.223-2.955-7.13C17.098 2.513 14.562 1.46 11.87 1.46h-.003C6.381 1.46 1.921 6.062 1.92 11.619c0 1.986.518 3.927 1.503 5.632l-.988 3.606 3.671-.977zm11.01-6.196c-.302-.15-1.786-.88-2.062-.98-.276-.1-.478-.15-.679.15-.2.3-.777.98-.952 1.18-.176.2-.352.23-.654.08-.302-.15-1.276-.47-2.43-1.5-1.258-1.12-1.806-1.57-1.98-1.87-.174-.3-.02-.46.13-.61.134-.13.3-.35.45-.53.15-.18.2-.3.3-.5.1-.2.05-.38-.025-.53-.075-.15-.68-1.66-.93-2.27-.244-.59-.49-.51-.67-.52-.18-.01-.39-.01-.6-.01-.2 0-.53.07-.81.38-.28.3-.106 1.04-.106 2.54 0 1.5 1.09 2.94 1.24 3.14.15.2 2.14 3.27 5.18 4.58.72.31 1.28.5 1.72.64.73.23 1.4.2 1.92.12.58-.09 1.8-.74 2.05-1.45.25-.71.25-1.32.17-1.45-.07-.12-.27-.2-.57-.35z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="h-[70px] lg:h-[76px] flex items-center justify-between gap-4">
                <a href="{{ url('/') }}" class="flex items-center shrink-0">
                    @include('partials.logo', [
                    'idSuffix' => 'nav',
                    'class' => 'max-h-10 w-auto max-w-[170px]',
                    'icon_only' => false,
                    'color_mode' => 'light',
                    ])
                </a>

                <nav id="desktop-nav" class="hidden xl:flex items-center self-stretch gap-6 2xl:gap-7">
                    <a href="{{ url('/') }}" class="nav-link transition-colors">Home</a>

                    <div class="nav-dropdown">
                        <a href="{{ route('about') }}" class="nav-link inline-flex items-center transition-colors">
                            About Us <span class="nav-caret" aria-hidden="true"></span>
                        </a>
                        <div class="nav-dropdown-menu" role="menu" aria-label="About Us">
                            <a href="{{ route('about') }}">About Us</a>
                            <a href="{{ route('about') }}#leadership">Our Leadership Team</a>
                        </div>
                    </div>

                    <div class="nav-dropdown nav-dropdown--mega">
                        <a href="{{ route('services.index') }}" class="nav-link inline-flex items-center transition-colors">
                            Services <span class="nav-caret" aria-hidden="true"></span>
                        </a>
                        <div class="nav-mega-menu" role="menu" aria-label="Services">
                            <div class="nav-mega-inner">
                                <div class="nav-mega-grid">
                                    @foreach(($navServices ?? collect()) as $navSrv)
                                    <div class="nav-mega-col">
                                        <a href="{{ route('services.show', $navSrv->slug) }}" class="nav-mega-heading" title="{{ $navSrv->title }}">
                                            {{ $navSrv->title }}
                                        </a>
                                        <ul class="nav-mega-list">
                                            @forelse(collect($navSrv->subs)->take(5) as $sub)
                                            <li>
                                                <a href="{{ route('subservices.show', [$navSrv->slug, $sub['slug']]) }}">
                                                    {{ $sub['title'] }}
                                                </a>
                                            </li>
                                            @empty
                                            <li>
                                                <a href="{{ route('services.show', $navSrv->slug) }}">View service</a>
                                            </li>
                                            @endforelse
                                            <li>
                                                <a href="{{ route('services.show', $navSrv->slug) }}" class="nav-mega-more">View all →</a>
                                            </li>
                                        </ul>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="nav-mega-footer">
                                    <a href="{{ route('services.index') }}">Explore all services →</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="nav-dropdown">
                        <a href="{{ url('/?scroll=sectors') }}" class="nav-link inline-flex items-center transition-colors" data-scroll="sectors">
                            Sectors <span class="nav-caret" aria-hidden="true"></span>
                        </a>
                        <div class="nav-dropdown-menu">
                            <a href="{{ url('/?scroll=sectors') }}">All sectors</a>
                            <a href="{{ url('/?scroll=sectors') }}">Residential</a>
                            <a href="{{ url('/?scroll=sectors') }}">Commercial</a>
                            <a href="{{ url('/?scroll=sectors') }}">Industrial</a>
                            <a href="{{ url('/?scroll=sectors') }}">Interior fit-out</a>
                        </div>
                    </div>

                    <a href="{{ route('projects.index') }}" class="nav-link transition-colors">Projects</a>
                    <a href="{{ route('contact.index') }}" class="nav-link transition-colors">Contact Us</a>

                    <div class="nav-dropdown">
                        <button type="button" class="nav-link inline-flex items-center transition-colors bg-transparent border-0 cursor-pointer p-0 font-sans">
                            More <span class="nav-caret" aria-hidden="true"></span>
                        </button>
                        <div class="nav-dropdown-menu">
                            <a href="{{ route('blog.index') }}">Insights</a>
                            <a href="{{ route('about') }}#leadership">Our Leadership Team</a>
                            <a href="{{ url('/?scroll=process') }}">How it works</a>
                            <a href="{{ route('tendering') }}">Tendering standard</a>
                            <a href="{{ route('privacy') }}">Privacy policy</a>
                            <a href="{{ route('terms') }}">Terms & conditions</a>
                        </div>
                    </div>
                </nav>

                <div class="hidden lg:flex items-center gap-4 shrink-0">
                    <div class="flex items-center gap-4">
                        <a href="tel:{{ $content['header_phone'] ?? '+442039309629' }}" class="inline-flex items-center gap-1.5 text-[12px] font-bold text-[#1a1a1a] hover:text-brand transition-colors whitespace-nowrap">
                            <svg class="h-3.5 w-3.5 text-brand shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.824-1.802-5.14-4.118-6.942-6.942l1.293-.97c.362-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                            </svg>
                            <span>{{ $content['header_phone_display'] ?? ($content['header_phone'] ?? '0203 930 9629') }}</span>
                        </a>
                        <a href="mailto:{{ $content['header_email'] ?? 'info@construction360.co' }}" class="inline-flex items-center gap-1.5 text-[12px] font-bold text-[#1a1a1a] hover:text-brand transition-colors whitespace-nowrap">
                            <svg class="h-3.5 w-3.5 text-brand shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                            <span>{{ $content['header_email'] ?? 'info@construction360.co' }}</span>
                        </a>
                    </div>
                    <a href="#" onclick="openTenderModal(); return false;" class="inline-flex items-center justify-center px-5 py-2.5 rounded-full text-[11px] font-bold uppercase tracking-[0.06em] text-white bg-[#111111] shadow-sm hover:bg-[#333] transition-colors">
                        Get a Quote
                    </a>
                </div>

                <button id="menu-toggle" type="button" class="menu-toggle-btn xl:hidden p-2 focus:outline-none" aria-label="Open menu">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 7h16M4 12h16M4 17h16" />
                    </svg>
                </button>
            </div>
        </div>

        <div id="mobile-menu" class="hidden xl:hidden mx-3 mb-3 bg-white border border-black/8 rounded-2xl p-5 space-y-1 shadow-xl max-h-[80vh] overflow-y-auto">
            <a href="{{ url('/') }}" class="block px-3 py-2.5 text-sm font-medium text-[#1a1a1a] rounded-lg hover:bg-stone">Home</a>
            <div class="px-1 pt-1">
                <button type="button" id="mobile-about-toggle" class="w-full flex items-center justify-between px-2 py-2.5 text-sm font-medium text-[#1a1a1a] rounded-lg hover:bg-stone" aria-expanded="false">
                    <span>About Us</span>
                    <svg class="h-4 w-4 text-[#6b7280] transition-transform" data-mobile-about-caret fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
                <div id="mobile-about-panel" class="hidden pl-2 pb-2 space-y-0.5">
                    <a href="{{ route('about') }}" class="block px-2 py-1.5 text-[13px] text-[#374151] rounded-md hover:bg-stone hover:text-brand">About Us</a>
                    <a href="{{ route('about') }}#leadership" class="block px-2 py-1.5 text-[13px] text-[#374151] rounded-md hover:bg-stone hover:text-brand">Our Leadership Team</a>
                </div>
            </div>
            <div class="px-1 pt-1">
                <button type="button" id="mobile-services-toggle" class="w-full flex items-center justify-between px-2 py-2.5 text-sm font-medium text-[#1a1a1a] rounded-lg hover:bg-stone" aria-expanded="false">
                    <span>Services</span>
                    <svg class="h-4 w-4 text-[#6b7280] transition-transform" data-mobile-services-caret fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
                <div id="mobile-services-panel" class="hidden pl-2 pb-2 space-y-3">
                    <a href="{{ route('services.index') }}" class="block px-2 py-1.5 text-[12px] font-semibold text-brand">All services →</a>
                    @foreach(($navServices ?? collect()) as $navSrv)
                    <div class="border-t border-black/5 pt-2">
                        <a href="{{ route('services.show', $navSrv->slug ?? \Illuminate\Support\Str::slug($navSrv->title)) }}" class="block px-2 py-1 text-[11px] font-semibold uppercase tracking-[0.14em] text-brand">{{ $navSrv->title }}</a>
                        <div class="mt-1 space-y-0.5">
                            @foreach(collect($navSrv->subs ?? [])->take(5) as $sub)
                            <a href="{{ route('subservices.show', [$navSrv->slug ?? \Illuminate\Support\Str::slug($navSrv->title), $sub['slug']]) }}" class="block px-2 py-1.5 text-[13px] text-[#374151] rounded-md hover:bg-stone hover:text-brand">{{ $sub['title'] }}</a>
                            @endforeach
                            @if(count($navSrv->subs ?? []) > 5)
                            <a href="{{ route('services.show', $navSrv->slug ?? \Illuminate\Support\Str::slug($navSrv->title)) }}" class="block px-2 py-1 text-[12px] text-[#6b7280] hover:text-brand">View all →</a>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <a href="{{ url('/?scroll=sectors') }}" class="block px-3 py-2.5 text-sm font-medium text-[#1a1a1a] rounded-lg hover:bg-stone" data-scroll="sectors">Sectors</a>
            <a href="{{ route('projects.index') }}" class="block px-3 py-2.5 text-sm font-medium text-[#1a1a1a] rounded-lg hover:bg-stone">Projects</a>
            <a href="{{ route('contact.index') }}" class="block px-3 py-2.5 text-sm font-medium text-[#1a1a1a] rounded-lg hover:bg-stone">Contact Us</a>
            <a href="{{ route('blog.index') }}" class="block px-3 py-2.5 text-sm font-medium text-[#1a1a1a] rounded-lg hover:bg-stone">Insights</a>
            <a href="{{ route('tendering') }}" class="block px-3 py-2.5 text-sm font-medium text-[#1a1a1a] rounded-lg hover:bg-stone">Tendering standard</a>
            <div class="pt-3 mt-2 border-t border-black/8 space-y-3 px-1">
                <div class="flex flex-wrap items-center gap-x-4 gap-y-2">
                    <a href="tel:{{ $content['header_phone'] ?? '+442039309629' }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-[#1a1a1a] hover:text-brand transition-colors">
                        <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.824-1.802-5.14-4.118-6.942-6.942l1.293-.97c.362-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                        </svg>
                        {{ $content['header_phone_display'] ?? ($content['header_phone'] ?? '0203 930 9629') }}
                    </a>
                    <a href="mailto:{{ $content['header_email'] ?? 'info@construction360.co' }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-[#1a1a1a] hover:text-brand transition-colors">
                        <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                        {{ $content['header_email'] ?? 'info@construction360.co' }}
                    </a>
                </div>
                <div class="flex items-center gap-4 pt-1">
                    <span class="text-xs text-[#6b7280]">Follow us:</span>
                    <a href="{{ !empty($content['social_facebook']) ? $content['social_facebook'] : 'https://www.facebook.com/people/Construction-360/61590797767639/' }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook" class="text-[#1877F2]">
                        <svg class="h-4 w-4 fill-current" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                        </svg>
                    </a>
                    <a href="{{ !empty($content['social_instagram']) ? $content['social_instagram'] : 'https://www.instagram.com/Construction360.co' }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram" class="text-[#E4405F]">
                        <svg class="h-4 w-4 fill-current" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg>
                    </a>
                    <a href="{{ !empty($content['social_linkedin']) ? $content['social_linkedin'] : 'https://www.linkedin.com/company/construction-360' }}" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn" class="text-[#0A66C2]">
                        <svg class="h-4 w-4 fill-current" viewBox="0 0 24 24">
                            <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                        </svg>
                    </a>
                    <a href="{{ !empty($content['social_whatsapp']) ? $content['social_whatsapp'] : 'https://wa.me/447500896792' }}" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp" class="text-[#25D366]">
                        <svg class="h-4 w-4 fill-current" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 11.957.01c3.178 0 6.165 1.237 8.411 3.487 2.247 2.25 3.481 5.24 3.479 8.423-.004 6.549-5.341 11.888-11.9 11.888-2.006 0-3.971-.51-5.714-1.485L0 24zm6.549-3.82c1.684.997 3.518 1.523 5.4 1.527h.005c5.485 0 9.948-4.603 9.95-10.158 0-2.692-1.049-5.223-2.955-7.13C17.098 2.513 14.562 1.46 11.87 1.46h-.003C6.381 1.46 1.921 6.062 1.92 11.619c0 1.986.518 3.927 1.503 5.632l-.988 3.606 3.671-.977zm11.01-6.196c-.302-.15-1.786-.88-2.062-.98-.276-.1-.478-.15-.679.15-.2.3-.777.98-.952 1.18-.176.2-.352.23-.654.08-.302-.15-1.276-.47-2.43-1.5-1.258-1.12-1.806-1.57-1.98-1.87-.174-.3-.02-.46.13-.61.134-.13.3-.35.45-.53.15-.18.2-.3.3-.5.1-.2.05-.38-.025-.53-.075-.15-.68-1.66-.93-2.27-.244-.59-.49-.51-.67-.52-.18-.01-.39-.01-.6-.01-.2 0-.53.07-.81.38-.28.3-.106 1.04-.106 2.54 0 1.5 1.09 2.94 1.24 3.14.15.2 2.14 3.27 5.18 4.58.72.31 1.28.5 1.72.64.73.23 1.4.2 1.92.12.58-.09 1.8-.74 2.05-1.45.25-.71.25-1.32.17-1.45-.07-.12-.27-.2-.57-.35z" />
                        </svg>
                    </a>
                </div>
                <a href="#" onclick="openTenderModal(); return false;" class="block w-full text-center py-2.5 rounded-full text-[11px] font-bold uppercase tracking-[0.06em] text-white bg-[#111111]">
                    Get a Quote
                </a>
            </div>
        </div>
    </header>
    @yield('content')

    <!-- Footer -->
    <footer class="bg-[#111111] text-white">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10 py-16 lg:py-20">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
                <div class="lg:col-span-4 space-y-5">
                    <a href="{{ url('/') }}" class="block">
                        @include('partials.logo', ['idSuffix' => 'foot', 'class' => 'w-full max-w-[200px] max-h-16 object-contain object-left-top brightness-0 invert', 'icon_only' => false, 'color_mode' => 'dark'])
                    </a>
                    <p class="text-sm text-white/50 leading-relaxed font-light max-w-sm">
                        {{ $content['footer_description'] ?? 'Construction 360 Ltd unites planning, design and site delivery into one accountable journey for homes and commercial spaces across London and Essex.' }}
                    </p>
                </div>

                <div class="lg:col-span-4 grid grid-cols-2 gap-x-6 gap-y-3">
                    <a href="{{ route('about') }}" class="text-sm text-white/65 hover:text-white transition-colors py-1">About Us</a>
                    <a href="{{ route('contact.index') }}" class="text-sm text-white/65 hover:text-white transition-colors py-1">Contact Us</a>
                    <a href="{{ route('services.index') }}" class="text-sm text-white/65 hover:text-white transition-colors py-1">Our Services</a>
                    <a href="{{ route('projects.index') }}" class="text-sm text-white/65 hover:text-white transition-colors py-1">Projects</a>
                    <a href="{{ route('tendering') }}" class="text-sm text-white/65 hover:text-white transition-colors py-1">Tendering Standard</a>
                    <a href="{{ route('blog.index') }}" class="text-sm text-white/65 hover:text-white transition-colors py-1">Insights</a>
                    <a href="{{ route('privacy') }}" class="text-sm text-white/65 hover:text-white transition-colors py-1">Privacy Policy</a>
                    <a href="{{ route('terms') }}" class="text-sm text-white/65 hover:text-white transition-colors py-1">Terms & Conditions</a>
                </div>

                <div class="lg:col-span-4 space-y-5">
                    <a href="mailto:{{ $content['header_email'] ?? 'info@construction360.co' }}" class="block font-heading text-2xl text-white hover:text-brand transition-colors">
                        {{ $content['header_email'] ?? 'info@construction360.co' }}
                    </a>
                    <a href="tel:{{ $content['header_phone'] ?? '+442039309629' }}" class="block font-heading text-2xl text-white hover:text-brand transition-colors">
                        {{ $content['header_phone'] ?? '+44 203 930 9629' }}
                    </a>
                    <p class="text-sm text-white/45 font-light">{{ $content['contact_address'] ?? '73 Thrale Road, London, England, SW16 1NU' }}</p>
                    @unless(request()->routeIs('landing'))
                    <a href="#" onclick="openTenderModal(); return false;" class="inline-flex px-6 py-3 text-[11px] font-semibold uppercase tracking-[0.14em] text-[#111] bg-white hover:bg-stone transition-colors">
                        {{ $content['cta_get_free_quote_label'] ?? 'Book a consultation' }}
                    </a>
                    @endunless
                </div>
            </div>
        </div>

        <div class="bg-stone text-[#1a1a1a]">
            <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10 py-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 text-[11px] tracking-wide">
                <div class="space-y-0.5 text-[#6b7280]">
                    <p>{{ $content['footer_company_registration'] ?? 'Registered in England and Wales. Company number 17277526' }}</p>
                    <p>Construction 360 Ltd &copy; {{ date('Y') }} — All rights reserved.</p>
                </div>
                <div class="flex flex-wrap items-center gap-5 font-medium uppercase tracking-[0.12em] text-[#6b7280]">
                    <a href="{{ !empty($content['social_facebook']) ? $content['social_facebook'] : 'https://www.facebook.com/people/Construction-360/61590797767639/' }}" target="_blank" class="hover:text-[#1a1a1a] transition-colors">Facebook</a>
                    <a href="{{ !empty($content['social_instagram']) ? $content['social_instagram'] : 'https://www.instagram.com/Construction360.co' }}" target="_blank" class="hover:text-[#1a1a1a] transition-colors">Instagram</a>
                    <a href="{{ !empty($content['social_linkedin']) ? $content['social_linkedin'] : 'https://www.linkedin.com/company/construction-360' }}" target="_blank" class="hover:text-[#1a1a1a] transition-colors">LinkedIn</a>
                    <a href="{{ !empty($content['social_whatsapp']) ? $content['social_whatsapp'] : 'https://wa.me/447500896792' }}" target="_blank" class="hover:text-[#1a1a1a] transition-colors">WhatsApp</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Tender Brief Popup Modal Overlay -->
    <div id="tender-brief-modal" class="hidden fixed inset-0 z-[100]">
        <div class="absolute inset-0 bg-[#0f2a3a]/70 backdrop-blur-sm" onclick="closeTenderModal()"></div>

        <div class="absolute inset-0 overflow-y-auto overscroll-contain">
            <div class="flex min-h-full items-center justify-center p-4 sm:p-6">
                <div role="dialog" aria-modal="true" aria-labelledby="tender-modal-title"
                    class="relative z-10 w-full max-w-4xl rounded-2xl overflow-hidden border border-black/[0.06] bg-white shadow-[0_30px_80px_-40px_rgba(54,161,179,0.45)]">
                    <button type="button" onclick="closeTenderModal()"
                        class="absolute top-4 right-4 z-20 inline-flex h-10 w-10 items-center justify-center rounded-full bg-white text-[#0f2a3a] shadow-sm hover:bg-white md:bg-black/[0.06] md:shadow-none md:hover:bg-black/10 transition-colors"
                        aria-label="Close enquiry form">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <div class="flex flex-col md:flex-row">
                        {{-- Brand panel --}}
                        <div class="md:w-[38%] shrink-0 bg-brand text-white p-8 sm:p-10 flex flex-col gap-8">
                            <div class="space-y-4 pr-6">
                                <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-white/70">Project enquiry</p>
                                <h3 id="tender-modal-title" class="font-heading text-3xl font-medium tracking-tight leading-tight">
                                    Tell us about your project
                                </h3>
                                <p class="text-sm text-white/75 leading-relaxed">
                                    Share your brief, location and timeline. We’ll respond with clear next steps.
                                </p>
                            </div>

                            <ul class="mt-auto space-y-4 text-sm text-white/90">
                                <li>
                                    <a href="mailto:{{ $content['header_email'] ?? 'info@construction360.co' }}" class="group flex items-start gap-3 hover:text-white transition-colors">
                                        <span class="mt-0.5 inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-white/10 text-[#f0d778]">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                            </svg>
                                        </span>
                                        <span>
                                            <span class="block text-[10px] uppercase tracking-[0.16em] text-white/60 mb-0.5">Email</span>
                                            {{ $content['header_email'] ?? 'info@construction360.co' }}
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="tel:{{ $content['header_phone'] ?? '+442039309629' }}" class="group flex items-start gap-3 hover:text-white transition-colors">
                                        <span class="mt-0.5 inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-white/10 text-[#f0d778]">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.824-1.802-5.14-4.118-6.942-6.942l1.293-.97c.362-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v1.5z" />
                                            </svg>
                                        </span>
                                        <span>
                                            <span class="block text-[10px] uppercase tracking-[0.16em] text-white/60 mb-0.5">Phone</span>
                                            {{ $content['header_phone_display'] ?? ($content['header_phone'] ?? '0203 930 9629') }}
                                            <span class="block text-xs text-white/55 mt-0.5">Mon–Fri, 9am–6pm</span>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ $content['contact_map_url'] ?? 'https://www.google.com/maps/search/?api=1&query=73+Thrale+Road,+London,+England,+SW16+1NU' }}" target="_blank" rel="noopener noreferrer" class="group flex items-start gap-3 hover:text-white transition-colors">
                                        <span class="mt-0.5 inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-white/10 text-[#f0d778]">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                            </svg>
                                        </span>
                                        <span>
                                            <span class="block text-[10px] uppercase tracking-[0.16em] text-white/60 mb-0.5">Office</span>
                                            {{ $content['contact_address'] ?? '73 Thrale Road, London, England, SW16 1NU' }}
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        {{-- Form panel --}}
                        <div class="md:w-[62%] bg-[#f8fbfc] p-8 sm:p-10 lg:p-12">
                            <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                                @csrf
                                <input type="hidden" name="is_modal" value="1">

                                <div class="grid grid-cols-1 gap-5">
                                    <div>
                                        <label for="modal-name" class="block text-[10px] font-bold uppercase tracking-widest text-[#6b7280] mb-2">Full name</label>
                                        <input type="text" name="name" id="modal-name" required placeholder="Your name" autocomplete="name"
                                            class="w-full rounded-xl border border-black/10 bg-white px-4 py-3.5 text-sm text-[#1a1a1a] placeholder:text-[#9ca3af] focus:outline-none focus:border-brand focus:ring-1 focus:ring-brand transition-colors">
                                    </div>
                                    <div>
                                        <label for="modal-email" class="block text-[10px] font-bold uppercase tracking-widest text-[#6b7280] mb-2">Email address</label>
                                        <input type="email" name="email" id="modal-email" required placeholder="you@company.com" autocomplete="email"
                                            class="w-full rounded-xl border border-black/10 bg-white px-4 py-3.5 text-sm text-[#1a1a1a] placeholder:text-[#9ca3af] focus:outline-none focus:border-brand focus:ring-1 focus:ring-brand transition-colors">
                                    </div>
                                </div>

                                <div>
                                    <label for="modal-subject" class="block text-[10px] font-bold uppercase tracking-widest text-[#6b7280] mb-2">Project type</label>
                                    <input type="text" name="subject" id="modal-subject" placeholder="e.g. Rear extension, commercial fit-out"
                                        class="w-full rounded-xl border border-black/10 bg-white px-4 py-3.5 text-sm text-[#1a1a1a] placeholder:text-[#9ca3af] focus:outline-none focus:border-brand focus:ring-1 focus:ring-brand transition-colors">
                                </div>

                                <div>
                                    <label for="modal-message" class="block text-[10px] font-bold uppercase tracking-widest text-[#6b7280] mb-2">Project details</label>
                                    <textarea name="message" id="modal-message" rows="4" required placeholder="Location, scope and timeline"
                                        class="w-full rounded-xl border border-black/10 bg-white px-4 py-3.5 text-sm text-[#1a1a1a] placeholder:text-[#9ca3af] focus:outline-none focus:border-brand focus:ring-1 focus:ring-brand transition-colors resize-none"></textarea>
                                </div>

                                {{-- Google reCAPTCHA v2 --}}
                                <div class="pt-1 overflow-x-auto">
                                    <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key', '6Lexo9MtAAAAAAwLn9Kg8xhfze4U4_qYot1786CJ') }}"></div>
                                    @error('g-recaptcha-response')
                                    <p class="mt-1.5 text-xs font-semibold text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="pt-1">
                                    <button type="submit"
                                        class="w-full inline-flex items-center justify-center gap-2 rounded-lg bg-brand hover:bg-brand-dark text-white px-6 py-4 text-sm font-semibold uppercase tracking-[0.08em] transition-colors">
                                        Submit enquiry <span aria-hidden="true">→</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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
            const siteHeader = document.getElementById('site-header');
            const onScrollHeader = () => {
                if (!siteHeader) return;
                if (window.scrollY > 8) {
                    siteHeader.classList.add('is-scrolled');
                } else {
                    siteHeader.classList.remove('is-scrolled');
                }
            };
            onScrollHeader();
            window.addEventListener('scroll', onScrollHeader, {
                passive: true
            });

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

            const mobileServicesToggle = document.getElementById('mobile-services-toggle');
            const mobileServicesPanel = document.getElementById('mobile-services-panel');
            if (mobileServicesToggle && mobileServicesPanel) {
                mobileServicesToggle.addEventListener('click', function() {
                    const open = mobileServicesPanel.classList.toggle('hidden') === false;
                    mobileServicesToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
                    const caret = mobileServicesToggle.querySelector('[data-mobile-services-caret]');
                    if (caret) caret.classList.toggle('rotate-180', open);
                });
            }

            const mobileAboutToggle = document.getElementById('mobile-about-toggle');
            const mobileAboutPanel = document.getElementById('mobile-about-panel');
            if (mobileAboutToggle && mobileAboutPanel) {
                mobileAboutToggle.addEventListener('click', function() {
                    const open = mobileAboutPanel.classList.toggle('hidden') === false;
                    mobileAboutToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
                    const caret = mobileAboutToggle.querySelector('[data-mobile-about-caret]');
                    if (caret) caret.classList.toggle('rotate-180', open);
                });
            }

            const megaDropdown = document.querySelector('.nav-dropdown--mega');
            if (megaDropdown) {
                let megaCloseTimer = null;
                const openMega = () => {
                    clearTimeout(megaCloseTimer);
                    megaDropdown.classList.add('is-open');
                };
                const scheduleCloseMega = () => {
                    clearTimeout(megaCloseTimer);
                    megaCloseTimer = setTimeout(() => {
                        megaDropdown.classList.remove('is-open');
                    }, 180);
                };
                megaDropdown.addEventListener('mouseenter', openMega);
                megaDropdown.addEventListener('mouseleave', scheduleCloseMega);
                const megaPanel = megaDropdown.querySelector('.nav-mega-menu');
                if (megaPanel) {
                    megaPanel.addEventListener('mouseenter', openMega);
                    megaPanel.addEventListener('mouseleave', scheduleCloseMega);
                }
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
                            targetElement.scrollIntoView({
                                behavior: 'smooth'
                            });
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
                            targetElement.scrollIntoView({
                                behavior: 'smooth'
                            });
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
                        targetElement.scrollIntoView({
                            behavior: 'smooth'
                        });
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
            <path d="M12.031 21.014c-1.636-.002-3.238-.42-4.664-1.21L2.247 21.52l1.758-5.003c-.868-1.468-1.325-3.14-1.322-4.862C2.686 5.86 7.378 1.168 13.167 1.17c2.81.002 5.454 1.096 7.441 3.084 1.986 1.988 3.08 4.633 3.078 7.444-.004 5.797-4.695 10.49-10.485 10.493l-1.17-.177zm5.556-7.585c-.305-.152-1.802-.888-2.08-.99-.279-.101-.482-.153-.686.152-.204.305-.788.99-.966 1.194-.178.204-.356.23-.661.077-.305-.153-1.286-.474-2.453-1.516-.906-.811-1.517-1.815-1.696-2.12-.178-.306-.02-.472.133-.625.138-.138.305-.357.458-.535.153-.178.204-.305.305-.509.102-.204.051-.382-.025-.535-.077-.152-.686-1.654-.94-2.264-.247-.593-.497-.513-.686-.523-.178-.01-.382-.01-.585-.01-.204 0-.535.076-.814.382-.279.305-1.067 1.042-1.067 2.54 0 1.498 1.093 2.946 1.246 3.149.153.204 2.148 3.28 5.203 4.597.727.313 1.294.5 1.738.641.73.232 1.393.199 1.916.12.585-.088 1.802-.736 2.056-1.448.254-.712.254-1.323.178-1.448-.076-.126-.279-.203-.584-.356z" />
        </svg>
    </a>

    @yield('scripts')
</body>

</html>