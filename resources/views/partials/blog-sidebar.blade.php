<aside class="lg:sticky lg:top-28 space-y-6">
    {{-- Search --}}
    <div class="rounded-2xl border border-black/8 bg-aqua-light p-5 sm:p-6 space-y-4">
        <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-brand">Search</p>
        <form action="{{ route('blog.index') }}" method="GET" class="relative">
            @if(request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search articles..."
                   class="w-full rounded-xl border border-black/10 bg-white px-4 py-3 pr-10 text-sm text-[#1a1a1a] placeholder:text-[#9ca3af] focus:outline-none focus:border-brand focus:ring-1 focus:ring-brand transition-colors">
            <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-[#9ca3af] hover:text-brand transition-colors">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </button>
        </form>
    </div>

    {{-- Categories --}}
    @if(!empty($categories) && count($categories) > 0)
        <div class="rounded-2xl border border-black/8 bg-white p-5 sm:p-6 space-y-4">
            <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-brand">Categories</p>
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('blog.index') }}"
                       class="flex items-center gap-2 text-sm font-medium transition-colors {{ !request('category') ? 'text-brand' : 'text-[#5b6770] hover:text-brand' }}">
                        <span class="h-1.5 w-1.5 rounded-full {{ !request('category') ? 'bg-brand' : 'bg-[#d1d5db]' }}"></span>
                        All posts
                    </a>
                </li>
                @foreach($categories as $cat)
                    <li>
                        <a href="{{ route('blog.index', ['category' => $cat]) }}"
                           class="flex items-center gap-2 text-sm font-medium transition-colors {{ request('category') === $cat ? 'text-brand' : 'text-[#5b6770] hover:text-brand' }}">
                            <span class="h-1.5 w-1.5 rounded-full {{ request('category') === $cat ? 'bg-brand' : 'bg-[#d1d5db]' }}"></span>
                            {{ $cat }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Recent posts --}}
    @if(!empty($recent_posts) && $recent_posts->count() > 0)
        <div class="rounded-2xl border border-black/8 bg-white p-5 sm:p-6 space-y-4">
            <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-brand">Recent posts</p>
            <div class="space-y-4">
                @foreach($recent_posts->take(4) as $post)
                    <a href="{{ route('blog.show', $post->slug) }}" class="flex items-start gap-3 group">
                        <div class="h-14 w-[4.5rem] shrink-0 overflow-hidden rounded-lg border border-black/8 bg-[#0f2a3a]">
                            @if($post->image_url)
                                <img src="{{ asset($post->image_url) }}" alt="{{ $post->title }}" class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @endif
                        </div>
                        <div class="min-w-0 space-y-1">
                            <span class="block text-sm font-semibold text-[#0f2a3a] leading-snug group-hover:text-brand transition-colors line-clamp-2">
                                {{ $post->title }}
                            </span>
                            <span class="block text-[10px] font-semibold uppercase tracking-[0.12em] text-[#9ca3af]">
                                {{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    {{-- CTA --}}
    <div class="rounded-2xl bg-brand text-white p-5 sm:p-6 space-y-4">
        <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-white/80">Need advice?</p>
        <p class="text-sm text-white/85 leading-relaxed">Speak with our team about your project brief or programme.</p>
        <a href="{{ route('contact.index') }}"
           class="inline-flex items-center gap-2 rounded-lg bg-white text-brand px-4 py-2.5 text-[11px] font-bold uppercase tracking-[0.08em] hover:bg-aqua-light transition-colors">
            Get in touch
        </a>
    </div>
</aside>
