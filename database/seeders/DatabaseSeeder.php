<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\SiteContent;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Admin User
        User::updateOrCreate(
            ['email' => 'admin@construction360.co'],
            [
                'name' => 'Construction 360 Admin',
                'password' => Hash::make('password'),
            ]
        );

        // 2. Seed Site Contents
        $contents = [
            'seo_meta_title' => 'Integrated Construction & Premium Architectural Builds',
            'seo_meta_description' => 'Construction 360 Ltd delivers 360-degree integration of design, structural planning, and premium quality construction management.',
            'seo_meta_keywords' => 'construction, architectural builds, structural engineering, commercial fit-outs, extensions, renovations, glazing, Essex, London',
            
            'hero_title' => 'Integrated Construction & Premium Architectural Builds',
            'hero_subtitle' => 'Building your vision with geometric precision. Providing the highest standard of planning, design, and structural construction that stands the test of time.',
            'about_text' => 'Construction 360 Ltd (inspired by 360 Developments) is a leading construction specialist firm. We work alongside master architects, structural engineers, surveyors, and local building control officers to deliver premium quality builds across residential extensions, new home developments, and commercial fit-outs.',
            'about_philosophy' => 'Our operation is built on digital transparency, CSCS compliance, and zero telephone reliance. By routing all project briefs and engineering specifications electronically, we maintain a flawless audit trail, secure structural guarantees, and deliver project handovers that exceed architectural standards.',
            
            // Why Choose Us Section
            'insurance_title' => 'Comprehensive Insurance',
            'insurance_text' => 'Full peace of mind with £10,000,000 Employers Liability, £5,000,000 Public & Products Liability, and £500,000 Contract Works (Contractors All Risk) cover.',
            
            'certificates_title' => 'Building Control & Certificates',
            'certificates_text' => 'We issue all appropriate building control certificates on completion (including FENSA, plumbing, and electrical). All structural work is covered by our 10-year guarantee.',
            
            'cscs_title' => 'CSCS Compliance',
            'cscs_text' => 'All security surveyors, structural developers, and engineers have completed the Construction Skills Certification Scheme (CSCS) ensuring full safety compliance.',

            // Testimonials
            'testimonial_1_quote' => 'Great company to do business with. Good standard of work and very reliable. Would definitely use again!',
            'testimonial_1_author' => 'Colin Ashworth',
            'testimonial_1_role' => 'Essex Homeowner',

            'testimonial_2_quote' => '360 developments managed our full commercial fit-out from planning drawings to final handover. Completed on time, within budget, and to absolute tolerances.',
            'testimonial_2_author' => 'David Vance',
            'testimonial_2_role' => 'Director, Vanguard Retail Group',

            'testimonial_3_quote' => 'Superb execution on our double-height rear extension. The digital progress logs kept us updated at every stage, and the structural finish is second to none.',
            'testimonial_3_author' => 'Eleanor Finch',
            'testimonial_3_role' => 'Residential Client, Chelmsford',

            // Header Top Bar & Corporate Contact
            'header_email' => 'info@construction360.co',

            // Team Section Headers
            'team_section_label' => 'Operational Leadership',
            'team_section_title' => 'Our Core Project Team',
            'team_section_subtitle' => 'A dedicated team of design partners, IStructE engineers, and quantity surveyors coordinating structural execution with digital precision.',

            // Team Member 1
            'team_member_1_name' => 'William Vance',
            'team_member_1_role' => 'Managing Director & Senior Coordinator',
            'team_member_1_description' => 'William oversees all site planning operations and client relationships, enforcing our paperless, digital-first correspondence log standards.',
            'team_member_1_accreditations' => 'CSCS Black Card, RICS Affiliate',

            // Team Member 2
            'team_member_2_name' => 'Elena Rostova',
            'team_member_2_role' => 'Lead Structural Engineer',
            'team_member_2_description' => 'Elena leads all wind-load assessments, concrete framing calculations, and structural detailing to guarantee full building control approval.',
            'team_member_2_accreditations' => 'IStructE Member, MSc Civil Eng',

            // Team Member 3
            'team_member_3_name' => 'Marcus Thorne',
            'team_member_3_role' => 'Project Estimator & Quantity Surveyor',
            'team_member_3_description' => 'Marcus compiles our Bill of Quantities (BoQ) surveys and coordinates logistics schedules to keep project execution within precise budget limits.',
            'team_member_3_accreditations' => 'RICS Certified, CSCS Card',

            // Homepage Section Headers
            'services_section_label' => 'Engineering Capabilities',
            'services_section_title' => 'Technical Specialties & Solutions',
            'services_section_subtitle' => 'Our dynamic capabilities span full-spectrum general contracting and specialized structural analysis, tracked via absolute electronic coordination.',

            'blog_section_label' => 'Knowledge Base & Updates',
            'blog_section_title' => 'Latest from Construction 360',
            'blog_section_subtitle' => 'Explore insights, blueprints, design guidelines, and site developments from our structural and engineering experts.',

            'contact_section_label' => 'Tender Submission',
            'contact_section_title' => 'Submit Project Specifications',
            'contact_section_subtitle' => 'Ready to launch your project? Fill out the architectural brief below. Our structural coordinators compile specs and respond within 24 hours.',

            // Privacy Policy Page Content
            'privacy_title' => 'Privacy Policy & Correspondence Standards',
            'privacy_notice' => 'NOTICE: Construction 360 Ltd routes all customer correspondence through electronic mail logs to preserve exact structural requirements and specifications. We do not offer phone numbers or call centers. For direct email queries, reach us at <a href="mailto:info@construction360.co" class="text-[#008080] hover:underline">info@construction360.co</a>.',
            'privacy_content' => <<<TEXT
1. Information We Collect

When you submit a digital tender brief or contact us via our encrypted webforms, we collect your name, email address, project subject, and any blueprints or architectural specifications provided. This data is logged directly into our secure database to preserve structural requirements.

2. Why We Restrict Voice Calls

To eliminate design discrepancies, wind-load calculation misunderstandings, and scheduling conflicts, Construction 360 Ltd has decommissioned all public telephone lines. Recording all client briefs in digital archives prevents verbal miscommunications and ensures building control documentation aligns perfectly with project instructions.

3. Data Security & Encryption

All client specifications, blueprints, and personal details are encrypted in transit using Secure Sockets Layer (SSL) technology. Data is stored on secure servers with restricted access controls. We do not share your structural files or contact information with third-party marketers.

4. Retention Policy

Because building control certificates (FENSA, gas safety, electrical) and structural works carry 10-year guarantees, we preserve correspondence logs and design calculations for a minimum of 10 years to protect contract warranties.

5. Your Rights

You retain the right to request a copy of your archived project log, check the status of your query, or ask for the deletion of personal details once building control signs off and project warranties expire.
TEXT
,

            // Terms & Conditions Page Content
            'terms_title' => 'Terms & Conditions of Service',
            'terms_notice' => 'By filing a brief or engaging <strong>Construction 360 Ltd</strong>, clients agree that all communications, modifications, and instructions must be submitted electronically to <a href="mailto:info@construction360.co" class="text-[#008080] hover:underline font-semibold font-sans">info@construction360.co</a>. Verbal discussions, call requests, and telephone negotiations are explicitly excluded from the contract record.',
            'terms_content' => <<<TEXT
1. Scope & Tendering

All estimates, proposals, and project timelines are compiled based on the digital documents, CAD blueprints, and surveyor surveys submitted via our encrypted forms. Clients must ensure that all plans are correct, complete, and meet planning permission guidelines prior to submission.

2. Milestone Inspections & Sign-offs

We work alongside local building control officers and structural engineers. At completion of each milestone stage (foundations, framing, structural glazing, mechanical fit-out, roofing), the client will receive digital progress summaries. Proceeding to the subsequent stage requires digital confirmation, preserving a transparent audit trail.

3. Warranties & Guarantees

All structural works carry a 10-year guarantee against structural failure, provided no modifications have been made by non-CSCS contractors. FENSA glazing certifications, gas certificates, and electrical certifications are logged digitally and transferred on final handover.

4. Liability & Assurances

Construction 360 Ltd maintains £10,000,000 Employers Liability, £5,000,000 Public Liability, and £500,000 Contractors All Risk coverage. Our liability for delay or design discrepancies is strictly limited to issues documented in the electronic audit logs.

5. Exclusions & Legacy Channels

We enforce a strict paperless and telephone-free standard. Construction 360 Ltd is not liable for structural delays, plan deviations, or additional fees arising from instructions passed through unofficial legacy routes (such as voice calls, SMS, or verbal on-site instructions that were not logged via email).
TEXT
,

            // Tendering Standard Page Content
            'tendering_title' => 'Official Tendering & Procurement Standards',
            'tendering_notice' => '<strong>CRITICAL:</strong> Construction 360 Ltd enforces an <strong>electronic-only tendering standard</strong>. We have decommissioned all public telephone lines. All blueprints, specifications, and client inquiries must be submitted digitally via our encrypted forms or emailed to <a href="mailto:info@construction360.co" class="text-teal-300 hover:underline font-bold font-sans">info@construction360.co</a>.',
            'tendering_content' => <<<TEXT
1. Submission Formats

To facilitate rapid structural engineering assessments and quantity takeoff calculations, all project blueprints and schedules must be submitted in vector PDF format, dwg (AutoCAD), or rvt (Revit). Excel files or structured CSVs are required for complete Bill of Quantities (BoQ) uploads.

2. Review SLA & Turnaround

Once a digital tender brief is logged via our system, a structural coordinator and site developer are assigned to review the specifications. Complete estimates, scheduling milestones, and preliminary structural feedback will be compiled and sent back to your corporate email within 24 business hours.

3. Communication Auditing

Every modification, drawing correction, and schedule revision requested during the tendering phase must be logged electronically. This ensures that our onsite project managers, CSCS carpenters, bricklayers, and glazing engineers operate with the identical version-controlled spec sheet, eliminating costly re-works.

4. Professional Ethics

By maintaining a paperless, digital tendering registry, we reduce project administration overheads by 15%, passing the savings directly back to our commercial and residential clients in competitive pricing schedules.
TEXT
,

            // Subpages Headings & Text Configuration
            'services_page_label' => 'Services',
            'services_page_title' => 'Design to Delivery',
            'services_page_subtitle' => 'We engage as early as possible in the lifecycle of a project to solve complex structural challenges, manage development risk, and exceed architectural standards.',
            
            'service_about_label' => 'ABOUT THE SERVICE',
            'service_scopes_label' => 'SCOPES & DELIVERABLES',
            'service_scopes_title' => 'Specialist Sub-Services',
            'service_why_choose_us_label' => 'CAPABILITIES',
            'service_why_choose_us_title' => 'Why Choose Us',
            'service_faqs_label' => 'COMMON INQUIRIES',
            'service_faqs_title' => 'Frequently Asked Questions',

            'projects_page_label' => 'PORTFOLIO',
            'projects_page_title' => 'Our Projects',
            'projects_page_subtitle' => 'A curated selection of our high-spec residential builds, commercial workspace designs, and structural renovations across London and Essex.',

            'project_overview_title' => 'Project Overview',
            'project_scopes_title' => 'Development Scopes',
            'project_specifications_title' => 'Project Specifications',
            'project_related_label' => 'PORTFOLIO',
            'project_related_title' => 'Related Projects',
        ];

        foreach ($contents as $key => $value) {
            SiteContent::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        // 3. Seed Services aligned with the reference site
        $services = [
            [
                'title' => 'Planning',
                'description' => 'We offer comprehensive planning services, guiding your project from architectural drawings and planning consultancy to successful planning application submissions.',
                'icon' => 'pencil-square',
                'display_order' => 1,
            ],
            [
                'title' => 'Design and Build',
                'description' => 'Our integrated Design and Build service covers commercial and residential buildings, loft conversions, extensions, and outbuildings from concept to completion.',
                'icon' => 'home',
                'display_order' => 2,
            ],
            [
                'title' => 'Finance',
                'description' => 'We assist developers and property owners in securing development finance to fund construction projects and unlock commercial viability.',
                'icon' => 'banknotes',
                'display_order' => 3,
            ],
            [
                'title' => 'Design',
                'description' => 'Our multidisciplinary design team provides specialist architectural, structural, below ground, fire safety, and M&E engineering services.',
                'icon' => 'paint-brush',
                'display_order' => 4,
            ],
            [
                'title' => 'Construction',
                'description' => 'We deliver full-spectrum construction services including demolition, piling, structural foundations, and reinforced concrete (RC) frames.',
                'icon' => 'wrench',
                'display_order' => 5,
            ],
            [
                'title' => 'Support Services',
                'description' => 'We manage crucial support services including conditions discharge, S106 negotiations, environmental reports, and SAP energy calculations.',
                'icon' => 'document-text',
                'display_order' => 6,
            ],
            [
                'title' => 'Building Control',
                'description' => 'We coordinate directly with local authorities and private inspectors to secure building control approvals and ensure full structural compliance.',
                'icon' => 'shield-check',
                'display_order' => 7,
            ],
            [
                'title' => 'Facilities Management',
                'description' => 'Our Managed Services division provides comprehensive facilities management, reactive maintenance, and planned preventative maintenance for residential blocks and commercial properties.',
                'icon' => 'globe-alt',
                'display_order' => 8,
            ],
        ];

        // Clear existing services to avoid duplicates and repopulate cleanly
        Service::truncate();

        $controller = new \App\Http\Controllers\LandingPageController();
        foreach ($services as $srv) {
            $slug = \Illuminate\Support\Str::slug($srv['title']);
            $details = $controller->getServiceDetails($slug);
            if ($details) {
                $srv['about'] = $details['about'] ?? null;
                $srv['why_choose_us'] = $details['why_choose_us'] ?? null;
                $srv['services_offered'] = $details['services_offered'] ?? null;
                $srv['faqs'] = $details['faqs'] ?? null;
                $srv['image_url'] = $details['image_url'] ?? null;
            }
            Service::create($srv);
        }

        // 4. Seed Blogs
        $blogs = [
            [
                'title' => 'The Future of Integrated Design & Construction Management',
                'slug' => 'future-integrated-design-construction-management',
                'excerpt' => 'Discover how unifying structural engineering, architectural design, and digital project management reduces delivery times and eliminates costly design discrepancies.',
                'category' => 'Company',
                'content' => '<p class="mb-4">In traditional construction, the separation between design planning and field execution is one of the primary drivers of budget overruns, delayed handovers, and structural deviations. When architects, structural engineers, and site developers operate in silos, miscommunications are inevitable.</p><p class="mb-4">At <strong>Construction 360 Ltd</strong>, we solve this through a unified approach. By integrating structural calculations directly with real-time architectural blueprints and commercial contracting models, we create a seamless flow from paper to timber and steel. This 360-degree digital overview ensures that any modification requested by building control or site developers updates across all active project files instantaneously.</p><p class="mb-4">Central to this model is our commitment to a digital-first communication channel. By routing all project briefs and architectural specifications through structured, immutable digital logs and decommissioning legacy telephone routes, we preserve an exact audit trail. This means no details are lost in casual conversation, safety margins are strictly maintained, and construction tolerances are met to the millimeter.</p>',
                'image_url' => 'images/blog_integrated.png',
                'author' => 'Construction 360 Editorial',
                'meta_title' => 'The Future of Integrated Design & Construction Management | Construction 360',
                'meta_description' => 'Learn how integrating architectural design with structural engineering under digital-first standards ensures seamless build handovers with zero errors.',
                'meta_keywords' => 'integrated design, construction management, BIM, architectural precision, digital contracting',
                'published_at' => now(),
            ],
            [
                'title' => 'Mastering Bespoke Glazing: A Guide to Modern Structural Glass',
                'slug' => 'mastering-bespoke-glazing-guide-modern-structural-glass',
                'excerpt' => 'An in-depth look at specifying high-performance double and triple glazing for modern residential extensions, from U-values to structural frame design.',
                'category' => 'Tips & Tricks',
                'content' => '<p class="mb-4">Contemporary architectural design increasingly relies on structural glass to bridge the gap between interior comfort and outdoor natural light. Double-height rear extensions, minimal-profile sliding doors, and structural glass rooflights are highly sought after by homeowners seeking to modernize their properties.</p><p class="mb-4">However, executing large-scale glazing installations is a complex engineering challenge. High-performance glass requires precise structural calculations to account for wind loads, building deflection, and thermal expansion. Additionally, maintaining low U-values—the measure of thermal transmittance—is critical for meeting building control insulation standards.</p><p class="mb-4">We ensure all glazing installations use top-tier insulated glass units (IGUs) matched with custom-extruded aluminum frames. Upon completion, we provide FENSA certification and comprehensive structural warranties, ensuring your architectural centerpieces are as energy-efficient and secure as they are visually striking.</p>',
                'image_url' => 'images/blog_glazing.png',
                'author' => 'Lead Glazing Engineer',
                'meta_title' => 'Bespoke Glazing & Modern Structural Glass Guide | Construction 360',
                'meta_description' => 'Dive deep into structural glazing for residential home extensions, including thermal U-values, wind-load calculations, and FENSA certifications.',
                'meta_keywords' => 'structural glass, glazing, FENSA compliance, U-values, home extensions',
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Commercial Fit-Outs: Maximizing Workspace Efficiency and Compliance',
                'slug' => 'commercial-fit-outs-maximizing-workspace-efficiency-compliance',
                'excerpt' => 'How commercial developers navigate building control regulations, CSCS safety standards, and space optimization for modern corporate hubs.',
                'category' => 'Processes',
                'content' => '<p class="mb-4">Refurbishing or fitting out a commercial space involves balancing human-centric design with strict regulatory compliance. Whether you are building out a modern co-working space, a high-traffic retail outlet, or a corporate headquarters, compliance with local fire codes, mechanical system regulations, and access guidelines is non-negotiable.</p><p class="mb-4">Every successful fit-out begins with space optimization planning. This involves positioning HVAC ducting, acoustic partitions, and emergency escape routes cleanly without sacrificing floor space or natural light. To guarantee execution quality on site, every surveyor, structural builder, and technician we deploy is fully CSCS certified, ensuring safety guidelines are executed to the highest standards.</p><p class="mb-4">By tracking and managing project timelines through centralized progress logs, commercial directors can view milestone check-offs in real time. This digital tracking minimizes overheads, eliminates contractor scheduling conflicts, and delivers a commercial environment tailored for operational excellence.</p>',
                'image_url' => 'images/blog_fitout.png',
                'author' => 'Project Management Lead',
                'meta_title' => 'Commercial Fit-Outs & Workspace Compliance | Construction 360',
                'meta_description' => 'Explore strategies for executing commercial renovations and workspace fit-outs aligned with fire codes, CSCS certification, and space efficiency.',
                'meta_keywords' => 'commercial fit-out, office renovation, building control, CSCS, workspace design',
                'published_at' => now()->subDays(5),
            ],
        ];

        // Clear existing blogs and seed
        \App\Models\Blog::truncate();
        foreach ($blogs as $blog) {
            \App\Models\Blog::create($blog);
        }

        // 5. Seed Projects
        \App\Models\Project::truncate();
        $projects = [
            [
                'title' => 'Haydons road',
                'slug' => 'haydons-road',
                'category' => 'Residential',
                'status' => 'under-construction',
                'description' => 'Ground-up construction of a purpose-built residential block of flats. Features optimized layouts, energy-efficient specifications, and strict compliance with building regulations Part B & L.',
                'image_url' => 'images/project_haydons.png',
                'location' => 'London, Merton',
                'year' => '2026',
                'display_order' => 1,
            ],
            [
                'title' => 'Streatham High road',
                'slug' => 'streatham-high-road',
                'category' => 'Residential',
                'status' => 'under-construction',
                'description' => 'Conversion of a commercial retail unit into residential flats. Focuses on structural space planning, soundproofing, and modern interior design suitable for the Lambeth community.',
                'image_url' => 'images/project_streatham.png',
                'location' => 'London, Lambeth',
                'year' => '2026',
                'display_order' => 2,
            ],
            [
                'title' => 'Hinton',
                'slug' => 'hinton',
                'category' => 'Residential',
                'status' => 'under-construction',
                'description' => 'Development of boutique residential units with modern steel-frame structure, triple glazing window specifications, and high-spec mechanical installations.',
                'image_url' => 'images/project_hinton.png',
                'location' => 'London, Lambeth',
                'year' => '2026',
                'display_order' => 3,
            ],
            [
                'title' => 'Hoxton',
                'slug' => 'hoxton',
                'category' => 'Commercial',
                'status' => 'under-construction',
                'description' => 'CAT A & B office fit-out and commercial workspace conversion. Delivering raised flooring, acoustical partitions, and brand-sensitive interior finishes.',
                'image_url' => 'images/project_hoxton.png',
                'location' => 'London, Hackney',
                'year' => '2025',
                'display_order' => 4,
            ],
            [
                'title' => 'Sutherland House',
                'slug' => 'sutherland-house',
                'category' => 'Commercial',
                'status' => 'under-construction',
                'description' => 'High-specification refurbishment of a heritage commercial building. Preserving historical facade while implementing modern interior space planning and mechanical extraction.',
                'image_url' => 'images/project_sutherland.png',
                'location' => 'London, Kensington and Chelsea',
                'year' => '2026',
                'display_order' => 5,
            ],
            [
                'title' => 'Gilsland Spa Hotel',
                'slug' => 'gilsland-spa-hotel',
                'category' => 'Commercial',
                'status' => 'completed',
                'description' => 'Complete facilities management and external fabric maintenance for a landmark spa resort. Includes HVAC upgrade, brick pointing, and preventative upkeep cycles.',
                'image_url' => 'images/project_gilsland.png',
                'location' => 'Cumbria',
                'year' => '2024',
                'display_order' => 6,
            ],
            [
                'title' => 'Finchley High road',
                'slug' => 'finchley-high-road',
                'category' => 'Residential',
                'status' => 'completed',
                'description' => 'A completed multi-unit residential apartment development. Delivered from ground-up foundations to zero-defect handovers with NHBC structural warranty.',
                'image_url' => 'images/project_finchley.png',
                'location' => 'London, Barnet',
                'year' => '2024',
                'display_order' => 7,
            ],
            [
                'title' => 'Belgravia House',
                'slug' => 'belgravia-house',
                'category' => 'Residential',
                'status' => 'completed',
                'description' => 'A high-end residential HMO conversion. Transformed a Victorian building into high-spec flat units with fire compartmentation and integrated smart amenities.',
                'image_url' => 'images/project_belgravia.png',
                'location' => 'London, Wandsworth',
                'year' => '2025',
                'display_order' => 8,
            ],
            [
                'title' => 'Balham 176',
                'slug' => 'balham-176',
                'category' => 'Residential',
                'status' => 'completed',
                'description' => 'Bespoke residential block of flats. Features custom-extruded aluminum window frames, double glazing, and high-spec kitchen and bathroom fit-outs.',
                'image_url' => 'images/project_balham.png',
                'location' => 'London, Wandsworth',
                'year' => '2025',
                'display_order' => 9,
            ],
        ];
        foreach ($projects as $proj) {
            \App\Models\Project::create($proj);
        }

        // 6. Seed Team Members
        \App\Models\TeamMember::truncate();
        $team = [
            [
                'name' => 'William Vance',
                'role' => 'Managing Director & Senior Coordinator',
                'description' => 'William oversees all site planning operations and client relationships, enforcing our paperless, digital-first correspondence log standards.',
                'accreditations' => 'CSCS Black Card, RICS Affiliate',
                'display_order' => 1,
            ],
            [
                'name' => 'Elena Rostova',
                'role' => 'Lead Structural Engineer',
                'description' => 'Elena leads all wind-load assessments, concrete framing calculations, and structural detailing to guarantee full building control approval.',
                'accreditations' => 'IStructE Member, MSc Civil Eng',
                'display_order' => 2,
            ],
            [
                'name' => 'Marcus Thorne',
                'role' => 'Project Estimator & Quantity Surveyor',
                'description' => 'Marcus compiles our Bill of Quantities (BoQ) surveys and coordinates logistics schedules to keep project execution within precise budget limits.',
                'accreditations' => 'RICS Certified, CSCS Card',
                'display_order' => 3,
            ],
        ];
        foreach ($team as $member) {
            \App\Models\TeamMember::create($member);
        }
    }
}
