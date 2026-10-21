@extends('layouts.public')

@if(!empty($project->meta_title))
    @section('meta_title', $project->meta_title)
@else
    @section('title', $project->title . ' | Projects | Construction 360 Ltd')
@endif

@if(!empty($project->meta_description) || !empty($project->meta_keywords))
    @section('meta')
        @if(!empty($project->meta_description))
            <meta name="description" content="{{ $project->meta_description }}">
        @endif
        @if(!empty($project->meta_keywords))
            <meta name="keywords" content="{{ $project->meta_keywords }}">
        @endif
    @endsection
@endif

@section('content')
    @php
        $statusRaw = strtolower((string) ($project->status ?? ''));
        $statusLabel = str_replace('-', ' ', $project->status ?: 'In progress');
    @endphp

    {{-- Light page header — home theme --}}
    <section class="relative bg-white border-b border-black/5">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10" style="padding-top: 10.5rem; padding-bottom: 2.5rem;">
            <div class="flex items-center gap-2 text-[11px] font-semibold uppercase tracking-[0.14em] text-[#6b7280] mb-8">
                <a href="{{ url('/') }}" class="hover:text-brand transition-colors">Home</a>
                <span>•</span>
                <a href="{{ route('projects.index') }}" class="hover:text-brand transition-colors">Projects</a>
                <span>•</span>
                <span class="text-[#0f2a3a] truncate max-w-[14rem] sm:max-w-none">{{ $project->title }}</span>
            </div>

            <div class="max-w-3xl">
                @if(!empty($project->category))
                    <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-brand">
                        {{ $project->category }}
                    </p>
                @endif
                <h1 class="mt-3 text-4xl sm:text-5xl lg:text-[3.25rem] font-bold tracking-tight leading-tight text-[#0f2a3a]">
                    {{ $project->title }}
                </h1>
                <div class="mt-5 h-[3px] w-14 bg-brand"></div>
            </div>
        </div>
    </section>

    {{-- Project body --}}
    <section class="bg-white py-12 lg:py-16">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 xl:gap-16 items-start">

                {{-- Main column --}}
                <div class="lg:col-span-8 space-y-12">
                    {{-- Main project image card with preview trigger --}}
                    <div
                        id="project-image-card"
                        onclick="openProjectLightbox(0)"
                        class="group relative w-full overflow-hidden rounded-2xl bg-[#0f2a3a] border border-black/5 shadow-sm cursor-pointer select-none"
                        style="width: 100%; aspect-ratio: 16 / 10; min-height: 320px; max-height: 520px;"
                        title="Click to view full picture"
                    >
                        <img
                            id="project-main-image"
                            src="{{ asset($project->image_url ?: 'images/hero_architecture.png') }}"
                            alt="{{ $project->title }}"
                            class="w-full h-full object-cover object-center block transition-transform duration-500 ease-out group-hover:scale-[1.03]"
                            style="width: 100%; height: 100%; object-fit: cover; object-position: center; display: block;"
                        >

                        {{-- Floating Preview Badge --}}
                        <div class="absolute bottom-4 right-4 pointer-events-none inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-black/60 hover:bg-black/80 backdrop-blur-md text-white text-xs font-medium tracking-wide shadow-lg border border-white/15 transition-all duration-300 group-hover:scale-105">
                            <svg class="w-3.5 h-3.5 text-[#36a1b3]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15" />
                            </svg>
                            <span>Preview Full Picture</span>
                        </div>
                    </div>

                    <div class="space-y-5">
                        <h2 class="text-2xl sm:text-3xl font-bold tracking-tight text-[#0f2a3a]">
                            {{ $content['project_overview_title'] ?? 'Project Overview' }}
                        </h2>
                        <div class="text-sm sm:text-[15px] text-[#5b6770] leading-relaxed space-y-4">
                            @php
                                $paragraphs = explode("\n", $project->description);
                            @endphp
                            @foreach($paragraphs as $p)
                                @if(trim($p) !== '')
                                    <p>{{ trim($p) }}</p>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="border-t border-black/5 pt-10 space-y-6">
                        <h3 class="text-xl sm:text-2xl font-bold tracking-tight text-[#0f2a3a]">
                            {{ $content['project_scopes_title'] ?? 'Development Scopes' }}
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                            <div class="rounded-2xl border border-black/8 bg-aqua-light p-6 space-y-2">
                                <span class="text-[10px] font-bold uppercase tracking-[0.18em] text-brand">Phase 1</span>
                                <h4 class="font-bold text-[#0f2a3a]">Structural & Framework</h4>
                                <p class="text-sm text-[#5b6770] leading-relaxed">Establish initial framing coordinates, load-bearing assessments, and secure local building control approvals.</p>
                            </div>
                            <div class="rounded-2xl border border-black/8 bg-aqua-light p-6 space-y-2">
                                <span class="text-[10px] font-bold uppercase tracking-[0.18em] text-brand">Phase 2</span>
                                <h4 class="font-bold text-[#0f2a3a]">Shell & Insulation</h4>
                                <p class="text-sm text-[#5b6770] leading-relaxed">Installation of custom glazing specifications, fire barriers, thermal insulation, and external brickwork finishes.</p>
                            </div>
                            <div class="rounded-2xl border border-black/8 bg-aqua-light p-6 space-y-2">
                                <span class="text-[10px] font-bold uppercase tracking-[0.18em] text-brand">Phase 3</span>
                                <h4 class="font-bold text-[#0f2a3a]">Handover & Audit</h4>
                                <p class="text-sm text-[#5b6770] leading-relaxed">Final mechanical certifications, snagging audit compliance checks, and handover of 10-year structural warranty.</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Specs sidebar --}}
                <div class="lg:col-span-4 lg:sticky lg:top-28 space-y-6">
                    <div class="rounded-2xl border border-black/8 bg-white p-6 sm:p-7 space-y-6">
                        <h3 class="text-[11px] font-semibold uppercase tracking-[0.22em] text-brand border-b border-black/5 pb-4">
                            {{ $content['project_specifications_title'] ?? 'Project Specifications' }}
                        </h3>

                        <div class="space-y-4">
                            <div class="flex justify-between items-baseline gap-4 text-xs">
                                <span class="font-semibold uppercase tracking-widest text-[#6b7280]">Location</span>
                                <span class="font-bold text-[#0f2a3a] text-right">{{ $project->location }}</span>
                            </div>
                            <div class="flex justify-between items-baseline gap-4 text-xs">
                                <span class="font-semibold uppercase tracking-widest text-[#6b7280]">Sector</span>
                                <span class="font-bold text-[#0f2a3a] text-right">{{ $project->category }}</span>
                            </div>
                            <div class="flex justify-between items-baseline gap-4 text-xs">
                                <span class="font-semibold uppercase tracking-widest text-[#6b7280]">Completed</span>
                                <span class="font-bold text-[#0f2a3a] text-right">{{ $project->year }}</span>
                            </div>
                            <div class="flex justify-between items-baseline gap-4 text-xs">
                                <span class="font-semibold uppercase tracking-widest text-[#6b7280]">Status</span>
                                <span class="font-bold uppercase tracking-wider text-brand text-right">
                                    {{ $statusLabel }}
                                </span>
                            </div>
                        </div>

                        <div class="pt-2">
                            <button type="button" onclick="openTenderModal()"
                                    class="w-full inline-flex items-center justify-center gap-2 rounded-lg bg-brand hover:bg-brand-dark text-white px-5 py-3.5 text-xs font-bold uppercase tracking-[0.08em] transition-colors">
                                Enquire about this build
                                <span aria-hidden="true">→</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Related projects — home portfolio card style --}}
    @if(!$related->isEmpty())
        <section class="bg-brand text-white py-16 lg:py-24">
            <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10">
                <div class="text-center max-w-2xl mx-auto mb-10 lg:mb-12 space-y-3">
                    <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-white/80">
                        {{ $content['project_related_label'] ?? 'Portfolio' }}
                    </p>
                    <h2 class="font-heading text-3xl sm:text-4xl font-medium tracking-tight text-white leading-tight">
                        {{ $content['project_related_title'] ?? 'Related Projects' }}
                    </h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-5">
                    @foreach($related as $relProj)
                        @php
                            $relSlug = $relProj->slug ?: \Illuminate\Support\Str::slug($relProj->title);
                            $relImg = asset($relProj->image_url ?: 'images/hero_architecture.png');
                            $locParts = array_filter(array_map('trim', explode(',', (string) ($relProj->location ?: ''))));
                            $loc = $locParts ? end($locParts) : ($relProj->category ?: 'London');
                        @endphp
                        <a href="{{ route('projects.show', $relSlug) }}"
                           class="group relative aspect-[3/4] rounded-2xl overflow-hidden border border-white/20 bg-[#0f2a3a]">
                            <img
                                src="{{ $relImg }}"
                                alt="{{ $relProj->title }}"
                                class="absolute inset-0 h-full w-full object-cover object-center transition-transform duration-700 group-hover:scale-105"
                            >
                            <div class="absolute inset-0 bg-black/50"></div>
                            <div class="absolute bottom-0 inset-x-0 p-5 lg:p-6">
                                <span class="block text-[10px] font-semibold uppercase tracking-[0.18em] text-white/85 mb-1.5">
                                    {{ strtoupper($loc) }}
                                </span>
                                <h3 class="text-[1.25rem] font-bold text-white leading-snug">
                                    {{ $relProj->title }}
                                </h3>
                                <span class="mt-3 inline-flex text-[13px] font-semibold text-white/90 group-hover:text-[#f0d778] transition-colors">
                                    View →
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="mt-10 text-center">
                    <a href="{{ route('projects.index') }}" class="text-[13px] font-semibold text-white/80 hover:text-white transition-colors">
                        {{ $content['cta_explore_portfolio_label'] ?? 'View full portfolio' }} →
                    </a>
                </div>
            </div>
        </section>
    @endif

    {{-- Bottom CTA --}}
    <section class="relative bg-white border-t border-black/5 py-14 lg:py-16">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="max-w-xl">
                <h2 class="text-2xl sm:text-3xl font-bold tracking-tight text-[#0f2a3a]">Ready to start your project?</h2>
                <p class="mt-2 text-sm text-[#5b6770]">Tell us about your space, timeline and ambitions — we’ll respond with clear next steps.</p>
            </div>
            <a href="#" onclick="openTenderModal(); return false;"
               class="inline-flex shrink-0 items-center gap-2 rounded-lg bg-brand hover:bg-brand-dark text-white px-7 py-3.5 text-xs font-bold uppercase tracking-[0.08em] transition-colors">
                Get a free quote
                <span aria-hidden="true">→</span>
            </a>
        </div>
    </section>

    {{-- Fullscreen Image Preview Lightbox (Circular Controls: <, ✕, >) --}}
    <div
        id="project-lightbox"
        style="position: fixed; inset: 0; z-index: 99999; display: none; align-items: center; justify-content: center; background: rgba(10, 25, 35, 0.94); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); transition: opacity 0.25s ease; opacity: 0;"
        role="dialog"
        aria-modal="true"
        aria-label="Image preview"
        onclick="handleLightboxBackdropClick(event)"
    >
        {{-- Top Bar: Title & Counter + Top Close Button --}}
        <div style="position: absolute; top: 0; left: 0; right: 0; padding: 1.25rem 1.5rem; display: flex; align-items: center; justify-content: space-between; z-index: 20; pointer-events: none;">
            <div style="pointer-events: auto; background: rgba(0, 0, 0, 0.5); backdrop-filter: blur(8px); border: 1px solid rgba(255, 255, 255, 0.15); padding: 0.4rem 1rem; border-radius: 9999px; color: #ffffff; font-size: 0.85rem; font-weight: 600; letter-spacing: 0.02em; display: inline-flex; align-items: center; gap: 0.5rem;">
                <span id="lightbox-title">{{ $project->title }}</span>
                <span id="lightbox-counter" style="color: rgba(255, 255, 255, 0.6); font-size: 0.75rem;"></span>
            </div>
            <button
                type="button"
                onclick="closeProjectLightbox(event)"
                style="pointer-events: auto; width: 42px; height: 42px; border-radius: 50%; background: rgba(0, 0, 0, 0.5); border: 1px solid rgba(255, 255, 255, 0.15); color: #ffffff; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: transform 0.2s, background 0.2s;"
                onmouseover="this.style.background='rgba(0,0,0,0.8)'; this.style.transform='scale(1.08)';"
                onmouseout="this.style.background='rgba(0,0,0,0.5)'; this.style.transform='scale(1)';"
                aria-label="Close"
                title="Close (Esc)"
            >
                <svg style="width: 20px; height: 20px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Center Full Picture Area --}}
        <div style="position: relative; max-width: 90vw; max-height: 80vh; display: flex; align-items: center; justify-content: center; padding: 0.5rem; z-index: 10;">
            <img
                id="lightbox-img"
                src=""
                alt="Full preview"
                style="max-width: 90vw; max-height: 80vh; width: auto; height: auto; object-fit: contain; border-radius: 12px; box-shadow: 0 25px 60px -15px rgba(0,0,0,0.7); display: block; user-select: none; transition: opacity 0.2s ease, transform 0.2s ease;"
            >
        </div>

        {{-- Bottom Floating Circular Toolbar (<, ✕, >) --}}
        <div style="position: absolute; bottom: 1.75rem; left: 0; right: 0; display: flex; align-items: center; justify-content: center; gap: 1rem; z-index: 20;">
            {{-- Prev (<) --}}
            <button
                type="button"
                id="lightbox-prev-btn"
                onclick="prevLightboxImage(event)"
                style="width: 46px; height: 46px; border-radius: 50%; background: #ffffff; color: #1f2937; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: 0 6px 20px rgba(0,0,0,0.28); transition: transform 0.18s, background 0.18s;"
                onmouseover="this.style.transform='scale(1.12)'; this.style.backgroundColor='#f3f4f6';"
                onmouseout="this.style.transform='scale(1)'; this.style.backgroundColor='#ffffff';"
                aria-label="Previous image"
                title="Previous image (←)"
            >
                <svg style="width: 20px; height: 20px;" fill="none" viewBox="0 0 24 24" stroke="#1f2937" stroke-width="2.6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            {{-- Close (✕) --}}
            <button
                type="button"
                id="lightbox-close-btn"
                onclick="closeProjectLightbox(event)"
                style="width: 48px; height: 48px; border-radius: 50%; background: #ffffff; color: #1f2937; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: 0 6px 20px rgba(0,0,0,0.28); transition: transform 0.18s, background 0.18s;"
                onmouseover="this.style.transform='scale(1.12)'; this.style.backgroundColor='#f3f4f6';"
                onmouseout="this.style.transform='scale(1)'; this.style.backgroundColor='#ffffff';"
                aria-label="Close preview"
                title="Close preview (Esc)"
            >
                <svg style="width: 20px; height: 20px;" fill="none" viewBox="0 0 24 24" stroke="#1f2937" stroke-width="2.6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            {{-- Next (>) --}}
            <button
                type="button"
                id="lightbox-next-btn"
                onclick="nextLightboxImage(event)"
                style="width: 46px; height: 46px; border-radius: 50%; background: #ffffff; color: #1f2937; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: 0 6px 20px rgba(0,0,0,0.28); transition: transform 0.18s, background 0.18s;"
                onmouseover="this.style.transform='scale(1.12)'; this.style.backgroundColor='#f3f4f6';"
                onmouseout="this.style.transform='scale(1)'; this.style.backgroundColor='#ffffff';"
                aria-label="Next image"
                title="Next image (→)"
            >
                <svg style="width: 20px; height: 20px;" fill="none" viewBox="0 0 24 24" stroke="#1f2937" stroke-width="2.6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>

    @php
        $gallery = [];
        $gallery[] = [
            'src' => asset($project->image_url ?: 'images/hero_architecture.png'),
            'title' => $project->title,
        ];
        if (isset($related) && !$related->isEmpty()) {
            foreach($related as $rel) {
                $gallery[] = [
                    'src' => asset($rel->image_url ?: 'images/hero_architecture.png'),
                    'title' => $rel->title,
                ];
            }
        }
    @endphp

    <script>
        const projectGallery = @json($gallery);
        let currentLightboxIndex = 0;

        function openProjectLightbox(index = 0) {
            currentLightboxIndex = index;
            const modal = document.getElementById('project-lightbox');
            if (!modal) return;
            updateLightboxView();
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
            requestAnimationFrame(() => {
                modal.style.opacity = '1';
            });
            window.addEventListener('keydown', handleLightboxKeydown);
        }

        function closeProjectLightbox(event) {
            if (event) event.stopPropagation();
            const modal = document.getElementById('project-lightbox');
            if (!modal) return;
            modal.style.opacity = '0';
            window.removeEventListener('keydown', handleLightboxKeydown);
            setTimeout(() => {
                modal.style.display = 'none';
                document.body.style.overflow = '';
            }, 250);
        }

        function updateLightboxView() {
            if (!projectGallery || projectGallery.length === 0) return;
            if (currentLightboxIndex < 0) currentLightboxIndex = projectGallery.length - 1;
            if (currentLightboxIndex >= projectGallery.length) currentLightboxIndex = 0;

            const item = projectGallery[currentLightboxIndex];
            const img = document.getElementById('lightbox-img');
            const title = document.getElementById('lightbox-title');
            const counter = document.getElementById('lightbox-counter');

            if (img) {
                img.style.opacity = '0.3';
                img.style.transform = 'scale(0.97)';
                const newImg = new Image();
                newImg.onload = () => {
                    img.src = item.src;
                    img.style.opacity = '1';
                    img.style.transform = 'scale(1)';
                };
                newImg.src = item.src;
            }
            if (title) title.textContent = item.title;
            if (counter) {
                if (projectGallery.length > 1) {
                    counter.textContent = `(${currentLightboxIndex + 1} of ${projectGallery.length})`;
                } else {
                    counter.textContent = '';
                }
            }
        }

        function prevLightboxImage(event) {
            if (event) event.stopPropagation();
            currentLightboxIndex--;
            updateLightboxView();
        }

        function nextLightboxImage(event) {
            if (event) event.stopPropagation();
            currentLightboxIndex++;
            updateLightboxView();
        }

        function handleLightboxBackdropClick(event) {
            const modal = document.getElementById('project-lightbox');
            if (event.target === modal) {
                closeProjectLightbox();
            }
        }

        function handleLightboxKeydown(event) {
            if (event.key === 'Escape') {
                closeProjectLightbox();
            } else if (event.key === 'ArrowLeft') {
                prevLightboxImage();
            } else if (event.key === 'ArrowRight') {
                nextLightboxImage();
            }
        }
    </script>
@endsection
