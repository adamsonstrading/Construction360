@extends('layouts.admin')

@section('title', 'Incoming Inquiries')
@section('page_title', 'Incoming Inquiries')

@section('content')
<div class="space-y-6">
    <!-- Status Filter Tabs -->
    <div class="border-b border-slate-200">
        <nav class="-mb-px flex space-x-6" aria-label="Tabs">
            <a href="{{ route('admin.queries.index') }}" 
               class="pb-4 px-1 border-b-2 font-semibold text-sm transition-colors {{ is_null($status) ? 'border-[#008080] text-[#008080]' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-350' }}">
                All Inquiries
            </a>
            <a href="{{ route('admin.queries.index', ['status' => 'new']) }}" 
               class="pb-4 px-1 border-b-2 font-semibold text-sm transition-colors {{ $status === 'new' ? 'border-[#008080] text-[#008080]' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-350' }}">
                New
            </a>
            <a href="{{ route('admin.queries.index', ['status' => 'reviewed']) }}" 
               class="pb-4 px-1 border-b-2 font-semibold text-sm transition-colors {{ $status === 'reviewed' ? 'border-[#008080] text-[#008080]' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-350' }}">
                Reviewed
            </a>
            <a href="{{ route('admin.queries.index', ['status' => 'archived']) }}" 
               class="pb-4 px-1 border-b-2 font-semibold text-sm transition-colors {{ $status === 'archived' ? 'border-[#008080] text-[#008080]' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-350' }}">
                Archived
            </a>
        </nav>
    </div>

    <!-- Data Table Card -->
    <div class="bg-white border border-slate-200 shadow-sm rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            @if($queries->isEmpty())
                <div class="text-center py-16">
                    <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 13.5h3.86a2.25 2.25 0 012.008 1.24l.885 1.77a2.25 2.25 0 002.007 1.24h1.98a2.25 2.25 0 002.007-1.24l.885-1.77a2.25 2.25 0 012.007-1.24h3.86m-18 0h18M2.25 9h18.75M2.25 5.25h18.75" />
                    </svg>
                    <h3 class="mt-4 text-sm font-semibold text-slate-900">No matching inquiries</h3>
                    <p class="mt-1 text-xs text-slate-500">No customer query records match the selected status.</p>
                </div>
            @else
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Contact</th>
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Subject</th>
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Received At</th>
                            <th class="relative px-6 py-3.5 text-right">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        @foreach($queries as $item)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-semibold text-slate-900">{{ $item->name }}</span>
                                        <span class="text-xs text-slate-400">{{ $item->email }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-slate-700 truncate block max-w-xs md:max-w-md">{{ $item->subject ?? 'Project Inquiry' }}</span>
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
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-semibold">
                                    <button type="button" 
                                            class="view-details-btn text-[#008080] hover:text-[#006666] transition-colors focus:outline-none"
                                            data-id="{{ $item->id }}"
                                            data-name="{{ $item->name }}"
                                            data-email="{{ $item->email }}"
                                            data-subject="{{ $item->subject ?? 'Project Inquiry' }}"
                                            data-message="{{ $item->message }}"
                                            data-status="{{ $item->status }}"
                                            data-date="{{ $item->created_at->format('F d, Y \a\t H:i') }}"
                                            data-update-url="{{ route('admin.queries.updateStatus', $item->id) }}">
                                        View Details
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        
        <!-- Pagination -->
        @if($queries->hasPages())
            <div class="px-6 py-4 border-t border-slate-200">
                {{ $queries->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Inquiry View Details Modal -->
<div id="query-modal" class="hidden fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4">
    <!-- Backdrop overlay -->
    <div id="modal-backdrop" class="fixed inset-0 bg-slate-900 bg-opacity-70 transition-opacity"></div>
    
    <!-- Modal panel -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-2xl w-full max-w-2xl overflow-hidden relative z-10 transition-transform">
        <!-- Header -->
        <div class="px-6 py-5 border-b border-slate-200 bg-slate-50 flex items-center justify-between">
            <div>
                <h3 class="text-lg font-bold text-slate-900" id="modal-title-subject">Project Specifications</h3>
                <p class="text-xs text-slate-400 mt-1" id="modal-date-received"></p>
            </div>
            <button type="button" id="close-modal-btn" class="text-slate-400 hover:text-slate-600 focus:outline-none">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <!-- Content Body -->
        <div class="p-6 space-y-5">
            <!-- Contact Row -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <h4 class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Client Name</h4>
                    <p class="mt-1 text-sm font-bold text-slate-800" id="modal-client-name"></p>
                </div>
                <div>
                    <h4 class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Client Email</h4>
                    <p class="mt-1 text-sm text-[#008080] font-medium" id="modal-client-email"></p>
                </div>
            </div>
            
            <!-- Message Content -->
            <div>
                <h4 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Message Description</h4>
                <div class="bg-slate-50 border border-slate-200 rounded-lg p-4 text-sm text-slate-800 leading-relaxed max-h-72 overflow-y-auto whitespace-pre-wrap font-sans" id="modal-client-message"></div>
            </div>
        </div>

        <!-- Footer Actions Form -->
        <div class="px-6 py-4 bg-slate-50 border-t border-slate-250 flex flex-col sm:flex-row items-center justify-between gap-3">
            <!-- Current status badge -->
            <div>
                <span class="text-xs text-slate-400 mr-2 font-medium">Status:</span>
                <span id="modal-status-badge" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold"></span>
            </div>
            
            <!-- Action buttons -->
            <form id="modal-status-form" method="POST" class="flex space-x-2 w-full sm:w-auto justify-end">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" id="modal-status-input" value="">
                
                <button type="button" id="mark-reviewed-btn" class="hidden px-4 py-2 text-xs font-bold text-white bg-[#008080] hover:bg-[#006666] rounded-lg shadow-sm transition-colors">
                    Mark as Reviewed
                </button>
                <button type="button" id="mark-archived-btn" class="hidden px-4 py-2 text-xs font-bold text-slate-700 bg-white border border-slate-200 hover:bg-slate-50 rounded-lg shadow-sm transition-colors">
                    Archive Inquiry
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('query-modal');
        const backdrop = document.getElementById('modal-backdrop');
        const closeBtn = document.getElementById('close-modal-btn');
        
        const subTitle = document.getElementById('modal-title-subject');
        const dateReceived = document.getElementById('modal-date-received');
        const clientName = document.getElementById('modal-client-name');
        const clientEmail = document.getElementById('modal-client-email');
        const clientMessage = document.getElementById('modal-client-message');
        const statusBadge = document.getElementById('modal-status-badge');
        
        const form = document.getElementById('modal-status-form');
        const statusInput = document.getElementById('modal-status-input');
        const reviewBtn = document.getElementById('mark-reviewed-btn');
        const archiveBtn = document.getElementById('mark-archived-btn');

        // Open Modal handler
        document.querySelectorAll('.view-details-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                const name = this.dataset.name;
                const email = this.dataset.email;
                const subject = this.dataset.subject;
                const message = this.dataset.message;
                const status = this.dataset.status;
                const date = this.dataset.date;
                const updateUrl = this.dataset.updateUrl;

                // Set values
                subTitle.textContent = subject;
                dateReceived.textContent = "Received " + date;
                clientName.textContent = name;
                clientEmail.textContent = email;
                clientMessage.textContent = message;
                
                form.action = updateUrl;

                // Reset Status Badge classes
                statusBadge.className = "inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold";
                if (status === 'new') {
                    statusBadge.textContent = 'New';
                    statusBadge.classList.add('bg-amber-50', 'text-[#F59E0B]', 'border', 'border-amber-200');
                    
                    reviewBtn.classList.remove('hidden');
                    archiveBtn.classList.remove('hidden');
                } else if (status === 'reviewed') {
                    statusBadge.textContent = 'Reviewed';
                    statusBadge.classList.add('bg-teal-50', 'text-[#008080]', 'border', 'border-teal-200');
                    
                    reviewBtn.classList.add('hidden');
                    archiveBtn.classList.remove('hidden');
                } else {
                    statusBadge.textContent = 'Archived';
                    statusBadge.classList.add('bg-slate-50', 'text-slate-500', 'border', 'border-slate-200');
                    
                    reviewBtn.classList.remove('hidden');
                    reviewBtn.textContent = 'Reopen Inquiry';
                    archiveBtn.classList.add('hidden');
                }

                // Show modal
                modal.classList.remove('hidden');
            });
        });

        // Close Modal handler
        function closeModal() {
            modal.classList.add('hidden');
        }

        closeBtn.addEventListener('click', closeModal);
        backdrop.addEventListener('click', closeModal);

        // Form Submission handlers
        reviewBtn.addEventListener('click', function() {
            const currentText = reviewBtn.textContent.trim();
            if (currentText === 'Reopen Inquiry') {
                statusInput.value = 'new';
            } else {
                statusInput.value = 'reviewed';
            }
            form.submit();
        });

        archiveBtn.addEventListener('click', function() {
            statusInput.value = 'archived';
            form.submit();
        });
    });
</script>
@endsection
