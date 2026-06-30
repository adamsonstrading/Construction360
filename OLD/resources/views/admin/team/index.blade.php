@extends('layouts.admin')

@section('title', 'Team Members CRUD')
@section('page_title', 'Team Members Manager')

@section('content')
<div class="space-y-6">
    <!-- Header Page Actions -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h3 class="text-lg font-bold text-slate-900 font-sans">Active Team Members</h3>
            <p class="text-sm text-slate-500 mt-1">Manage the core team members displayed on the public landing page.</p>
        </div>
        <a href="{{ route('admin.team.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-[#008080] hover:bg-[#006666] rounded-lg shadow-sm transition-colors">
            <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Add Team Member
        </a>
    </div>

    <!-- Alert Message -->
    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-850 p-4 rounded-xl text-sm flex items-start">
            <svg class="mr-2.5 h-5 w-5 text-emerald-600 flex-shrink-0 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Listing Table -->
    <div class="bg-white border border-slate-200 shadow-sm rounded-xl overflow-hidden">
        @if($team->isEmpty())
            <div class="text-center py-16">
                <svg class="mx-auto h-12 w-12 text-slate-350" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.109A11.386 11.386 0 0110.089 20c-2.202 0-4.254-.622-6.002-1.701V18.17a4.125 4.125 0 015.24-3.793M15 11.622a5.25 5.25 0 11-6.75-6.75m6.75 6.75a5.25 5.25 0 01-6.75-6.75m3.75 1.5H9" />
                </svg>
                <h3 class="mt-4 text-sm font-semibold text-slate-900">No team members found</h3>
                <p class="mt-1 text-xs text-slate-500">Get started by adding your first team member.</p>
            </div>
        @else
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider w-20">Avatar</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Name & Role</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Accreditations</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider w-28">Order</th>
                        <th class="relative px-6 py-3.5 text-right">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    @foreach($team as $item)
                        @php
                            $words = explode(' ', trim($item->name));
                            $initials = strtoupper(substr($words[0] ?? 'T', 0, 1) . (isset($words[1]) ? substr($words[1], 0, 1) : ''));
                        @endphp
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="h-10 w-10 rounded-full overflow-hidden border border-slate-200 bg-slate-950 flex items-center justify-center text-teal-400 font-bold shadow-inner">
                                    @if($item->image_url)
                                        <img src="{{ asset($item->image_url) }}" alt="{{ $item->name }}" class="object-cover h-full w-full">
                                    @else
                                        <span class="text-xs">{{ $initials }}</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="max-w-xs sm:max-w-sm">
                                    <span class="text-sm font-semibold text-slate-900 block truncate">{{ $item->name }}</span>
                                    <span class="text-xs text-[#008080] font-bold block mt-0.5">{{ $item->role }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1">
                                    @foreach(explode(',', $item->accreditations ?? '') as $badge)
                                        @if(trim($badge))
                                            <span class="text-[9px] font-bold uppercase tracking-wider text-slate-600 bg-slate-100 px-2 py-0.5 rounded border border-slate-200">{{ trim($badge) }}</span>
                                        @endif
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                {{ $item->display_order }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-semibold space-x-3">
                                <a href="{{ route('admin.team.edit', $item->id) }}" class="text-[#008080] hover:text-[#006666] transition-colors">
                                    Edit
                                </a>
                                <form action="{{ route('admin.team.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to remove this team member?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-650 hover:text-red-800 transition-colors focus:outline-none">
                                        Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
