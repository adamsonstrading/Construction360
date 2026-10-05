{{-- Partial: Corporate Contact & Office Details --}}
<div class="space-y-6">
    <div class="border-b border-slate-200 pb-4">
        <h4 class="text-base font-bold text-slate-800 flex items-center">
            <svg class="h-5 w-5 text-[#36a1b3] mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.824-1.802-5.14-4.118-6.942-6.942l1.293-.97c.362-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v1.5z" />
            </svg>
            Corporate Contact & Office Location
        </h4>
        <p class="text-xs text-slate-500 mt-1">Configure company telephone numbers, support email, registered office address, Google Map links, and contact page copy.</p>
    </div>

    <!-- Corporate Contact Info -->
    <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-4">
        <span class="text-xs font-bold text-[#36a1b3] uppercase tracking-wide">Primary Contact Channels</span>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="header_email" class="block text-xs font-semibold text-slate-700">Official Company Email</label>
                <input type="email" name="header_email" id="header_email" value="{{ old('header_email', $content['header_email'] ?? 'info@construction360.co') }}" required
                    class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">
                @error('header_email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="header_phone" class="block text-xs font-semibold text-slate-700">Phone Number (Optional)</label>
                <input type="text" name="header_phone" id="header_phone" value="{{ old('header_phone', $content['header_phone'] ?? '+442039309629') }}"
                    class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">
                @error('header_phone') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="sm:col-span-2">
                <label for="contact_address" class="block text-xs font-semibold text-slate-700">Registered Office Address</label>
                <input type="text" name="contact_address" id="contact_address" value="{{ old('contact_address', $content['contact_address'] ?? '73 Thrale Road, London, England, SW16 1NU') }}"
                    class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">
                @error('contact_address') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="contact_map_url" class="block text-xs font-semibold text-slate-700">Google Maps Direct Link URL</label>
                <input type="url" name="contact_map_url" id="contact_map_url" value="{{ old('contact_map_url', $content['contact_map_url'] ?? '') }}"
                    placeholder="https://maps.google.com/?q=..."
                    class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">
                @error('contact_map_url') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="digital_tenders_only_label" class="block text-xs font-semibold text-slate-700">Electronic Communication Notice</label>
                <input type="text" name="digital_tenders_only_label" id="digital_tenders_only_label" value="{{ old('digital_tenders_only_label', $content['digital_tenders_only_label'] ?? 'Digital Tenders & Specifications Only') }}" required
                    class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">
            </div>

            <div class="sm:col-span-2">
                <label for="contact_map_embed_url" class="block text-xs font-semibold text-slate-700">Google Maps Embed Iframe URL</label>
                <input type="text" name="contact_map_embed_url" id="contact_map_embed_url" value="{{ old('contact_map_embed_url', $content['contact_map_embed_url'] ?? '') }}" required
                    placeholder="https://www.google.com/maps/embed?pb=..."
                    class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs font-mono">
                <p class="text-[11px] text-slate-400 mt-1">The `src` attribute from Google Maps Embed iframe on the Contact page.</p>
            </div>
        </div>
    </div>

    <!-- Contact Page Copy -->
    <div class="space-y-4">
        <h5 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Contact Us Page Copy</h5>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="contact_page_title" class="block text-xs font-semibold text-slate-700">Contact Page Title</label>
                <input type="text" name="contact_page_title" id="contact_page_title" value="{{ old('contact_page_title', $content['contact_page_title'] ?? 'Contact Construction 360') }}" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs font-bold">
            </div>
            <div>
                <label for="contact_page_form_title" class="block text-xs font-semibold text-slate-700">Form Header Title</label>
                <input type="text" name="contact_page_form_title" id="contact_page_form_title" value="{{ old('contact_page_form_title', $content['contact_page_form_title'] ?? 'Send Us a Message') }}" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">
            </div>
            <div class="sm:col-span-2">
                <label for="contact_page_subtitle" class="block text-xs font-semibold text-slate-700">Contact Page Subtitle</label>
                <textarea rows="2" name="contact_page_subtitle" id="contact_page_subtitle" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">{{ old('contact_page_subtitle', $content['contact_page_subtitle'] ?? '') }}</textarea>
            </div>
            <div>
                <label for="contact_support_email_label" class="block text-xs font-semibold text-slate-700">Support Email Label</label>
                <input type="text" name="contact_support_email_label" id="contact_support_email_label" value="{{ old('contact_support_email_label', $content['contact_support_email_label'] ?? 'Support Email') }}" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">
            </div>
            <div>
                <label for="contact_mobile_label" class="block text-xs font-semibold text-slate-700">Mobile / WhatsApp Label</label>
                <input type="text" name="contact_mobile_label" id="contact_mobile_label" value="{{ old('contact_mobile_label', $content['contact_mobile_label'] ?? 'Direct Line / WhatsApp') }}" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">
            </div>
            <div class="sm:col-span-2">
                <label for="contact_location_label" class="block text-xs font-semibold text-slate-700">Location Heading Label</label>
                <input type="text" name="contact_location_label" id="contact_location_label" value="{{ old('contact_location_label', $content['contact_location_label'] ?? 'Head Office & Operations Hub') }}" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">
            </div>
        </div>
    </div>

    <!-- Pre-Footer CTA Band -->
    <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
        <span class="text-xs font-bold text-[#36a1b3] uppercase tracking-wide">Pre-Footer Call to Action Banner</span>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="pre_footer_cta_title" class="block text-xs font-semibold text-slate-700">Banner Title</label>
                <input type="text" name="pre_footer_cta_title" id="pre_footer_cta_title" value="{{ old('pre_footer_cta_title', $content['pre_footer_cta_title'] ?? 'Ready to start your next project?') }}" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs font-bold">
            </div>
            <div>
                <label for="pre_footer_cta_subtitle" class="block text-xs font-semibold text-slate-700">Banner Subtitle</label>
                <input type="text" name="pre_footer_cta_subtitle" id="pre_footer_cta_subtitle" value="{{ old('pre_footer_cta_subtitle', $content['pre_footer_cta_subtitle'] ?? 'Our specialist team is on hand to review your plans and tender documents.') }}" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">
            </div>
        </div>
    </div>
</div>
