@extends('layouts.public')

@section('title', ($content['blog_title'] ?? 'Insights & News') . ' | Construction 360 Ltd')

@section('meta')
    <meta name="description" content="{{ $content['blog_section_subtitle'] ?? 'Read the latest construction insights, project updates and expert guides from Construction 360 Ltd across London and Essex.' }}">
    <meta name="robots" content="index, follow">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Construction 360 Ltd">
    <meta property="og:title" content="{{ $content['blog_title'] ?? 'Insights & News' }} | Construction 360 Ltd">
    <meta property="og:description" content="{{ $content['blog_section_subtitle'] ?? 'Construction insights and news from Construction 360 Ltd.' }}">
    <meta property="og:image" content="{{ asset($content['hero_image'] ?? 'images/hero_construction.png') }}">
@endsection

@section('content')
    {{-- Light hero — matches Projects / Services --}}
    <section class="relative bg-white border-b border-black/5">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10" style="padding-top: 7.5rem; padding-bottom: 3.5rem;">
            <div class="max-w-3xl">
                <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-brand">
                    {{ $content['blog_label'] ?? 'Insights' }}
                </p>
                <h1 class="mt-4 text-4xl sm:text-5xl lg:text-[3.25rem] font-bold tracking-tight leading-tight text-[#0f2a3a]">
                    {{ $content['blog_title'] ?? 'Our blog' }}
                </h1>
                <div class="mt-5 h-[3px] w-14 bg-brand"></div>
                <p class="mt-5 text-base sm:text-[15px] text-[#5b6770] leading-relaxed max-w-2xl">
                    {{ $content['blog_section_subtitle'] ?? 'Read the latest technical guidelines, fit-out processes, glazing specifications, and industry news from our building experts.' }}
                </p>
                <div class="mt-6 flex items-center gap-2 text-[11px] font-semibold uppercase tracking-[0.14em] text-[#6b7280]">
                    <a href="{{ url('/') }}" class="hover:text-brand transition-colors">Home</a>
                    <span>•</span>
                    <span class="text-[#0f2a3a]">Blog</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Blog feed --}}
    <section class="bg-white py-12 lg:py-16">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10">
            {{-- Category filters --}}
            <div class="flex flex-wrap gap-2.5 mb-10 lg:mb-12 pb-8 border-b border-black/5">
                <a href="{{ route('blog.index') }}"
                   class="px-4 py-2 rounded-full text-[11px] font-bold uppercase tracking-[0.1em] transition-all {{ !request('category') ? 'bg-brand text-white' : 'border border-black/10 text-[#5b6770] hover:border-brand hover:text-brand bg-white' }}">
                    All posts
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('blog.index', ['category' => $cat]) }}"
                       class="px-4 py-2 rounded-full text-[11px] font-bold uppercase tracking-[0.1em] transition-all {{ request('category') === $cat ? 'bg-brand text-white' : 'border border-black/10 text-[#5b6770] hover:border-brand hover:text-brand bg-white' }}">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-start">
                {{-- Posts --}}
                <div class="lg:col-span-8 space-y-12 lg:space-y-16">
                    @if($blogs->isEmpty())
                        <div class="text-center py-16 lg:py-20 rounded-2xl border border-black/8 bg-aqua-light">
                            <h3 class="text-xl font-bold text-[#0f2a3a]">No posts found</h3>
                            <p class="mt-3 text-sm text-[#5b6770] max-w-md mx-auto">
                                We couldn't find any articles matching your filters. Try another category or reset your search.
                            </p>
                            <a href="{{ route('blog.index') }}"
                               class="mt-6 inline-flex items-center gap-2 rounded-lg bg-brand text-white px-5 py-3 text-[11px] font-bold uppercase tracking-[0.08em] hover:bg-brand-dark transition-colors">
                                Show all posts
                            </a>
                        </div>
                    @else
                        @foreach($blogs as $blog)
                            <article class="group pb-12 border-b border-black/5 last:border-b-0 last:pb-0 space-y-5">
                                @if($blog->image_url)
                                    <a href="{{ route('blog.show', $blog->slug) }}" class="block relative overflow-hidden rounded-2xl border border-black/5 bg-[#0f2a3a]">
                                        <img src="{{ asset($blog->image_url) }}" alt="{{ $blog->title }}"
                                             class="w-full h-[260px] sm:h-[340px] lg:h-[380px] object-cover group-hover:scale-[1.02] transition-transform duration-700">
                                    </a>
                                @endif

                                <div class="flex flex-wrap items-center gap-x-3 gap-y-2 text-[10px] font-semibold uppercase tracking-[0.14em] text-[#9ca3af]">
                                    <span class="rounded-md bg-brand text-white px-2.5 py-1">
                                        {{ $blog->category ?? 'Uncategorized' }}
                                    </span>
                                    <span>{{ $blog->published_at ? $blog->published_at->format('M d, Y') : $blog->created_at->format('M d, Y') }}</span>
                                    <span>By {{ $blog->author }}</span>
                                </div>

                                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold tracking-tight leading-tight text-[#0f2a3a]">
                                    <a href="{{ route('blog.show', $blog->slug) }}" class="hover:text-brand transition-colors">
                                        {{ $blog->title }}
                                    </a>
                                </h2>

                                <p class="text-sm sm:text-[15px] text-[#5b6770] leading-relaxed line-clamp-4">
                                    {{ $blog->excerpt }}
                                </p>

                                <a href="{{ route('blog.show', $blog->slug) }}"
                                   class="inline-flex items-center gap-2 text-[11px] font-bold uppercase tracking-[0.12em] text-brand hover:text-brand-dark transition-colors">
                                    Read post
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                                </a>
                            </article>
                        @endforeach
                    @endif
                </div>

                {{-- Sidebar --}}
                <div class="lg:col-span-4">
                    @include('partials.blog-sidebar')
                </div>
            </div>
        </div>
    </section>

    {{-- Footer CTA --}}
    <section class="bg-brand text-white py-16 lg:py-20">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10 text-center space-y-5">
            <h2 class="text-2xl sm:text-3xl font-bold leading-tight">
                {{ $content['pre_footer_cta_title'] ?? 'Ready to build with clarity and craft?' }}
            </h2>
            <p class="text-sm text-white/75 max-w-lg mx-auto">
                {{ $content['pre_footer_cta_subtitle'] ?? 'Tell us about your space, timeline and ambitions.' }}
            </p>
            <a href="#" onclick="openTenderModal(); return false;"
               class="inline-flex items-center gap-2 rounded-lg bg-white text-brand px-6 py-3.5 text-xs font-bold uppercase tracking-[0.08em] hover:bg-aqua-light transition-colors">
                {{ $content['cta_get_free_quote_label'] ?? 'Get your free quote' }}
            </a>
        </div>
    </section>
@endsection
