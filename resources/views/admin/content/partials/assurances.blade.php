{{-- Partial: Operational Assurances, Capabilities & Client Testimonials --}}
<div class="space-y-8">
    <div class="border-b border-slate-200 pb-4">
        <h4 class="text-base font-bold text-slate-800 flex items-center">
            <svg class="h-5 w-5 text-[#36a1b3] mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
            </svg>
            Operational Assurances, Capabilities & Client Testimonials
        </h4>
        <p class="text-xs text-slate-500 mt-1">Configure your corporate insurance guarantees, CSCS compliance, building control certifications, 4 differentiator cards, and verified client testimonials.</p>
    </div>

    <!-- 1. Operational Assurances & Guarantees -->
    <div class="space-y-4">
        <h5 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Operational Assurances & Guarantees</h5>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-2">
                <span class="text-xs font-bold text-[#36a1b3] uppercase">1. Insurance Cover</span>
                <div>
                    <label class="block text-[11px] font-semibold text-slate-600">Title</label>
                    <input type="text" name="insurance_title" value="{{ old('insurance_title', $content['insurance_title'] ?? 'Comprehensive Insurance') }}" required class="mt-0.5 block w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded text-xs font-bold">
                </div>
                <div>
                    <label class="block text-[11px] font-semibold text-slate-600">Details</label>
                    <textarea rows="4" name="insurance_text" required class="mt-0.5 block w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded text-xs leading-relaxed">{{ old('insurance_text', $content['insurance_text'] ?? '') }}</textarea>
                </div>
            </div>

            <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-2">
                <span class="text-xs font-bold text-[#36a1b3] uppercase">2. Building Control & Certificates</span>
                <div>
                    <label class="block text-[11px] font-semibold text-slate-600">Title</label>
                    <input type="text" name="certificates_title" value="{{ old('certificates_title', $content['certificates_title'] ?? 'Building Control & Certificates') }}" required class="mt-0.5 block w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded text-xs font-bold">
                </div>
                <div>
                    <label class="block text-[11px] font-semibold text-slate-600">Details</label>
                    <textarea rows="4" name="certificates_text" required class="mt-0.5 block w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded text-xs leading-relaxed">{{ old('certificates_text', $content['certificates_text'] ?? '') }}</textarea>
                </div>
            </div>

            <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-2">
                <span class="text-xs font-bold text-[#36a1b3] uppercase">3. CSCS Safety Compliance</span>
                <div>
                    <label class="block text-[11px] font-semibold text-slate-600">Title</label>
                    <input type="text" name="cscs_title" value="{{ old('cscs_title', $content['cscs_title'] ?? 'CSCS Compliance') }}" required class="mt-0.5 block w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded text-xs font-bold">
                </div>
                <div>
                    <label class="block text-[11px] font-semibold text-slate-600">Details</label>
                    <textarea rows="4" name="cscs_text" required class="mt-0.5 block w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded text-xs leading-relaxed">{{ old('cscs_text', $content['cscs_text'] ?? '') }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. Four Why Choose Us Capabilities -->
    <div class="space-y-4">
        <h5 class="text-xs font-bold text-slate-700 uppercase tracking-wider">4 Why Choose Us Capability Cards</h5>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
            @foreach([1, 2, 3, 4] as $idx)
                <div class="bg-white p-3.5 border border-slate-200 rounded-xl space-y-2">
                    <span class="text-[11px] font-bold text-[#36a1b3] uppercase">Card #{{ $idx }}</span>
                    <div>
                        <label class="block text-[10px] font-semibold text-slate-500">Card Title</label>
                        <input type="text" name="why_{{ $idx }}_title" value="{{ old('why_'.$idx.'_title', $content['why_'.$idx.'_title'] ?? '') }}" required class="mt-0.5 block w-full px-2 py-1 bg-slate-50 border border-slate-200 rounded text-xs font-bold">
                    </div>
                    <div>
                        <label class="block text-[10px] font-semibold text-slate-500">Card Text</label>
                        <textarea rows="3" name="why_{{ $idx }}_text" required class="mt-0.5 block w-full px-2 py-1 bg-slate-50 border border-slate-200 rounded text-xs">{{ old('why_'.$idx.'_text', $content['why_'.$idx.'_text'] ?? '') }}</textarea>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- 3. Client Testimonials -->
    <div class="space-y-4">
        <h5 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Client Testimonials & Endorsements</h5>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach([1, 2, 3] as $t)
                <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
                    <span class="text-xs font-bold text-[#36a1b3] uppercase">Testimonial #{{ $t }}</span>
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-600">Client Quote</label>
                        <textarea rows="3" name="testimonial_{{ $t }}_quote" required class="mt-0.5 block w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded text-xs italic">{{ old('testimonial_'.$t.'_quote', $content['testimonial_'.$t.'_quote'] ?? '') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-600">Author Name</label>
                        <input type="text" name="testimonial_{{ $t }}_author" value="{{ old('testimonial_'.$t.'_author', $content['testimonial_'.$t.'_author'] ?? '') }}" required class="mt-0.5 block w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded text-xs font-bold">
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-600">Client Role / Location</label>
                        <input type="text" name="testimonial_{{ $t }}_role" value="{{ old('testimonial_'.$t.'_role', $content['testimonial_'.$t.'_role'] ?? '') }}" required class="mt-0.5 block w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded text-xs">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
