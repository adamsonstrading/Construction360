{{-- Partial: SEO & Search Engine Optimization --}}
<div class="space-y-6">
    <div class="border-b border-slate-200 pb-4">
        <h4 class="text-base font-bold text-slate-800 flex items-center">
            <svg class="h-5 w-5 text-[#36a1b3] mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            SEO & Search Engine Metadata
        </h4>
        <p class="text-xs text-slate-500 mt-1">Fine-tune global Google search indexing, meta tags, OpenGraph preview cards, and webmaster verification.</p>
    </div>

    <div>
        <label for="seo_meta_title" class="block text-sm font-semibold text-slate-700">SEO Meta Title</label>
        <input type="text" name="seo_meta_title" id="seo_meta_title" value="{{ old('seo_meta_title', $content['seo_meta_title'] ?? '') }}" required
            class="mt-1.5 block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent">
        <p class="mt-1 text-xs text-slate-400">The browser title & Google search headline (recommended: 50–60 characters).</p>
        @error('seo_meta_title')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="seo_meta_description" class="block text-sm font-semibold text-slate-700">SEO Meta Description</label>
        <textarea rows="3" name="seo_meta_description" id="seo_meta_description" required
            class="mt-1.5 block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent">{{ old('seo_meta_description', $content['seo_meta_description'] ?? '') }}</textarea>
        <p class="mt-1 text-xs text-slate-400">Brief summary displayed below your title in Google search results (recommended: 150–160 characters).</p>
        @error('seo_meta_description')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="seo_meta_keywords" class="block text-sm font-semibold text-slate-700">SEO Meta Keywords</label>
        <input type="text" name="seo_meta_keywords" id="seo_meta_keywords" value="{{ old('seo_meta_keywords', $content['seo_meta_keywords'] ?? '') }}" required
            placeholder="e.g. construction, architectural builds, structural engineering, London, Essex"
            class="mt-1.5 block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent">
        <p class="mt-1 text-xs text-slate-400">Comma-separated keyword tags for indexing.</p>
        @error('seo_meta_keywords')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-2">
        <label for="seo_og_image" class="block text-xs font-semibold text-slate-700">Social Share Image (OpenGraph & Twitter Card)</label>
        @if(!empty($content['seo_og_image']))
            <div class="flex items-center gap-3">
                <img src="{{ asset($content['seo_og_image']) }}" alt="OG Preview" class="h-12 w-20 object-cover rounded border border-slate-300">
                <span class="text-xs text-slate-500 font-mono">{{ $content['seo_og_image'] }}</span>
            </div>
        @endif
        <input type="file" name="seo_og_image" id="seo_og_image" accept="image/*"
            class="block w-full text-xs text-slate-500 file:mr-4 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-teal-50 file:text-[#36a1b3] hover:file:bg-teal-100 transition-colors">
        <p class="text-[11px] text-slate-400">Displayed when your website is shared on WhatsApp, Facebook, LinkedIn, Twitter/X. Recommended: 1200x630px.</p>
        @error('seo_og_image')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="google_site_verification" class="block text-sm font-semibold text-slate-700">Google Search Console Verification Code <span class="text-slate-400 font-normal">(Optional)</span></label>
        <input type="text" name="google_site_verification" id="google_site_verification" value="{{ old('google_site_verification', $content['google_site_verification'] ?? '') }}"
            placeholder="e.g. RKr7Z5yGUbjxyvoUWYtvvx17blX28YkHUc2N-lDET68"
            class="mt-1.5 block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent font-mono">
        <p class="mt-1 text-xs text-slate-400">Enables automatic Google Search Console HTML meta tag verification.</p>
        @error('google_site_verification')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>
