{{-- Partial: Subpages, Legal Policies & Layout Texts --}}
<div class="space-y-8">
    <div class="border-b border-slate-200 pb-4">
        <h4 class="text-base font-bold text-slate-800 flex items-center">
            <svg class="h-5 w-5 text-[#36a1b3] mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
            </svg>
            Subpages, Legal Policies & Global Layout Copy
        </h4>
        <p class="text-xs text-slate-500 mt-1">Configure legal compliance pages (Privacy, Terms, Tendering), inner pages header templates (Services & Projects), and pre-footer global CTA banners.</p>
    </div>

    <!-- 1. Legal Compliance Pages -->
    <div class="space-y-4">
        <h5 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Compliance & Legal Pages</h5>
        
        <!-- Privacy Policy -->
        <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
            <div class="flex items-center space-x-2 border-b border-slate-200 pb-2">
                <span class="text-xs font-bold text-[#36a1b3] uppercase tracking-wide">Privacy Policy Page</span>
            </div>
            <div>
                <label for="privacy_title" class="block text-xs font-semibold text-slate-700">Page Main Title</label>
                <input type="text" name="privacy_title" id="privacy_title" 
                    value="{{ old('privacy_title', $content['privacy_title'] ?? 'Privacy Policy') }}" required
                    class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">
                @error('privacy_title')
                    <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="privacy_notice" class="block text-xs font-semibold text-slate-700">Notice Block (HTML or Text)</label>
                <textarea rows="3" name="privacy_notice" id="privacy_notice" required
                    class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs font-mono">{{ old('privacy_notice', $content['privacy_notice'] ?? '') }}</textarea>
                @error('privacy_notice')
                    <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="privacy_content" class="block text-xs font-semibold text-slate-700">Policy Body Content</label>
                <textarea rows="6" name="privacy_content" id="privacy_content" required
                    class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">{{ old('privacy_content', $content['privacy_content'] ?? '') }}</textarea>
                @error('privacy_content')
                    <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Terms & Conditions -->
        <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
            <div class="flex items-center space-x-2 border-b border-slate-200 pb-2">
                <span class="text-xs font-bold text-[#36a1b3] uppercase tracking-wide">Terms & Conditions Page</span>
            </div>
            <div>
                <label for="terms_title" class="block text-xs font-semibold text-slate-700">Page Main Title</label>
                <input type="text" name="terms_title" id="terms_title" 
                    value="{{ old('terms_title', $content['terms_title'] ?? 'Terms & Conditions') }}" required
                    class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">
                @error('terms_title')
                    <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="terms_notice" class="block text-xs font-semibold text-slate-700">Notice Block (HTML or Text)</label>
                <textarea rows="3" name="terms_notice" id="terms_notice" required
                    class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs font-mono">{{ old('terms_notice', $content['terms_notice'] ?? '') }}</textarea>
                @error('terms_notice')
                    <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="terms_content" class="block text-xs font-semibold text-slate-700">Terms Body Content</label>
                <textarea rows="6" name="terms_content" id="terms_content" required
                    class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">{{ old('terms_content', $content['terms_content'] ?? '') }}</textarea>
                @error('terms_content')
                    <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Tendering Standard -->
        <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
            <div class="flex items-center space-x-2 border-b border-slate-200 pb-2">
                <span class="text-xs font-bold text-[#36a1b3] uppercase tracking-wide">Tendering Standards Page</span>
            </div>
            <div>
                <label for="tendering_title" class="block text-xs font-semibold text-slate-700">Page Main Title</label>
                <input type="text" name="tendering_title" id="tendering_title" 
                    value="{{ old('tendering_title', $content['tendering_title'] ?? 'Tendering Standard & Framework') }}" required
                    class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">
                @error('tendering_title')
                    <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="tendering_notice" class="block text-xs font-semibold text-slate-700">Notice Block (HTML or Text)</label>
                <textarea rows="3" name="tendering_notice" id="tendering_notice" required
                    class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs font-mono">{{ old('tendering_notice', $content['tendering_notice'] ?? '') }}</textarea>
                @error('tendering_notice')
                    <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="tendering_content" class="block text-xs font-semibold text-slate-700">Tendering Body Content</label>
                <textarea rows="6" name="tendering_content" id="tendering_content" required
                    class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">{{ old('tendering_content', $content['tendering_content'] ?? '') }}</textarea>
                @error('tendering_content')
                    <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <!-- 2. Services & Projects Subpages Headings -->
    <div class="space-y-4">
        <h5 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Subpages Layout Headings</h5>

        <!-- Services Listing Page -->
        <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
            <span class="text-xs font-bold text-[#36a1b3] uppercase tracking-wide">Services Archive Page</span>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="services_page_label" class="block text-xs font-semibold text-slate-700">Hero Eyebrow Label</label>
                    <input type="text" name="services_page_label" id="services_page_label" 
                        value="{{ old('services_page_label', $content['services_page_label'] ?? 'Services') }}" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">
                </div>
                <div>
                    <label for="services_page_title" class="block text-xs font-semibold text-slate-700">Hero Main Title</label>
                    <input type="text" name="services_page_title" id="services_page_title" 
                        value="{{ old('services_page_title', $content['services_page_title'] ?? 'Design to Deliver') }}" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">
                </div>
                <div class="md:col-span-2">
                    <label for="services_page_subtitle" class="block text-xs font-semibold text-slate-700">Hero Subtitle / Description</label>
                    <textarea rows="2" name="services_page_subtitle" id="services_page_subtitle" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">{{ old('services_page_subtitle', $content['services_page_subtitle'] ?? 'Delivering excellence across residential, commercial and infrastructure construction projects.') }}</textarea>
                </div>
            </div>
        </div>

        <!-- Service Detail Page -->
        <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
            <span class="text-xs font-bold text-[#36a1b3] uppercase tracking-wide">Single Service Detail Page Sections</span>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="service_about_label" class="block text-xs font-semibold text-slate-700">About Section Eyebrow</label>
                    <input type="text" name="service_about_label" id="service_about_label" 
                        value="{{ old('service_about_label', $content['service_about_label'] ?? 'ABOUT THE SERVICE') }}" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">
                </div>
                <div>
                    <label for="service_scopes_label" class="block text-xs font-semibold text-slate-700">Scopes Section Eyebrow</label>
                    <input type="text" name="service_scopes_label" id="service_scopes_label" 
                        value="{{ old('service_scopes_label', $content['service_scopes_label'] ?? 'SCOPES & DELIVERABLES') }}" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">
                </div>
                <div>
                    <label for="service_scopes_title" class="block text-xs font-semibold text-slate-700">Scopes Section Title</label>
                    <input type="text" name="service_scopes_title" id="service_scopes_title" 
                        value="{{ old('service_scopes_title', $content['service_scopes_title'] ?? 'Specialist Sub-Services') }}" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">
                </div>
                <div>
                    <label for="service_why_choose_us_label" class="block text-xs font-semibold text-slate-700">Why Choose Us Eyebrow</label>
                    <input type="text" name="service_why_choose_us_label" id="service_why_choose_us_label" 
                        value="{{ old('service_why_choose_us_label', $content['service_why_choose_us_label'] ?? 'CAPABILITIES') }}" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">
                </div>
                <div>
                    <label for="service_why_choose_us_title" class="block text-xs font-semibold text-slate-700">Why Choose Us Title</label>
                    <input type="text" name="service_why_choose_us_title" id="service_why_choose_us_title" 
                        value="{{ old('service_why_choose_us_title', $content['service_why_choose_us_title'] ?? 'Why Choose Us') }}" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">
                </div>
                <div>
                    <label for="service_faqs_label" class="block text-xs font-semibold text-slate-700">FAQs Section Eyebrow</label>
                    <input type="text" name="service_faqs_label" id="service_faqs_label" 
                        value="{{ old('service_faqs_label', $content['service_faqs_label'] ?? 'COMMON INQUIRIES') }}" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">
                </div>
                <div class="md:col-span-2">
                    <label for="service_faqs_title" class="block text-xs font-semibold text-slate-700">FAQs Section Title</label>
                    <input type="text" name="service_faqs_title" id="service_faqs_title" 
                        value="{{ old('service_faqs_title', $content['service_faqs_title'] ?? 'Frequently Asked Questions') }}" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">
                </div>
            </div>
        </div>

        <!-- Projects Listing Page -->
        <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
            <span class="text-xs font-bold text-[#36a1b3] uppercase tracking-wide">Projects Portfolio Archive</span>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="projects_page_label" class="block text-xs font-semibold text-slate-700">Hero Eyebrow Label</label>
                    <input type="text" name="projects_page_label" id="projects_page_label" 
                        value="{{ old('projects_page_label', $content['projects_page_label'] ?? 'PORTFOLIO') }}" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">
                </div>
                <div>
                    <label for="projects_page_title" class="block text-xs font-semibold text-slate-700">Hero Main Title</label>
                    <input type="text" name="projects_page_title" id="projects_page_title" 
                        value="{{ old('projects_page_title', $content['projects_page_title'] ?? 'Our Projects') }}" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">
                </div>
                <div class="md:col-span-2">
                    <label for="projects_page_subtitle" class="block text-xs font-semibold text-slate-700">Hero Subtitle / Description</label>
                    <textarea rows="2" name="projects_page_subtitle" id="projects_page_subtitle" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">{{ old('projects_page_subtitle', $content['projects_page_subtitle'] ?? 'Browse our track record of successfully delivered landmark architectural projects.') }}</textarea>
                </div>
            </div>
        </div>

        <!-- Project Detail Page -->
        <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
            <span class="text-xs font-bold text-[#36a1b3] uppercase tracking-wide">Single Project Detail Page Sections</span>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="project_overview_title" class="block text-xs font-semibold text-slate-700">Overview Section Title</label>
                    <input type="text" name="project_overview_title" id="project_overview_title" 
                        value="{{ old('project_overview_title', $content['project_overview_title'] ?? 'Project Overview') }}" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">
                </div>
                <div>
                    <label for="project_scopes_title" class="block text-xs font-semibold text-slate-700">Development Scopes Title</label>
                    <input type="text" name="project_scopes_title" id="project_scopes_title" 
                        value="{{ old('project_scopes_title', $content['project_scopes_title'] ?? 'Development Scopes') }}" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">
                </div>
                <div>
                    <label for="project_specifications_title" class="block text-xs font-semibold text-slate-700">Sidebar Specs Title</label>
                    <input type="text" name="project_specifications_title" id="project_specifications_title" 
                        value="{{ old('project_specifications_title', $content['project_specifications_title'] ?? 'Project Specifications') }}" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">
                </div>
                <div>
                    <label for="project_related_label" class="block text-xs font-semibold text-slate-700">Related Projects Eyebrow</label>
                    <input type="text" name="project_related_label" id="project_related_label" 
                        value="{{ old('project_related_label', $content['project_related_label'] ?? 'PORTFOLIO') }}" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">
                </div>
                <div class="md:col-span-2">
                    <label for="project_related_title" class="block text-xs font-semibold text-slate-700">Related Projects Title</label>
                    <input type="text" name="project_related_title" id="project_related_title" 
                        value="{{ old('project_related_title', $content['project_related_title'] ?? 'Related Projects') }}" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">
                </div>
            </div>
        </div>
    </div>

    <!-- 3. Global Layout, Footer & Disclaimers -->
    <div class="space-y-4">
        <h5 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Layout, CTA Banners & Legal Disclaimer</h5>
        <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="digital_tenders_only_label" class="block text-xs font-semibold text-slate-700">Digital Tenders Only Badge</label>
                    <input type="text" name="digital_tenders_only_label" id="digital_tenders_only_label" 
                        value="{{ old('digital_tenders_only_label', $content['digital_tenders_only_label'] ?? 'Digital Tenders Only') }}" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">
                </div>
                <div>
                    <label for="pre_footer_cta_title" class="block text-xs font-semibold text-slate-700">Pre-Footer Banner Title</label>
                    <input type="text" name="pre_footer_cta_title" id="pre_footer_cta_title" 
                        value="{{ old('pre_footer_cta_title', $content['pre_footer_cta_title'] ?? 'Your Execution Partner') }}" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">
                </div>
                <div class="md:col-span-2">
                    <label for="pre_footer_cta_subtitle" class="block text-xs font-semibold text-slate-700">Pre-Footer Banner Subtitle</label>
                    <textarea rows="2" name="pre_footer_cta_subtitle" id="pre_footer_cta_subtitle" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">{{ old('pre_footer_cta_subtitle', $content['pre_footer_cta_subtitle'] ?? "Whether you're exploring our premium architectural builds or envisioning a custom structural solution, we are here to bring your vision to life.") }}</textarea>
                </div>
                <div class="md:col-span-2">
                    <label for="footer_company_registration" class="block text-xs font-semibold text-slate-700">Footer Legal Registration Line</label>
                    <textarea rows="2" name="footer_company_registration" id="footer_company_registration" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">{{ old('footer_company_registration', $content['footer_company_registration'] ?? 'This Company is Registered in England and Wales. Company number 17277526') }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
