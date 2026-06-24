<?php

namespace App\Http\Controllers;

use App\Models\SiteContent;
use App\Models\Service;
use App\Models\Blog;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    /**
     * Display the dynamic landing page.
     */
    public function index()
    {
        // Fetch all key-value contents
        $content = SiteContent::pluck('value', 'key')->all();

        // Fetch services ordered by display_order
        $services = Service::orderBy('display_order', 'asc')->get();

        // Fetch active blogs
        $blogs = Blog::where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->get();

        // Fetch projects and team members
        $projects = \App\Models\Project::orderBy('display_order', 'asc')->take(6)->get();
        $team = \App\Models\TeamMember::orderBy('display_order', 'asc')->get();

        return view('welcome', compact('content', 'services', 'blogs', 'projects', 'team'));
    }

    /**
     * Display the public Services listing page.
     */
    public function services()
    {
        $content = SiteContent::pluck('value', 'key')->all();
        $services = Service::orderBy('display_order', 'asc')->get();
        return view('services.index', compact('content', 'services'));
    }

    /**
     * Display a detailed Service page.
     */
    public function showService($slug)
    {
        $content = SiteContent::pluck('value', 'key')->all();
        $services = Service::orderBy('display_order', 'asc')->get();
        
        $details = $this->getServiceDetails($slug);
        if (!$details) {
            abort(404, 'Service not found');
        }

        return view('services.show', compact('content', 'services', 'details', 'slug'));
    }

    /**
     * Display the public Projects portfolio listing page with filters.
     */
    public function projects(Request $request)
    {
        $content = SiteContent::pluck('value', 'key')->all();
        
        $query = \App\Models\Project::query();

        // 1. Filter by Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // 2. Filter by Category/Type
        if ($request->filled('type')) {
            $query->where('category', $request->type);
        }

        // 3. Filter by Location
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        $projects = $query->orderBy('display_order', 'asc')->take(6)->get();

        // Get unique locations and categories for filter options
        $locations = \App\Models\Project::whereNotNull('location')->pluck('location')->unique()->map(function($loc) {
            $parts = explode(',', $loc);
            return trim(end($parts));
        })->unique()->filter()->all();
        
        $categories = \App\Models\Project::pluck('category')->unique()->filter()->all();

        return view('projects.index', compact('content', 'projects', 'locations', 'categories'));
    }

    /**
     * Display a detailed Project page.
     */
    public function showProject($slug)
    {
        $content = SiteContent::pluck('value', 'key')->all();
        $project = \App\Models\Project::where('slug', $slug)->firstOrFail();
        
        // Fetch 3 related projects
        $related = \App\Models\Project::where('id', '!=', $project->id)
            ->where('category', $project->category)
            ->limit(3)
            ->get();
        
        if ($related->isEmpty()) {
            $related = \App\Models\Project::where('id', '!=', $project->id)
                ->limit(3)
                ->get();
        }

        return view('projects.show', compact('content', 'project', 'related'));
    }

    /**
     * Display the public Blogs listing page with category and search filters.
     */
    public function blog(Request $request)
    {
        $content = SiteContent::pluck('value', 'key')->all();
        
        $query = \App\Models\Blog::where('published_at', '<=', now());

        // 1. Search filter
        if ($request->filled('q')) {
            $searchTerm = '%' . $request->q . '%';
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', $searchTerm)
                  ->orWhere('excerpt', 'like', $searchTerm)
                  ->orWhere('content', 'like', $searchTerm);
            });
        }

        // 2. Category filter
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $blogs = $query->orderBy('published_at', 'desc')->get();

        // Unique categories for filters & sidebar
        $categories = \App\Models\Blog::whereNotNull('category')->pluck('category')->unique()->filter()->all();
        
        // Ensure "Uncategorized" exists if it was seeded or is in the DB
        if (!in_array('Uncategorized', $categories)) {
            $categories[] = 'Uncategorized';
        }

        // Recent posts for sidebar
        $recent_posts = \App\Models\Blog::where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->limit(5)
            ->get();

        return view('blog.index', compact('content', 'blogs', 'categories', 'recent_posts'));
    }

    /**
     * Display a detailed Blog post.
     */
    public function showBlog($slug)
    {
        $content = SiteContent::pluck('value', 'key')->all();
        $blog = \App\Models\Blog::where('slug', $slug)->firstOrFail();
        
        // Unique categories for sidebar
        $categories = \App\Models\Blog::whereNotNull('category')->pluck('category')->unique()->filter()->all();
        
        // Recent posts for sidebar
        $recent_posts = \App\Models\Blog::where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->limit(5)
            ->get();

        return view('blog.show', compact('content', 'blog', 'categories', 'recent_posts'));
    }

    /**
     * Display the public Contact Us page.
     */
    public function contact()
    {
        $content = SiteContent::pluck('value', 'key')->all();
        return view('contact', compact('content'));
    }

    /**
     * Display the Privacy Policy page.
     */
    public function privacy()
    {
        $content = SiteContent::pluck('value', 'key')->all();
        return view('privacy', compact('content'));
    }

    /**
     * Display the Terms & Conditions page.
     */
    public function terms()
    {
        $content = SiteContent::pluck('value', 'key')->all();
        return view('terms', compact('content'));
    }

    /**
     * Display the Tendering Standard page.
     */
    public function tendering()
    {
        $content = SiteContent::pluck('value', 'key')->all();
        return view('tendering', compact('content'));
    }

    /**
     * Structured detail data map for competitor-matched service pages.
     */
    protected function getServiceDetails($slug)
    {
        $slug = strtolower($slug);
        
        // 1. Design and Build (must be matched before Design to avoid incorrect matching)
        if ($slug === 'design-and-build' || str_contains($slug, 'design-and-build') || (str_contains($slug, 'design') && str_contains($slug, 'build'))) {
            return [
                'title' => 'Design and Build',
                'image_url' => 'images/service_residential.png',
                'about' => 'Our integrated Design and Build service provides a single point of responsibility, integrating architectural planning, structural engineering, and construction delivery. By aligning design intent with site feasibility and budgets from the outset, we eliminate discrepancies and accelerate project timelines. Whether executing a new commercial building, multi-unit residential project, complex loft conversion, or home extension, we manage every phase under a unified team.',
                'why_choose_us' => [
                    [
                        'title' => 'Single Responsibility',
                        'desc' => 'One point of contact handles everything from the initial sketch to the final structural sign-off and completion certificate.'
                    ],
                    [
                        'title' => 'Budget Alignment',
                        'desc' => 'Cost estimation is integrated with the design process, ensuring your project remains financially viable before site works begin.'
                    ],
                    [
                        'title' => 'Optimized Timelines',
                        'desc' => 'Overlapping the design and construction phases allows us to begin site preparation and procurement while details are finalized.'
                    ],
                    [
                        'title' => 'Quality Guaranteed',
                        'desc' => 'With structural engineers and builders working as one team, construction details are executed precisely as designed.'
                    ]
                ],
                'services_offered' => [
                    'Commercial Building' => 'End-to-end design and construction of commercial facilities, offices, retail spaces, and mixed-use structures tailored to operational needs.',
                    'Residential Buildings' => 'Construction of new build developments, blocks of flats, and premium custom residences built to the highest architectural standards.',
                    'Loft Conversions' => 'Transforming unused roof space into premium habitable rooms, including dormer, mansard, and hip-to-gable conversions with full structural support.',
                    'Rear Extensions' => 'Expanding ground-floor living spaces with seamless rear extensions that connect your home to the outdoors with modern glazing and layouts.',
                    'Second Storey Extensions' => 'Adding a second floor to existing structures, requiring careful structural load assessment and seamless integration with existing architecture.',
                    'Outbuildings' => 'Design and build of bespoke garden rooms, home offices, gyms, and annexes built with full residential-grade insulation and utility services.'
                ],
                'faqs' => [
                    [
                        'q' => 'What are the benefits of Design and Build?',
                        'a' => 'It minimizes project risk, reduces delivery times, and prevents budget overruns by eliminating the friction between separate architects and contractors.'
                    ],
                    [
                        'q' => 'Do you handle structural calculations for extensions?',
                        'a' => 'Yes, our team includes structural engineers who produce all necessary structural calculations, steel beam specifications, and loading diagrams.'
                    ],
                    [
                        'q' => 'How long does a typical loft conversion or rear extension take?',
                        'a' => 'Loft conversions generally take 6 to 8 weeks on site, while rear extensions typically require 8 to 12 weeks depending on structural complexity.'
                    ],
                    [
                        'q' => 'Can I live in the property during construction?',
                        'a' => 'For most loft conversions and rear extensions, we can partition the work areas to minimize disruption, allowing you to occupy the property safely.'
                    ]
                ]
            ];
        }

        // 2. Planning
        if ($slug === 'planning' || str_contains($slug, 'planning') || str_contains($slug, 'drawings')) {
            return [
                'title' => 'Planning',
                'image_url' => 'images/service_design_planning.png',
                'about' => 'Navigating the planning process requires strategic foresight, technical accuracy, and local policy expertise. At Construction 360 Ltd, we coordinate your development\'s initial planning stages to secure approvals efficiently. From architectural planning drawings to pre-application consultations and complete planning submissions, we ensure your scheme aligns with local planning guidelines while maximizing development potential.',
                'why_choose_us' => [
                    [
                        'title' => 'Policy Expertise',
                        'desc' => 'We keep up-to-date with evolving local plans, planning policies, and permitted development rights across London and Essex.'
                    ],
                    [
                        'title' => 'Clear Visuals',
                        'desc' => 'Our planning packages combine detailed layouts with site context views that clearly communicate design merits to planning officers.'
                    ],
                    [
                        'title' => 'Proactive Liaison',
                        'desc' => 'We handle all communications, negotiations, and representations with local planning authorities on your behalf.'
                    ],
                    [
                        'title' => 'Risk Mitigation',
                        'desc' => 'By conducting early planning policy risk assessments, we structure your applications to maximize approval success.'
                    ]
                ],
                'services_offered' => [
                    'Architectural Drawings' => 'Detailed planning drawings including site layout plans, floor plans, elevations, and sections showing the exact proposal and its relation to neighboring properties.',
                    'Planning Consultancy' => 'Professional advice on development potential, planning policy compliance, pre-application consultations, and strategy development for complex schemes.',
                    'Planning Application submissions' => 'Preparation, compilation, and submission of all planning documents, design and access statements, and management of the application through local authority determination.'
                ],
                'faqs' => [
                    [
                        'q' => 'What drawings are required for a planning application?',
                        'a' => 'A standard application requires a site location plan, block plan, existing and proposed floor plans, and existing and proposed elevations.'
                    ],
                    [
                        'q' => 'How long does a planning application take?',
                        'a' => 'Once submitted, local planning authorities typically take 8 weeks to determine householder and minor applications, and up to 13 weeks for major developments.'
                    ],
                    [
                        'q' => 'What is Permitted Development?',
                        'a' => 'Permitted Development rights allow certain minor improvements and extensions to be built without submitting a full planning application, subject to specific limits and conditions.'
                    ],
                    [
                        'q' => 'Do you handle planning appeals?',
                        'a' => 'Yes, if an application is refused, our planning consultancy team can assess the reasons for refusal and represent you in submitting a planning appeal.'
                    ]
                ]
            ];
        }

        // 3. Finance
        if ($slug === 'finance' || str_contains($slug, 'finance')) {
            return [
                'title' => 'Finance',
                'image_url' => 'images/about_overlap.png',
                'about' => 'Securing the right funding structure is critical to the viability of any property development. At Construction 360 Ltd, we work alongside leading institutional lenders, private funds, and specialist brokers to help you structure development finance. By preparing detailed development appraisals, cash flow projections, and construction cost schedules, we present your project in its strongest light to secure optimal funding terms.',
                'why_choose_us' => [
                    [
                        'title' => 'Funding Relationships',
                        'desc' => 'We have direct access to a wide network of development lenders, private equity partners, and niche construction financiers.'
                    ],
                    [
                        'title' => 'Robust Appraisals',
                        'desc' => 'Our dual expertise in construction costs and property finance allows us to build highly accurate appraisals that lenders trust.'
                    ],
                    [
                        'title' => 'Flexible Terms',
                        'desc' => 'We help you negotiate structures that optimize your equity contribution, loan-to-cost (LTC) ratios, and interest roll-up terms.'
                    ],
                    [
                        'title' => 'Drawdown Management',
                        'desc' => 'We coordinate the ongoing monitoring surveyor visits and valuation reports to ensure smooth, timely drawdowns on construction funds.'
                    ]
                ],
                'services_offered' => [
                    'Development Finance' => 'Sourcing and structuring funding for ground-up developments, commercial fit-outs, major refurbishments, and land acquisitions.'
                ],
                'faqs' => [
                    [
                        'q' => 'What is Development Finance?',
                        'a' => 'Development finance is a short-term loan used to fund the purchase of land and the construction costs of a property development project.'
                    ],
                    [
                        'q' => 'What information do lenders require?',
                        'a' => 'Lenders require a detailed development appraisal, planning permission documents, architectural designs, detailed construction budgets, and CVs of the development team.'
                    ],
                    [
                        'q' => 'What is a Gross Development Value (GDV)?',
                        'a' => 'GDV is the estimated market value that the completed property development project will achieve once it is fully built and sold or let.'
                    ],
                    [
                        'q' => 'How are development finance funds released?',
                        'a' => 'Funds are typically released in stages (drawdowns) monthly, following an inspection by an independent monitoring surveyor to verify work completed.'
                    ]
                ]
            ];
        }

        // 4. Design
        if ($slug === 'design' || str_contains($slug, 'design')) {
            return [
                'title' => 'Design',
                'image_url' => 'images/about_engineering.png',
                'about' => 'Modern buildings require integrated engineering and design solutions to be safe, sustainable, and highly functional. Our multi-disciplinary design team brings together architectural design, structural engineering, below-ground drainage, fire safety, and mechanical & electrical (M&E) systems. By coordinating all technical services under one roof, we eliminate spatial clashes and deliver fully coordinated construction packages.',
                'why_choose_us' => [
                    [
                        'title' => 'Technical Excellence',
                        'desc' => 'We produce fully coordinated structural, civil, and M&E packages designed to meet British Standards and building codes.'
                    ],
                    [
                        'title' => 'Clash Detection',
                        'desc' => 'Using advanced software, we coordinate structural frames with drainage runs and M&E services to prevent site conflicts.'
                    ],
                    [
                        'title' => 'Safety-First Design',
                        'desc' => 'Our fire safety consultants integrate compartmentalisation, structural protection, and escape strategies early in the design.'
                    ],
                    [
                        'title' => 'Energy Efficiency',
                        'desc' => 'We optimize technical services and building envelopes to achieve high energy performance ratings and low running costs.'
                    ]
                ],
                'services_offered' => [
                    'Architectural services' => 'Concept creation, spatial planning, detailed elevations, interior specifications, and construction-level drawing sets.',
                    'Structural Services' => 'Structural steelwork designs, reinforced concrete calculations, load-bearing masonry analysis, and timber frame designs.',
                    'Below Ground Services' => 'Specialist design of below-ground drainage layouts, attenuation tanks, soil drainage networks, and connection details to public sewers.',
                    'Fire Safety Consultancy' => 'Comprehensive fire safety strategies, fire risk assessments, compartmentation layouts, and fire escape route designs.',
                    'M&E services' => 'Design of mechanical, electrical, and plumbing infrastructure including heating layouts, ventilation, power routing, and smart control systems.'
                ],
                'faqs' => [
                    [
                        'q' => 'Why is structural design necessary?',
                        'a' => 'Structural design ensures that a building can safely support all dead loads (its own weight) and live loads (people, furniture, wind) without structural failure.'
                    ],
                    [
                        'q' => 'What are below ground drainage services?',
                        'a' => 'These involve designing systems to manage foul water (waste) and surface water (rainwater) beneath the ground, ensuring proper disposal and preventing flooding.'
                    ],
                    [
                        'q' => 'What does a Fire Safety Strategy include?',
                        'a' => 'A strategy details how a building will detect, contain, and suppress fire, as well as how occupants will safely evacuate and how firefighters will access the building.'
                    ],
                    [
                        'q' => 'Do you coordinate with building control during design?',
                        'a' => 'Yes, we submit all technical designs to building control for plan check approval prior to starting work on site.'
                    ]
                ]
            ];
        }

        // 5. Construction
        if ($slug === 'construction' || str_contains($slug, 'construction')) {
            return [
                'title' => 'Construction',
                'image_url' => 'images/hero_construction.png',
                'about' => 'From ground breaking to structural completion, our construction division delivers robust civil engineering and structural framing solutions. We specialize in the complex, high-risk phases of building delivery, including safe demolition, heavy piling, reinforced foundations, and structural concrete frames. Operating with rigorous safety protocols and heavy plant, we ensure the structural integrity of your build is established on a rock-solid foundation.',
                'why_choose_us' => [
                    [
                        'title' => 'Structural Integrity',
                        'desc' => 'We specialize in heavy civil works, structural concrete, and complex ground engineering to set the foundation for successful builds.'
                    ],
                    [
                        'title' => 'Safety Leadership',
                        'desc' => 'Our sites operate under strict HSE guidelines, with comprehensive risk assessments, method statements, and qualified site managers.'
                    ],
                    [
                        'title' => 'Modern Plant',
                        'desc' => 'We own and operate advanced excavation, piling, and concrete pouring equipment to maintain complete schedule control.'
                    ],
                    [
                        'title' => 'Precision Tolerance',
                        'desc' => 'Using advanced laser-guided surveying and electronic tracking, we build structural frames to millimeter tolerances.'
                    ]
                ],
                'services_offered' => [
                    'Demolition' => 'Safe, controlled demolition of existing structures, site clearance, and recycling of materials in accordance with environmental standards.',
                    'Piling' => 'Installation of deep concrete or steel piles (such as screw, bored, or driven piles) to support heavy structural loads in weak soils.',
                    'Foundations' => 'Design and casting of strip, raft, trench fill, or pile cap foundations engineered specifically for site soil conditions.',
                    'RC Frames' => 'Construction of reinforced concrete (RC) frames, columns, slabs, and retaining walls for multi-storey residential and commercial builds.',
                    'Etc' => 'Associated heavy works including ground retaining structures, basement excavations, structural steel frames, and civil engineering works.'
                ],
                'faqs' => [
                    [
                        'q' => 'What is piling and when is it required?',
                        'a' => 'Piling is the installation of deep structural columns into the ground. It is required when the surface soil is too weak to support a building\'s load.'
                    ],
                    [
                        'q' => 'What is an RC Frame?',
                        'a' => 'An RC (Reinforced Concrete) Frame is a structural skeleton of concrete reinforced with steel bars, providing high strength and fire resistance for buildings.'
                    ],
                    [
                        'q' => 'How do you manage noise and vibration during piling/demolition?',
                        'a' => 'We use low-vibration piling rigs, implement acoustic barriers, and monitor noise and vibration levels to remain within local authority guidelines.'
                    ],
                    [
                        'q' => 'Are you fully insured for demolition works?',
                        'a' => 'Yes, we hold comprehensive public liability, employer\'s liability, and contractor\'s all-risk insurance specifically covering structural works.'
                    ]
                ]
            ];
        }

        // 6. Support Services
        if ($slug === 'support-services' || str_contains($slug, 'support')) {
            return [
                'title' => 'Support Services',
                'image_url' => 'images/service_facilities.png',
                'about' => 'Successful developments require a range of technical approvals, regulatory compliance checks, and environmental surveys before and during construction. Our Support Services division manages these specialized requirements, including local authority planning conditions, Section 106 agreements, environmental assessments, and energy performance calculations. We act as your technical coordinator to ensure all regulatory obligations are discharged smoothly.',
                'why_choose_us' => [
                    [
                        'title' => 'Comprehensive Coordination',
                        'desc' => 'We act as a single coordinator to manage all technical sub-consultants, surveyors, and energy assessors.'
                    ],
                    [
                        'title' => 'Prompt Discharge',
                        'desc' => 'We track all planning conditions and submit required reports early to prevent construction delays on site.'
                    ],
                    [
                        'title' => 'Environmental Compliance',
                        'desc' => 'We ensure all ecological, archaeological, and drainage strategies comply with local and national environmental guidelines.'
                    ],
                    [
                        'title' => 'Energy Performance',
                        'desc' => 'Our energy assessors produce SAP and SBEM calculations to ensure building envelope design meets Part L regulations.'
                    ]
                ],
                'services_offered' => [
                    'Conditions Discharge' => 'Liaising with local planning authorities to submit details and clear pre-commencement and pre-occupation planning conditions.',
                    'S106' => 'Assisting developers with Section 106 planning obligations, developer contributions, and coordination of community infrastructure levy (CIL) matters.',
                    'Archeological and Heriotage Reports' => 'Specialist historical and archaeological impact assessments, heritage statements, and watching briefs for sensitive sites.',
                    'Surface Water and Drainagae' => 'Preparation of Sustainable Drainage Systems (SuDS) reports, surface water run-off calculations, and drainage strategy schemes.',
                    'SAP Calculations' => 'Standard Assessment Procedure (SAP) calculations for residential units to verify compliance with Building Regulations Part L (Conservation of Fuel and Power).'
                ],
                'faqs' => [
                    [
                        'q' => 'What does discharging planning conditions mean?',
                        'a' => 'When planning permission is granted, it often contains conditions that must be formally cleared (discharged) by submitting reports to the planning department.'
                    ],
                    [
                        'q' => 'What is a Section 106 (S106) agreement?',
                        'a' => 'An agreement under Section 106 of the Town and Country Planning Act 1990 between a developer and a local authority to mitigate the impact of development on the community.'
                    ],
                    [
                        'q' => 'Why do I need a SAP calculation?',
                        'a' => 'SAP calculations are required by Building Regulations to prove that a new build home meets carbon emission targets and energy efficiency standards.'
                    ],
                    [
                        'q' => 'What is a SuDS report?',
                        'a' => 'A Sustainable Drainage Systems (SuDS) report details how rainwater running off a new building or hard surface will be managed to prevent local flooding.'
                    ]
                ]
            ];
        }

        // 7. Building Control
        if ($slug === 'building-control' || str_contains($slug, 'control')) {
            return [
                'title' => 'Building Control',
                'image_url' => 'images/service_commercial.png',
                'about' => 'Building control is the essential framework that ensures all structures are safe, energy-efficient, and accessible. At Construction 360 Ltd, we manage the entire building control process, working with local authorities and approved private inspectors. We handle structural plan check submissions, schedule on-site inspections at critical build stages, and secure the final completion certificates that validate your building\'s structural compliance.',
                'why_choose_us' => [
                    [
                        'title' => 'Full Compliance',
                        'desc' => 'We guarantee that all designs and structural works are executed to fully satisfy building regulations Part A through S.'
                    ],
                    [
                        'title' => 'Approved Inspectors',
                        'desc' => 'We work with top-tier private approved inspectors to speed up plan checks and ensure flexible, prompt site inspections.'
                    ],
                    [
                        'title' => 'Rigorous Inspection Coordination',
                        'desc' => 'We manage inspections for excavations, foundations, damp proof courses, drainage, pre-plaster, and completion.'
                    ],
                    [
                        'title' => 'Final Certification',
                        'desc' => 'We ensure all testing certificates (air pressure, acoustics, electrical, gas) are compiled to secure your final Completion Certificate.'
                    ]
                ],
                'services_offered' => [
                    'Building Regulations Submissions' => 'Compilation and submission of detailed technical drawings, structural calculations, and specifications for full plans check approval.',
                    'Inspector Liaison & Site Inspections' => 'Coordinating key inspection stages on site with local authority building control officers or approved private inspectors.',
                    'Final Completion Certification' => 'Securing the final Building Control Completion Certificate by compiling all necessary commissioning certificates and structural sign-offs.'
                ],
                'faqs' => [
                    [
                        'q' => 'What is the difference between Planning Permission and Building Control?',
                        'a' => 'Planning permission deals with the use of land, the appearance of a building, and its impact on the neighborhood. Building control deals with structural integrity, safety, fire escape, and energy efficiency.'
                    ],
                    [
                        'q' => 'When is building control approval required?',
                        'a' => 'Approval is required for almost all new buildings, structural alterations, extensions, loft conversions, and changes of use.'
                    ],
                    [
                        'q' => 'What happens if building control sign-off is not obtained?',
                        'a' => 'Without sign-off, it is illegal to occupy the building, you could face local authority enforcement action, and the property cannot be sold or financed.'
                    ],
                    [
                        'q' => 'How are building inspections scheduled?',
                        'a' => 'We coordinate with the inspector to check the work at key milestones: foundation excavations, concrete pours, drainage laying, floor structures, roof structures, and final completion.'
                    ]
                ]
            ];
        }

        // 8. Facilities Management
        if ($slug === 'facilities-management' || str_contains($slug, 'facilities') || str_contains($slug, 'maintenance')) {
            return [
                'title' => 'Facilities Management',
                'image_url' => 'images/service_facilities.png',
                'about' => 'Property ownership doesn’t end at completion—it’s an ongoing commitment that demands consistent attention, proactive maintenance, and rapid response when issues arise. At Construction 360 Ltd, our Managed Services division provides comprehensive facilities management for residential blocks, commercial properties, and mixed-use developments. With over 300 units under our management, we’ve developed robust systems and trusted supplier relationships that keep buildings running smoothly, tenants satisfied, and property values protected.',
                'why_choose_us' => [
                    [
                        'title' => 'Responsive Service',
                        'desc' => 'Emergency response with guaranteed call-back times. Routine requests handled within agreed SLAs.'
                    ],
                    [
                        'title' => 'Proactive Maintenance',
                        'desc' => 'Planned preventative maintenance programmes that catch issues before they become emergencies.'
                    ],
                    [
                        'title' => 'In-House Capability',
                        'desc' => 'From minor repairs to major remedial works, we handle everything with our in-house trade teams.'
                    ],
                    [
                        'title' => 'Transparent Reporting',
                        'desc' => 'Detailed reports outlining works completed, compliance statuses, and upcoming preventative tasks.'
                    ]
                ],
                'services_offered' => [
                    'Reactive Maintenance & Repairs' => 'Rapid response to tenant-reported issues and property emergencies. Our team handles everything from leaking taps and faulty electrics to boiler breakdowns and security concerns.',
                    'Planned Preventative Maintenance (PPM)' => 'Structured maintenance programmes designed to extend asset life, maintain compliance, and prevent costly emergency repairs. PPM schedules typically include: HVAC servicing, gutter clearance, roof inspections, communal lighting checks, fire safety equipment testing, lift maintenance coordination, drainage surveys, and decorative upkeep cycles.',
                    'Communal Area Management' => 'Comprehensive care for shared spaces in residential blocks and commercial buildings. Services include regular cleaning, lighting maintenance, entrance door and intercom upkeep, bin store management, car park maintenance, garden and landscaping coordination, and decorative refresh programmes.',
                    'Building Fabric Maintenance' => 'Ongoing care for the physical structure and exterior of your property. Services include roof repairs and maintenance, external redecoration programmes, window and door maintenance, brickwork and pointing repairs, balcony inspections and repairs, rainwater goods maintenance, and structural monitoring where required.',
                    'Emergency & Out-of-Hours Service' => 'Round-the-clock coverage for genuine emergencies. Our 24/7 service handles burst pipes, security breaches, dangerous structural issues, power failures, and other urgent situations that can\'t wait until morning.'
                ],
                'faqs' => [
                    [
                        'q' => 'What size properties do you manage?',
                        'a' => 'We manage properties of all sizes, from individual residential buy-to-let apartments and blocks of flats to commercial office buildings, industrial spaces, and mixed-use retail blocks.'
                    ],
                    [
                        'q' => 'How does your pricing work?',
                        'a' => 'We offer both fixed-rate monthly retainer packages for planned maintenance and transparent hourly rates for reactive callouts. We can tailor an agreement based on your portfolio size.'
                    ],
                    [
                        'q' => 'What\'s your response time for emergencies?',
                        'a' => 'We provide a guaranteed 4-hour response time for structural, electrical, or plumbing emergencies that pose an immediate risk to the property or occupant safety.'
                    ],
                    [
                        'q' => 'Are your trade teams fully certified?',
                        'a' => 'Yes, all our engineers and tradespeople are fully certified, including Gas Safe, NICEIC registered electricians, and SafeContractor approved technicians.'
                    ]
                ]
            ];
        }
        
        return null;
    }
}


