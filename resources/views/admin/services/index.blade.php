@extends('layouts.admin')

@section('title', 'Service Grid CRUD')
@section('page_title', 'Service Grid Manager')

@section('content')
<div class="space-y-6">
    <!-- Header Page Actions -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h3 class="text-lg font-bold text-slate-900 font-sans">Active Public Services</h3>
            <p class="text-sm text-slate-500 mt-1">Manage the services displayed on the public landing page services grid.</p>
        </div>
        <a href="{{ route('admin.services.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-[#008080] hover:bg-[#006666] rounded-lg shadow-sm transition-colors">
            <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Add New Service
        </a>
    </div>

    <!-- Listing Table -->
    <div class="bg-white border border-slate-200 shadow-sm rounded-xl overflow-hidden">
        @if($services->isEmpty())
            <div class="text-center py-16">
                <svg class="mx-auto h-12 w-12 text-slate-350" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766l.002-.001a1.56 1.56 0 011.83 1.83c-.14.468-.382.89-.766 1.207l-3.03 2.496zm-7.494-.001c-.496-.496-.496-1.3 0-1.796l8.502-8.502a1.27 1.27 0 011.797 0L19.121 9.8c.496.496.496 1.3 0 1.796l-8.502 8.502a1.27 1.27 0 01-1.796 0L3.926 15.17z" />
                </svg>
                <h3 class="mt-4 text-sm font-semibold text-slate-900">No services created</h3>
                <p class="mt-1 text-xs text-slate-500">Get started by creating your first construction service card.</p>
            </div>
        @else
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider w-16">Icon</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Service Title</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider w-28">Order</th>
                        <th class="relative px-6 py-3.5 text-right">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    @foreach($services as $item)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="h-10 w-10 rounded-lg bg-teal-50 border border-teal-100 flex items-center justify-center text-[#008080]">
                                    @if($item->icon === 'academic-cap')
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.263 15.918a9.008 9.008 0 0015.474 0M12 2.25l-9.75 4.5 9.75 4.5 9.75-4.5-9.75-4.5zM3 13.5v3.375c0 .621.504 1.125 1.125 1.125h15.75c.621 0 1.125-.504 1.125-1.125V13.5" /></svg>
                                    @elseif($item->icon === 'building-office-2')
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 16.5h1.5m3 0H15" /></svg>
                                    @elseif($item->icon === 'globe-alt')
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-.778.099-1.533.284-2.253" /></svg>
                                    @elseif($item->icon === 'square-3-stack-3d')
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75L2.25 12l4.179 2.25m11.142 0L21.75 12l-4.179-2.25M12 5.25L16.179 7.5 12 9.75 7.821 7.5 12 5.25zm0 9l4.179 2.25L12 18.75l-4.179-2.25 4.179-2.25zm0-4.5l4.179 2.25L12 14.25l-4.179-2.25 4.179-2.25z" /></svg>
                                    @else
                                        <!-- Fallback generic mechanical/wrench icon -->
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766l.002-.001a1.56 1.56 0 011.83 1.83c-.14.468-.382.89-.766 1.207l-3.03 2.496zm-7.494-.001c-.496-.496-.496-1.3 0-1.796l8.502-8.502a1.27 1.27 0 011.797 0L19.121 9.8c.496.496.496 1.3 0 1.796l-8.502 8.502a1.27 1.27 0 01-1.796 0L3.926 15.17z" /></svg>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-semibold text-slate-900">{{ $item->title }}</span>
                                <span class="text-xs text-slate-400 block mt-0.5">ID: #{{ $item->id }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-slate-650 line-clamp-2 max-w-lg leading-relaxed">{{ $item->description }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-slate-100 text-slate-800 border border-slate-200">
                                    {{ $item->display_order }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-semibold space-x-3">
                                <a href="{{ route('admin.services.edit', $item->id) }}" class="text-[#008080] hover:text-[#006666] transition-colors">
                                    Edit
                                </a>
                                <form action="{{ route('admin.services.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to permanently delete this service?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-650 hover:text-red-800 transition-colors focus:outline-none">
                                        Delete
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
