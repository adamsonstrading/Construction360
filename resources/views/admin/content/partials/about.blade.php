{{-- Partial: About Us, Company Philosophy & Leadership --}}
<div class="space-y-6">
    <div class="border-b border-slate-200 pb-4">
        <h4 class="text-base font-bold text-slate-800 flex items-center">
            <svg class="h-5 w-5 text-[#36a1b3] mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
            About Us, Company Philosophy & Leadership
        </h4>
        <p class="text-xs text-slate-500 mt-1">Configure your corporate overview, architectural vision, engineering mission, core values, founder quote, and about page copy.</p>
    </div>

    <!-- 1. About Us Homepage Card -->
    <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
        <span class="text-xs font-bold text-[#36a1b3] uppercase tracking-wide">Homepage About Card</span>
        <div>
            <label for="about_heading" class="block text-xs font-semibold text-slate-700">About Section Heading</label>
            <input type="text" name="about_heading" id="about_heading" value="{{ old('about_heading', $content['about_heading'] ?? 'About Construction 360') }}" required
                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs font-bold">
        </div>
        <div>
            <label for="about_text" class="block text-xs font-semibold text-slate-700">About Description Paragraph</label>
            <textarea rows="3" name="about_text" id="about_text" required
                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs leading-relaxed">{{ old('about_text', $content['about_text'] ?? '') }}</textarea>
        </div>
    </div>

    <!-- 2. Who We Are Section Card -->
    <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
        <span class="text-xs font-bold text-[#36a1b3] uppercase tracking-wide">Who We Are Overview</span>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <div>
                <label for="who_we_are_label" class="block text-xs font-semibold text-slate-700">Label (Small Text)</label>
                <input type="text" name="who_we_are_label" id="who_we_are_label" value="{{ old('who_we_are_label', $content['who_we_are_label'] ?? 'Who We Are') }}"
                    class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">
            </div>
            <div>
                <label for="who_we_are_heading" class="block text-xs font-semibold text-slate-700">Headline</label>
                <input type="text" name="who_we_are_heading" id="who_we_are_heading" value="{{ old('who_we_are_heading', $content['who_we_are_heading'] ?? 'We are a design-led main contractor') }}"
                    class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">
            </div>
        </div>
        <div>
            <label for="who_we_are_text" class="block text-xs font-semibold text-slate-700">Who We Are Detailed Narrative</label>
            <textarea rows="3" name="who_we_are_text" id="who_we_are_text"
                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs leading-relaxed">{{ old('who_we_are_text', $content['who_we_are_text'] ?? '') }}</textarea>
        </div>
    </div>

    <!-- 3. Vision, Mission & Values -->
    <div class="space-y-4">
        <h5 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Vision, Mission & Company Values</h5>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white p-3.5 border border-slate-200 rounded-xl space-y-2">
                <input type="text" name="about_vision_label" value="{{ old('about_vision_label', $content['about_vision_label'] ?? 'Our Vision') }}" required class="block w-full px-2 py-1 bg-slate-50 border border-slate-200 rounded text-xs font-bold text-[#36a1b3]">
                <textarea rows="3" name="about_vision" required placeholder="Vision text..." class="block w-full px-2 py-1.5 border border-slate-200 rounded text-xs">{{ old('about_vision', $content['about_vision'] ?? '') }}</textarea>
            </div>

            <div class="bg-white p-3.5 border border-slate-200 rounded-xl space-y-2">
                <input type="text" name="about_mission_label" value="{{ old('about_mission_label', $content['about_mission_label'] ?? 'Our Mission') }}" required class="block w-full px-2 py-1 bg-slate-50 border border-slate-200 rounded text-xs font-bold text-[#36a1b3]">
                <textarea rows="3" name="about_mission" required placeholder="Mission text..." class="block w-full px-2 py-1.5 border border-slate-200 rounded text-xs">{{ old('about_mission', $content['about_mission'] ?? '') }}</textarea>
            </div>

            <div class="bg-white p-3.5 border border-slate-200 rounded-xl space-y-2">
                <input type="text" name="about_values_label" value="{{ old('about_values_label', $content['about_values_label'] ?? 'Core Values') }}" required class="block w-full px-2 py-1 bg-slate-50 border border-slate-200 rounded text-xs font-bold text-[#36a1b3]">
                <textarea rows="3" name="about_values" required placeholder="Values text..." class="block w-full px-2 py-1.5 border border-slate-200 rounded text-xs">{{ old('about_values', $content['about_values'] ?? '') }}</textarea>
            </div>
        </div>
    </div>

    <!-- 4. Philosophy, Quote & Dedicated About Page Headings -->
    <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
        <span class="text-xs font-bold text-[#36a1b3] uppercase tracking-wide">Operational Philosophy & Founder Quote</span>
        
        <div>
            <label for="about_philosophy" class="block text-xs font-semibold text-slate-700">Digital Transparency & Audit Philosophy</label>
            <textarea rows="3" name="about_philosophy" id="about_philosophy"
                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">{{ old('about_philosophy', $content['about_philosophy'] ?? '') }}</textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
            <div>
                <label for="about_quote" class="block text-xs font-semibold text-slate-700">Founder Quote</label>
                <textarea rows="2" name="about_quote" id="about_quote" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs italic">{{ old('about_quote', $content['about_quote'] ?? '') }}</textarea>
            </div>
            <div>
                <label for="about_quote_author" class="block text-xs font-semibold text-slate-700">Quote Attribution / Author</label>
                <input type="text" name="about_quote_author" id="about_quote_author" value="{{ old('about_quote_author', $content['about_quote_author'] ?? 'Management Team') }}" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-2 border-t border-slate-200">
            <div>
                <label for="about_page_label" class="block text-[11px] font-semibold text-slate-600">About Page Label</label>
                <input type="text" name="about_page_label" id="about_page_label" value="{{ old('about_page_label', $content['about_page_label'] ?? 'About Construction 360') }}" class="mt-0.5 block w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded text-xs">
            </div>
            <div>
                <label for="about_page_title" class="block text-[11px] font-semibold text-slate-600">About Page Title</label>
                <input type="text" name="about_page_title" id="about_page_title" value="{{ old('about_page_title', $content['about_page_title'] ?? 'Building with precision & craft') }}" class="mt-0.5 block w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded text-xs">
            </div>
            <div>
                <label for="leadership_section_title" class="block text-[11px] font-semibold text-slate-600">Leadership Title</label>
                <input type="text" name="leadership_section_title" id="leadership_section_title" value="{{ old('leadership_section_title', $content['leadership_section_title'] ?? 'Company Leadership') }}" class="mt-0.5 block w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded text-xs">
            </div>
        </div>
        <div>
            <label for="about_page_subtitle" class="block text-xs font-semibold text-slate-700">About Page Subtitle / Banner Intro</label>
            <textarea rows="2" name="about_page_subtitle" id="about_page_subtitle" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">{{ old('about_page_subtitle', $content['about_page_subtitle'] ?? '') }}</textarea>
        </div>
    </div>
</div>
