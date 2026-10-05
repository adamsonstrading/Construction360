{{-- Partial: Homepage Sections & Process Workflow --}}
<div class="space-y-8">
    <div class="border-b border-slate-200 pb-4">
        <h4 class="text-base font-bold text-slate-800 flex items-center">
            <svg class="h-5 w-5 text-[#36a1b3] mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
            </svg>
            Homepage Sections, Interactive Process & Content Tickers
        </h4>
        <p class="text-xs text-slate-500 mt-1">Configure section labels, titles, process steps (Design & Build), industry sectors, action prompts, and running marquee copy.</p>
    </div>

    <!-- 1. Landing Page Section Headers -->
    <div class="space-y-4">
        <h5 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Main Section Headers & Eyebrows</h5>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-slate-50 p-3.5 border border-slate-200 rounded-xl space-y-2">
                <span class="text-xs font-bold text-[#36a1b3] uppercase">Services Section</span>
                <div>
                    <label class="block text-[11px] font-semibold text-slate-600">Label (Small Text)</label>
                    <input type="text" name="services_label" value="{{ old('services_label', $content['services_label'] ?? 'Marking Benchmarks') }}" required class="mt-0.5 block w-full px-3 py-1.5 bg-white border border-slate-200 rounded text-xs">
                </div>
                <div>
                    <label class="block text-[11px] font-semibold text-slate-600">Title</label>
                    <input type="text" name="services_title" value="{{ old('services_title', $content['services_title'] ?? 'Principle Contractor in construction') }}" required class="mt-0.5 block w-full px-3 py-1.5 bg-white border border-slate-200 rounded text-xs">
                </div>
            </div>

            <div class="bg-slate-50 p-3.5 border border-slate-200 rounded-xl space-y-2">
                <span class="text-xs font-bold text-[#36a1b3] uppercase">Projects Section</span>
                <div>
                    <label class="block text-[11px] font-semibold text-slate-600">Label (Small Text)</label>
                    <input type="text" name="projects_label" value="{{ old('projects_label', $content['projects_label'] ?? 'Selected Scopes') }}" required class="mt-0.5 block w-full px-3 py-1.5 bg-white border border-slate-200 rounded text-xs">
                </div>
                <div>
                    <label class="block text-[11px] font-semibold text-slate-600">Title</label>
                    <input type="text" name="projects_title" value="{{ old('projects_title', $content['projects_title'] ?? 'Explore our diverse portfolio') }}" required class="mt-0.5 block w-full px-3 py-1.5 bg-white border border-slate-200 rounded text-xs">
                </div>
            </div>

            <div class="bg-slate-50 p-3.5 border border-slate-200 rounded-xl space-y-2">
                <span class="text-xs font-bold text-[#36a1b3] uppercase">Why Choose Us Section</span>
                <div>
                    <label class="block text-[11px] font-semibold text-slate-600">Label</label>
                    <input type="text" name="assurances_label" value="{{ old('assurances_label', $content['assurances_label'] ?? 'Operational Assurances') }}" required class="mt-0.5 block w-full px-3 py-1.5 bg-white border border-slate-200 rounded text-xs">
                </div>
                <div>
                    <label class="block text-[11px] font-semibold text-slate-600">Title</label>
                    <input type="text" name="assurances_title" value="{{ old('assurances_title', $content['assurances_title'] ?? 'Built to the highest technical standard') }}" required class="mt-0.5 block w-full px-3 py-1.5 bg-white border border-slate-200 rounded text-xs">
                </div>
            </div>

            <div class="bg-slate-50 p-3.5 border border-slate-200 rounded-xl space-y-2">
                <span class="text-xs font-bold text-[#36a1b3] uppercase">Testimonials Section</span>
                <div>
                    <label class="block text-[11px] font-semibold text-slate-600">Label</label>
                    <input type="text" name="testimonials_label" value="{{ old('testimonials_label', $content['testimonials_label'] ?? 'Client Feedback') }}" required class="mt-0.5 block w-full px-3 py-1.5 bg-white border border-slate-200 rounded text-xs">
                </div>
                <div>
                    <label class="block text-[11px] font-semibold text-slate-600">Title</label>
                    <input type="text" name="testimonials_title" value="{{ old('testimonials_title', $content['testimonials_title'] ?? 'What our clients say') }}" required class="mt-0.5 block w-full px-3 py-1.5 bg-white border border-slate-200 rounded text-xs">
                </div>
            </div>

            <div class="bg-slate-50 p-3.5 border border-slate-200 rounded-xl space-y-2">
                <span class="text-xs font-bold text-[#36a1b3] uppercase">Blog Section</span>
                <div>
                    <label class="block text-[11px] font-semibold text-slate-600">Label</label>
                    <input type="text" name="blog_label" value="{{ old('blog_label', $content['blog_label'] ?? 'Insights & Updates') }}" required class="mt-0.5 block w-full px-3 py-1.5 bg-white border border-slate-200 rounded text-xs">
                </div>
                <div>
                    <label class="block text-[11px] font-semibold text-slate-600">Title</label>
                    <input type="text" name="blog_title" value="{{ old('blog_title', $content['blog_title'] ?? 'Latest news from site') }}" required class="mt-0.5 block w-full px-3 py-1.5 bg-white border border-slate-200 rounded text-xs">
                </div>
            </div>

            <div class="bg-slate-50 p-3.5 border border-slate-200 rounded-xl space-y-2">
                <span class="text-xs font-bold text-[#36a1b3] uppercase">Sectors Section</span>
                <div>
                    <label class="block text-[11px] font-semibold text-slate-600">Label</label>
                    <input type="text" name="sectors_label" value="{{ old('sectors_label', $content['sectors_label'] ?? 'Industries Served') }}" required class="mt-0.5 block w-full px-3 py-1.5 bg-white border border-slate-200 rounded text-xs">
                </div>
                <div>
                    <label class="block text-[11px] font-semibold text-slate-600">Title</label>
                    <input type="text" name="sectors_title" value="{{ old('sectors_title', $content['sectors_title'] ?? 'Sectors We Operate In') }}" required class="mt-0.5 block w-full px-3 py-1.5 bg-white border border-slate-200 rounded text-xs">
                </div>
            </div>
        </div>
    </div>

    <!-- 2. Sectors List Repeater -->
    @php
        $defaultSectors = [
            ['title' => 'Residential Developments', 'icon' => 'home', 'desc' => 'Bespoke homes, major domestic extensions, loft conversions, and private client commissions.'],
            ['title' => 'Commercial & Retail', 'icon' => 'building-storefront', 'desc' => 'Office fit-outs, shop conversions, leisure premises, and fast-track tenant fit-outs.'],
            ['title' => 'Civil & Infrastructure', 'icon' => 'truck', 'desc' => 'Groundworks, retaining walls, highway crossovers, deep drainage, and substructures.'],
            ['title' => 'Industrial & Logistics', 'icon' => 'cube', 'desc' => 'Steel-portal warehouses, loading docks, mezzanine floor installs, and plant compounds.'],
            ['title' => 'Heritage & Conservation', 'icon' => 'academic-cap', 'desc' => 'Listed building sensitive remediation, period masonry repairs, and traditional lime plastering.'],
            ['title' => 'Institutional & Education', 'icon' => 'building-office-2', 'desc' => 'School extensions, local authority infrastructure works, and community health centers.']
        ];
        $sectorsList = json_decode($content['sectors_list'] ?? '[]', true) ?: $defaultSectors;
    @endphp
    <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-3">
        <span class="text-xs font-bold text-[#36a1b3] uppercase tracking-wide">Industry Sectors Cards</span>
        <p class="text-xs text-slate-500">Highlight sectors where your team delivers construction services.</p>
        
        <div>
            <label class="block text-xs font-semibold text-slate-700">Sectors Section Overview</label>
            <textarea rows="2" name="sectors_description" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">{{ old('sectors_description', $content['sectors_description'] ?? 'Construction 360 operates across diverse built-environment sectors with dedicated teams.') }}</textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 pt-2">
            @foreach($sectorsList as $index => $sector)
                <div class="bg-white p-3 border border-slate-200 rounded-lg space-y-2">
                    <span class="text-[10px] font-bold text-slate-400">Sector #{{ $index + 1 }}</span>
                    <input type="text" name="sectors_list[{{ $index }}][title]" value="{{ old('sectors_list.'.$index.'.title', $sector['title'] ?? '') }}" required placeholder="Sector Title" class="block w-full px-2 py-1 border border-slate-200 rounded text-xs font-bold">
                    <input type="text" name="sectors_list[{{ $index }}][icon]" value="{{ old('sectors_list.'.$index.'.icon', $sector['icon'] ?? 'building-office-2') }}" required placeholder="Icon key" class="block w-full px-2 py-1 border border-slate-200 rounded text-xs font-mono">
                    <textarea rows="2" name="sectors_list[{{ $index }}][desc]" required placeholder="Brief sector summary" class="block w-full px-2 py-1 border border-slate-200 rounded text-xs">{{ old('sectors_list.'.$index.'.desc', $sector['desc'] ?? '') }}</textarea>
                </div>
            @endforeach
        </div>
    </div>

    <!-- 3. What We Do & Popular Paths Copy -->
    <div class="space-y-4">
        <h5 class="text-xs font-bold text-slate-700 uppercase tracking-wider">What We Do & Popular Paths</h5>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-slate-700">What we do — Title Line 1</label>
                <input type="text" name="services_title_line1" value="{{ old('services_title_line1', $content['services_title_line1'] ?? 'One team.') }}" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-700">What we do — Title Line 2 (Teal)</label>
                <input type="text" name="services_title_line2" value="{{ old('services_title_line2', $content['services_title_line2'] ?? 'Every discipline.') }}" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">
            </div>
            <div class="sm:col-span-2">
                <label class="block text-xs font-semibold text-slate-700">What we do — Subtitle</label>
                <textarea rows="2" name="services_subtitle" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">{{ old('services_subtitle', $content['services_subtitle'] ?? 'From pre-construction through structure, interiors and external works — one accountable team across every trade.') }}</textarea>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-700">What we do — CTA prompt</label>
                <input type="text" name="services_cta_prompt" value="{{ old('services_cta_prompt', $content['services_cta_prompt'] ?? 'Looking for something specific?') }}" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-700">Service card price label</label>
                <input type="text" name="services_card_price_label" value="{{ old('services_card_price_label', $content['services_card_price_label'] ?? 'Enquire for pricing') }}" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-700">Popular paths — Label</label>
                <input type="text" name="popular_paths_label" value="{{ old('popular_paths_label', $content['popular_paths_label'] ?? 'Start here') }}" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-700">Popular paths — Title</label>
                <input type="text" name="popular_paths_title" value="{{ old('popular_paths_title', $content['popular_paths_title'] ?? 'Popular project paths') }}" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-700">Popular paths — Link text</label>
                <input type="text" name="popular_paths_link" value="{{ old('popular_paths_link', $content['popular_paths_link'] ?? 'All services →') }}" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-700">About band — Button text</label>
                <input type="text" name="about_learn_more_label" value="{{ old('about_learn_more_label', $content['about_learn_more_label'] ?? 'Learn more about us →') }}" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-700">Partners — Title</label>
                <input type="text" name="partners_title" value="{{ old('partners_title', $content['partners_title'] ?? 'Our Trusted Partners') }}" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-700">Partners — Subtitle</label>
                <input type="text" name="partners_subtitle" value="{{ old('partners_subtitle', $content['partners_subtitle'] ?? 'Authorised suppliers') }}" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-700">Projects — Subtitle</label>
                <input type="text" name="projects_subtitle" value="{{ old('projects_subtitle', $content['projects_subtitle'] ?? '') }}" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-700">Projects — Trust Badge</label>
                <input type="text" name="projects_reviews_badge" value="{{ old('projects_reviews_badge', $content['projects_reviews_badge'] ?? 'Trusted by homeowners across London & Essex') }}" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-700">Client stories — Label</label>
                <input type="text" name="client_stories_label" value="{{ old('client_stories_label', $content['client_stories_label'] ?? 'Client stories') }}" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-700">Client stories — Title</label>
                <input type="text" name="client_stories_title" value="{{ old('client_stories_title', $content['client_stories_title'] ?? 'Hear from our clients') }}" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-700">Client stories — Link</label>
                <input type="text" name="client_stories_link" value="{{ old('client_stories_link', $content['client_stories_link'] ?? 'View full case studies') }}" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">
            </div>
        </div>
    </div>

    <!-- 4. Interactive 6-Step Process -->
    @php
        $processIconOptions = ['phone','pencil','document','clipboard','building','search','check'];
        $defaultDesignSteps = [
            ['step'=>'01','title'=>'Free consultation','duration'=>'1 hour','body'=>'We listen to your brief, budget and constraints, then outline the clearest path from idea to site.','icon'=>'phone'],
            ['step'=>'02','title'=>'Surveys & design','duration'=>'2–4 weeks','body'=>'Measured surveys, design options and early engineering input so decisions are grounded and buildable.','icon'=>'pencil'],
            ['step'=>'03','title'=>'Planning & approvals','duration'=>'4–12 weeks','body'=>'We manage planning, building control and partner submissions so permissions stay on the critical path.','icon'=>'document'],
            ['step'=>'04','title'=>'Costing & programme','duration'=>'1–2 weeks','body'=>'Transparent budgets, procurement and a sequenced programme before any mobilisation begins.','icon'=>'clipboard'],
            ['step'=>'05','title'=>'Construction delivery','duration'=>'Project based','body'=>'Principal contracting with weekly reporting, quality checkpoints and accountable site leadership.','icon'=>'building'],
            ['step'=>'06','title'=>'Handover & aftercare','duration'=>'Ongoing','body'=>'Snag-free handover packs, warranties and a team that stays reachable after practical completion.','icon'=>'check'],
        ];
        $defaultBuildSteps = [
            ['step'=>'01','title'=>'Free consultation','duration'=>'1 hour','body'=>'Share your drawings and aspirations — we confirm scope, risks and whether we are the right contractor.','icon'=>'phone'],
            ['step'=>'02','title'=>'Drawings & scope review','duration'=>'3–5 days','body'=>'We stress-test your pack for buildability, packages and missing information before pricing.','icon'=>'search'],
            ['step'=>'03','title'=>'Fixed quotation','duration'=>'1–2 weeks','body'=>'A clear tender with allowances, exclusions and a realistic programme you can take to decision.','icon'=>'clipboard'],
            ['step'=>'04','title'=>'Pre-start & mobilisation','duration'=>'1–2 weeks','body'=>'Contracts, site logistics, temporary works and neighbour liaison so day one runs cleanly.','icon'=>'document'],
            ['step'=>'05','title'=>'Construction delivery','duration'=>'Project based','body'=>'Disciplined site delivery with scheduled updates, cost control and quality at every stage.','icon'=>'building'],
            ['step'=>'06','title'=>'Handover & aftercare','duration'=>'Ongoing','body'=>'Commissioning, certification and responsive aftercare when you need us after handover.','icon'=>'check'],
        ];
        $processDesignSteps = json_decode($content['process_design_steps'] ?? '[]', true) ?: $defaultDesignSteps;
        $processBuildSteps = json_decode($content['process_build_steps'] ?? '[]', true) ?: $defaultBuildSteps;
    @endphp
    <div class="bg-slate-50 p-4 border border-slate-200 rounded-xl space-y-4">
        <span class="text-xs font-bold text-[#36a1b3] uppercase tracking-wide">6-Step Interactive Process Configuration</span>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="text" name="process_label" value="{{ old('process_label', $content['process_label'] ?? 'Our simple 6-step process') }}" required placeholder="Label" class="px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">
            <input type="text" name="process_title" value="{{ old('process_title', $content['process_title'] ?? 'How your project works — start to finish') }}" required placeholder="Title" class="px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">
            <textarea rows="2" name="process_subtitle" required placeholder="Subtitle" class="md:col-span-2 px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">{{ old('process_subtitle', $content['process_subtitle'] ?? '') }}</textarea>
            <input type="text" name="process_tab_design" value="{{ old('process_tab_design', $content['process_tab_design'] ?? 'Design & Build') }}" required placeholder="Tab: Design & Build" class="px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">
            <input type="text" name="process_tab_build" value="{{ old('process_tab_build', $content['process_tab_build'] ?? 'Build only') }}" required placeholder="Tab: Build only" class="px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">
            <input type="text" name="process_caption_design" value="{{ old('process_caption_design', $content['process_caption_design'] ?? 'Full turnkey service — concept to completion') }}" required placeholder="Caption: Design & Build" class="px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">
            <input type="text" name="process_caption_build" value="{{ old('process_caption_build', $content['process_caption_build'] ?? 'You bring the plans — we deliver the build') }}" required placeholder="Caption: Build only" class="px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">
            <input type="text" name="process_cta" value="{{ old('process_cta', $content['process_cta'] ?? 'Start your project today') }}" required placeholder="CTA button" class="md:col-span-2 px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">
        </div>

        @foreach(['process_design_steps' => 'Design & Build Steps', 'process_build_steps' => 'Build Only Steps'] as $field => $label)
            @php $steps = $field === 'process_design_steps' ? $processDesignSteps : $processBuildSteps; @endphp
            <div class="space-y-3 pt-3 border-t border-slate-200">
                <span class="text-xs font-semibold text-slate-700">{{ $label }}</span>
                @foreach($steps as $idx => $step)
                    <div class="grid grid-cols-1 md:grid-cols-6 gap-2 bg-white p-3 rounded-lg border border-slate-100">
                        <input type="hidden" name="{{ $field }}[{{ $idx }}][step]" value="{{ $step['step'] ?? sprintf('%02d', $idx + 1) }}">
                        <input type="text" name="{{ $field }}[{{ $idx }}][title]" value="{{ old($field.'.'.$idx.'.title', $step['title'] ?? '') }}" required placeholder="Title" class="md:col-span-2 px-2 py-1.5 border border-slate-200 rounded text-xs">
                        <input type="text" name="{{ $field }}[{{ $idx }}][duration]" value="{{ old($field.'.'.$idx.'.duration', $step['duration'] ?? '') }}" required placeholder="Duration" class="px-2 py-1.5 border border-slate-200 rounded text-xs">
                        <select name="{{ $field }}[{{ $idx }}][icon]" class="px-2 py-1.5 border border-slate-200 rounded text-xs">
                            @foreach($processIconOptions as $icon)
                                <option value="{{ $icon }}" @selected(($step['icon'] ?? '') === $icon)>{{ $icon }}</option>
                            @endforeach
                        </select>
                        <textarea rows="2" name="{{ $field }}[{{ $idx }}][body]" required placeholder="Description" class="md:col-span-2 px-2 py-1.5 border border-slate-200 rounded text-xs">{{ old($field.'.'.$idx.'.body', $step['body'] ?? '') }}</textarea>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>

    <!-- 5. Dynamic Tickers, Filters & CTAs -->
    <div class="space-y-4">
        <h5 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Marquee Ticker & Action Button Labels</h5>
        <div class="space-y-3">
            <div>
                <label for="marquee_text" class="block text-xs font-semibold text-slate-700">Running Marquee Ticker (Separated by bullets or dashes)</label>
                <textarea rows="2" name="marquee_text" id="marquee_text" required class="mt-1 block w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs">{{ old('marquee_text', $content['marquee_text'] ?? 'RESIDENTIAL EXTENSIONS • STRUCTURAL ENGINEERING • COMMERCIAL FIT-OUTS • ARCHITECTURAL DESIGN • FIXED PRICE GUARANTEE') }}</textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-700">Portfolio Filter: All</label>
                    <input type="text" name="filter_all_label" value="{{ old('filter_all_label', $content['filter_all_label'] ?? 'All Projects') }}" required class="mt-1 block w-full px-3 py-1.5 bg-white border border-slate-200 rounded text-xs">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700">Portfolio Filter: Completed</label>
                    <input type="text" name="filter_completed_label" value="{{ old('filter_completed_label', $content['filter_completed_label'] ?? 'Completed Builds') }}" required class="mt-1 block w-full px-3 py-1.5 bg-white border border-slate-200 rounded text-xs">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700">Portfolio Filter: In Progress</label>
                    <input type="text" name="filter_under_construction_label" value="{{ old('filter_under_construction_label', $content['filter_under_construction_label'] ?? 'Under Construction') }}" required class="mt-1 block w-full px-3 py-1.5 bg-white border border-slate-200 rounded text-xs">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 pt-2">
                <div>
                    <label class="block text-[11px] font-semibold text-slate-600">CTA: Submit Tender</label>
                    <input type="text" name="cta_submit_tender_label" value="{{ old('cta_submit_tender_label', $content['cta_submit_tender_label'] ?? 'Submit a Tender') }}" required class="mt-0.5 block w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded text-xs">
                </div>
                <div>
                    <label class="block text-[11px] font-semibold text-slate-600">CTA: Explore Services</label>
                    <input type="text" name="cta_explore_services_label" value="{{ old('cta_explore_services_label', $content['cta_explore_services_label'] ?? 'Explore Services') }}" required class="mt-0.5 block w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded text-xs">
                </div>
                <div>
                    <label class="block text-[11px] font-semibold text-slate-600">CTA: Ask Quote</label>
                    <input type="text" name="cta_ask_quote_label" value="{{ old('cta_ask_quote_label', $content['cta_ask_quote_label'] ?? 'Ask for a Quote') }}" required class="mt-0.5 block w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded text-xs">
                </div>
                <div>
                    <label class="block text-[11px] font-semibold text-slate-600">CTA: Explore Portfolio</label>
                    <input type="text" name="cta_explore_portfolio_label" value="{{ old('cta_explore_portfolio_label', $content['cta_explore_portfolio_label'] ?? 'Explore Portfolio') }}" required class="mt-0.5 block w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded text-xs">
                </div>
                <div>
                    <label class="block text-[11px] font-semibold text-slate-600">CTA: View All Posts</label>
                    <input type="text" name="cta_view_all_posts_label" value="{{ old('cta_view_all_posts_label', $content['cta_view_all_posts_label'] ?? 'View All Posts') }}" required class="mt-0.5 block w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded text-xs">
                </div>
                <div>
                    <label class="block text-[11px] font-semibold text-slate-600">CTA: Get Free Quote</label>
                    <input type="text" name="cta_get_free_quote_label" value="{{ old('cta_get_free_quote_label', $content['cta_get_free_quote_label'] ?? 'Get Free Quote') }}" required class="mt-0.5 block w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded text-xs">
                </div>
                <div>
                    <label class="block text-[11px] font-semibold text-slate-600">CTA: Book Consultation</label>
                    <input type="text" name="cta_book_consult_label" value="{{ old('cta_book_consult_label', $content['cta_book_consult_label'] ?? 'Book a consultation') }}" required class="mt-0.5 block w-full px-2.5 py-1.5 bg-white border border-slate-200 rounded text-xs">
                </div>
            </div>
        </div>
    </div>
</div>
