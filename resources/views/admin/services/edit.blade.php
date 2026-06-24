@extends('layouts.admin')

@section('title', 'Edit Service')
@section('page_title', 'Edit Service')

@section('content')
@php
    // Pad why_choose_us to 4 items
    $whyChooseUs = $service->why_choose_us ?? [];
    while (count($whyChooseUs) < 4) {
        $whyChooseUs[] = ['title' => '', 'desc' => ''];
    }

    // Pad services_offered to 4 items. services_offered is an associative array in DB.
    $servicesOffered = [];
    if (!empty($service->services_offered)) {
        foreach ($service->services_offered as $title => $desc) {
            $servicesOffered[] = ['title' => $title, 'desc' => $desc];
        }
    }
    while (count($servicesOffered) < 4) {
        $servicesOffered[] = ['title' => '', 'desc' => ''];
    }

    // Pad faqs to 4 items
    $faqs = $service->faqs ?? [];
    while (count($faqs) < 4) {
        $faqs[] = ['q' => '', 'a' => ''];
    }
@endphp

<div class="max-w-4xl mx-auto">
    <div class="bg-white border border-slate-200 shadow-sm rounded-xl overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-200">
            <h3 class="text-lg font-bold text-slate-900">Modify Service Details</h3>
            <p class="mt-1 text-sm text-slate-500">Update the service information, descriptions, custom images, sub-services, and FAQs.</p>
        </div>

        <form action="{{ route('admin.services.update', $service->id) }}" method="POST" class="p-6 space-y-8">
            @csrf
            @method('PUT')

            <!-- Section 1: Basic Information -->
            <div class="space-y-6">
                <h4 class="text-sm font-bold text-slate-800 uppercase tracking-wider border-b border-slate-100 pb-2">Basic Info</h4>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="title" class="block text-sm font-semibold text-slate-700">Service Title</label>
                        <div class="mt-1.5">
                            <input type="text" name="title" id="title" value="{{ old('title', $service->title) }}" required
                                class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm">
                        </div>
                        @error('title')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="image_url" class="block text-sm font-semibold text-slate-700">Custom Image URL</label>
                        <div class="mt-1.5">
                            <input type="text" name="image_url" id="image_url" value="{{ old('image_url', $service->getRawOriginal('image_url')) }}" placeholder="e.g. images/service_custom.png (Leave blank for default dynamic image)"
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
                        <textarea rows="3" name="description" id="description" required
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm">{{ old('description', $service->description) }}</textarea>
                    </div>
                    @error('description')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="about" class="block text-sm font-semibold text-slate-700">Detailed About Copy (Service Detail Page)</label>
                    <div class="mt-1.5">
                        <textarea rows="4" name="about" id="about" placeholder="Provide a detailed about description for this service detail page..."
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm">{{ old('about', $service->about) }}</textarea>
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
                                <option value="building-office-2" {{ old('icon', $service->icon) === 'building-office-2' ? 'selected' : '' }}>Office Building (Commercial)</option>
                                <option value="academic-cap" {{ old('icon', $service->icon) === 'academic-cap' ? 'selected' : '' }}>Academic Cap (Structural Design)</option>
                                <option value="globe-alt" {{ old('icon', $service->icon) === 'globe-alt' ? 'selected' : '' }}>Globe (Civil Infrastructure)</option>
                                <option value="square-3-stack-3d" {{ old('icon', $service->icon) === 'square-3-stack-3d' ? 'selected' : '' }}>3D Stack (Management 360)</option>
                            </select>
                        </div>
                        @error('icon')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="display_order" class="block text-sm font-semibold text-slate-700">Display Order</label>
                        <div class="mt-1.5">
                            <input type="number" name="display_order" id="display_order" value="{{ old('display_order', $service->display_order) }}" min="0" required
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
                    <h4 class="text-sm font-bold text-slate-800 uppercase tracking-wider">Specialist Sub-Services (Scopes & Deliverables)</h4>
                    <span class="text-xs text-slate-500 font-medium">Exactly 4 items</span>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach ($servicesOffered as $index => $item)
                        <div class="bg-slate-50/50 p-4 border border-slate-200 rounded-xl space-y-3">
                            <span class="text-xs font-bold text-slate-400">Sub-Service #{{ $index + 1 }}</span>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600">Title</label>
                                <input type="text" name="services_offered[{{ $index }}][title]" value="{{ old('services_offered.'.$index.'.title', $item['title']) }}"
                                    class="block w-full mt-1 px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600">Description</label>
                                <textarea rows="2" name="services_offered[{{ $index }}][desc]"
                                    class="block w-full mt-1 px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">{{ old('services_offered.'.$index.'.desc', $item['desc']) }}</textarea>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Section 3: Why Choose Us -->
            <div class="space-y-6 pt-4 border-t border-slate-100">
                <div class="flex items-center justify-between border-b border-slate-100 pb-2">
                    <h4 class="text-sm font-bold text-slate-800 uppercase tracking-wider">Why Choose Us Cards</h4>
                    <span class="text-xs text-slate-500 font-medium">Exactly 4 items</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach ($whyChooseUs as $index => $item)
                        <div class="bg-slate-50/50 p-4 border border-slate-200 rounded-xl space-y-3">
                            <span class="text-xs font-bold text-slate-400">Card #{{ $index + 1 }}</span>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600">Title</label>
                                <input type="text" name="why_choose_us[{{ $index }}][title]" value="{{ old('why_choose_us.'.$index.'.title', $item['title']) }}"
                                    class="block w-full mt-1 px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600">Description</label>
                                <textarea rows="2" name="why_choose_us[{{ $index }}][desc]"
                                    class="block w-full mt-1 px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">{{ old('why_choose_us.'.$index.'.desc', $item['desc']) }}</textarea>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Section 4: FAQs -->
            <div class="space-y-6 pt-4 border-t border-slate-100">
                <div class="flex items-center justify-between border-b border-slate-100 pb-2">
                    <h4 class="text-sm font-bold text-slate-800 uppercase tracking-wider">Frequently Asked Questions</h4>
                    <span class="text-xs text-slate-500 font-medium">Exactly 4 items</span>
                </div>

                <div class="space-y-4">
                    @foreach ($faqs as $index => $item)
                        <div class="bg-slate-50/50 p-4 border border-slate-200 rounded-xl space-y-3">
                            <span class="text-xs font-bold text-slate-400 font-mono">FAQ #{{ $index + 1 }}</span>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600">Question</label>
                                <input type="text" name="faqs[{{ $index }}][q]" value="{{ old('faqs.'.$index.'.q', $item['q']) }}"
                                    class="block w-full mt-1 px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600">Answer</label>
                                <textarea rows="2" name="faqs[{{ $index }}][a]"
                                    class="block w-full mt-1 px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-xs">{{ old('faqs.'.$index.'.a', $item['a']) }}</textarea>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="flex items-center justify-end space-x-3 pt-6 border-t border-slate-200">
                <a href="{{ route('admin.services.index') }}" class="px-4 py-2 border border-slate-200 text-sm font-semibold text-slate-700 rounded-lg hover:bg-slate-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-5 py-2 text-sm font-bold text-white bg-[#008080] hover:bg-[#006666] rounded-lg shadow-sm transition-colors">
                    Update Service
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
