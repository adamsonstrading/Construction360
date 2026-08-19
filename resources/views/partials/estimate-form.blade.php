{{-- Linx-style Fast & Free Project Estimates form --}}
    @php
    $selectClass = 'est-select w-full rounded-xl border border-black/10 bg-[#fafafa] pl-4 pr-10 py-3.5 text-sm text-[#1a1a1a] focus:outline-none focus:border-brand focus:ring-1 focus:ring-brand focus:bg-white appearance-none cursor-pointer transition-colors';
    $inputClass = 'w-full rounded-xl border border-black/10 bg-[#fafafa] px-4 py-3.5 text-sm text-[#1a1a1a] placeholder:text-[#9ca3af] focus:outline-none focus:border-brand focus:ring-1 focus:ring-brand focus:bg-white transition-colors';
    $estEmail = $content['header_email'] ?? 'info@construction360.co';
    $estPhone = $content['header_phone'] ?? '+442039309629';
    $estPhoneDisplay = $content['header_phone_display'] ?? ($content['header_phone'] ?? '0203 930 9629');
    $estAddress = $content['contact_address'] ?? '73 Thrale Road, London, England, SW16 1NU';
    $estMapUrl = $content['contact_map_url'] ?? 'https://www.google.com/maps/search/?api=1&query=73+Thrale+Road,+London,+England,+SW16+1NU';
@endphp

<section id="enquiry" class="relative bg-white py-16 lg:py-24 scroll-mt-24 overflow-hidden">
    <div class="pointer-events-none absolute inset-0 bg-brand/5"></div>
    <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-0 items-stretch rounded-[2rem] overflow-hidden shadow-[0_30px_80px_-40px_rgba(54, 161, 179,0.35)] border border-black/[0.04]">
            <div class="lg:col-span-4 bg-brand text-white p-8 lg:p-10 flex flex-col justify-between gap-8">
                <div class="space-y-4">
                    <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-white/70">
                        {{ $content['estimate_eyebrow'] ?? 'Get started today' }}
                    </p>
                    <h2 class="font-heading text-3xl sm:text-4xl font-medium tracking-tight leading-tight">
                        {{ $content['estimate_title'] ?? 'Fast & free project estimates' }}
                    </h2>
                    <p class="text-sm text-white/75 leading-relaxed">
                        {{ $content['estimate_subtitle'] ?? "Tell us about your project and we'll be in touch shortly to discuss your requirements and suggest your first steps." }}
                    </p>
                </div>
                <ul class="space-y-4 text-sm text-white/90">
                    <li>
                        <a href="mailto:{{ $estEmail }}" class="group flex items-start gap-3 hover:text-white transition-colors">
                            <span class="mt-0.5 inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-white/10 text-[#f0d778]">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                            </span>
                            <span>
                                <span class="block text-[10px] uppercase tracking-[0.16em] text-white/60 mb-0.5">Email</span>
                                {{ $estEmail }}
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="tel:{{ $estPhone }}" class="group flex items-start gap-3 hover:text-white transition-colors">
                            <span class="mt-0.5 inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-white/10 text-[#f0d778]">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.824-1.802-5.14-4.118-6.942-6.942l1.293-.97c.362-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v1.5z"/></svg>
                            </span>
                            <span>
                                <span class="block text-[10px] uppercase tracking-[0.16em] text-white/60 mb-0.5">Phone</span>
                                {{ $estPhoneDisplay }}
                                <span class="block text-xs text-white/55 mt-0.5">Mon–Fri, 9am–6pm</span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ $estMapUrl }}" target="_blank" rel="noopener noreferrer" class="group flex items-start gap-3 hover:text-white transition-colors">
                            <span class="mt-0.5 inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-white/10 text-[#f0d778]">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                            </span>
                            <span>
                                <span class="block text-[10px] uppercase tracking-[0.16em] text-white/60 mb-0.5">Office</span>
                                {{ $estAddress }}
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="lg:col-span-8 bg-[#f8fbfc] p-6 sm:p-8 lg:p-10">
        <form action="{{ route('contact.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="est-first-name" class="sr-only">First name</label>
                    <input type="text" name="first_name" id="est-first-name" required placeholder="First name"
                        value="{{ old('first_name') }}" class="{{ $inputClass }}">
                </div>
                <div>
                    <label for="est-last-name" class="sr-only">Last name</label>
                    <input type="text" name="last_name" id="est-last-name" required placeholder="Last name"
                        value="{{ old('last_name') }}" class="{{ $inputClass }}">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="est-email" class="sr-only">Email</label>
                    <input type="email" name="email" id="est-email" required placeholder="Email"
                        value="{{ old('email') }}" class="{{ $inputClass }}">
                </div>
                <div>
                    <label for="est-phone" class="sr-only">Phone number</label>
                    <input type="tel" name="phone" id="est-phone" placeholder="Phone number"
                        value="{{ old('phone') }}" class="{{ $inputClass }}">
                </div>
            </div>

            <div class="relative">
                <label for="est-service" class="sr-only">Select services</label>
                <select name="service" id="est-service" class="{{ $selectClass }}">
                    <option value="" disabled {{ old('service') ? '' : 'selected' }}>Select services...</option>
                    @forelse(($services ?? collect()) as $srv)
                        <option value="{{ $srv->title }}" @selected(old('service') === $srv->title)>{{ $srv->title }}</option>
                    @empty
                        <option value="Extension">Extension</option>
                        <option value="Loft conversion">Loft conversion</option>
                        <option value="Renovation">Renovation</option>
                        <option value="New build">New build</option>
                        <option value="Commercial fit-out">Commercial fit-out</option>
                        <option value="Full design & build">Full design & build</option>
                    @endforelse
                </select>
                <span class="est-select-icon" aria-hidden="true">
                    <svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.17l3.71-3.94a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/></svg>
                </span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="relative">
                    <label for="est-start" class="sr-only">When to start</label>
                    <select name="start_when" id="est-start" class="{{ $selectClass }}">
                        <option value="" disabled {{ old('start_when') ? '' : 'selected' }}>When to start?</option>
                        <option value="ASAP" @selected(old('start_when') === 'ASAP')>ASAP</option>
                        <option value="1–3 months" @selected(old('start_when') === '1–3 months')>1–3 months</option>
                        <option value="3–6 months" @selected(old('start_when') === '3–6 months')>3–6 months</option>
                        <option value="6+ months" @selected(old('start_when') === '6+ months')>6+ months</option>
                        <option value="Just exploring" @selected(old('start_when') === 'Just exploring')>Just exploring</option>
                    </select>
                    <span class="est-select-icon" aria-hidden="true">
                        <svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.17l3.71-3.94a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/></svg>
                    </span>
                </div>
                <div class="relative">
                    <label for="est-budget" class="sr-only">Approx. budget</label>
                    <select name="budget" id="est-budget" class="{{ $selectClass }}">
                        <option value="" disabled {{ old('budget') ? '' : 'selected' }}>Approx. budget</option>
                        <option value="Under £50k" @selected(old('budget') === 'Under £50k')>Under £50k</option>
                        <option value="£50k–£150k" @selected(old('budget') === '£50k–£150k')>£50k–£150k</option>
                        <option value="£150k–£500k" @selected(old('budget') === '£150k–£500k')>£150k–£500k</option>
                        <option value="£500k+" @selected(old('budget') === '£500k+')>£500k+</option>
                        <option value="Prefer not to say" @selected(old('budget') === 'Prefer not to say')>Prefer not to say</option>
                    </select>
                    <span class="est-select-icon" aria-hidden="true">
                        <svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.17l3.71-3.94a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/></svg>
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="relative">
                    <label for="est-call-day" class="sr-only">Best day to call</label>
                    <select name="call_day" id="est-call-day" required class="{{ $selectClass }}">
                        <option value="" disabled {{ old('call_day') ? '' : 'selected' }}>Best day to call *</option>
                        <option value="Monday" @selected(old('call_day') === 'Monday')>Monday</option>
                        <option value="Tuesday" @selected(old('call_day') === 'Tuesday')>Tuesday</option>
                        <option value="Wednesday" @selected(old('call_day') === 'Wednesday')>Wednesday</option>
                        <option value="Thursday" @selected(old('call_day') === 'Thursday')>Thursday</option>
                        <option value="Friday" @selected(old('call_day') === 'Friday')>Friday</option>
                        <option value="Any weekday" @selected(old('call_day') === 'Any weekday')>Any weekday</option>
                    </select>
                    <span class="est-select-icon" aria-hidden="true">
                        <svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.17l3.71-3.94a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/></svg>
                    </span>
                </div>
                <div class="relative">
                    <label for="est-call-time" class="sr-only">Best time to call</label>
                    <select name="call_time" id="est-call-time" required class="{{ $selectClass }}">
                        <option value="" disabled {{ old('call_time') ? '' : 'selected' }}>Best time to call *</option>
                        <option value="Morning (9–12)" @selected(old('call_time') === 'Morning (9–12)')>Morning (9–12)</option>
                        <option value="Afternoon (12–5)" @selected(old('call_time') === 'Afternoon (12–5)')>Afternoon (12–5)</option>
                        <option value="Evening (5–7)" @selected(old('call_time') === 'Evening (5–7)')>Evening (5–7)</option>
                        <option value="Any time" @selected(old('call_time') === 'Any time')>Any time</option>
                    </select>
                    <span class="est-select-icon" aria-hidden="true">
                        <svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.17l3.71-3.94a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/></svg>
                    </span>
                </div>
            </div>

            <div>
                <label for="est-message" class="sr-only">Briefly describe your project</label>
                <textarea name="message" id="est-message" rows="5" required placeholder="Briefly describe your project"
                    class="{{ $inputClass }} resize-y">{{ old('message') }}</textarea>
            </div>

            <div class="flex flex-wrap items-center gap-3 pt-1">
                <label class="inline-flex items-center gap-2 rounded-md border border-black/10 bg-white px-4 py-2.5 text-sm text-[#1a1a1a] cursor-pointer hover:border-brand/40 transition-colors">
                    <svg class="h-4 w-4 text-[#6b7280]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                    </svg>
                    <span>Upload Files (Optional)</span>
                    <input type="file" name="attachments[]" multiple accept=".pdf,.jpg,.jpeg,.png,.doc,.docx,.webp" class="sr-only" onchange="document.getElementById('est-file-label').textContent = this.files.length ? (this.files.length + ' file(s) chosen') : 'No files chosen'">
                </label>
                <span id="est-file-label" class="text-sm text-[#9ca3af]">No files chosen</span>
            </div>

            @if($errors->any())
                <div class="rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="pt-2">
                <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-full bg-brand hover:bg-brand-dark text-white px-8 py-3.5 text-sm font-semibold uppercase tracking-[0.08em] transition-colors shadow-sm">
                    Send <span aria-hidden="true">→</span>
                </button>
            </div>
        </form>
            </div>
        </div>
    </div>
</section>
