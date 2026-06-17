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

            <!-- About Us Group -->
            <div class="space-y-4 pt-4">
                <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wider border-b border-slate-150 pb-2 flex items-center">
                    <span class="h-2 w-2 rounded-full bg-[#008080] mr-2"></span>
                    About Us & Philosophy
                </h4>

                <div>
                    <label for="about_text" class="block text-sm font-semibold text-slate-700">Company Overview Text</label>
                    <div class="mt-1.5">
                        <textarea rows="4" name="about_text" id="about_text" required
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm">{{ old('about_text', $content['about_text'] ?? '') }}</textarea>
                    </div>
                    @error('about_text')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="about_philosophy" class="block text-sm font-semibold text-slate-700">Operational Philosophy & Tendering Notice</label>
                    <div class="mt-1.5">
                        <textarea rows="4" name="about_philosophy" id="about_philosophy" required
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm">{{ old('about_philosophy', $content['about_philosophy'] ?? '') }}</textarea>
                    </div>
                    @error('about_philosophy')
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
                <h4 class="text-sm font-bold text-[#008080] uppercase tracking-wider border-b border-slate-150 pb-2 flex items-center">
                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Corporate Contact Info
                </h4>
                <div>
                    <label for="header_email" class="block text-sm font-semibold text-slate-700">Corporate Email Address</label>
                    <div class="mt-1.5">
                        <input type="email" name="header_email" id="header_email" value="{{ old('header_email', $content['header_email'] ?? '') }}" required
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm">
                    </div>
                    <p class="mt-1 text-xs text-slate-400">The central corporate email shown on the top bar, footer, and subpages.</p>
                    @error('header_email')
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
