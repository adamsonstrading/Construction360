@extends('layouts.admin')

@section('title', 'Add New Blog Post')
@section('page_title', 'Add New Blog Post')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white border border-slate-200 shadow-sm rounded-xl overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-200 bg-slate-50">
            <h3 class="text-lg font-bold text-slate-900">New Blog Post</h3>
            <p class="mt-1 text-sm text-slate-500">Create a new article to be published on the homepage blog grid.</p>
        </div>

        <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="sm:col-span-2">
                    <label for="title" class="block text-sm font-semibold text-slate-700">Article Title</label>
                    <div class="mt-1.5">
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required placeholder="e.g. The Future of Integrated Design & Construction"
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm transition-all">
                    </div>
                    @error('title')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="slug" class="block text-sm font-semibold text-slate-700">Custom Slug <span class="text-slate-400 font-normal">(Optional)</span></label>
                    <div class="mt-1.5">
                        <input type="text" name="slug" id="slug" value="{{ old('slug') }}" placeholder="e.g. future-integrated-design"
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm transition-all">
                    </div>
                    <p class="mt-1 text-xs text-slate-400">Unique URL identifier. Generated automatically from title if left blank.</p>
                    @error('slug')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="author" class="block text-sm font-semibold text-slate-700">Author Name <span class="text-slate-400 font-normal">(Optional)</span></label>
                    <div class="mt-1.5">
                        <input type="text" name="author" id="author" value="{{ old('author', 'Construction 360') }}" placeholder="e.g. Project Lead"
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm transition-all">
                    </div>
                    @error('author')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="category" class="block text-sm font-semibold text-slate-700">Category</label>
                    <div class="mt-1.5">
                        <select name="category" id="category" required
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm transition-all">
                            <option value="Uncategorized" {{ old('category') === 'Uncategorized' ? 'selected' : '' }}>Uncategorized</option>
                            <option value="Company" {{ old('category') === 'Company' ? 'selected' : '' }}>Company</option>
                            <option value="Processes" {{ old('category') === 'Processes' ? 'selected' : '' }}>Processes</option>
                            <option value="Social Media" {{ old('category') === 'Social Media' ? 'selected' : '' }}>Social Media</option>
                            <option value="Tips & Tricks" {{ old('category') === 'Tips & Tricks' ? 'selected' : '' }}>Tips & Tricks</option>
                        </select>
                    </div>
                    @error('category')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-2">
                <div>
                    <label for="image" class="block text-sm font-semibold text-slate-700">Upload Cover Image</label>
                    <div class="mt-1.5">
                        <input type="file" name="image" id="image" accept="image/*"
                            class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-teal-50 file:text-[#008080] hover:file:bg-teal-100 border border-slate-200 rounded-lg p-1.5 bg-slate-50">
                    </div>
                    @error('image')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="image_url" class="block text-sm font-semibold text-slate-700">Or Cover Image URL</label>
                    <div class="mt-1.5">
                        <input type="text" name="image_url" id="image_url" value="{{ old('image_url') }}" placeholder="e.g. images/blog_custom.png"
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm transition-all">
                    </div>
                    @error('image_url')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="published_at" class="block text-sm font-semibold text-slate-700">Publication Date <span class="text-slate-400 font-normal">(Optional)</span></label>
                    <div class="mt-1.5">
                        <input type="datetime-local" name="published_at" id="published_at" value="{{ old('published_at') }}"
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm transition-all">
                    </div>
                    <p class="mt-1 text-xs text-slate-400">Leave blank to publish immediately.</p>
                    @error('published_at')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="excerpt" class="block text-sm font-semibold text-slate-700">Article Excerpt (Summary)</label>
                <div class="mt-1.5">
                    <textarea rows="3" name="excerpt" id="excerpt" required placeholder="Provide a short, engaging description to display on the homepage blog card grid (recommended 150-200 characters)..."
                        class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm transition-all">{{ old('excerpt') }}</textarea>
                </div>
                @error('excerpt')
                    <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="content" class="block text-sm font-semibold text-slate-700">Full Article Content (HTML allowed)</label>
                <div class="mt-1.5">
                    <textarea rows="10" name="content" id="content" required placeholder="Write the main body of the article here. HTML tags like <p>, <strong>, <ul>, and <li> are supported for rich formatting."
                        class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm transition-all">{{ old('content') }}</textarea>
                </div>
                @error('content')
                    <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                @enderror
            </div>

            <!-- SEO Settings Group -->
            <div class="space-y-4 pt-4 border-t border-slate-200">
                <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wider flex items-center">
                    <svg class="h-4 w-4 mr-2 text-[#008080]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    SEO Metadata Settings
                </h4>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="sm:col-span-2">
                        <label for="meta_title" class="block text-sm font-semibold text-slate-700">Meta Title <span class="text-slate-400 font-normal">(Optional)</span></label>
                        <div class="mt-1.5">
                            <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title') }}" placeholder="e.g. Integrated Design & Construction | Construction 360"
                                class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm transition-all">
                        </div>
                        <p class="mt-1 text-xs text-slate-400">The title tag shown in search engine results (recommended: 50-60 characters).</p>
                        @error('meta_title')
                            <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="meta_keywords" class="block text-sm font-semibold text-slate-700">Meta Keywords / Tags <span class="text-slate-400 font-normal">(Optional)</span></label>
                        <div class="mt-1.5">
                            <input type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords') }}" placeholder="e.g. design build, structural planning, construction, Essex"
                                class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm transition-all">
                        </div>
                        <p class="mt-1 text-xs text-slate-400">Comma-separated tags or keywords for search engine indexing.</p>
                        @error('meta_keywords')
                            <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="meta_description" class="block text-sm font-semibold text-slate-700">Meta Description <span class="text-slate-400 font-normal">(Optional)</span></label>
                        <div class="mt-1.5">
                            <textarea rows="3" name="meta_description" id="meta_description" placeholder="A short description summarizing the article for search results (recommended: 150-160 characters)..."
                                class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm transition-all">{{ old('meta_description') }}</textarea>
                        </div>
                        @error('meta_description')
                            <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end space-x-3 pt-6 border-t border-slate-200">
                <a href="{{ route('admin.blogs.index') }}" class="px-4 py-2 border border-slate-200 text-sm font-semibold text-slate-700 rounded-lg hover:bg-slate-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-5 py-2 text-sm font-bold text-white bg-[#008080] hover:bg-[#006666] rounded-lg shadow-sm transition-colors">
                    Create Blog Post
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
