{{-- Partial: Team Section & Leadership Profiles --}}
<div class="space-y-8">
    <div class="border-b border-slate-200 pb-4">
        <h4 class="text-base font-bold text-slate-800 flex items-center">
            <svg class="h-5 w-5 text-[#36a1b3] mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            Leadership & Core Team Members
        </h4>
        <p class="text-xs text-slate-500 mt-1">Configure section headings and detailed bio cards for the key leaders and project directors showcased on the website.</p>
    </div>

    <!-- Team Section Headers -->
    <div class="space-y-4">
        <h5 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Section Intro & Headings</h5>
        <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="team_section_label" class="block text-xs font-semibold text-slate-700">Section Label (Mini Tag)</label>
                    <input type="text" name="team_section_label" id="team_section_label" 
                        value="{{ old('team_section_label', $content['team_section_label'] ?? 'Leadership') }}" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">
                    @error('team_section_label')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="team_section_title" class="block text-xs font-semibold text-slate-700">Section Title</label>
                    <input type="text" name="team_section_title" id="team_section_title" 
                        value="{{ old('team_section_title', $content['team_section_title'] ?? 'Meet the Experts Behind Our Success') }}" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">
                    @error('team_section_title')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div>
                <label for="team_section_subtitle" class="block text-xs font-semibold text-slate-700">Section Subtitle / Description</label>
                <textarea rows="2" name="team_section_subtitle" id="team_section_subtitle" required
                    class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">{{ old('team_section_subtitle', $content['team_section_subtitle'] ?? 'Our dedicated multidisciplinary leadership combines decades of technical engineering, structural expertise, and hands-on site management.') }}</textarea>
                @error('team_section_subtitle')
                    <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <!-- Team Members Cards -->
    <div class="space-y-4">
        <h5 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Featured Team Member Profiles</h5>
        
        <div class="space-y-5">
            <!-- Member 1 -->
            <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
                <div class="flex items-center space-x-2 border-b border-slate-200 pb-2">
                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-[#36a1b3] text-white font-bold text-xs">1</span>
                    <span class="text-xs font-bold text-slate-800 uppercase tracking-wide">Primary Lead / Director</span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="team_member_1_name" class="block text-xs font-semibold text-slate-700">Full Name</label>
                        <input type="text" name="team_member_1_name" id="team_member_1_name" 
                            value="{{ old('team_member_1_name', $content['team_member_1_name'] ?? '') }}" required
                            class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">
                        @error('team_member_1_name')
                            <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="team_member_1_role" class="block text-xs font-semibold text-slate-700">Role / Job Title</label>
                        <input type="text" name="team_member_1_role" id="team_member_1_role" 
                            value="{{ old('team_member_1_role', $content['team_member_1_role'] ?? '') }}" required
                            class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">
                        @error('team_member_1_role')
                            <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="team_member_1_description" class="block text-xs font-semibold text-slate-700">Biography / Overview</label>
                    <textarea rows="2" name="team_member_1_description" id="team_member_1_description" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">{{ old('team_member_1_description', $content['team_member_1_description'] ?? '') }}</textarea>
                    @error('team_member_1_description')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="team_member_1_accreditations" class="block text-xs font-semibold text-slate-700">Accreditations / Credentials (Comma separated)</label>
                    <input type="text" name="team_member_1_accreditations" id="team_member_1_accreditations" 
                        value="{{ old('team_member_1_accreditations', $content['team_member_1_accreditations'] ?? '') }}" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">
                    <p class="mt-1 text-[10px] text-slate-400">Example: CSCS Black Card, CIOB Chartered Member</p>
                    @error('team_member_1_accreditations')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Member 2 -->
            <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
                <div class="flex items-center space-x-2 border-b border-slate-200 pb-2">
                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-[#36a1b3] text-white font-bold text-xs">2</span>
                    <span class="text-xs font-bold text-slate-800 uppercase tracking-wide">Operations / Engineering Lead</span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="team_member_2_name" class="block text-xs font-semibold text-slate-700">Full Name</label>
                        <input type="text" name="team_member_2_name" id="team_member_2_name" 
                            value="{{ old('team_member_2_name', $content['team_member_2_name'] ?? '') }}" required
                            class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">
                        @error('team_member_2_name')
                            <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="team_member_2_role" class="block text-xs font-semibold text-slate-700">Role / Job Title</label>
                        <input type="text" name="team_member_2_role" id="team_member_2_role" 
                            value="{{ old('team_member_2_role', $content['team_member_2_role'] ?? '') }}" required
                            class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">
                        @error('team_member_2_role')
                            <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="team_member_2_description" class="block text-xs font-semibold text-slate-700">Biography / Overview</label>
                    <textarea rows="2" name="team_member_2_description" id="team_member_2_description" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">{{ old('team_member_2_description', $content['team_member_2_description'] ?? '') }}</textarea>
                    @error('team_member_2_description')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="team_member_2_accreditations" class="block text-xs font-semibold text-slate-700">Accreditations / Credentials (Comma separated)</label>
                    <input type="text" name="team_member_2_accreditations" id="team_member_2_accreditations" 
                        value="{{ old('team_member_2_accreditations', $content['team_member_2_accreditations'] ?? '') }}" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">
                    <p class="mt-1 text-[10px] text-slate-400">Example: IStructE Member, MSc Civil Eng</p>
                    @error('team_member_2_accreditations')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Member 3 -->
            <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
                <div class="flex items-center space-x-2 border-b border-slate-200 pb-2">
                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-[#36a1b3] text-white font-bold text-xs">3</span>
                    <span class="text-xs font-bold text-slate-800 uppercase tracking-wide">Commercial & Compliance Lead</span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="team_member_3_name" class="block text-xs font-semibold text-slate-700">Full Name</label>
                        <input type="text" name="team_member_3_name" id="team_member_3_name" 
                            value="{{ old('team_member_3_name', $content['team_member_3_name'] ?? '') }}" required
                            class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">
                        @error('team_member_3_name')
                            <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="team_member_3_role" class="block text-xs font-semibold text-slate-700">Role / Job Title</label>
                        <input type="text" name="team_member_3_role" id="team_member_3_role" 
                            value="{{ old('team_member_3_role', $content['team_member_3_role'] ?? '') }}" required
                            class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">
                        @error('team_member_3_role')
                            <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="team_member_3_description" class="block text-xs font-semibold text-slate-700">Biography / Overview</label>
                    <textarea rows="2" name="team_member_3_description" id="team_member_3_description" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">{{ old('team_member_3_description', $content['team_member_3_description'] ?? '') }}</textarea>
                    @error('team_member_3_description')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="team_member_3_accreditations" class="block text-xs font-semibold text-slate-700">Accreditations / Credentials (Comma separated)</label>
                    <input type="text" name="team_member_3_accreditations" id="team_member_3_accreditations" 
                        value="{{ old('team_member_3_accreditations', $content['team_member_3_accreditations'] ?? '') }}" required
                        class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#36a1b3] focus:border-transparent text-xs">
                    <p class="mt-1 text-[10px] text-slate-400">Example: RICS Certified, NEBOSH Diploma</p>
                    @error('team_member_3_accreditations')
                        <p class="mt-1 text-xs text-red-650">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>
