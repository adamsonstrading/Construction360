@extends('layouts.admin')

@section('title', 'Edit Service')
@section('page_title', 'Edit Service')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white border border-slate-200 shadow-sm rounded-xl overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-200">
            <h3 class="text-lg font-bold text-slate-900">Modify Service Details</h3>
            <p class="mt-1 text-sm text-slate-500">Update the service title, description, display ordering, or icon representation.</p>
        </div>

        <form action="{{ route('admin.services.update', $service->id) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')

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
                <label for="description" class="block text-sm font-semibold text-slate-700">Description</label>
                <div class="mt-1.5">
                    <textarea rows="4" name="description" id="description" required
                        class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm">{{ old('description', $service->description) }}</textarea>
                </div>
                @error('description')
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
