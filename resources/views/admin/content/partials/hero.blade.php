{{-- Partial: Hero Section & Statistics --}}
<div class="space-y-6">
    <div class="border-b border-slate-200 pb-4">
        <h4 class="text-base font-bold text-slate-800 flex items-center">
            <svg class="h-5 w-5 text-[#36a1b3] mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
            </svg>
            Hero Header & Key Performance Indicators
        </h4>
        <p class="text-xs text-slate-500 mt-1">Configure your primary above-the-fold value proposition, headlines, background media, intro video, metrics counters, and trust badges.</p>
    </div>

    <!-- Main Headlines -->
    <div class="space-y-3">
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Multi-Line Split Headline</label>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="hero_line_1" class="block text-xs font-semibold text-slate-600">Headline Line 1 (Dark)</label>
                <input type="text" name="hero_line_1" id="hero_line_1" value="{{ old('hero_line_1', $content['hero_line_1'] ?? 'Design-led construction') }}" required
                    class="mt-1 block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent">
                @error('hero_line_1') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="hero_line_2" class="block text-xs font-semibold text-slate-600">Headline Line 2 (Dark)</label>
                <input type="text" name="hero_line_2" id="hero_line_2" value="{{ old('hero_line_2', $content['hero_line_2'] ?? 'built with care') }}"
                    class="mt-1 block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent">
                @error('hero_line_2') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="hero_line_3" class="block text-xs font-semibold text-slate-600">Headline Line 3 (Teal Highlight)</label>
                <input type="text" name="hero_line_3" id="hero_line_3" value="{{ old('hero_line_3', $content['hero_line_3'] ?? 'Across London and') }}"
                    class="mt-1 block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent">
                @error('hero_line_3') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="hero_line_4" class="block text-xs font-semibold text-slate-600">Headline Line 4 (Teal Highlight)</label>
                <input type="text" name="hero_line_4" id="hero_line_4" value="{{ old('hero_line_4', $content['hero_line_4'] ?? 'Essex') }}"
                    class="mt-1 block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent">
                @error('hero_line_4') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>

    <!-- Badge & Subtitle -->
    <div class="grid grid-cols-1 gap-4 pt-2">
        <div>
            <label for="hero_badge" class="block text-xs font-semibold text-slate-700">Eyebrow Pill Badge (Above Headline)</label>
            <input type="text" name="hero_badge" id="hero_badge" value="{{ old('hero_badge', $content['hero_badge'] ?? 'London · Est. 2013 · Fixed prices') }}"
                class="mt-1 block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent">
            @error('hero_badge') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="hero_subtitle" class="block text-xs font-semibold text-slate-700">Hero Subtitle</label>
            <textarea rows="3" name="hero_subtitle" id="hero_subtitle" required
                class="mt-1 block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent">{{ old('hero_subtitle', $content['hero_subtitle'] ?? '') }}</textarea>
            @error('hero_subtitle') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>
    </div>

    <!-- Hero Media (Image & Video) -->
    <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-4">
        <h5 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Hero Visual Media</h5>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="hero_image" class="block text-xs font-semibold text-slate-700">Hero Poster Image</label>
                @if(!empty($content['hero_image']))
                    <p class="mt-1 text-xs text-slate-500 font-mono">Current: {{ $content['hero_image'] }}</p>
                @endif
                <input type="file" name="hero_image" id="hero_image" accept="image/*"
                    class="mt-1 block w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:bg-teal-50 file:text-[#36a1b3] hover:file:bg-teal-100">
            </div>

            <div>
                <label for="hero_video" class="block text-xs font-semibold text-slate-700">Hero Intro Video (MP4 / WebM)</label>
                @if(!empty($content['hero_video']))
                    <p class="mt-1 text-xs text-slate-500 font-mono">Current: {{ $content['hero_video'] }}</p>
                @endif
                <input type="file" name="hero_video" id="hero_video" accept="video/mp4,video/webm"
                    class="mt-1 block w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:bg-teal-50 file:text-[#36a1b3] hover:file:bg-teal-100">
            </div>

            <div>
                <label for="hero_watch_label" class="block text-xs font-semibold text-slate-700">Video Overlay Title</label>
                <input type="text" name="hero_watch_label" id="hero_watch_label" value="{{ old('hero_watch_label', $content['hero_watch_label'] ?? 'Watch Our Intro') }}"
                    class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">
            </div>

            <div>
                <label for="hero_watch_sub" class="block text-xs font-semibold text-slate-700">Video Overlay Subtitle</label>
                <input type="text" name="hero_watch_sub" id="hero_watch_sub" value="{{ old('hero_watch_sub', $content['hero_watch_sub'] ?? '60 sec overview') }}"
                    class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">
            </div>
        </div>
    </div>

    <!-- 4 Key Stat Counters -->
    <div class="space-y-3">
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">4 Key Proof / Statistic Counters</label>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
            @foreach([1, 2, 3, 4] as $i)
                <div class="bg-slate-50 p-3.5 rounded-xl border border-slate-200 space-y-2">
                    <span class="text-[11px] font-bold text-[#36a1b3] uppercase tracking-wider">Metric Counter {{ $i }}</span>
                    <div>
                        <label class="block text-[10px] font-semibold text-slate-500">Value (e.g. £10M+)</label>
                        <input type="text" name="stat_{{ $i }}_value" value="{{ old('stat_'.$i.'_value', $content['stat_'.$i.'_value'] ?? '') }}" required
                            class="mt-0.5 block w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded-md text-xs font-bold">
                    </div>
                    <div>
                        <label class="block text-[10px] font-semibold text-slate-500">Label (e.g. Insured Cover)</label>
                        <input type="text" name="stat_{{ $i }}_label" value="{{ old('stat_'.$i.'_label', $content['stat_'.$i.'_label'] ?? '') }}" required
                            class="mt-0.5 block w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded-md text-xs">
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Reviews Trust Strip -->
    <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Reviews & Ratings Strip</label>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <label for="reviews_score" class="block text-xs font-semibold text-slate-700">Review Score Rating</label>
                <input type="text" name="reviews_score" id="reviews_score" value="{{ old('reviews_score', $content['reviews_score'] ?? '4.9') }}" required
                    class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs font-bold">
            </div>
            <div>
                <label for="reviews_score_sub" class="block text-xs font-semibold text-slate-700">Rating Subtitle</label>
                <input type="text" name="reviews_score_sub" id="reviews_score_sub" value="{{ old('reviews_score_sub', $content['reviews_score_sub'] ?? 'from client reviews') }}" required
                    class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">
            </div>
            <div>
                <label for="reviews_link_label" class="block text-xs font-semibold text-slate-700">Reviews Link CTA</label>
                <input type="text" name="reviews_link_label" id="reviews_link_label" value="{{ old('reviews_link_label', $content['reviews_link_label'] ?? 'Read all reviews') }}" required
                    class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">
            </div>
        </div>
    </div>
</div>
