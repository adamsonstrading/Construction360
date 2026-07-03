@php
    $suffix = $idSuffix ?? 'default';
    $sizeClass = $class ?? 'h-9 w-9';
    $iconOnly = $icon_only ?? false;
    $colorMode = $color_mode ?? 'light'; // 'light' (black text for light bg) or 'dark' (white text for dark bg)
    $textHex = $colorMode === 'light' ? '#0F172A' : '#FFFFFF';
    $lineHex = $colorMode === 'light' ? '#E2E8F0' : '#334155';
    // Fetch global content if not passed
    $siteContent = isset($content) ? $content : \App\Models\SiteContent::pluck('value', 'key')->all();
@endphp

@if(isset($siteContent['site_logo']) && $siteContent['site_logo'])
    <!-- Uploaded Custom Logo -->
    @php
        $logoUrl = asset($siteContent['site_logo']);
        $logoPath = public_path($siteContent['site_logo']);
        if (file_exists($logoPath)) {
            $logoUrl .= '?v=' . filemtime($logoPath);
        }
    @endphp
    <img src="{{ $logoUrl }}" alt="Construction 360 Logo" class="{{ $sizeClass }} object-contain">
@elseif($iconOnly)
    <!-- Compact Minimalist C360 Icon -->
    <svg class="{{ $sizeClass }} transition-transform duration-500 hover:scale-105" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="50" cy="50" r="44" stroke="{{ $textHex }}" stroke-width="3.5" />
        <line x1="46" y1="18" x2="46" y2="82" stroke="{{ $lineHex }}" stroke-width="2.5" />
        
        <!-- C for Construction -->
        <text x="36" y="62" font-family="'Outfit', 'Plus Jakarta Sans', sans-serif" font-size="34" font-weight="900" fill="{{ $textHex }}" text-anchor="end">C</text>
        
        <!-- 360 for Group -->
        <text x="54" y="60" font-family="'Outfit', 'Plus Jakarta Sans', sans-serif" font-size="28" font-weight="300" fill="#00B4D8" text-anchor="start">360</text>
    </svg>
@else
    <!-- Full Landscape Brand Logo -->
    <svg class="{{ $sizeClass }} transition-transform duration-500 hover:scale-[1.01]" viewBox="0 0 520 150" fill="none" xmlns="http://www.w3.org/2000/svg">
        <defs>
            <style>
                .logo-text-c-{{ $suffix }} {
                    font-family: 'Outfit', 'Plus Jakarta Sans', sans-serif;
                    font-size: 50px;
                    font-weight: 850;
                    fill: {{ $textHex }};
                }
                .logo-text-3-{{ $suffix }} {
                    font-family: 'Outfit', 'Plus Jakarta Sans', sans-serif;
                    font-size: 50px;
                    font-weight: 300;
                    fill: #00B4D8;
                }
                .logo-sub-blue-{{ $suffix }} {
                    font-family: 'Outfit', 'Plus Jakarta Sans', sans-serif;
                    font-size: 10px;
                    font-weight: 700;
                    fill: #00B4D8;
                    letter-spacing: 2px;
                }
                .logo-sub-dark-{{ $suffix }} {
                    font-family: 'Outfit', 'Plus Jakarta Sans', sans-serif;
                    font-size: 10px;
                    font-weight: 700;
                    fill: {{ $textHex }};
                    letter-spacing: 2.2px;
                }
            </style>
        </defs>

        <!-- Construction 360 Headline -->
        <text x="20" y="70">
            <tspan class="logo-text-c-{{ $suffix }}">Construction</tspan>
            <tspan dx="15" class="logo-text-3-{{ $suffix }}">360</tspan>
        </text>

        <!-- Horizontal separator line -->
        <line x1="20" y1="90" x2="500" y2="90" stroke="{{ $lineHex }}" stroke-width="1.5" />

        <!-- Subtitle: Columns divided vertically -->
        <!-- Left Side: Aqua Blue (Right Aligned) -->
        <g text-anchor="end">
            <text x="250" y="112" class="logo-sub-blue-{{ $suffix }}">360 CONSTRUCTION SERVICES</text>
            <text x="250" y="127" class="logo-sub-blue-{{ $suffix }}">LOCATED IN</text>
            <text x="250" y="142" class="logo-sub-blue-{{ $suffix }}">LONDON</text>
        </g>

        <!-- Vertical dividing line -->
        <line x1="270" y1="100" x2="270" y2="146" stroke="{{ $lineHex }}" stroke-width="1.5" />

        <!-- Right Side: Dark Slate (Left Aligned) -->
        <g text-anchor="start">
            <text x="290" y="112" class="logo-sub-dark-{{ $suffix }}">DESIGN</text>
            <text x="290" y="127" class="logo-sub-dark-{{ $suffix }}">BUILD</text>
            <text x="290" y="142" class="logo-sub-dark-{{ $suffix }}">CONSTRUCT</text>
        </g>
    </svg>
@endif
