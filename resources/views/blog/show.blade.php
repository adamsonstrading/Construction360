@extends('layouts.public')

@section('title', ($blog->meta_title ?: $blog->title) . ' | News & Insights | Construction 360 Ltd')

@section('meta')
    <meta name="description" content="{{ $blog->meta_description ?: $blog->excerpt }}">
    <meta name="keywords" content="{{ $blog->meta_keywords ?: 'construction blog, news, builder insights, UK construction' }}">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Construction 360 Ltd">
    <!-- Open Graph -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Construction 360 Ltd">
    <meta property="og:title" content="{{ $blog->meta_title ?: $blog->title }}">
    <meta property="og:description" content="{{ $blog->meta_description ?: $blog->excerpt }}">
    <meta property="og:image" content="{{ !empty($blog->image_url) ? asset($blog->image_url) : asset('images/hero_construction.png') }}">
    @if($blog->published_at)
        <meta property="article:published_time" content="{{ $blog->published_at->toIso8601String() }}">
    @endif
    <!-- Twitter Card -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $blog->meta_title ?: $blog->title }}">
    <meta property="twitter:description" content="{{ $blog->meta_description ?: $blog->excerpt }}">
    <meta property="twitter:image" content="{{ !empty($blog->image_url) ? asset($blog->image_url) : asset('images/hero_construction.png') }}">
@endsection

@section('content')
    <!-- Breadcrumbs & Navigation -->
    <nav class="bg-slate-50 border-b border-slate-100 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center space-x-2 text-xs font-bold uppercase tracking-widest text-slate-400">
                <a href="{{ url('/') }}" class="hover:text-aqua transition-colors">Home</a>
                <span>/</span>
                <a href="{{ route('blog.index') }}" class="hover:text-aqua transition-colors">News</a>
                <span>/</span>
                <span class="text-slate-600 truncate max-w-xs sm:max-w-md">{{ $blog->title }}</span>
            </div>
        </div>
    </nav>

    <!-- Blog Detail Container -->
    <section class="bg-white py-16 lg:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
                
                <!-- Left Column: Article Body (66% Width) -->
                <article class="lg:col-span-8 space-y-8">
                    
                    <!-- Date & Category Meta Row -->
                    <div class="flex items-center space-x-4 text-xs font-bold uppercase tracking-wider text-slate-400">
                        <span class="bg-[#328f95] text-white px-3 py-1 rounded-md text-[10px] tracking-widest uppercase">
                            {{ $blog->category ?? 'Uncategorized' }}
                        </span>
                        <span>•</span>
                        <span>{{ $blog->published_at ? $blog->published_at->format('M d, Y') : $blog->created_at->format('M d, Y') }}</span>
                        <span>•</span>
                        <span>By {{ $blog->author }}</span>
                    </div>

                    <!-- Title -->
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-950 tracking-tighter leading-tight font-sans">
                        {{ $blog->title }}
                    </h1>

                    <!-- Featured Image -->
                    @if($blog->image_url)
                        <div class="bg-white border border-slate-150 rounded-3xl p-2.5 shadow-md overflow-hidden">
                            <img src="{{ asset($blog->image_url) }}" alt="{{ $blog->title }}" 
                                 class="w-full h-auto max-h-[500px] object-cover rounded-2xl">
                        </div>
                    @endif

                    <!-- Article Body Content -->
                    <div class="prose prose-slate max-w-none text-slate-650 leading-relaxed text-sm sm:text-base space-y-6 font-sans pt-4">
                        {!! $blog->content !!}
                    </div>

                    <!-- CTA bottom panel -->
                    <div class="border-t border-slate-100 pt-10 mt-12">
                        <div class="bg-slate-50 border border-slate-150 rounded-2xl p-6 sm:p-8 flex flex-col sm:flex-row justify-between items-center gap-6">
                            <div class="space-y-1.5 text-center sm:text-left">
                                <h4 class="text-sm font-bold text-slate-900 font-sans">Interested in our building solutions?</h4>
                                <p class="text-xs text-slate-500 font-sans">We deliver high-end structural, residential, and commercial developments.</p>
                            </div>
                            <a href="#" onclick="openTenderModal(); return false;" class="inline-flex items-center justify-center px-5 py-2.5 text-xs font-bold uppercase tracking-widest text-white bg-slate-950 hover:bg-slate-800 rounded-lg shadow-sm transition-all duration-200">
                                Get In Touch
                            </a>
                        </div>
                    </div>
                </article>

                <!-- Right Column: Sidebar (33% Width) -->
                <aside class="lg:col-span-4 lg:sticky lg:top-28 space-y-12">
                    
                    <!-- Search Widget -->
                    <div class="space-y-4">
                        <h3 class="text-xs font-bold uppercase tracking-widest text-slate-400 border-b border-slate-100 pb-3 font-sans">
                            Search
                        </h3>
                        <form action="{{ route('blog.index') }}" method="GET" class="relative">
                            <input type="text" name="q" placeholder="Search articles..."
                                   class="w-full bg-slate-50 border border-slate-200 rounded-lg pl-4 pr-10 py-3 text-xs font-bold text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-aqua focus:border-transparent transition-all font-sans">
                            <button type="submit" class="absolute right-3 top-3.5 text-slate-400 hover:text-aqua transition-colors">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </form>
                    </div>

                    <!-- Recent Posts Widget -->
                    <div class="space-y-4">
                        <h3 class="text-xs font-bold uppercase tracking-widest text-slate-400 border-b border-slate-100 pb-3 font-sans">
                            Recent Posts
                        </h3>
                        <ul class="space-y-3">
                            @foreach($recent_posts as $post)
                                <li>
                                    <a href="{{ route('blog.show', $post->slug) }}" 
                                       class="text-xs font-bold text-slate-700 hover:text-aqua leading-relaxed transition-colors font-sans block">
                                        {{ $post->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Recent Comments Widget (WordPress Style) -->
                    <div class="space-y-4">
                        <h3 class="text-xs font-bold uppercase tracking-widest text-slate-400 border-b border-slate-100 pb-3 font-sans">
                            Recent Comments
                        </h3>
                        <p class="text-xs text-slate-400 font-sans italic leading-relaxed">
                            No comments to show.
                        </p>
                    </div>

                    <!-- Categories List Widget -->
                    <div class="space-y-4">
                        <h3 class="text-xs font-bold uppercase tracking-widest text-slate-400 border-b border-slate-100 pb-3 font-sans">
                            Categories
                        </h3>
                        <ul class="space-y-2.5">
                            @foreach($categories as $cat)
                                <li>
                                    <a href="{{ route('blog.index', ['category' => $cat]) }}" 
                                       class="text-xs font-bold text-slate-700 hover:text-aqua flex items-center space-x-2 transition-colors font-sans">
                                        <span class="h-1.5 w-1.5 rounded-full bg-slate-300"></span>
                                        <span>{{ $cat }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Recent Posts with Thumbnails Widget -->
                    <div class="space-y-4">
                        <h3 class="text-xs font-bold uppercase tracking-widest text-slate-400 border-b border-slate-100 pb-3 font-sans">
                            Recent Posts
                        </h3>
                        <div class="space-y-4">
                            @foreach($recent_posts->take(3) as $post)
                                <div class="flex items-center space-x-3">
                                    <div class="h-12 w-16 bg-slate-100 rounded-lg overflow-hidden border border-slate-200 flex-shrink-0">
                                        @if($post->image_url)
                                            <img src="{{ asset($post->image_url) }}" alt="{{ $post->title }}" class="object-cover h-full w-full">
                                        @else
                                            <svg class="h-6 w-6 text-slate-350 m-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="flex-grow">
                                        <a href="{{ route('blog.show', $post->slug) }}" 
                                           class="text-[11px] font-bold text-slate-800 hover:text-aqua transition-colors leading-tight block line-clamp-2 font-sans">
                                            {{ $post->title }}
                                        </a>
                                        <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-0.5 block">
                                            {{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </aside>
            </div>
        </div>
    </section>
@endsection
