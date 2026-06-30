@extends('layouts.admin')

@section('title', 'Site Content Manager')
@section('page_title', 'Site Content Manager')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    <div class="bg-white border border-slate-200 shadow-sm rounded-xl overflow-hidden">
        <!-- Header -->
        <div class="px-6 py-5 border-b border-slate-200 bg-slate-50">
            <h3 class="text-lg font-bold text-slate-900">Landing Page Copy Configuration</h3>
            <p class="mt-1 text-sm text-slate-500">Edit the core copy elements of the public homepage. Any updates made here will instantly be reflected on the landing page.</p>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.content.update') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-8">
            @csrf

            <!-- General Settings -->
            <div class="space-y-4">
                <h4 class="text-sm font-bold text-[#008080] uppercase tracking-wider border-b border-slate-150 pb-2 flex items-center">
                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    General Settings
                </h4>
                
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Site Logo</label>
                    <div class="mt-1.5">
                        <input type="file" name="site_logo" accept="image/*"
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm">
                    </div>
                    @if(isset($content['site_logo']) && $content['site_logo'])
                        <div class="mt-2">
                            <p class="text-xs text-slate-500 mb-1">Current Logo:</p>
                            <img src="{{ asset($content['site_logo']) }}" alt="Current Logo" class="h-10 w-auto bg-slate-900 p-2 rounded">
                        </div>
                    @endif
                    @error('site_logo')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="social_facebook" class="block text-sm font-semibold text-slate-700">Facebook URL</label>
                    <div class="mt-1.5">
                        <input type="url" name="social_facebook" id="social_facebook" value="{{ old('social_facebook', $content['social_facebook'] ?? 'https://www.facebook.com/people/Construction-360/61590797767639/') }}"
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm">
                    </div>
                    @error('social_facebook')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="social_instagram" class="block text-sm font-semibold text-slate-700">Instagram URL</label>
                    <div class="mt-1.5">
                        <input type="url" name="social_instagram" id="social_instagram" value="{{ old('social_instagram', $content['social_instagram'] ?? 'https://www.instagram.com/Construction360.co') }}"
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm">
                    </div>
                    @error('social_instagram')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="social_linkedin" class="block text-sm font-semibold text-slate-700">LinkedIn URL</label>
                    <div class="mt-1.5">
                        <input type="url" name="social_linkedin" id="social_linkedin" value="{{ old('social_linkedin', $content['social_linkedin'] ?? 'https://www.linkedin.com/company/construction-360') }}"
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm">
                    </div>
                    @error('social_linkedin')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="social_whatsapp" class="block text-sm font-semibold text-slate-700">WhatsApp URL</label>
                    <div class="mt-1.5">
                        <input type="url" name="social_whatsapp" id="social_whatsapp" value="{{ old('social_whatsapp', $content['social_whatsapp'] ?? 'https://wa.me/447500896792') }}"
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm">
                    </div>
                    @error('social_whatsapp')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- SEO & Metadata Group -->
            <div class="space-y-4">
                <h4 class="text-sm font-bold text-[#008080] uppercase tracking-wider border-b border-slate-150 pb-2 flex items-center">
                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    SEO & Search Engine Settings
                </h4>
                
                <div>
                    <label for="seo_meta_title" class="block text-sm font-semibold text-slate-700">SEO Meta Title</label>
                    <div class="mt-1.5">
                        <input type="text" name="seo_meta_title" id="seo_meta_title" value="{{ old('seo_meta_title', $content['seo_meta_title'] ?? '') }}" required
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm">
                    </div>
                    <p class="mt-1 text-xs text-slate-400">The page title tag shown in search engine results (recommended length: 50-60 characters).</p>
                    @error('seo_meta_title')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="seo_meta_description" class="block text-sm font-semibold text-slate-700">SEO Meta Description</label>
                    <div class="mt-1.5">
                        <textarea rows="2" name="seo_meta_description" id="seo_meta_description" required
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm">{{ old('seo_meta_description', $content['seo_meta_description'] ?? '') }}</textarea>
                    </div>
                    <p class="mt-1 text-xs text-slate-400">Summarizes the page content for search engines (recommended length: 150-160 characters).</p>
                    @error('seo_meta_description')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="seo_meta_keywords" class="block text-sm font-semibold text-slate-700">SEO Meta Keywords</label>
                    <div class="mt-1.5">
                        <input type="text" name="seo_meta_keywords" id="seo_meta_keywords" value="{{ old('seo_meta_keywords', $content['seo_meta_keywords'] ?? '') }}" required
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm">
                    </div>
                    <p class="mt-1 text-xs text-slate-400">Comma-separated keywords for general SEO indexing.</p>
                    @error('seo_meta_keywords')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="google_site_verification" class="block text-sm font-semibold text-slate-700">Google Site Verification Code <span class="text-slate-400 font-normal">(Optional)</span></label>
                    <div class="mt-1.5">
                        <input type="text" name="google_site_verification" id="google_site_verification" value="{{ old('google_site_verification', $content['google_site_verification'] ?? '') }}" placeholder="e.g. google-site-verification=xxxxxx or code value"
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm">
                    </div>
                    <p class="mt-1 text-xs text-slate-400">Insert your Google Search Console verification meta tag key or code.</p>
                    @error('google_site_verification')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Hero Section Group -->
            <div class="space-y-4">
                <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wider border-b border-slate-150 pb-2 flex items-center">
                    <span class="h-2 w-2 rounded-full bg-[#008080] mr-2"></span>
                    Hero Header Section
                </h4>
                
                <div>
                    <label for="hero_title" class="block text-sm font-semibold text-slate-700">Hero Main Title</label>
                    <div class="mt-1.5">
                        <input type="text" name="hero_title" id="hero_title" value="{{ old('hero_title', $content['hero_title'] ?? '') }}" required
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm">
                    </div>
                    @error('hero_title')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="hero_subtitle" class="block text-sm font-semibold text-slate-700">Hero Subtitle</label>
                    <div class="mt-1.5">
                        <textarea rows="3" name="hero_subtitle" id="hero_subtitle" required
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm">{{ old('hero_subtitle', $content['hero_subtitle'] ?? '') }}</textarea>
                    </div>
                    @error('hero_subtitle')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Section Headers Group -->
            <div class="space-y-6 pt-4">
                <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wider border-b border-slate-150 pb-2 flex items-center">
                    <span class="h-2 w-2 rounded-full bg-[#008080] mr-2"></span>
                    Landing Page Section Headers
                </h4>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Services Header -->
                    <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
                        <span class="text-xs font-bold text-[#008080] uppercase tracking-wide">Services Section</span>
                        <div>
                            <label for="services_label" class="block text-xs font-semibold text-slate-700">Label (Small Text)</label>
                            <input type="text" name="services_label" id="services_label" value="{{ old('services_label', $content['services_label'] ?? 'Marking Benchmarks') }}" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                        </div>
                        <div>
                            <label for="services_title" class="block text-xs font-semibold text-slate-700">Title</label>
                            <input type="text" name="services_title" id="services_title" value="{{ old('services_title', $content['services_title'] ?? 'Principle Contractor in construction') }}" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                        </div>
                    </div>

                    <!-- Projects Header -->
                    <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
                        <span class="text-xs font-bold text-[#008080] uppercase tracking-wide">Projects Section</span>
                        <div>
                            <label for="projects_label" class="block text-xs font-semibold text-slate-700">Label (Small Text)</label>
                            <input type="text" name="projects_label" id="projects_label" value="{{ old('projects_label', $content['projects_label'] ?? 'Selected Scopes') }}" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                        </div>
                        <div>
                            <label for="projects_title" class="block text-xs font-semibold text-slate-700">Title</label>
                            <input type="text" name="projects_title" id="projects_title" value="{{ old('projects_title', $content['projects_title'] ?? 'Explore our diverse portfolio') }}" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                        </div>
                    </div>

                    <!-- Why Choose Us Header -->
                    <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
                        <span class="text-xs font-bold text-[#008080] uppercase tracking-wide">Why Choose Us Section</span>
                        <div>
                            <label for="assurances_label" class="block text-xs font-semibold text-slate-700">Label (Small Text)</label>
                            <input type="text" name="assurances_label" id="assurances_label" value="{{ old('assurances_label', $content['assurances_label'] ?? 'Operational Assurances') }}" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                        </div>
                        <div>
                            <label for="assurances_title" class="block text-xs font-semibold text-slate-700">Title</label>
                            <input type="text" name="assurances_title" id="assurances_title" value="{{ old('assurances_title', $content['assurances_title'] ?? 'An exceptional quality that can\'t be beaten') }}" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                        </div>
                    </div>

                    <!-- Testimonials Header -->
                    <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
                        <span class="text-xs font-bold text-[#008080] uppercase tracking-wide">Testimonials Section</span>
                        <div>
                            <label for="testimonials_label" class="block text-xs font-semibold text-slate-700">Label (Small Text)</label>
                            <input type="text" name="testimonials_label" id="testimonials_label" value="{{ old('testimonials_label', $content['testimonials_label'] ?? 'Client Feedback') }}" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                        </div>
                        <div>
                            <label for="testimonials_title" class="block text-xs font-semibold text-slate-700">Title</label>
                            <input type="text" name="testimonials_title" id="testimonials_title" value="{{ old('testimonials_title', $content['testimonials_title'] ?? 'Verified Testimonials') }}" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                        </div>
                    </div>

                    <!-- Blog Header -->
                    <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
                        <span class="text-xs font-bold text-[#008080] uppercase tracking-wide">Blog Section</span>
                        <div>
                            <label for="blog_label" class="block text-xs font-semibold text-slate-700">Label (Small Text)</label>
                            <input type="text" name="blog_label" id="blog_label" value="{{ old('blog_label', $content['blog_label'] ?? 'Blueprints & Blue Skies') }}" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                        </div>
                        <div>
                            <label for="blog_title" class="block text-xs font-semibold text-slate-700">Title</label>
                            <input type="text" name="blog_title" id="blog_title" value="{{ old('blog_title', $content['blog_title'] ?? 'Discover inspiration and trends') }}" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                        </div>
                    </div>
                </div>
            </div>

            <!-- About Us Group -->
            <div class="space-y-4 pt-4">
                <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wider border-b border-slate-150 pb-2 flex items-center">
                    <span class="h-2 w-2 rounded-full bg-[#008080] mr-2"></span>
                    About Us & Philosophy
                </h4>

                <div>
                    <label for="about_heading" class="block text-sm font-semibold text-slate-700">About Section Heading</label>
                    <div class="mt-1.5">
                        <textarea rows="2" name="about_heading" id="about_heading" required
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm">{{ old('about_heading', $content['about_heading'] ?? '') }}</textarea>
                    </div>
                    @error('about_heading')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="about_vision" class="block text-sm font-semibold text-slate-700">Our Vision</label>
                    <div class="mt-1.5">
                        <textarea rows="2" name="about_vision" id="about_vision" required
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm">{{ old('about_vision', $content['about_vision'] ?? '') }}</textarea>
                    </div>
                    @error('about_vision')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="about_mission" class="block text-sm font-semibold text-slate-700">Our Mission</label>
                    <div class="mt-1.5">
                        <textarea rows="3" name="about_mission" id="about_mission" required
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm">{{ old('about_mission', $content['about_mission'] ?? '') }}</textarea>
                    </div>
                    @error('about_mission')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="about_values" class="block text-sm font-semibold text-slate-700">Our Values</label>
                    <div class="mt-1.5">
                        <textarea rows="2" name="about_values" id="about_values" required
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm">{{ old('about_values', $content['about_values'] ?? '') }}</textarea>
                    </div>
                    @error('about_values')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="about_quote" class="block text-sm font-semibold text-slate-700">Founder's Quote</label>
                    <div class="mt-1.5">
                        <textarea rows="2" name="about_quote" id="about_quote" required
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm">{{ old('about_quote', $content['about_quote'] ?? '') }}</textarea>
                    </div>
                    @error('about_quote')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Why Choose Us / Assurances Section Group -->
            <div class="space-y-6 pt-4">
                <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wider border-b border-slate-150 pb-2 flex items-center">
                    <span class="h-2 w-2 rounded-full bg-[#008080] mr-2"></span>
                    Operational Assurances (Why Choose Us Cards)
                </h4>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Card 1: Insurance -->
                    <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
                        <span class="text-xs font-bold text-[#008080] uppercase tracking-wide">Card 1 (Insurance)</span>
                        <div>
                            <label for="insurance_title" class="block text-xs font-semibold text-slate-700">Title</label>
                            <input type="text" name="insurance_title" id="insurance_title" value="{{ old('insurance_title', $content['insurance_title'] ?? '') }}" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                        </div>
                        <div>
                            <label for="insurance_text" class="block text-xs font-semibold text-slate-700">Text Content</label>
                            <textarea rows="3" name="insurance_text" id="insurance_text" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">{{ old('insurance_text', $content['insurance_text'] ?? '') }}</textarea>
                        </div>
                    </div>

                    <!-- Card 2: Certificates -->
                    <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
                        <span class="text-xs font-bold text-[#008080] uppercase tracking-wide">Card 2 (Certifications)</span>
                        <div>
                            <label for="certificates_title" class="block text-xs font-semibold text-slate-700">Title</label>
                            <input type="text" name="certificates_title" id="certificates_title" value="{{ old('certificates_title', $content['certificates_title'] ?? '') }}" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                        </div>
                        <div>
                            <label for="certificates_text" class="block text-xs font-semibold text-slate-700">Text Content</label>
                            <textarea rows="3" name="certificates_text" id="certificates_text" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">{{ old('certificates_text', $content['certificates_text'] ?? '') }}</textarea>
                        </div>
                    </div>

                    <!-- Card 3: CSCS -->
                    <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3 md:col-span-2">
                        <span class="text-xs font-bold text-[#008080] uppercase tracking-wide">Card 3 (CSCS Compliance)</span>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="md:col-span-1">
                                <label for="cscs_title" class="block text-xs font-semibold text-slate-700">Title</label>
                                <input type="text" name="cscs_title" id="cscs_title" value="{{ old('cscs_title', $content['cscs_title'] ?? '') }}" required
                                    class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                            </div>
                            <div class="md:col-span-2">
                                <label for="cscs_text" class="block text-xs font-semibold text-slate-700">Text Content</label>
                                <textarea rows="2" name="cscs_text" id="cscs_text" required
                                    class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">{{ old('cscs_text', $content['cscs_text'] ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimonials Section Group -->
            <div class="space-y-6 pt-4">
                <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wider border-b border-slate-150 pb-2 flex items-center">
                    <span class="h-2 w-2 rounded-full bg-[#008080] mr-2"></span>
                    Client Testimonials Grid
                </h4>

                <div class="space-y-6">
                    <!-- Testimonial 1 -->
                    <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
                        <span class="text-xs font-bold text-[#008080] uppercase tracking-wide">Testimonial 1 (Colin Ashworth)</span>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div class="md:col-span-3">
                                <label for="testimonial_1_quote" class="block text-xs font-semibold text-slate-700">Client Quote</label>
                                <textarea rows="2" name="testimonial_1_quote" id="testimonial_1_quote" required
                                    class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">{{ old('testimonial_1_quote', $content['testimonial_1_quote'] ?? '') }}</textarea>
                            </div>
                            <div class="md:col-span-1 space-y-2">
                                <div>
                                    <label for="testimonial_1_author" class="block text-xs font-semibold text-slate-700">Author Name</label>
                                    <input type="text" name="testimonial_1_author" id="testimonial_1_author" value="{{ old('testimonial_1_author', $content['testimonial_1_author'] ?? '') }}" required
                                        class="mt-1 block w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                                </div>
                                <div>
                                    <label for="testimonial_1_role" class="block text-xs font-semibold text-slate-700">Role/Sub</label>
                                    <input type="text" name="testimonial_1_role" id="testimonial_1_role" value="{{ old('testimonial_1_role', $content['testimonial_1_role'] ?? '') }}" required
                                        class="mt-1 block w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 2 -->
                    <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
                        <span class="text-xs font-bold text-[#008080] uppercase tracking-wide">Testimonial 2 (David Vance)</span>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div class="md:col-span-3">
                                <label for="testimonial_2_quote" class="block text-xs font-semibold text-slate-700">Client Quote</label>
                                <textarea rows="2" name="testimonial_2_quote" id="testimonial_2_quote" required
                                    class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">{{ old('testimonial_2_quote', $content['testimonial_2_quote'] ?? '') }}</textarea>
                            </div>
                            <div class="md:col-span-1 space-y-2">
                                <div>
                                    <label for="testimonial_2_author" class="block text-xs font-semibold text-slate-700">Author Name</label>
                                    <input type="text" name="testimonial_2_author" id="testimonial_2_author" value="{{ old('testimonial_2_author', $content['testimonial_2_author'] ?? '') }}" required
                                        class="mt-1 block w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                                </div>
                                <div>
                                    <label for="testimonial_2_role" class="block text-xs font-semibold text-slate-700">Role/Sub</label>
                                    <input type="text" name="testimonial_2_role" id="testimonial_2_role" value="{{ old('testimonial_2_role', $content['testimonial_2_role'] ?? '') }}" required
                                        class="mt-1 block w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 3 -->
                    <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
                        <span class="text-xs font-bold text-[#008080] uppercase tracking-wide">Testimonial 3 (Eleanor Finch)</span>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div class="md:col-span-3">
                                <label for="testimonial_3_quote" class="block text-xs font-semibold text-slate-700">Client Quote</label>
                                <textarea rows="2" name="testimonial_3_quote" id="testimonial_3_quote" required
                                    class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">{{ old('testimonial_3_quote', $content['testimonial_3_quote'] ?? '') }}</textarea>
                            </div>
                            <div class="md:col-span-1 space-y-2">
                                <div>
                                    <label for="testimonial_3_author" class="block text-xs font-semibold text-slate-700">Author Name</label>
                                    <input type="text" name="testimonial_3_author" id="testimonial_3_author" value="{{ old('testimonial_3_author', $content['testimonial_3_author'] ?? '') }}" required
                                        class="mt-1 block w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                                </div>
                                <div>
                                    <label for="testimonial_3_role" class="block text-xs font-semibold text-slate-700">Role/Sub</label>
                                    <input type="text" name="testimonial_3_role" id="testimonial_3_role" value="{{ old('testimonial_3_role', $content['testimonial_3_role'] ?? '') }}" required
                                        class="mt-1 block w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Corporate Contacts Settings -->
            <div class="space-y-4 pt-4">
            <!-- Corporate Contact Info -->
            <div class="space-y-4 pt-4">
                <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wider border-b border-slate-150 pb-2 flex items-center">
                    <span class="h-2 w-2 rounded-full bg-[#008080] mr-2"></span>
                    Corporate Header & Contact
                </h4>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="header_email" class="block text-sm font-semibold text-slate-700">Corporate Email Address</label>
                        <div class="mt-1.5">
                            <input type="email" name="header_email" id="header_email" value="{{ old('header_email', $content['header_email'] ?? '') }}" required
                                class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm">
                        </div>
                        @error('header_email')
                            <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="header_phone" class="block text-sm font-semibold text-slate-700">Corporate Phone Number</label>
                        <div class="mt-1.5">
                            <input type="text" name="header_phone" id="header_phone" value="{{ old('header_phone', $content['header_phone'] ?? '+440203 930 9629') }}" required
                                class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm">
                        </div>
                        @error('header_phone')
                            <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <div>
                        <label for="contact_address" class="block text-sm font-semibold text-slate-700">Physical Address</label>
                        <div class="mt-1.5">
                            <textarea rows="3" name="contact_address" id="contact_address" required
                                class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm">{{ old('contact_address', $content['contact_address'] ?? '73 Thrale Road, London, England, SW16 1NU') }}</textarea>
                        </div>
                        @error('contact_address')
                            <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="contact_map_url" class="block text-sm font-semibold text-slate-700">Google Maps URL</label>
                        <div class="mt-1.5">
                            <input type="url" name="contact_map_url" id="contact_map_url" value="{{ old('contact_map_url', $content['contact_map_url'] ?? 'https://www.google.com/maps/search/?api=1&query=73+Thrale+Road,+London,+England,+SW16+1NU') }}"
                                class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm">
                        </div>
                        @error('contact_map_url')
                            <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <label for="footer_description" class="block text-sm font-semibold text-slate-700">Footer Short Description</label>
                    <div class="mt-1.5">
                        <textarea rows="2" name="footer_description" id="footer_description" required
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm"
                            placeholder="Delivering 360-degree integration of premium architectural builds, structural planning, and design-build management.">{{ old('footer_description', $content['footer_description'] ?? 'Delivering 360-degree integration of premium architectural builds, structural planning, and design-build management.') }}</textarea>
                    </div>
                    @error('footer_description')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Team Section Config -->
            <div class="space-y-4 pt-4">
                <h4 class="text-sm font-bold text-[#008080] uppercase tracking-wider border-b border-slate-150 pb-2 flex items-center">
                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Team Section Headers
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="team_section_label" class="block text-sm font-semibold text-slate-700">Section Label (Mini Tag)</label>
                        <div class="mt-1.5">
                            <input type="text" name="team_section_label" id="team_section_label" value="{{ old('team_section_label', $content['team_section_label'] ?? '') }}" required
                                class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm">
                        </div>
                        @error('team_section_label')
                            <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="team_section_title" class="block text-sm font-semibold text-slate-700">Section Title</label>
                        <div class="mt-1.5">
                            <input type="text" name="team_section_title" id="team_section_title" value="{{ old('team_section_title', $content['team_section_title'] ?? '') }}" required
                                class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm">
                        </div>
                        @error('team_section_title')
                            <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="team_section_subtitle" class="block text-sm font-semibold text-slate-700">Section Subtitle / Description</label>
                    <div class="mt-1.5">
                        <textarea rows="2" name="team_section_subtitle" id="team_section_subtitle" required
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm">{{ old('team_section_subtitle', $content['team_section_subtitle'] ?? '') }}</textarea>
                    </div>
                    @error('team_section_subtitle')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Team Members Group -->
            <div class="space-y-6 pt-4">
                <h4 class="text-sm font-bold text-[#008080] uppercase tracking-wider border-b border-slate-150 pb-2 flex items-center">
                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Team Members Profiles
                </h4>

                <div class="space-y-6">
                    <!-- Member 1 -->
                    <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
                        <span class="text-xs font-bold text-[#008080] uppercase tracking-wide">Team Member 1</span>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="team_member_1_name" class="block text-xs font-semibold text-slate-700">Full Name</label>
                                <input type="text" name="team_member_1_name" id="team_member_1_name" value="{{ old('team_member_1_name', $content['team_member_1_name'] ?? '') }}" required
                                    class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                            </div>
                            <div>
                                <label for="team_member_1_role" class="block text-xs font-semibold text-slate-700">Role / Job Title</label>
                                <input type="text" name="team_member_1_role" id="team_member_1_role" value="{{ old('team_member_1_role', $content['team_member_1_role'] ?? '') }}" required
                                    class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                            </div>
                        </div>
                        <div>
                            <label for="team_member_1_description" class="block text-xs font-semibold text-slate-700">Biography / Description</label>
                            <textarea rows="2" name="team_member_1_description" id="team_member_1_description" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">{{ old('team_member_1_description', $content['team_member_1_description'] ?? '') }}</textarea>
                        </div>
                        <div>
                            <label for="team_member_1_accreditations" class="block text-xs font-semibold text-slate-700">Accreditations / Badges (Comma separated)</label>
                            <input type="text" name="team_member_1_accreditations" id="team_member_1_accreditations" value="{{ old('team_member_1_accreditations', $content['team_member_1_accreditations'] ?? '') }}" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                            <p class="mt-1 text-[10px] text-slate-400">Example: CSCS Black Card, RICS Affiliate</p>
                        </div>
                    </div>

                    <!-- Member 2 -->
                    <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
                        <span class="text-xs font-bold text-[#008080] uppercase tracking-wide">Team Member 2</span>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="team_member_2_name" class="block text-xs font-semibold text-slate-700">Full Name</label>
                                <input type="text" name="team_member_2_name" id="team_member_2_name" value="{{ old('team_member_2_name', $content['team_member_2_name'] ?? '') }}" required
                                    class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                            </div>
                            <div>
                                <label for="team_member_2_role" class="block text-xs font-semibold text-slate-700">Role / Job Title</label>
                                <input type="text" name="team_member_2_role" id="team_member_2_role" value="{{ old('team_member_2_role', $content['team_member_2_role'] ?? '') }}" required
                                    class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                            </div>
                        </div>
                        <div>
                            <label for="team_member_2_description" class="block text-xs font-semibold text-slate-700">Biography / Description</label>
                            <textarea rows="2" name="team_member_2_description" id="team_member_2_description" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">{{ old('team_member_2_description', $content['team_member_2_description'] ?? '') }}</textarea>
                        </div>
                        <div>
                            <label for="team_member_2_accreditations" class="block text-xs font-semibold text-slate-700">Accreditations / Badges (Comma separated)</label>
                            <input type="text" name="team_member_2_accreditations" id="team_member_2_accreditations" value="{{ old('team_member_2_accreditations', $content['team_member_2_accreditations'] ?? '') }}" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                            <p class="mt-1 text-[10px] text-slate-400">Example: IStructE Member, MSc Civil Eng</p>
                        </div>
                    </div>

                    <!-- Member 3 -->
                    <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
                        <span class="text-xs font-bold text-[#008080] uppercase tracking-wide">Team Member 3</span>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="team_member_3_name" class="block text-xs font-semibold text-slate-700">Full Name</label>
                                <input type="text" name="team_member_3_name" id="team_member_3_name" value="{{ old('team_member_3_name', $content['team_member_3_name'] ?? '') }}" required
                                    class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                            </div>
                            <div>
                                <label for="team_member_3_role" class="block text-xs font-semibold text-slate-700">Role / Job Title</label>
                                <input type="text" name="team_member_3_role" id="team_member_3_role" value="{{ old('team_member_3_role', $content['team_member_3_role'] ?? '') }}" required
                                    class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                            </div>
                        </div>
                        <div>
                            <label for="team_member_3_description" class="block text-xs font-semibold text-slate-700">Biography / Description</label>
                            <textarea rows="2" name="team_member_3_description" id="team_member_3_description" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">{{ old('team_member_3_description', $content['team_member_3_description'] ?? '') }}</textarea>
                        </div>
                        <div>
                            <label for="team_member_3_accreditations" class="block text-xs font-semibold text-slate-700">Accreditations / Badges (Comma separated)</label>
                            <input type="text" name="team_member_3_accreditations" id="team_member_3_accreditations" value="{{ old('team_member_3_accreditations', $content['team_member_3_accreditations'] ?? '') }}" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                            <p class="mt-1 text-[10px] text-slate-400">Example: RICS Certified, CSCS Card</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Homepage Section Headers -->
            <div class="space-y-6 pt-4">
                <h4 class="text-sm font-bold text-[#008080] uppercase tracking-wider border-b border-slate-150 pb-2 flex items-center">
                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    Homepage Section Headers & Subtitles
                </h4>

                <!-- Services Section Headers -->
                <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
                    <span class="text-xs font-bold text-[#008080] uppercase tracking-wide">Services Section Headers</span>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="services_section_label" class="block text-xs font-semibold text-slate-700">Section Label (Mini Tag)</label>
                            <input type="text" name="services_section_label" id="services_section_label" value="{{ old('services_section_label', $content['services_section_label'] ?? '') }}" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                        </div>
                        <div>
                            <label for="services_section_title" class="block text-xs font-semibold text-slate-700">Section Title</label>
                            <input type="text" name="services_section_title" id="services_section_title" value="{{ old('services_section_title', $content['services_section_title'] ?? '') }}" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                        </div>
                    </div>
                    <div>
                        <label for="services_section_subtitle" class="block text-xs font-semibold text-slate-700">Section Subtitle / Description</label>
                        <textarea rows="2" name="services_section_subtitle" id="services_section_subtitle" required
                            class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">{{ old('services_section_subtitle', $content['services_section_subtitle'] ?? '') }}</textarea>
                    </div>
                </div>

                <!-- Blog Section Headers -->
                <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
                    <span class="text-xs font-bold text-[#008080] uppercase tracking-wide">Blog Section Headers</span>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="blog_section_label" class="block text-xs font-semibold text-slate-700">Section Label (Mini Tag)</label>
                            <input type="text" name="blog_section_label" id="blog_section_label" value="{{ old('blog_section_label', $content['blog_section_label'] ?? '') }}" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                        </div>
                        <div>
                            <label for="blog_section_title" class="block text-xs font-semibold text-slate-700">Section Title</label>
                            <input type="text" name="blog_section_title" id="blog_section_title" value="{{ old('blog_section_title', $content['blog_section_title'] ?? '') }}" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                        </div>
                    </div>
                    <div>
                        <label for="blog_section_subtitle" class="block text-xs font-semibold text-slate-700">Section Subtitle / Description</label>
                        <textarea rows="2" name="blog_section_subtitle" id="blog_section_subtitle" required
                            class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">{{ old('blog_section_subtitle', $content['blog_section_subtitle'] ?? '') }}</textarea>
                    </div>
                </div>

                <!-- Contact Section Headers -->
                <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
                    <span class="text-xs font-bold text-[#008080] uppercase tracking-wide">Contact Section Headers</span>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="contact_section_label" class="block text-xs font-semibold text-slate-700">Section Label (Mini Tag)</label>
                            <input type="text" name="contact_section_label" id="contact_section_label" value="{{ old('contact_section_label', $content['contact_section_label'] ?? '') }}" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                        </div>
                        <div>
                            <label for="contact_section_title" class="block text-xs font-semibold text-slate-700">Section Title</label>
                            <input type="text" name="contact_section_title" id="contact_section_title" value="{{ old('contact_section_title', $content['contact_section_title'] ?? '') }}" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                        </div>
                    </div>
                    <div>
                        <label for="contact_section_subtitle" class="block text-xs font-semibold text-slate-700">Section Subtitle / Description</label>
                        <textarea rows="2" name="contact_section_subtitle" id="contact_section_subtitle" required
                            class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">{{ old('contact_section_subtitle', $content['contact_section_subtitle'] ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Subpages Copy Configuration -->
            <div class="space-y-6 pt-4">
                <h4 class="text-sm font-bold text-[#008080] uppercase tracking-wider border-b border-slate-150 pb-2 flex items-center">
                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Footer Sub-Pages Copy Blocks
                </h4>

                <!-- Privacy Policy -->
                <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
                    <span class="text-xs font-bold text-[#008080] uppercase tracking-wide">Privacy Policy Page</span>
                    <div>
                        <label for="privacy_title" class="block text-xs font-semibold text-slate-700">Page Main Title</label>
                        <input type="text" name="privacy_title" id="privacy_title" value="{{ old('privacy_title', $content['privacy_title'] ?? '') }}" required
                            class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                    </div>
                    <div>
                        <label for="privacy_notice" class="block text-xs font-semibold text-slate-700">Notice Block (HTML Allowed)</label>
                        <textarea rows="3" name="privacy_notice" id="privacy_notice" required
                            class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs font-mono">{{ old('privacy_notice', $content['privacy_notice'] ?? '') }}</textarea>
                    </div>
                    <div>
                        <label for="privacy_content" class="block text-xs font-semibold text-slate-700">Main Sections Content (Plain Text)</label>
                        <textarea rows="8" name="privacy_content" id="privacy_content" required
                            class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">{{ old('privacy_content', $content['privacy_content'] ?? '') }}</textarea>
                    </div>
                </div>

                <!-- Terms & Conditions -->
                <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
                    <span class="text-xs font-bold text-[#008080] uppercase tracking-wide">Terms & Conditions Page</span>
                    <div>
                        <label for="terms_title" class="block text-xs font-semibold text-slate-700">Page Main Title</label>
                        <input type="text" name="terms_title" id="terms_title" value="{{ old('terms_title', $content['terms_title'] ?? '') }}" required
                            class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                    </div>
                    <div>
                        <label for="terms_notice" class="block text-xs font-semibold text-slate-700">Notice Block (HTML Allowed)</label>
                        <textarea rows="3" name="terms_notice" id="terms_notice" required
                            class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs font-mono">{{ old('terms_notice', $content['terms_notice'] ?? '') }}</textarea>
                    </div>
                    <div>
                        <label for="terms_content" class="block text-xs font-semibold text-slate-700">Main Sections Content (Plain Text)</label>
                        <textarea rows="8" name="terms_content" id="terms_content" required
                            class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">{{ old('terms_content', $content['terms_content'] ?? '') }}</textarea>
                    </div>
                </div>

                <!-- Tendering Standard -->
                <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
                    <span class="text-xs font-bold text-[#008080] uppercase tracking-wide">Tendering Standard Page</span>
                    <div>
                        <label for="tendering_title" class="block text-xs font-semibold text-slate-700">Page Main Title</label>
                        <input type="text" name="tendering_title" id="tendering_title" value="{{ old('tendering_title', $content['tendering_title'] ?? '') }}" required
                            class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                    </div>
                    <div>
                        <label for="tendering_notice" class="block text-xs font-semibold text-slate-700">Notice Block (HTML Allowed)</label>
                        <textarea rows="3" name="tendering_notice" id="tendering_notice" required
                            class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs font-mono">{{ old('tendering_notice', $content['tendering_notice'] ?? '') }}</textarea>
                    </div>
                    <div>
                        <label for="tendering_content" class="block text-xs font-semibold text-slate-700">Main Sections Content (Plain Text)</label>
                        <textarea rows="8" name="tendering_content" id="tendering_content" required
                            class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">{{ old('tendering_content', $content['tendering_content'] ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Additional Website Copy Details (Dynamic Customization) -->
            <div class="space-y-6 pt-4">
                <h4 class="text-sm font-bold text-[#008080] uppercase tracking-wider border-b border-slate-150 pb-2 flex items-center">
                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Additional Dynamic Website Texts
                </h4>

                <!-- About Subheaders -->
                <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
                    <span class="text-xs font-bold text-[#008080] uppercase tracking-wide">About Section Subheaders</span>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="about_vision_label" class="block text-xs font-semibold text-slate-700">Vision Section Title</label>
                            <input type="text" name="about_vision_label" id="about_vision_label" value="{{ old('about_vision_label', $content['about_vision_label'] ?? 'Our vision') }}" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                        </div>
                        <div>
                            <label for="about_mission_label" class="block text-xs font-semibold text-slate-700">Mission Section Title</label>
                            <input type="text" name="about_mission_label" id="about_mission_label" value="{{ old('about_mission_label', $content['about_mission_label'] ?? 'Our mission') }}" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                        </div>
                        <div>
                            <label for="about_values_label" class="block text-xs font-semibold text-slate-700">Values Section Title</label>
                            <input type="text" name="about_values_label" id="about_values_label" value="{{ old('about_values_label', $content['about_values_label'] ?? 'Our values') }}" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                        </div>
                    </div>
                </div>

                <!-- Why Choose Us Detailed Cards -->
                <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-4">
                    <span class="text-xs font-bold text-[#008080] uppercase tracking-wide">Why Choose Us Cards</span>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-3 bg-white border border-slate-150 rounded-lg space-y-2">
                            <label for="why_1_title" class="block text-xs font-bold text-slate-700">Card 1 Title</label>
                            <input type="text" name="why_1_title" id="why_1_title" value="{{ old('why_1_title', $content['why_1_title'] ?? 'Operational Excellence') }}" required
                                class="block w-full px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                            <label for="why_1_text" class="block text-xs font-bold text-slate-700 mt-2">Card 1 Description</label>
                            <textarea rows="2" name="why_1_text" id="why_1_text" required
                                class="block w-full px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">{{ old('why_1_text', $content['why_1_text'] ?? 'We hold full ISO and FORS accreditations, ensuring our processes are rigorous, compliant, and efficient.') }}</textarea>
                        </div>
                        <div class="p-3 bg-white border border-slate-150 rounded-lg space-y-2">
                            <label for="why_2_title" class="block text-xs font-bold text-slate-700">Card 2 Title</label>
                            <input type="text" name="why_2_title" id="why_2_title" value="{{ old('why_2_title', $content['why_2_title'] ?? 'London Specialists') }}" required
                                class="block w-full px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                            <label for="why_2_text" class="block text-xs font-bold text-slate-700 mt-2">Card 2 Description</label>
                            <textarea rows="2" name="why_2_text" id="why_2_text" required
                                class="block w-full px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">{{ old('why_2_text', $content['why_2_text'] ?? 'Experts in London Landscape. With 25+ projects across Capital, we specialise in navigating the complexities of London.') }}</textarea>
                        </div>
                        <div class="p-3 bg-white border border-slate-150 rounded-lg space-y-2">
                            <label for="why_3_title" class="block text-xs font-bold text-slate-700">Card 3 Title</label>
                            <input type="text" name="why_3_title" id="why_3_title" value="{{ old('why_3_title', $content['why_3_title'] ?? 'Quality Assurance') }}" required
                                class="block w-full px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                            <label for="why_3_text" class="block text-xs font-bold text-slate-700 mt-2">Card 3 Description</label>
                            <textarea rows="2" name="why_3_text" id="why_3_text" required
                                class="block w-full px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">{{ old('why_3_text', $content['why_3_text'] ?? 'We refuse to cut corners, applying strict quality controls to ensure superior craftsmanship in every trade.') }}</textarea>
                        </div>
                        <div class="p-3 bg-white border border-slate-150 rounded-lg space-y-2">
                            <label for="why_4_title" class="block text-xs font-bold text-slate-700">Card 4 Title</label>
                            <input type="text" name="why_4_title" id="why_4_title" value="{{ old('why_4_title', $content['why_4_title'] ?? 'Financial Clarity') }}" required
                                class="block w-full px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                            <label for="why_4_text" class="block text-xs font-bold text-slate-700 mt-2">Card 4 Description</label>
                            <textarea rows="2" name="why_4_text" id="why_4_text" required
                                class="block w-full px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">{{ old('why_4_text', $content['why_4_text'] ?? 'Our detailed cost breakdowns and project management ensure you stay informed, in control, & confident in your investment throughout the build.') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Marquee and Filters -->
                <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
                    <span class="text-xs font-bold text-[#008080] uppercase tracking-wide">Marquee & Project Filters</span>
                    <div>
                        <label for="marquee_text" class="block text-xs font-semibold text-slate-700">Scrolling Marquee Text (Separate items with ' • ')</label>
                        <input type="text" name="marquee_text" id="marquee_text" value="{{ old('marquee_text', $content['marquee_text'] ?? 'Accreditations • Memberships • Incorporation 2013 • ISO 9001 Certified • ISO 14001 Certified • Fleet Operator Recognition Scheme • Federation of Master Builders • ConstructionLine Silver membership') }}" required
                            class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-2">
                        <div>
                            <label for="filter_all_label" class="block text-xs font-semibold text-slate-700">Filter 'All' Title</label>
                            <input type="text" name="filter_all_label" id="filter_all_label" value="{{ old('filter_all_label', $content['filter_all_label'] ?? 'All Projects') }}" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                        </div>
                        <div>
                            <label for="filter_completed_label" class="block text-xs font-semibold text-slate-700">Filter 'Completed' Title</label>
                            <input type="text" name="filter_completed_label" id="filter_completed_label" value="{{ old('filter_completed_label', $content['filter_completed_label'] ?? 'Completed Projs.') }}" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                        </div>
                        <div>
                            <label for="filter_under_construction_label" class="block text-xs font-semibold text-slate-700">Filter 'Under Dev' Title</label>
                            <input type="text" name="filter_under_construction_label" id="filter_under_construction_label" value="{{ old('filter_under_construction_label', $content['filter_under_construction_label'] ?? 'Under Developm.') }}" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                        </div>
                    </div>
                </div>

                <!-- Call to Actions & Labels -->
                <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
                    <span class="text-xs font-bold text-[#008080] uppercase tracking-wide">Call To Action Button Labels</span>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="cta_submit_tender_label" class="block text-xs font-semibold text-slate-700">Submit Tender Button</label>
                            <input type="text" name="cta_submit_tender_label" id="cta_submit_tender_label" value="{{ old('cta_submit_tender_label', $content['cta_submit_tender_label'] ?? 'Submit Tender Brief') }}" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                        </div>
                        <div>
                            <label for="cta_explore_services_label" class="block text-xs font-semibold text-slate-700">Explore Services Button</label>
                            <input type="text" name="cta_explore_services_label" id="cta_explore_services_label" value="{{ old('cta_explore_services_label', $content['cta_explore_services_label'] ?? 'Explore Services') }}" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                        </div>
                        <div>
                            <label for="cta_ask_quote_label" class="block text-xs font-semibold text-slate-700">Ask for Quote Button</label>
                            <input type="text" name="cta_ask_quote_label" id="cta_ask_quote_label" value="{{ old('cta_ask_quote_label', $content['cta_ask_quote_label'] ?? 'Ask for a quote') }}" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                        </div>
                        <div>
                            <label for="cta_explore_portfolio_label" class="block text-xs font-semibold text-slate-700">Explore Portfolio Button</label>
                            <input type="text" name="cta_explore_portfolio_label" id="cta_explore_portfolio_label" value="{{ old('cta_explore_portfolio_label', $content['cta_explore_portfolio_label'] ?? 'Explore Full Portfolio') }}" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                        </div>
                        <div>
                            <label for="cta_view_all_posts_label" class="block text-xs font-semibold text-slate-700">View All Posts Button</label>
                            <input type="text" name="cta_view_all_posts_label" id="cta_view_all_posts_label" value="{{ old('cta_view_all_posts_label', $content['cta_view_all_posts_label'] ?? 'view all posts') }}" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                        </div>
                        <div>
                            <label for="cta_get_free_quote_label" class="block text-xs font-semibold text-slate-700">Footer Get Quote Circle (use \n for line breaks)</label>
                            <textarea rows="2" name="cta_get_free_quote_label" id="cta_get_free_quote_label" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">{{ old('cta_get_free_quote_label', $content['cta_get_free_quote_label'] ?? "Get Your\nFree\nQuote") }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Contact Page Specific Config -->
                <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
                    <span class="text-xs font-bold text-[#008080] uppercase tracking-wide">Contact Page Customizations</span>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="contact_page_title" class="block text-xs font-semibold text-slate-700">Contact Hero Title</label>
                            <input type="text" name="contact_page_title" id="contact_page_title" value="{{ old('contact_page_title', $content['contact_page_title'] ?? 'Get in touch') }}" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                        </div>
                        <div>
                            <label for="contact_page_form_title" class="block text-xs font-semibold text-slate-700">Contact Form Title</label>
                            <input type="text" name="contact_page_form_title" id="contact_page_form_title" value="{{ old('contact_page_form_title', $content['contact_page_form_title'] ?? 'Leave a message') }}" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                        </div>
                        <div>
                            <label for="contact_support_email_label" class="block text-xs font-semibold text-slate-700">Support Email Card Title</label>
                            <input type="text" name="contact_support_email_label" id="contact_support_email_label" value="{{ old('contact_support_email_label', $content['contact_support_email_label'] ?? 'Support email') }}" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                        </div>
                        <div>
                            <label for="contact_mobile_label" class="block text-xs font-semibold text-slate-700">Mobile Card Title</label>
                            <input type="text" name="contact_mobile_label" id="contact_mobile_label" value="{{ old('contact_mobile_label', $content['contact_mobile_label'] ?? 'Mobile Number') }}" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                        </div>
                        <div class="md:col-span-2">
                            <label for="contact_location_label" class="block text-xs font-semibold text-slate-700">Location Card Title</label>
                            <input type="text" name="contact_location_label" id="contact_location_label" value="{{ old('contact_location_label', $content['contact_location_label'] ?? 'Location') }}" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                        </div>
                        <div class="md:col-span-2">
                            <label for="contact_page_subtitle" class="block text-xs font-semibold text-slate-700">Contact Hero Subtitle</label>
                            <textarea rows="2" name="contact_page_subtitle" id="contact_page_subtitle" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">{{ old('contact_page_subtitle', $content['contact_page_subtitle'] ?? 'Our global construction experts are here to help you in this ever-changing market.') }}</textarea>
                        </div>
                        <div class="md:col-span-2">
                            <label for="contact_map_embed_url" class="block text-xs font-semibold text-slate-700">Google Map Embed URL</label>
                            <input type="text" name="contact_map_embed_url" id="contact_map_embed_url" value="{{ old('contact_map_embed_url', $content['contact_map_embed_url'] ?? 'https://maps.google.com/maps?q=73%20Thrale%20Road,%20London,%20England,%20SW16%201NU&t=&z=15&ie=UTF8&iwloc=&output=embed') }}" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                        </div>
                    </div>
                </div>

                <!-- Subpages Headings Customizations -->
                <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-4">
                    <span class="text-xs font-bold text-[#008080] uppercase tracking-wide">Subpages Headings & Text Customizations</span>
                    
                    <!-- Services Page Headers -->
                    <div class="p-3 bg-white border border-slate-150 rounded-lg space-y-3">
                        <span class="text-xs font-bold text-slate-500 uppercase">Services Listing Page</span>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="services_page_label" class="block text-xs font-semibold text-slate-700">Hero Label</label>
                                <input type="text" name="services_page_label" id="services_page_label" value="{{ old('services_page_label', $content['services_page_label'] ?? 'Services') }}" required
                                    class="mt-1 block w-full px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                            </div>
                            <div>
                                <label for="services_page_title" class="block text-xs font-semibold text-slate-700">Hero Title</label>
                                <input type="text" name="services_page_title" id="services_page_title" value="{{ old('services_page_title', $content['services_page_title'] ?? 'Design to Delivery') }}" required
                                    class="mt-1 block w-full px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                            </div>
                            <div class="md:col-span-2">
                                <label for="services_page_subtitle" class="block text-xs font-semibold text-slate-700">Hero Subtitle / Description</label>
                                <textarea rows="2" name="services_page_subtitle" id="services_page_subtitle" required
                                    class="mt-1 block w-full px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">{{ old('services_page_subtitle', $content['services_page_subtitle'] ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Service Detail Headers -->
                    <div class="p-3 bg-white border border-slate-150 rounded-lg space-y-3">
                        <span class="text-xs font-bold text-slate-500 uppercase">Service Detail Pages</span>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="service_about_label" class="block text-xs font-semibold text-slate-700">About Section Label</label>
                                <input type="text" name="service_about_label" id="service_about_label" value="{{ old('service_about_label', $content['service_about_label'] ?? 'ABOUT THE SERVICE') }}" required
                                    class="mt-1 block w-full px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                            </div>
                            <div class="hidden md:block"></div>
                            <div>
                                <label for="service_scopes_label" class="block text-xs font-semibold text-slate-700">Scopes Section Label</label>
                                <input type="text" name="service_scopes_label" id="service_scopes_label" value="{{ old('service_scopes_label', $content['service_scopes_label'] ?? 'SCOPES & DELIVERABLES') }}" required
                                    class="mt-1 block w-full px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                            </div>
                            <div>
                                <label for="service_scopes_title" class="block text-xs font-semibold text-slate-700">Scopes Section Title</label>
                                <input type="text" name="service_scopes_title" id="service_scopes_title" value="{{ old('service_scopes_title', $content['service_scopes_title'] ?? 'Specialist Sub-Services') }}" required
                                    class="mt-1 block w-full px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                            </div>
                            <div>
                                <label for="service_why_choose_us_label" class="block text-xs font-semibold text-slate-700">Why Choose Us Label</label>
                                <input type="text" name="service_why_choose_us_label" id="service_why_choose_us_label" value="{{ old('service_why_choose_us_label', $content['service_why_choose_us_label'] ?? 'CAPABILITIES') }}" required
                                    class="mt-1 block w-full px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                            </div>
                            <div>
                                <label for="service_why_choose_us_title" class="block text-xs font-semibold text-slate-700">Why Choose Us Title</label>
                                <input type="text" name="service_why_choose_us_title" id="service_why_choose_us_title" value="{{ old('service_why_choose_us_title', $content['service_why_choose_us_title'] ?? 'Why Choose Us') }}" required
                                    class="mt-1 block w-full px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                            </div>
                            <div>
                                <label for="service_faqs_label" class="block text-xs font-semibold text-slate-700">FAQs Label</label>
                                <input type="text" name="service_faqs_label" id="service_faqs_label" value="{{ old('service_faqs_label', $content['service_faqs_label'] ?? 'COMMON INQUIRIES') }}" required
                                    class="mt-1 block w-full px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                            </div>
                            <div>
                                <label for="service_faqs_title" class="block text-xs font-semibold text-slate-700">FAQs Title</label>
                                <input type="text" name="service_faqs_title" id="service_faqs_title" value="{{ old('service_faqs_title', $content['service_faqs_title'] ?? 'Frequently Asked Questions') }}" required
                                    class="mt-1 block w-full px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                            </div>
                        </div>
                    </div>

                    <!-- Projects Page Headers -->
                    <div class="p-3 bg-white border border-slate-150 rounded-lg space-y-3">
                        <span class="text-xs font-bold text-slate-500 uppercase">Projects Listing Page</span>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="projects_page_label" class="block text-xs font-semibold text-slate-700">Hero Label</label>
                                <input type="text" name="projects_page_label" id="projects_page_label" value="{{ old('projects_page_label', $content['projects_page_label'] ?? 'PORTFOLIO') }}" required
                                    class="mt-1 block w-full px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                            </div>
                            <div>
                                <label for="projects_page_title" class="block text-xs font-semibold text-slate-700">Hero Title</label>
                                <input type="text" name="projects_page_title" id="projects_page_title" value="{{ old('projects_page_title', $content['projects_page_title'] ?? 'Our Projects') }}" required
                                    class="mt-1 block w-full px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                            </div>
                            <div class="md:col-span-2">
                                <label for="projects_page_subtitle" class="block text-xs font-semibold text-slate-700">Hero Subtitle / Description</label>
                                <textarea rows="2" name="projects_page_subtitle" id="projects_page_subtitle" required
                                    class="mt-1 block w-full px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">{{ old('projects_page_subtitle', $content['projects_page_subtitle'] ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Project Detail Headers -->
                    <div class="p-3 bg-white border border-slate-150 rounded-lg space-y-3">
                        <span class="text-xs font-bold text-slate-500 uppercase">Project Detail Pages</span>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="project_overview_title" class="block text-xs font-semibold text-slate-700">Overview Section Title</label>
                                <input type="text" name="project_overview_title" id="project_overview_title" value="{{ old('project_overview_title', $content['project_overview_title'] ?? 'Project Overview') }}" required
                                    class="mt-1 block w-full px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                            </div>
                            <div>
                                <label for="project_scopes_title" class="block text-xs font-semibold text-slate-700">Development Scopes Title</label>
                                <input type="text" name="project_scopes_title" id="project_scopes_title" value="{{ old('project_scopes_title', $content['project_scopes_title'] ?? 'Development Scopes') }}" required
                                    class="mt-1 block w-full px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                            </div>
                            <div>
                                <label for="project_specifications_title" class="block text-xs font-semibold text-slate-700">Sidebar Specs Title</label>
                                <input type="text" name="project_specifications_title" id="project_specifications_title" value="{{ old('project_specifications_title', $content['project_specifications_title'] ?? 'Project Specifications') }}" required
                                    class="mt-1 block w-full px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                            </div>
                            <div>
                                <label for="project_related_label" class="block text-xs font-semibold text-slate-700">Related Section Label</label>
                                <input type="text" name="project_related_label" id="project_related_label" value="{{ old('project_related_label', $content['project_related_label'] ?? 'PORTFOLIO') }}" required
                                    class="mt-1 block w-full px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                            </div>
                            <div>
                                <label for="project_related_title" class="block text-xs font-semibold text-slate-700">Related Section Title</label>
                                <input type="text" name="project_related_title" id="project_related_title" value="{{ old('project_related_title', $content['project_related_title'] ?? 'Related Projects') }}" required
                                    class="mt-1 block w-full px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Miscellaneous Layout Copies -->
                <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
                    <span class="text-xs font-bold text-[#008080] uppercase tracking-wide">Layout & Pre-Footer Copys</span>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="digital_tenders_only_label" class="block text-xs font-semibold text-slate-700">Digital Tenders Only Label</label>
                            <input type="text" name="digital_tenders_only_label" id="digital_tenders_only_label" value="{{ old('digital_tenders_only_label', $content['digital_tenders_only_label'] ?? 'Digital Tenders Only') }}" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                        </div>
                        <div>
                            <label for="pre_footer_cta_title" class="block text-xs font-semibold text-slate-700">Pre-Footer CTA Title</label>
                            <input type="text" name="pre_footer_cta_title" id="pre_footer_cta_title" value="{{ old('pre_footer_cta_title', $content['pre_footer_cta_title'] ?? 'Your Execution Partner') }}" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                        </div>
                        <div class="md:col-span-2">
                            <label for="pre_footer_cta_subtitle" class="block text-xs font-semibold text-slate-700">Pre-Footer CTA Subtitle</label>
                            <textarea rows="2" name="pre_footer_cta_subtitle" id="pre_footer_cta_subtitle" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">{{ old('pre_footer_cta_subtitle', $content['pre_footer_cta_subtitle'] ?? "Whether you're exploring our premium architectural builds or envisioning a custom structural solution, we are here to bring your vision to life.") }}</textarea>
                        </div>
                        <div class="md:col-span-2">
                            <label for="footer_company_registration" class="block text-xs font-semibold text-slate-700">Footer Company Registration Line</label>
                            <textarea rows="2" name="footer_company_registration" id="footer_company_registration" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">{{ old('footer_company_registration', $content['footer_company_registration'] ?? 'This Company is Registered in England and Wales. Company number 17277526') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end space-x-3 pt-6 border-t border-slate-200">
                <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 border border-slate-200 text-sm font-semibold text-slate-700 rounded-lg hover:bg-slate-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-5 py-2 text-sm font-bold text-white bg-[#008080] hover:bg-[#006666] rounded-lg shadow-sm transition-colors">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
