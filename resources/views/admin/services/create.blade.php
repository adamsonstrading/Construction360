@extends('layouts.admin')

@section('title', 'Add New Service')
@section('page_title', 'Add New Service')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white border border-slate-200 shadow-sm rounded-xl overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-200">
            <h3 class="text-lg font-bold text-slate-900">New Service Card</h3>
            <p class="mt-1 text-sm text-slate-500">Provide details for the new construction or engineering service card.</p>
        </div>

        <form action="{{ route('admin.services.store') }}" method="POST" class="p-6 space-y-8">
            @csrf

            <!-- Section 1: Basic Information -->
            <div class="space-y-6">
                <h4 class="text-sm font-bold text-slate-800 uppercase tracking-wider border-b border-slate-100 pb-2">Basic Info</h4>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="title" class="block text-sm font-semibold text-slate-700">Service Title</label>
                        <div class="mt-1.5">
                            <input type="text" name="title" id="title" value="{{ old('title') }}" required placeholder="e.g. Structural Engineering & Drafting"
                                class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm">
                        </div>
                        @error('title')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="image_url" class="block text-sm font-semibold text-slate-700">Custom Image URL</label>
                        <div class="mt-1.5">
                            <input type="text" name="image_url" id="image_url" value="{{ old('image_url') }}" placeholder="e.g. images/service_custom.png (Leave blank for default dynamic image)"
                                class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm">
                        </div>
                        @error('image_url')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-sm font-semibold text-slate-700">Short Card Description</label>
                    <div class="mt-1.5">
                        <textarea rows="3" name="description" id="description" required placeholder="Describe the service scope, methodologies, and engineering deliverables..."
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm">{{ old('description') }}</textarea>
                    </div>
                    @error('description')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="about" class="block text-sm font-semibold text-slate-700">Detailed About Copy (Service Detail Page)</label>
                    <div class="mt-1.5">
                        <textarea rows="4" name="about" id="about" placeholder="Provide a detailed about description for this service detail page..."
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm">{{ old('about') }}</textarea>
                    </div>
                    @error('about')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="icon" class="block text-sm font-semibold text-slate-700">Representative Icon</label>
                        <div class="mt-1.5">
                            <select name="icon" id="icon" required
                                class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm">
                                <option value="building-office-2" {{ old('icon') === 'building-office-2' ? 'selected' : '' }}>Office Building (Commercial)</option>
                                <option value="academic-cap" {{ old('icon') === 'academic-cap' ? 'selected' : '' }}>Academic Cap (Structural Design)</option>
                                <option value="globe-alt" {{ old('icon') === 'globe-alt' ? 'selected' : '' }}>Globe (Civil Infrastructure)</option>
                                <option value="square-3-stack-3d" {{ old('icon') === 'square-3-stack-3d' ? 'selected' : '' }}>3D Stack (Management 360)</option>
                            </select>
                        </div>
                        @error('icon')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="display_order" class="block text-sm font-semibold text-slate-700">Display Order</label>
                        <div class="mt-1.5">
                            <input type="number" name="display_order" id="display_order" value="{{ old('display_order', 0) }}" min="0" required
                                class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm">
                        </div>
                        @error('display_order')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Section 2: Specialist Sub-Services -->
            <div class="space-y-6 pt-4 border-t border-slate-100">
                <div class="flex items-center justify-between border-b border-slate-100 pb-2">
                    <div>
                        <h4 class="text-sm font-bold text-slate-800 uppercase tracking-wider">Specialist Sub-Services (Scopes & Deliverables)</h4>
                        <p class="text-xs text-slate-500 mt-0.5">Manage as many sub-services as needed. Empty entries will be skipped.</p>
                    </div>
                    <button type="button" id="add-sub-service-btn" class="px-3 py-1.5 text-xs font-semibold text-[#008080] bg-teal-50 hover:bg-teal-100 rounded-lg transition-colors flex items-center">
                        <svg class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        Add Sub-Service
                    </button>
                </div>
                
                <div id="sub-services-container" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @for ($index = 0; $index < 4; $index++)
                        <div class="bg-slate-50/50 p-4 border border-slate-200 rounded-xl space-y-3 relative sub-service-card">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-slate-400 card-index-label">Sub-Service #{{ $index + 1 }}</span>
                                <button type="button" class="text-red-500 hover:text-red-700 text-xs font-semibold remove-sub-service-btn">Remove</button>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600">Title</label>
                                <input type="text" name="services_offered[{{ $index }}][title]" value="{{ old('services_offered.'.$index.'.title') }}"
                                    class="block w-full mt-1 px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600">Description</label>
                                <textarea rows="2" name="services_offered[{{ $index }}][desc]"
                                    class="block w-full mt-1 px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">{{ old('services_offered.'.$index.'.desc') }}</textarea>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Section 3: Why Choose Us -->
            <div class="space-y-6 pt-4 border-t border-slate-100">
                <div class="flex items-center justify-between border-b border-slate-100 pb-2">
                    <h4 class="text-sm font-bold text-slate-800 uppercase tracking-wider">Why Choose Us Cards</h4>
                    <span class="text-xs text-slate-500 font-medium">Exactly 4 items</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @for ($index = 0; $index < 4; $index++)
                        <div class="bg-slate-50/50 p-4 border border-slate-200 rounded-xl space-y-3">
                            <span class="text-xs font-bold text-slate-400">Card #{{ $index + 1 }}</span>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600">Title</label>
                                <input type="text" name="why_choose_us[{{ $index }}][title]" value="{{ old('why_choose_us.'.$index.'.title') }}"
                                    class="block w-full mt-1 px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600">Description</label>
                                <textarea rows="2" name="why_choose_us[{{ $index }}][desc]"
                                    class="block w-full mt-1 px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">{{ old('why_choose_us.'.$index.'.desc') }}</textarea>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Section 4: FAQs -->
            <div class="space-y-6 pt-4 border-t border-slate-100">
                <div class="flex items-center justify-between border-b border-slate-100 pb-2">
                    <h4 class="text-sm font-bold text-slate-800 uppercase tracking-wider">Frequently Asked Questions</h4>
                    <span class="text-xs text-slate-500 font-medium">Exactly 4 items</span>
                </div>

                <div class="space-y-4">
                    @for ($index = 0; $index < 4; $index++)
                        <div class="bg-slate-50/50 p-4 border border-slate-200 rounded-xl space-y-3">
                            <span class="text-xs font-bold text-slate-400 font-mono">FAQ #{{ $index + 1 }}</span>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600">Question</label>
                                <input type="text" name="faqs[{{ $index }}][q]" value="{{ old('faqs.'.$index.'.q') }}"
                                    class="block w-full mt-1 px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600">Answer</label>
                                <textarea rows="2" name="faqs[{{ $index }}][a]"
                                    class="block w-full mt-1 px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">{{ old('faqs.'.$index.'.a') }}</textarea>
                            </div>
                        </div>
                    @endfor
                </div>
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
                            <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title') }}" placeholder="e.g. Architectural Planning Services | Construction 360"
                                class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm transition-all">
                        </div>
                        @error('meta_title')
                            <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="meta_keywords" class="block text-sm font-semibold text-slate-700">Meta Keywords <span class="text-slate-400 font-normal">(Optional)</span></label>
                        <div class="mt-1.5">
                            <input type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords') }}" placeholder="e.g. architectural drawings, planning applications, planning consultancy"
                                class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm transition-all">
                        </div>
                        @error('meta_keywords')
                            <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="meta_description" class="block text-sm font-semibold text-slate-700">Meta Description <span class="text-slate-400 font-normal">(Optional)</span></label>
                        <div class="mt-1.5">
                            <textarea rows="3" name="meta_description" id="meta_description" placeholder="A brief summary of the service for search results..."
                                class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm transition-all">{{ old('meta_description') }}</textarea>
                        </div>
                        @error('meta_description')
                            <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end space-x-3 pt-6 border-t border-slate-200">
                <a href="{{ route('admin.services.index') }}" class="px-4 py-2 border border-slate-200 text-sm font-semibold text-slate-700 rounded-lg hover:bg-slate-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-5 py-2 text-sm font-bold text-white bg-[#008080] hover:bg-[#006666] rounded-lg shadow-sm transition-colors">
                    Create Service
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('sub-services-container');
    const addBtn = document.getElementById('add-sub-service-btn');
    
    if (addBtn && container) {
        addBtn.addEventListener('click', function () {
            const cards = container.querySelectorAll('.sub-service-card');
            const newIndex = cards.length;
            
            const cardHtml = `
                <div class="bg-slate-50/50 p-4 border border-slate-200 rounded-xl space-y-3 relative sub-service-card">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-400 card-index-label">Sub-Service #\${newIndex + 1}</span>
                        <button type="button" class="text-red-500 hover:text-red-700 text-xs font-semibold remove-sub-service-btn">Remove</button>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-600">Title</label>
                        <input type="text" name="services_offered[\${newIndex}][title]" value=""
                            class="block w-full mt-1 px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-600">Description</label>
                        <textarea rows="2" name="services_offered[\${newIndex}][desc]"
                            class="block w-full mt-1 px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs"></textarea>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', cardHtml);
            reindexSubServices();
        });
        
        container.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-sub-service-btn')) {
                const card = e.target.closest('.sub-service-card');
                if (card) {
                    card.remove();
                    reindexSubServices();
                }
            }
        });
        
        function reindexSubServices() {
            const cards = container.querySelectorAll('.sub-service-card');
            cards.forEach((card, idx) => {
                const label = card.querySelector('.card-index-label');
                if (label) label.textContent = `Sub-Service #\${idx + 1}`;
                
                const titleInput = card.querySelector('input[type="text"]');
                if (titleInput) titleInput.name = `services_offered[\${idx}][title]`;
                
                const descTextarea = card.querySelector('textarea');
                if (descTextarea) descTextarea.name = `services_offered[\${idx}][desc]`;
            });
        }
    }
});
</script>
@endsection
