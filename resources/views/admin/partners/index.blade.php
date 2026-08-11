@extends('layouts.admin')

@section('title', 'Partners CRUD')
@section('page_title', 'Trusted Partners Manager')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h3 class="text-lg font-bold text-slate-900 font-sans">Trusted Partners</h3>
            <p class="text-sm text-slate-500 mt-1">Manage accreditation and partner logos shown on the homepage.</p>
        </div>
        <a href="{{ route('admin.partners.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-[#36a1b3] hover:bg-[#2c8493] rounded-lg shadow-sm transition-colors">
            <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Add Partner
        </a>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-850 p-4 rounded-xl text-sm flex items-start">
            <svg class="mr-2.5 h-5 w-5 text-emerald-600 flex-shrink-0 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white border border-slate-200 shadow-sm rounded-xl overflow-hidden">
        @if($partners->isEmpty())
            <div class="text-center py-16">
                <h3 class="mt-4 text-sm font-semibold text-slate-900">No partners found</h3>
                <p class="mt-1 text-xs text-slate-500">Get started by adding your first partner logo.</p>
            </div>
        @else
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider w-28">Logo</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider w-28">Order</th>
                        <th class="relative px-6 py-3.5 text-right">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    @foreach($partners as $item)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="h-12 w-20 rounded-lg overflow-hidden border border-slate-200 bg-white flex items-center justify-center p-1.5">
                                    @if($item->image_url)
                                        <img src="{{ asset($item->image_url) }}" alt="{{ $item->name }}" class="max-h-full max-w-full object-contain">
                                    @else
                                        <span class="text-[10px] text-slate-400">No logo</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-semibold text-slate-900 block truncate">{{ $item->name }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                {{ $item->display_order }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-semibold space-x-3">
                                <a href="{{ route('admin.partners.edit', $item->id) }}" class="text-[#36a1b3] hover:text-[#2c8493] transition-colors">
                                    Edit
                                </a>
                                <form action="{{ route('admin.partners.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to remove this partner?');">
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
