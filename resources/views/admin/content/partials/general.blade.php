{{-- Partial: General & Branding Settings --}}
<div class="space-y-6">
    <div class="border-b border-slate-200 pb-4">
        <h4 class="text-base font-bold text-slate-800 flex items-center">
            <svg class="h-5 w-5 text-[#36a1b3] mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            General & Branding Settings
        </h4>
        <p class="text-xs text-slate-500 mt-1">Configure your corporate brand logo and public social media connectivity.</p>
    </div>

    <!-- Site Logo -->
    <div class="bg-slate-50 p-5 rounded-xl border border-slate-200 space-y-3">
        <label class="block text-sm font-semibold text-slate-800">Primary Site Logo</label>
        <p class="text-xs text-slate-500">Recommended format: SVG or transparent PNG. Displayed in the main header and mobile drawer navigation.</p>
        
        <div class="mt-2 flex flex-col sm:flex-row items-start sm:items-center gap-4">
            @if(isset($content['site_logo']) && $content['site_logo'])
                <div class="p-3 bg-slate-900 rounded-lg border border-slate-700 inline-flex items-center justify-center">
                    <img src="{{ asset($content['site_logo']) }}" alt="Current Logo" class="h-10 w-auto object-contain">
                </div>
            @endif
            <div class="flex-1 w-full">
                <input type="file" name="site_logo" accept="image/*"
                    class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-teal-50 file:text-[#36a1b3] hover:file:bg-teal-100 transition-colors">
            </div>
        </div>
        @error('site_logo')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Social Media Accounts -->
    <div class="space-y-4 pt-2">
        <h5 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Social Channels & Messengers</h5>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="social_facebook" class="block text-xs font-semibold text-slate-700">Facebook Page URL</label>
                <input type="url" name="social_facebook" id="social_facebook" value="{{ old('social_facebook', $content['social_facebook'] ?? '') }}"
                    placeholder="https://facebook.com/your-page"
                    class="mt-1 block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent">
                @error('social_facebook')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="social_instagram" class="block text-xs font-semibold text-slate-700">Instagram Profile URL</label>
                <input type="url" name="social_instagram" id="social_instagram" value="{{ old('social_instagram', $content['social_instagram'] ?? '') }}"
                    placeholder="https://instagram.com/your-handle"
                    class="mt-1 block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent">
                @error('social_instagram')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="social_linkedin" class="block text-xs font-semibold text-slate-700">LinkedIn Company URL</label>
                <input type="url" name="social_linkedin" id="social_linkedin" value="{{ old('social_linkedin', $content['social_linkedin'] ?? '') }}"
                    placeholder="https://linkedin.com/company/your-company"
                    class="mt-1 block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent">
                @error('social_linkedin')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="social_whatsapp" class="block text-xs font-semibold text-slate-700">WhatsApp Direct Link / Phone</label>
                <input type="url" name="social_whatsapp" id="social_whatsapp" value="{{ old('social_whatsapp', $content['social_whatsapp'] ?? '') }}"
                    placeholder="https://wa.me/447500896792"
                    class="mt-1 block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent">
                <p class="text-[11px] text-slate-400 mt-1">Used by the floating WhatsApp badge and contact links.</p>
                @error('social_whatsapp')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
</div>
