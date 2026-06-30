@extends('layouts.admin')

@section('title', 'Add Team Member')
@section('page_title', 'Add Team Member')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white border border-slate-200 shadow-sm rounded-xl overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-200 bg-slate-50">
            <h3 class="text-lg font-bold text-slate-900 font-sans">New Team Member Profile</h3>
            <p class="mt-1 text-sm text-slate-500">Add a new professional member to the operational leadership block on the homepage.</p>
        </div>

        <form action="{{ route('admin.team.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-semibold text-slate-700">Full Name</label>
                    <div class="mt-1.5">
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="e.g. William Vance"
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm transition-all">
                    </div>
                    @error('name')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="role" class="block text-sm font-semibold text-slate-700">Role / Position</label>
                    <div class="mt-1.5">
                        <input type="text" name="role" id="role" value="{{ old('role') }}" required placeholder="e.g. Managing Director, Lead Engineer"
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm transition-all">
                    </div>
                    @error('role')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>

                <div class="sm:col-span-2">
                    <label for="accreditations" class="block text-sm font-semibold text-slate-700">Accreditations <span class="text-slate-400 font-normal">(Comma-separated)</span></label>
                    <div class="mt-1.5">
                        <input type="text" name="accreditations" id="accreditations" value="{{ old('accreditations') }}" placeholder="e.g. CSCS Black Card, RICS Affiliate, IStructE Member"
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm transition-all">
                    </div>
                    <p class="mt-1 text-xs text-slate-400">Specify multiple qualifications separated by commas (e.g. MSc Civil Eng, CSCS Card).</p>
                    @error('accreditations')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="display_order" class="block text-sm font-semibold text-slate-700">Display Order</label>
                    <div class="mt-1.5">
                        <input type="number" name="display_order" id="display_order" value="{{ old('display_order', 0) }}" required
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm transition-all">
                    </div>
                    <p class="mt-1 text-xs text-slate-400">Controls ordering. Lower values display first.</p>
                    @error('display_order')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-2">
                <div>
                    <label for="image" class="block text-sm font-semibold text-slate-700">Upload Photo</label>
                    <div class="mt-1.5">
                        <input type="file" name="image" id="image" accept="image/*"
                            class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-teal-50 file:text-[#008080] hover:file:bg-teal-100 border border-slate-200 rounded-lg p-1.5 bg-slate-50">
                    </div>
                    @error('image')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="image_url" class="block text-sm font-semibold text-slate-700">Or Photo Path / URL</label>
                    <div class="mt-1.5">
                        <input type="text" name="image_url" id="image_url" value="{{ old('image_url') }}" placeholder="e.g. images/team_custom.png"
                            class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm transition-all">
                    </div>
                    @error('image_url')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="description" class="block text-sm font-semibold text-slate-700">Bio / Description</label>
                <div class="mt-1.5">
                    <textarea rows="4" name="description" id="description" placeholder="Provide a brief background description of this team member's site capabilities and qualifications..."
                        class="block w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-transparent text-sm transition-all">{{ old('description') }}</textarea>
                </div>
                @error('description')
                    <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end space-x-3 pt-6 border-t border-slate-200">
                <a href="{{ route('admin.team.index') }}" class="px-4 py-2 border border-slate-200 text-sm font-semibold text-slate-700 rounded-lg hover:bg-slate-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-5 py-2 text-sm font-bold text-white bg-[#008080] hover:bg-[#006666] rounded-lg shadow-sm transition-colors">
                    Add Member
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
