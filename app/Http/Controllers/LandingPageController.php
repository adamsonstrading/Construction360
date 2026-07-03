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

        // Sectors grid — load from DB if an admin has saved them, otherwise use defaults
        $sectorsRaw = $content['homepage_sectors'] ?? null;
        $sectors = $sectorsRaw ? json_decode($sectorsRaw, true) : [
            ['icon' => 'home',                 'title' => 'Residential',          'desc' => 'Extensions, loft conversions, renovations and full new-build residential construction.'],
            ['icon' => 'building-office',      'title' => 'Commercial',           'desc' => 'Office fit-outs, retail spaces, warehouses and bespoke commercial developments.'],
            ['icon' => 'building-office-2',    'title' => 'Industrial',           'desc' => 'Factory units, logistics hubs and large-scale industrial construction projects.'],
            ['icon' => 'squares-plus',         'title' => 'Mixed-Use',            'desc' => 'Integrated residential and commercial schemes delivered on time and to specification.'],
            ['icon' => 'chevron-double-up',    'title' => 'Structural Works',     'desc' => 'Reinforced concrete, steelwork, masonry, brickwork and timber frame structures.'],
            ['icon' => 'adjustments-horizontal','title' => 'MEP Services',        'desc' => 'Complete mechanical, electrical, plumbing, HVAC and building services solutions.'],
            ['icon' => 'paint-brush',          'title' => 'Interior Fit-Out',     'desc' => 'Premium interior refurbishment, flooring, carpentry and decorating services.'],
            ['icon' => 'cube',                 'title' => 'Civil Engineering',    'desc' => 'Roads, drainage, utilities, groundworks and infrastructure projects across the UK.'],
            ['icon' => 'sparkles',             'title' => 'Specialist Services',  'desc' => 'Scaffolding, crane hire, waterproofing, concrete repairs and metal fabrication.'],
        ];

        return view('welcome', compact('content', 'services', 'blogs', 'projects', 'team', 'sectors'));
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
        
        // Find the service by slug
        $service = null;
        foreach ($services as $srv) {
            if (\Illuminate\Support\Str::slug($srv->title) === $slug) {
                $service = $srv;
                break;
            }
        }
        
        if (!$service) {
            $details = $this->getServiceDetails($slug);
            if (!$details) {
                abort(404, 'Service not found');
            }
            $details['meta_title'] = null;
            $details['meta_description'] = null;
            $details['meta_keywords'] = null;
        } else {
            $details = [
                'title' => $service->title,
                'image_url' => $service->image_url,
                'about' => $service->about,
                'why_choose_us' => is_string($service->why_choose_us) ? json_decode($service->why_choose_us, true) : $service->why_choose_us,
                'services_offered' => is_string($service->services_offered) ? json_decode($service->services_offered, true) : $service->services_offered,
                'faqs' => is_string($service->faqs) ? json_decode($service->faqs, true) : $service->faqs,
                'meta_title' => $service->meta_title,
                'meta_description' => $service->meta_description,
                'meta_keywords' => $service->meta_keywords,
            ];

            // Fallback empty fields to defaults from controller
            $defaults = $this->getServiceDetails($slug);
            if ($defaults) {
                if (empty($details['image_url'])) $details['image_url'] = $defaults['image_url'];
                if (empty($details['about'])) $details['about'] = $defaults['about'];
                if (empty($details['why_choose_us'])) $details['why_choose_us'] = $defaults['why_choose_us'];
                if (empty($details['services_offered'])) $details['services_offered'] = $defaults['services_offered'];
                if (empty($details['faqs'])) $details['faqs'] = $defaults['faqs'];
            }
        }

        $details['slug'] = $slug;
        // Normalise services_offered so every entry always has title, desc, and slug keys
        if (!empty($details['services_offered']) && is_array($details['services_offered'])) {
            $details['services_offered'] = $this->normaliseServicesOffered($details['services_offered']);
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
    /**
     * Normalise a services_offered array so every entry is a uniform
     * ['title' => ..., 'desc' => ..., 'slug' => ...] array regardless
     * of the format the data was originally stored in.
     *
     * Supported input formats:
     *  - ['Title' => 'Description string'] (legacy key=>value)
     *  - [['title' => ..., 'desc' => ...]] (structured, slug may be missing)
     *  - [['title' => ..., 'desc' => ..., 'slug' => ...]] (fully structured)
     */
    private function normaliseServicesOffered(array $raw): array
    {
        $normalised = [];
        foreach ($raw as $key => $value) {
            if (is_array($value)) {
                // Already a structured array — ensure slug and desc exist
                $title = $value['title'] ?? (is_string($key) ? $key : '');
                
                // Normalise deliverables to array of strings
                $deliverablesRaw = $value['deliverables'] ?? '';
                $deliverables = [];
                if (is_array($deliverablesRaw)) {
                    $deliverables = $deliverablesRaw;
                } elseif (is_string($deliverablesRaw) && trim($deliverablesRaw) !== '') {
                    $deliverables = array_map('trim', explode(',', $deliverablesRaw));
                } else {
                    $deliverables = [
                        'Regulatory & Code Compliance',
                        'Quality Assured Craftsmanship',
                        'Experienced Civil Engineers',
                        'Comprehensive Sign-Off'
                    ];
                }

                $normalised[] = [
                    'title' => $title,
                    'desc'  => $value['desc'] ?? $value['description'] ?? '',
                    'slug'  => $value['slug'] ?? \Illuminate\Support\Str::slug($title),
                    'deliverables' => $deliverables,
                ] + $value;
            } else {
                // Legacy 'Title' => 'Description string' format
                $title = is_string($key) ? $key : (string) $value;
                $desc  = is_string($value) ? $value : '';
                $normalised[] = [
                    'title' => $title,
                    'desc'  => $desc,
                    'slug'  => \Illuminate\Support\Str::slug($title),
                    'deliverables' => [
                        'Regulatory & Code Compliance',
                        'Quality Assured Craftsmanship',
                        'Experienced Civil Engineers',
                        'Comprehensive Sign-Off'
                    ],
                ];
            }
        }
        return $normalised;
    }

    public function getServiceDetails($slug)
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
                    'New Build Homes' => 'End-to-end design and construction of high-specification bespoke residential homes.',
                    'Residential Developments' => 'Delivery of multi-unit residential housing projects and blocks of flats.',
                    'Commercial Buildings' => 'Design and construction of premium retail units, corporate offices, and warehouses.',
                    'High-Rise Developments' => 'Multi-storey concrete and steel framing solutions for urban residential and commercial spaces.',
                    'Mixed-Use Developments' => 'Integrated builds combining ground-floor commercial space with upper-level residential units.',
                    'Warehouses & Industrial Buildings' => 'Bespoke steel-portal frame industrial buildings and storage facilities.',
                    'Home Extensions' => 'Expanding ground-floor and multi-storey layouts with premium rear and side extensions.',
                    'Loft Conversions' => 'Transforming unused roof voids into premium habitable rooms with full structural support.',
                    'Garage Conversions' => 'Converting standard garages into fully insulated modern home offices or annexes.',
                    'Basement Conversions' => 'Excavation and structural waterproofing to create habitable lower-ground floor spaces.',
                    'Bespoke Outbuildings' => 'High-specification garden rooms, home offices, gyms, and custom summerhouses.',
                    'Property Refurbishments' => 'Comprehensive updates to modernize property interiors, layouts, and services.',
                    'Home Renovations' => 'Structural and aesthetic updates to restore residential properties to pristine conditions.',
                    'Structural Alterations' => 'Creating open-plan spaces through structural steel installations and wall removals.',
                    'Listed Building Restoration' => 'Sensitive repair and renovation of historic structures using traditional techniques.',
                    'Commercial Fit-Out' => 'Comprehensive interior fit-out for retail, leisure, and commercial business units.',
                    'Office Fit-Out' => 'Creating modern, collaborative workspaces with custom partition walls, power, and lighting.'
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
                    'Architectural Planning Drawings' => 'Detailed layouts, elevations, and site plans tailored for local planning authority reviews.',
                    'Planning Consultancy' => 'Expert advice on policy compliance, permitted development limits, and feasibility assessments.',
                    'Pre-Application Consultations' => 'Formal submissions and negotiations with local authorities to assess project feasibility.',
                    'Full Planning Applications' => 'Preparation and management of full planning application submissions for minor and major schemes.',
                    'Planning Permission' => 'Navigating regulatory requirements to secure legal planning permission for new developments.',
                    'Planning Conditions & Discharge' => 'Coordinating surveys and technical reports to clear pre-commencement planning conditions.',
                    'Feasibility Studies' => 'Comprehensive site assessments to determine development constraints and potential yields.',
                    'Site Surveys & Ground Investigation' => 'Topographical, utility, and soil surveys to inform design and structural engineering.',
                    'Civil Engineering Design' => 'Design of access roads, drainage networks, and external works infrastructure.',
                    'Environmental & Planning Reports' => 'Eco, noise, trees, and daylight reports to satisfy planning requirements.'
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
                'image_url' => 'images/service_finance.png',
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
                    'Development Finance Sourcing' => 'Structuring and securing optimal funding for ground-up construction and land acquisitions.',
                    'Financial Feasibility Appraisals' => 'Detailed cash flow models and cost planning to verify project commercial viability.',
                    'Cost Planning & Estimation' => 'Compiling precise construction cost estimates to set initial project budgets.',
                    'Quantity Surveying' => 'Bill of Quantities preparation and ongoing cost management to control spend.',
                    'Equity & Joint Venture Advisory' => 'Structuring joint ventures and mezzanine funding to optimize developer equity contributions.',
                    'Drawdown & Monitoring Management' => 'Coordinating monthly surveyor valuations and site inspections to ensure smooth funds release.',
                    'Project Cost Control' => 'Ongoing budget tracking and variance analysis to prevent cost overruns.',
                    'Budget Management' => 'Strategic allocation of development funds to maximize return on investment.'
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
                    'Architectural Services' => 'Creative layout designs, detailed building regulations plans, and 3D architectural renders.',
                    'Structural Engineering' => 'Structural calculation packages, steelwork details, and load-bearing concrete specs.',
                    'Civil Engineering' => 'Civil design services for site infrastructure, highway works, and retaining structures.',
                    'Quantity Surveying' => 'Expert cost engineering, pricing surveys, and material calculations.',
                    'Project Management' => 'Comprehensive contract administration and technical coordination of design teams.',
                    'Building Regulations Design' => 'Producing technical specification drawing packages for full building control approval.',
                    'Building Control Consultancy' => 'Expert advice on building safety codes, fire strategies, and accessibility laws.',
                    'CDM Principal Designer' => 'Managing health and safety risks during the pre-construction design phase.',
                    'Below Ground Drainage Design' => 'Design of foul water disposal, surface water attenuation, and sewer connections.',
                    'MEP Design' => 'Integrated design of mechanical, electrical, and plumbing engineering layouts.',
                    'Mechanical Engineering' => 'Heating, ventilation, and air conditioning system layouts and thermal load calculations.',
                    'Electrical Engineering' => 'Power distribution, lighting, security, and smart home system specifications.',
                    'Fire Engineering' => 'Designing structural fire protection, compartmentation, and safe escape pathways.',
                    'HVAC Design' => 'Optimal heating, ventilation, and cooling layout specifications for energy efficiency.',
                    'Plumbing & Heating Design' => 'Domestic hot and cold water services and underfloor heating system designs.',
                    'Ventilation Design' => 'Mechanical Ventilation Heat Recovery (MVHR) and extract duct layouts.',
                    'Air Conditioning Design' => 'Comfort cooling system specifications and refrigerant pipework layouts.'
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
                    'Site Preparation' => 'Demolition, Strip Out, Site Clearance, Groundworks, Earthworks, Excavation, and Utility Installation.',
                    'Foundations & Substructure' => 'Foundations, Piling, Basement Construction, and Ground Beams.',
                    'Structural Works' => 'Reinforced Concrete (RC Frames), Structural Steel, Brickwork, and Blockwork.',
                    'Roofing & Building Envelope' => 'Roofing, Waterproofing, Windows, Doors, Glazing, and Cladding.',
                    'MEP Installation' => 'Electrical Installation, Lighting, Fire Alarm Systems, CCTV, Access Control, EV Chargers, and Solar PV.',
                    'Plumbing & Gas' => 'Plumbing, Heating Systems, Boiler Installation, Gas Installation, and Drainage.',
                    'HVAC Installation' => 'Air Conditioning, Ventilation, and Ductwork.',
                    'Interior Works' => 'Drylining, Plastering, Partitions, Suspended Ceilings, Painting & Decorating, Flooring, Tiling, Carpentry, Joinery, Kitchen Installation, and Bathroom Installation.',
                    'External Works' => 'Landscaping, Driveways, Paving, Patios, Decking, Fencing, Gates, and Surfacing.',
                    'Civil Engineering' => 'Roads, Car Parks, Drainage, Utility Works, and Bridge Construction.',
                    'Specialist Services' => 'Scaffolding, Crane Hire, Diamond Drilling, Concrete Cutting, Concrete Repairs, Metal Fabrication, and Structural Welding.'
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
                'image_url' => 'images/service_support.png',
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
                    'Planning Conditions Discharge' => 'Liaising with councils to clear pre-commencement and pre-occupation planning conditions.',
                    'Section 106 & CIL Management' => 'Negotiating Section 106 agreements, infrastructure contributions, and CIL liability assessments.',
                    'Heritage Reports' => 'Impact assessments, heritage statements, and watching briefs for historic sites.',
                    'Archaeological Reports' => 'Impact assessments, mitigation strategies, and watched excavation briefs for historical sites.',
                    'SAP Calculations' => 'Standard Assessment Procedure (SAP) energy ratings to satisfy Part L building compliance.',
                    'Energy Assessments' => 'Comprehensive energy audits and assessments for sustainable construction.',
                    'Building Control Consultancy' => 'Technical advice on fire safety codes, structure, and accessibility laws.',
                    'CDM Principal Designer' => 'Coordinating health and safety risk mitigation during design phases.',
                    'Project Management' => 'End-to-end administration, timelines, and contract coordination.',
                    'Construction Consultancy' => 'Professional advice on construction feasibility, build methods, and quality controls.',
                    'Procurement Advice' => 'Strategic guidance on material sourcing, logistics, and supply chain management.',
                    'Tender Management' => 'Compiling tender packages, pricing reviews, and contractor selections.'
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
                'image_url' => 'images/service_control.png',
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
                    'Building Regulations Submissions' => 'Preparation of detailed technical specifications and plan-check submissions for full approval.',
                    'Building Regulations Approval' => 'Securing full plan-check approvals from local authorities or private inspectors.',
                    'Building Notice Applications' => 'Filing building notices for minor structural works to expedite site start.',
                    'Site Inspection Coordination' => 'Managing milestone inspections on site (foundations, drainage, structure) with building inspectors.',
                    'Building Inspector Liaison' => 'Direct technical communication to resolve regulatory compliance questions.',
                    'Technical Commissioning' => 'Overseeing commissioning logs for electrical, heating, and ventilation systems.',
                    'Completion Certificates' => 'Securing the final Building Control Completion Certificate to certify structural compliance.',
                    'Fire Safety Compliance' => 'Ensuring materials and layouts comply with Building Regulations Part B safety standards.',
                    'Structural Compliance' => 'Verifying structural load distributions satisfy British Standards.',
                    'Quality Assurance' => 'Rigorous checks to ensure materials and execution meet building specification standards.',
                    'Final Completion Certification' => 'Securing final legal sign-off for occupying or selling the property.'
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
                    'Reactive Maintenance & Repairs' => 'Emergency response teams to resolve plumbing, electrical, and structural issues.',
                    'Planned Preventative Maintenance (PPM)' => 'Scheduled inspections and services to prevent equipment failures.',
                    'Emergency 24/7 Out-of-Hours Service' => 'Round-the-clock telephone and on-site support for building emergencies.',
                    'Property Maintenance' => 'Day-to-day general upkeep, structural repairs, and paintwork touch-ups.',
                    'Building Repairs' => 'Remedial works to correct damp, brickwork cracks, and structural wear and tear.',
                    'Asset Management' => 'Tracking and maintaining plant equipment, elevators, and building services.',
                    'Communal Area Management' => 'Upkeep of shared hallways, bin stores, landscape lawns, and security systems.',
                    'Electrical Maintenance' => 'Periodic inspection testing (EICR), emergency lighting tests, and re-wiring repairs.',
                    'Mechanical Maintenance' => 'Servicing boilers, hot water cylinders, pumps, and water booster systems.',
                    'HVAC Servicing' => 'Filter replacements and pressure checks for heating and air conditioning units.',
                    'Plumbing Maintenance' => 'Pipe leak repairs, valve replacements, and commercial drainage clearance.',
                    'Drainage Maintenance' => 'Routine gutter cleaning, downpipe inspections, and grease-trap maintenance.',
                    'Roofing Maintenance' => 'Inspecting and repairing roof tiles, flat-roof membranes, and lead flashing.',
                    'Landscaping Maintenance' => 'Grounds keeping, lawn mowing, weed control, and garden clearing.'
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

    /**
     * Display the detailed Sub-Service page.
     * Route: /services/{service_slug}/{sub_service_slug}
     */
    public function showSubService($serviceSlug, $subServiceSlug)
    {
        $content = SiteContent::pluck('value', 'key')->all();
        $services = Service::orderBy('display_order', 'asc')->get();

        // Resolve the parent service (DB first, then static fallback)
        $service = null;
        foreach ($services as $srv) {
            if (\Illuminate\Support\Str::slug($srv->title) === $serviceSlug) {
                $service = $srv;
                break;
            }
        }

        if (!$service) {
            $details = $this->getServiceDetails($serviceSlug);
            if (!$details) {
                abort(404, 'Service not found');
            }
            $details['meta_title'] = null;
            $details['meta_description'] = null;
            $details['meta_keywords'] = null;
        } else {
            $details = [
                'title'          => $service->title,
                'image_url'      => $service->image_url,
                'about'          => $service->about,
                'why_choose_us'  => is_string($service->why_choose_us)  ? json_decode($service->why_choose_us,  true) : $service->why_choose_us,
                'services_offered' => is_string($service->services_offered) ? json_decode($service->services_offered, true) : $service->services_offered,
                'faqs'           => is_string($service->faqs)           ? json_decode($service->faqs,           true) : $service->faqs,
                'meta_title'     => $service->meta_title,
                'meta_description' => $service->meta_description,
                'meta_keywords'  => $service->meta_keywords,
            ];

            $defaults = $this->getServiceDetails($serviceSlug);
            if ($defaults) {
                if (empty($details['image_url']))       $details['image_url']       = $defaults['image_url']       ?? null;
                if (empty($details['about']))            $details['about']            = $defaults['about']            ?? null;
                if (empty($details['why_choose_us']))   $details['why_choose_us']   = $defaults['why_choose_us']   ?? [];
                if (empty($details['services_offered'])) $details['services_offered'] = $defaults['services_offered'] ?? [];
                if (empty($details['faqs']))             $details['faqs']             = $defaults['faqs']             ?? [];
            }
        }

        $details['slug'] = $serviceSlug;
        // Normalise sub-services so every entry has title, desc, slug
        if (!empty($details['services_offered']) && is_array($details['services_offered'])) {
            $details['services_offered'] = $this->normaliseServicesOffered($details['services_offered']);
        }

        // Find the specific sub-service by slug
        $subService = null;
        foreach ($details['services_offered'] as $sub) {
            if (($sub['slug'] ?? '') === $subServiceSlug) {
                $subService = $sub;
                break;
            }
        }

        if (!$subService) {
            abort(404, 'Sub-service not found');
        }

        return view('services.sub_show', compact('content', 'services', 'details', 'subService', 'serviceSlug', 'subServiceSlug'));
    }
}


