@extends('layouts.admin')

@section('title', 'Add Partner')
@section('page_title', 'Add Partner')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white border border-slate-200 shadow-sm rounded-xl overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-200 bg-slate-50">
            <h3 class="text-lg font-bold text-slate-900 font-sans">New Trusted Partner</h3>
            <p class="mt-1 text-sm text-slate-500">Add a partner or accreditation logo to the homepage grid.</p>
        </div>

        <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="sm:col-span-2">
                    <label for="name" class="block text-sm font-semibold text-slate-700">Partner Name</label>
                    <div class="mt-1.5">
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="e.g. CHAS"
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-sm transition-all">
                    </div>
                    @error('name')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="display_order" class="block text-sm font-semibold text-slate-700">Display Order</label>
                    <div class="mt-1.5">
                        <input type="number" name="display_order" id="display_order" value="{{ old('display_order', 0) }}" required
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-sm transition-all">
                    </div>
                    <p class="mt-1 text-xs text-slate-400">Lower values display first.</p>
                    @error('display_order')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-2">
                <div>
                    <label for="image" class="block text-sm font-semibold text-slate-700">Upload Logo</label>
                    <div class="mt-1.5">
                        <input type="file" name="image" id="image" accept="image/*"
                            class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-teal-50 file:text-[#36a1b3] hover:file:bg-teal-100 border border-slate-200 rounded-lg p-1.5 bg-slate-50">
                    </div>
                    @error('image')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="image_url" class="block text-sm font-semibold text-slate-700">Or Logo Path / URL</label>
                    <div class="mt-1.5">
                        <input type="text" name="image_url" id="image_url" value="{{ old('image_url') }}" placeholder="e.g. images/partners/chas.png"
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-sm transition-all">
                    </div>
                    @error('image_url')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center justify-end space-x-3 pt-6 border-t border-slate-200">
                <a href="{{ route('admin.partners.index') }}" class="px-4 py-2 border border-slate-200 text-sm font-semibold text-slate-700 rounded-lg hover:bg-slate-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-5 py-2 text-sm font-bold text-white bg-[#36a1b3] hover:bg-[#2c8493] rounded-lg shadow-sm transition-colors">
                    Add Partner
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
