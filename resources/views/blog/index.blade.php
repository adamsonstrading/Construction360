@extends('layouts.public')

@section('title', 'Insights & News | Construction 360 Ltd')

@section('content')
    <!-- Blog Hero Section -->
    <section class="bg-white py-16 border-b border-slate-100 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-3xl">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-aqua">Insights & Updates</span>
                <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold text-slate-950 mt-4 tracking-tighter leading-none font-sans">
                    Our Blog
                </h1>
                <p class="mt-6 text-base sm:text-lg text-slate-550 leading-relaxed font-sans">
                    Read the latest technical guidelines, architectural fit-out processes, glazing specifications, and industry news from our building experts.
                </p>
            </div>
        </div>
    </section>

    <!-- Blog Container -->
    <section class="bg-white py-12 lg:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Category Filter Pills Bar (Competitor-matched) -->
            <div class="flex flex-wrap gap-2.5 pb-10 border-b border-slate-100 mb-12">
                <a href="{{ route('blog.index') }}" 
                   class="px-5 py-2.5 rounded-full border text-xs font-bold uppercase tracking-wider transition-all {{ !request('category') ? 'bg-[#328f95] text-white border-transparent' : 'border-slate-200 text-slate-600 hover:border-slate-400 bg-white' }}">
                    All Posts
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('blog.index', ['category' => $cat]) }}" 
                       class="px-5 py-2.5 rounded-full border text-xs font-bold uppercase tracking-wider transition-all {{ request('category') === $cat ? 'bg-[#328f95] text-white border-transparent' : 'border-slate-200 text-slate-600 hover:border-slate-400 bg-white' }}">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>

            <!-- Two Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
                
                <!-- Left Column: Blog Post List (66% Width) -->
                <div class="lg:col-span-8 space-y-16">
                    @if($blogs->isEmpty())
                        <div class="text-center py-20 bg-slate-50 border border-slate-150 rounded-2xl">
                            <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                            <h3 class="mt-4 text-base font-bold text-slate-900 font-sans">No posts found</h3>
                            <p class="mt-2 text-xs sm:text-sm text-slate-500 max-w-sm mx-auto font-sans">
                                We couldn't find any articles matching your search criteria. Try modifying your search or resetting filters.
                            </p>
                            <div class="mt-6">
                                <a href="{{ route('blog.index') }}" class="inline-flex items-center px-4 py-2 border border-slate-200 text-xs font-bold uppercase tracking-widest text-slate-700 hover:border-slate-800 rounded-lg transition-all">
                                    Show All Posts
                                </a>
                            </div>
                        </div>
                    @else
                        @foreach($blogs as $blog)
                            <article class="space-y-6 pb-12 border-b border-slate-100 last:border-b-0 last:pb-0">
                                <!-- Featured Image -->
                                @if($blog->image_url)
                                    <div class="relative overflow-hidden rounded-3xl border border-slate-150 p-2 bg-white shadow-sm group">
                                        <a href="{{ route('blog.show', $blog->slug) }}" class="block overflow-hidden rounded-2xl">
                                            <img src="{{ asset($blog->image_url) }}" alt="{{ $blog->title }}" 
                                                 class="w-full h-[320px] sm:h-[400px] object-cover rounded-2xl group-hover:scale-[1.015] transition-transform duration-700">
                                        </a>
                                    </div>
                                @endif

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
                                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-950 tracking-tight leading-snug hover:text-aqua transition-colors font-sans">
                                    <a href="{{ route('blog.show', $blog->slug) }}">
                                        {{ $blog->title }}
                                    </a>
                                </h2>

                                <!-- Excerpt -->
                                <p class="text-slate-500 text-sm sm:text-base leading-relaxed font-sans line-clamp-4">
                                    {{ $blog->excerpt }}
                                </p>

                                <!-- Read More -->
                                <div class="pt-2">
                                    <a href="{{ route('blog.show', $blog->slug) }}" 
                                       class="inline-flex items-center text-xs font-bold uppercase tracking-widest text-slate-900 hover:text-aqua transition-colors group evoke-link">
                                        Read post
                                        <svg class="ml-2 h-4 w-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                        </svg>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    @endif
                </div>

                <!-- Right Column: Sidebar (33% Width) -->
                <aside class="lg:col-span-4 lg:sticky lg:top-28 space-y-12">
                    
                    <!-- Search Widget -->
                    <div class="space-y-4">
                        <h3 class="text-xs font-bold uppercase tracking-widest text-slate-400 border-b border-slate-100 pb-3 font-sans">
                            Search
                        </h3>
                        <form action="{{ route('blog.index') }}" method="GET" class="relative">
                            @if(request('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search articles..."
                                   class="w-full bg-slate-50 border border-slate-200 rounded-lg pl-4 pr-10 py-3 text-xs font-bold text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-aqua focus:border-transparent transition-all">
                            <!-- Search Icon Button -->
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
