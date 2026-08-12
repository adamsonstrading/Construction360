@extends('layouts.public')

@section('title', ($blog->meta_title ?: $blog->title) . ' | Construction 360 Ltd')

@section('meta')
    <meta name="description" content="{{ $blog->meta_description ?: $blog->excerpt }}">
    <meta name="keywords" content="{{ $blog->meta_keywords ?: 'construction blog, news, builder insights, London Essex construction' }}">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Construction 360 Ltd">
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Construction 360 Ltd">
    <meta property="og:title" content="{{ $blog->meta_title ?: $blog->title }}">
    <meta property="og:description" content="{{ $blog->meta_description ?: $blog->excerpt }}">
    <meta property="og:image" content="{{ !empty($blog->image_url) ? asset($blog->image_url) : asset('images/hero_construction.png') }}">
    @if($blog->published_at)
        <meta property="article:published_time" content="{{ $blog->published_at->toIso8601String() }}">
    @endif
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $blog->meta_title ?: $blog->title }}">
    <meta property="twitter:description" content="{{ $blog->meta_description ?: $blog->excerpt }}">
    <meta property="twitter:image" content="{{ !empty($blog->image_url) ? asset($blog->image_url) : asset('images/hero_construction.png') }}">
@endsection

@section('content')
    {{-- Brand hero --}}
    <section class="bg-brand text-white" style="padding-top: 7.5rem;">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10 pb-12 lg:pb-14">
            <div class="max-w-3xl space-y-4">
                <div class="flex flex-wrap items-center gap-x-2 gap-y-1 text-[11px] font-semibold uppercase tracking-[0.14em] text-white/70">
                    <a href="{{ url('/') }}" class="hover:text-white transition-colors">Home</a>
                    <span>•</span>
                    <a href="{{ route('blog.index') }}" class="hover:text-white transition-colors">Blog</a>
                    <span>•</span>
                    <span class="text-white line-clamp-1">{{ $blog->title }}</span>
                </div>

                <div class="flex flex-wrap items-center gap-x-3 gap-y-2 text-[10px] font-semibold uppercase tracking-[0.14em] text-white/75">
                    <span class="rounded-md bg-white/15 px-2.5 py-1 text-white">
                        {{ $blog->category ?? 'Uncategorized' }}
                    </span>
                    <span>{{ $blog->published_at ? $blog->published_at->format('M d, Y') : $blog->created_at->format('M d, Y') }}</span>
                    <span>By {{ $blog->author }}</span>
                </div>

                <h1 class="text-3xl sm:text-4xl lg:text-[3rem] font-bold tracking-tight leading-tight text-white">
                    {{ $blog->title }}
                </h1>
                <div class="h-[3px] w-14 bg-white"></div>
            </div>
        </div>
    </section>

    {{-- Article --}}
    <section class="bg-white py-12 lg:py-16">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-start">
                <article class="lg:col-span-8 space-y-8">
                    @if($blog->image_url)
                        <div class="relative overflow-hidden rounded-2xl border border-black/5 bg-[#0f2a3a]">
                            <img src="{{ asset($blog->image_url) }}" alt="{{ $blog->title }}"
                                 class="w-full h-auto max-h-[520px] object-cover">
                        </div>
                    @endif

                    <div class="prose prose-slate max-w-none text-[#5b6770] leading-relaxed text-sm sm:text-[15px] space-y-5">
                        {!! $blog->content !!}
                    </div>

                    <div class="pt-8 mt-4 border-t border-black/5">
                        <div class="rounded-2xl bg-aqua-light border border-black/8 p-6 sm:p-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
                            <div class="space-y-2">
                                <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-brand">Next step</p>
                                <h2 class="text-lg sm:text-xl font-bold text-[#0f2a3a]">Interested in our building solutions?</h2>
                                <p class="text-sm text-[#5b6770]">We deliver design-led residential, commercial and structural projects across London and Essex.</p>
                            </div>
                            <a href="#" onclick="openTenderModal(); return false;"
                               class="inline-flex shrink-0 items-center gap-2 rounded-lg bg-brand text-white px-5 py-3 text-[11px] font-bold uppercase tracking-[0.08em] hover:bg-brand-dark transition-colors">
                                Get in touch
                            </a>
                        </div>
                    </div>
                </article>

                <div class="lg:col-span-4">
                    @include('partials.blog-sidebar')
                </div>
            </div>
        </div>
    </section>
@endsection
