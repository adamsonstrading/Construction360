@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'System Overview')

@section('content')
<div class="space-y-8">
    <!-- Top Stats Grid -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <!-- Card: Total Inquiries -->
        <div class="bg-white overflow-hidden shadow-sm border border-slate-200 rounded-xl hover:shadow-md transition-shadow">
            <div class="p-6 flex items-center">
                <div class="p-3 rounded-lg bg-teal-50 text-[#008080]">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                    </svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-slate-500 truncate">Total Inquiries Received</dt>
                        <dd class="flex items-baseline">
                            <div class="text-3xl font-bold text-slate-900">{{ $totalLeads }}</div>
                        </dd>
                    </dl>
                </div>
            </div>
            <div class="bg-slate-50 px-6 py-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <a href="{{ route('admin.queries.index') }}" class="font-semibold text-[#008080] hover:text-[#006666] transition-colors">
                    View inbox
                </a>
                <span class="text-slate-400">All submissions</span>
            </div>
        </div>

        <!-- Card: Pending Review -->
        <div class="bg-white overflow-hidden shadow-sm border border-slate-200 rounded-xl hover:shadow-md transition-shadow">
            <div class="p-6 flex items-center">
                <div class="p-3 rounded-lg {{ $pendingLeads > 0 ? 'bg-amber-50 text-[#F59E0B]' : 'bg-slate-50 text-slate-400' }}">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-slate-500 truncate">Pending Review</dt>
                        <dd class="flex items-baseline">
                            <div class="text-3xl font-bold {{ $pendingLeads > 0 ? 'text-[#F59E0B]' : 'text-slate-900' }}">{{ $pendingLeads }}</div>
                        </dd>
                    </dl>
                </div>
            </div>
            <div class="bg-slate-50 px-6 py-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <a href="{{ route('admin.queries.index', ['status' => 'new']) }}" class="font-semibold text-[#008080] hover:text-[#006666] transition-colors">
                    Filter pending
                </a>
                <span class="text-slate-400">Requires attention</span>
            </div>
        </div>

        <!-- Card: Total Active Services -->
        <div class="bg-white overflow-hidden shadow-sm border border-slate-200 rounded-xl hover:shadow-md transition-shadow">
            <div class="p-6 flex items-center">
                <div class="p-3 rounded-lg bg-slate-100 text-slate-700">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766l.002-.001a1.56 1.56 0 011.83 1.83c-.14.468-.382.89-.766 1.207l-3.03 2.496zm-7.494-.001c-.496-.496-.496-1.3 0-1.796l8.502-8.502a1.27 1.27 0 011.797 0L19.121 9.8c.496.496.496 1.3 0 1.796l-8.502 8.502a1.27 1.27 0 01-1.796 0L3.926 15.17z" />
                    </svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-slate-500 truncate">Total Active Services</dt>
                        <dd class="flex items-baseline">
                            <div class="text-3xl font-bold text-slate-900">{{ $totalServices }}</div>
                        </dd>
                    </dl>
                </div>
            </div>
            <div class="bg-slate-50 px-6 py-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <a href="{{ route('admin.services.index') }}" class="font-semibold text-[#008080] hover:text-[#006666] transition-colors">
                    Manage service grid
                </a>
                <span class="text-slate-400">On public site</span>
            </div>
        </div>
    </div>

    <!-- Recent Activity Table -->
    <div class="bg-white border border-slate-200 shadow-sm rounded-xl overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-200 flex items-center justify-between">
            <div>
                <h3 class="text-lg font-bold text-slate-900">Recent Customer Inquiries</h3>
                <p class="mt-1 text-sm text-slate-500">The most recent project inquiries routed electronically from the contact form.</p>
            </div>
            <a href="{{ route('admin.queries.index') }}" class="text-xs font-semibold text-[#008080] hover:text-[#006666] border border-slate-200 hover:border-[#008080] rounded-lg px-3 py-2 transition-all">
                View All Inquiries
            </a>
        </div>
        <div class="overflow-x-auto">
            @if($recentQueries->isEmpty())
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                    </svg>
                    <h3 class="mt-4 text-sm font-semibold text-slate-900">No inquiries yet</h3>
                    <p class="mt-1 text-xs text-slate-500">New leads submitted on the landing page will display here.</p>
                </div>
            @else
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Contact</th>
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Subject</th>
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Received At</th>
                            <th class="relative px-6 py-3.5">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        @foreach($recentQueries as $item)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-semibold text-slate-900">{{ $item->name }}</span>
                                        <span class="text-xs text-slate-400">{{ $item->email }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-slate-700 truncate block max-w-xs">{{ $item->subject ?? 'Project inquiry' }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($item->status === 'new')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-50 text-[#F59E0B] border border-amber-200">
                                            New
                                        </span>
                                    @elseif($item->status === 'reviewed')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-teal-50 text-[#008080] border border-teal-200">
                                            Reviewed
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-50 text-slate-500 border border-slate-200">
                                            Archived
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-400">
                                    {{ $item->created_at->format('M d, Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('admin.queries.index') }}" class="text-[#008080] hover:text-[#006666] font-semibold">
                                        Manage
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
