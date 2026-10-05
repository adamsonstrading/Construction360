@extends('layouts.admin')

@section('title', 'Site Content Manager - ' . ($sections[$activeSection]['name'] ?? 'Configuration'))
@section('page_title', 'Site Content Manager')

@section('content')
<div class="space-y-6">
    <!-- Top Header & Breadcrumb -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-2 border-b border-slate-200">
        <div>
            <div class="flex items-center space-x-2 text-xs font-semibold text-slate-500 mb-1">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-slate-800 transition-colors">Admin</a>
                <span>/</span>
                <span class="text-[#36a1b3]">Content CMS</span>
                <span>/</span>
                <span class="text-slate-800">{{ $sections[$activeSection]['name'] ?? 'Section' }}</span>
            </div>
            <h2 class="text-2xl font-black text-slate-900 tracking-tight flex items-center gap-2">
                <span>Site Content Configuration</span>
                <span class="text-xs font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-[#36a1b3]/10 text-[#36a1b3] border border-[#36a1b3]/20">
                    {{ $sections[$activeSection]['name'] ?? 'Active' }}
                </span>
            </h2>
            <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Manage live website copy, hero headers, media, legal disclaimers, and interactive workflows in modular isolated screens.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ url('/') }}" target="_blank" class="inline-flex items-center px-3.5 py-2 text-xs font-bold text-slate-700 bg-white border border-slate-200 rounded-lg shadow-sm hover:bg-slate-50 hover:text-slate-900 transition-colors">
                <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                </svg>
                View Public Site
            </a>
        </div>
    </div>

    <!-- Layout Grid: Left Section Navigation Pills + Right Active Section Content Form -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Left Column: Section Screens Navigation (Desktop Sidebar / Mobile Scroller) -->
        <aside class="lg:col-span-4 xl:col-span-3 space-y-3 lg:sticky lg:top-4">
            <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-3 overflow-hidden">
                <div class="px-3 py-2 border-b border-slate-100 flex items-center justify-between mb-2">
                    <span class="text-xs font-black uppercase tracking-wider text-slate-400">Content Sections</span>
                    <span class="text-[11px] font-bold text-slate-400">9 Modules</span>
                </div>

                <nav class="space-y-1.5" aria-label="Content Sections">
                    @foreach($sections as $slug => $sec)
                        @php
                            $isActive = ($activeSection === $slug);
                        @endphp
                        <a href="{{ route('admin.content.edit', ['section' => $slug]) }}" 
                           class="group flex items-start p-3 rounded-lg text-left transition-all duration-150 {{ $isActive ? 'bg-[#36a1b3] text-white shadow-md shadow-[#36a1b3]/20 ring-1 ring-[#36a1b3]' : 'text-slate-700 hover:bg-slate-50 hover:text-slate-900 border border-transparent' }}"
                           data-section-link="{{ $slug }}">
                            <div class="flex-shrink-0 mr-3 mt-0.5">
                                @if($slug === 'general')
                                    <svg class="w-5 h-5 {{ $isActive ? 'text-white' : 'text-[#36a1b3] group-hover:text-slate-900' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                @elseif($slug === 'seo')
                                    <svg class="w-5 h-5 {{ $isActive ? 'text-white' : 'text-[#36a1b3] group-hover:text-slate-900' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                @elseif($slug === 'hero')
                                    <svg class="w-5 h-5 {{ $isActive ? 'text-white' : 'text-[#36a1b3] group-hover:text-slate-900' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456z" />
                                    </svg>
                                @elseif($slug === 'homepage')
                                    <svg class="w-5 h-5 {{ $isActive ? 'text-white' : 'text-[#36a1b3] group-hover:text-slate-900' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                                    </svg>
                                @elseif($slug === 'about')
                                    <svg class="w-5 h-5 {{ $isActive ? 'text-white' : 'text-[#36a1b3] group-hover:text-slate-900' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                    </svg>
                                @elseif($slug === 'assurances')
                                    <svg class="w-5 h-5 {{ $isActive ? 'text-white' : 'text-[#36a1b3] group-hover:text-slate-900' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                                    </svg>
                                @elseif($slug === 'contact')
                                    <svg class="w-5 h-5 {{ $isActive ? 'text-white' : 'text-[#36a1b3] group-hover:text-slate-900' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.824-1.802-5.14-4.118-6.942-6.942l1.293-.97c.362-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v1.5z" />
                                    </svg>
                                @elseif($slug === 'team')
                                    <svg class="w-5 h-5 {{ $isActive ? 'text-white' : 'text-[#36a1b3] group-hover:text-slate-900' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                @elseif($slug === 'subpages')
                                    <svg class="w-5 h-5 {{ $isActive ? 'text-white' : 'text-[#36a1b3] group-hover:text-slate-900' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-bold truncate {{ $isActive ? 'text-white' : 'text-slate-800 group-hover:text-slate-900' }}">
                                        {{ $sec['name'] }}
                                    </span>
                                    @if($isActive)
                                        <span class="inline-block w-1.5 h-1.5 rounded-full bg-white ml-2"></span>
                                    @endif
                                </div>
                                <p class="text-[11px] truncate mt-0.5 {{ $isActive ? 'text-white/80' : 'text-slate-500' }}">
                                    {{ $sec['desc'] }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </nav>

                <div class="mt-4 pt-3 border-t border-slate-100 px-2">
                    <p class="text-[11px] text-slate-400 leading-tight">
                        <strong class="text-slate-600">Tip:</strong> Each screen saves independently. You do not need to fill other sections to save changes here.
                    </p>
                </div>
            </div>
        </aside>

        <!-- Right Column: Active Partial Screen Form -->
        <main class="lg:col-span-8 xl:col-span-9">
            <div class="bg-white border border-slate-200 shadow-sm rounded-xl overflow-hidden">
                <!-- Section Form Top Banner -->
                <div class="px-6 py-5 border-b border-slate-200 bg-slate-50/70 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div>
                        <span class="text-[11px] font-black tracking-wider text-[#36a1b3] uppercase">Section Screen</span>
                        <h3 class="text-lg font-bold text-slate-900">{{ $sections[$activeSection]['name'] ?? 'Section Editor' }}</h3>
                        <p class="text-xs text-slate-500 mt-0.5">{{ $sections[$activeSection]['desc'] ?? '' }}</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                            Live Sync Ready
                        </span>
                    </div>
                </div>

                @if (isset($errors) && $errors->any())
                    <div class="m-6 mb-0 p-4 rounded-xl bg-red-50 border border-red-200 text-sm text-red-800">
                        <div class="flex items-center space-x-2 font-bold text-red-900 mb-1">
                            <svg class="w-5 h-5 text-red-650" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <span>Please review the errors below ({{ $errors->count() }} found):</span>
                        </div>
                        <ul class="list-disc list-inside text-xs text-red-700 space-y-0.5 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Active Form -->
                <form id="content-section-form" action="{{ route('admin.content.update') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-8">
                    @csrf
                    <input type="hidden" name="section" value="{{ $activeSection }}">

                    <!-- Dynamically Injected Screen Partial -->
                    @if(view()->exists('admin.content.partials.' . $activeSection))
                        @include('admin.content.partials.' . $activeSection)
                    @else
                        <div class="p-8 text-center text-slate-500">
                            <p class="text-sm font-semibold">Partial template for <code>{{ $activeSection }}</code> not found.</p>
                        </div>
                    @endif

                    <!-- Sticky or Clean Action Footer -->
                    <div class="pt-6 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="text-xs text-slate-500 text-center sm:text-left">
                            Editing: <strong class="text-slate-700">{{ $sections[$activeSection]['name'] ?? '' }}</strong>
                        </div>
                        <div class="flex items-center space-x-3 w-full sm:w-auto justify-end">
                            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 text-xs font-semibold text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors shadow-sm">
                                Cancel
                            </a>
                            <button type="submit" id="save-section-btn" class="px-5 py-2 text-xs font-bold text-white bg-[#36a1b3] hover:bg-[#2c8493] rounded-lg shadow-sm transition-all duration-150 flex items-center justify-center space-x-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Save {{ $sections[$activeSection]['name'] ?? 'Changes' }}</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('content-section-form');
    const saveBtn = document.getElementById('save-section-btn');
    const sectionName = "{{ $sections[$activeSection]['name'] ?? 'Section' }}";

    let formDirty = false;
    if (form) {
        form.addEventListener('input', function() {
            formDirty = true;
        });

        // Intercept section links if form has unsaved modifications
        document.querySelectorAll('a[data-section-link]').forEach(link => {
            link.addEventListener('click', function(e) {
                if (formDirty && !this.classList.contains('bg-[#36a1b3]')) {
                    e.preventDefault();
                    const targetUrl = this.href;
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: 'Unsaved Changes',
                            text: 'You have unsaved changes in ' + sectionName + '. Discard and switch section?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#94a3b8',
                            confirmButtonText: 'Discard & Switch',
                            cancelButtonText: 'Stay Here'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                formDirty = false;
                                window.location.href = targetUrl;
                            }
                        });
                    } else {
                        if (confirm('You have unsaved changes. Discard and switch section?')) {
                            formDirty = false;
                            window.location.href = targetUrl;
                        }
                    }
                }
            });
        });

        // SweetAlert confirmation on Save Button
        if (saveBtn) {
            saveBtn.addEventListener('click', function (e) {
                if (typeof Swal !== 'undefined') {
                    e.preventDefault();
                    
                    // Native HTML5 form validation check first
                    if (!form.checkValidity()) {
                        form.reportValidity();
                        return;
                    }

                    Swal.fire({
                        title: 'Save ' + sectionName + '?',
                        text: 'Updates will instantly reflect on the public website.',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#36a1b3',
                        cancelButtonColor: '#94a3b8',
                        confirmButtonText: 'Yes, Save Changes',
                        cancelButtonText: 'Review More'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            formDirty = false;
                            form.submit();
                        }
                    });
                }
            });
        }
    }
});
</script>
@endsection
