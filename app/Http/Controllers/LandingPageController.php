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
        
        // Slug mapping for backward compatibility
        if ($slug === 'planning' || $slug === 'design' || $slug === 'support-services' || $slug === 'building-control') {
            $slug = 'pre-construction';
        } elseif ($slug === 'design-and-build') {
            $slug = 'renovation-and-property-improvements';
        } elseif ($slug === 'construction') {
            $slug = 'structural-works';
        } elseif ($slug === 'facilities-management') {
            $slug = 'mep-services';
        }

        // 1. Pre-Construction
        if ($slug === 'pre-construction' || str_contains($slug, 'pre-construction') || str_contains($slug, 'planning') || str_contains($slug, 'drawings')) {
            return [
                'title' => 'Pre-Construction',
                'image_url' => 'images/hero_architecture.png',
                'about' => 'Before ground breaking, every successful build relies on technical planning, architectural accuracy, and budget alignment. At Construction 360 Ltd, we coordinate your development\'s pre-construction phase, from bespoke architectural design and planning permissions to building regulations compliance and structural engineering. We align design intent with cost plans and site feasibility from day one to ensure your project starts smoothly.',
                'why_choose_us' => [
                    [
                        'title' => 'Policy Expertise',
                        'desc' => 'We navigate permitted development limits, building control, and planning policies across London and Essex.'
                    ],
                    [
                        'title' => 'Precise Visuals',
                        'desc' => 'Our architectural design packages clearly communicate project feasibility and aesthetic value.'
                    ],
                    [
                        'title' => 'Cost Control',
                        'desc' => 'Quantity surveying and financial planning are integrated early to prevent unexpected cost overruns.'
                    ],
                    [
                        'title' => 'Project Administration',
                        'desc' => 'We manage tenders, health and safety (CDM), and pre-commencement planning approvals.'
                    ]
                ],
                'services_offered' => [
                    'Architectural Services' => 'Bespoke design concepts, floor plans, and layout elevations.',
                    'Architectural Design' => 'Detailed interior and exterior spatial architectural designs.',
                    'Planning Permission' => 'Preparing and submitting full planning applications for local authority approval.',
                    'Building Regulations' => 'Technical drawings and specification packages complying with building codes.',
                    'Structural Engineering' => 'Calculation packages and steelwork connection details for structural safety.',
                    'Civil Engineering' => 'Below-ground drainage layouts, site levels, and structural calculations.',
                    'Quantity Surveying' => 'Bills of Quantities, tender packages, and cost planning.',
                    'Project Management' => 'Liaising with surveyors, design teams, and local authorities.',
                    'Construction Management' => 'Detailed schedules and construction execution planning.',
                    'Building Consultancy' => 'Expert advice on structural design and site viability.',
                    'Site Surveys' => 'Comprehensive measured surveys of existing properties.',
                    'Land Surveying' => 'Determining boundary lines and site layouts for construction.',
                    'Topographical Surveys' => 'Mapping site terrain levels, contours, and physical features.',
                    'Ground Investigation' => 'Assessing geological soil profiles and load bearing capacity.',
                    'Soil Testing' => 'Chemical and structural soil testing for foundations and piling.',
                    'Cost Estimation' => 'Compiling accurate itemized estimates of building costs.',
                    'Cost Planning' => 'Developing budget limits and financial controls for development schemes.',
                    'Feasibility Studies' => 'Analyzing site constraints, policy limits, and development yields.',
                    'Planning Consultancy' => 'Strategic advice on planning regulations and permitted developments.',
                    'Building Control Consultancy' => 'Advising on accessibility, fire safety, and code compliance.',
                    'Principal Designer (CDM)' => 'Coordinating health and safety risks during design stages.',
                    'Tender Management' => 'Drafting contract packages, managing builder bids, and contract award.'
                ],
                'faqs' => [
                    [
                        'q' => 'How long does it take to secure planning permission?',
                        'a' => 'Council determination typically takes 8 weeks for householders/minor works and 13 weeks for major schemes from the validation date.'
                    ],
                    [
                        'q' => 'What does a feasibility study cover?',
                        'a' => 'It evaluates development yield, planning policy risks, utility constraints, and structural buildability to ensure your scheme is commercial.'
                    ],
                    [
                        'q' => 'Why is a soil test required?',
                        'a' => 'Soil testing determines the soil\'s bearing capacity, moisture content, and depth, allowing structural engineers to design the correct foundation.'
                    ],
                    [
                        'q' => 'What is the role of the CDM Principal Designer?',
                        'a' => 'They manage health and safety risks during the pre-construction phase, preparing the file to ensure the build remains safe.'
                    ]
                ]
            ];
        }

        // 2. Site Preparation
        if ($slug === 'site-preparation' || str_contains($slug, 'site-prep') || str_contains($slug, 'clearance')) {
            return [
                'title' => 'Site Preparation',
                'image_url' => 'images/service_support.png',
                'about' => 'Transforming raw land or old structures into a builder-ready site requires heavy plant expertise and absolute precision. Construction 360 Ltd handles all aspects of site preparation, including land clearance, structural demolition, internal strip outs, earthworks, and service utility installations. We execute all works under strict environmental controls to prepare your plot safely for ground breaking.',
                'why_choose_us' => [
                    [
                        'title' => 'Safe Demolition',
                        'desc' => 'We execute structural demolition and strip outs following strict HSE guidelines and method statements.'
                    ],
                    [
                        'title' => 'High Precision',
                        'desc' => 'Laser-guided excavation and site grading ensure site levels match architectural datum points.'
                    ],
                    [
                        'title' => 'Drainage Works',
                        'desc' => 'We install pre-construction drainage infrastructure and connection channels early.'
                    ],
                    [
                        'title' => 'Utility Liaison',
                        'desc' => 'We manage service trench installations and coordinate mains hookups with utility boards.'
                    ]
                ],
                'services_offered' => [
                    'Site Clearance' => 'Removing obstacles, debris, and vegetative growth from the site.',
                    'Land Clearance' => 'Clearing larger plots and greenfield/brownfield sites.',
                    'Demolition' => 'Controlled structural demolition of residential and commercial units.',
                    'Strip Out' => 'Removing internal partitions, finishes, and services prior to refurbishment.',
                    'Excavation' => 'Deep digging for foundations, drainage, and basements.',
                    'Groundworks' => 'Initial sub-structural works including earth moving and pipe laying.',
                    'Earthworks' => 'Moving and reshaping soil levels to specification.',
                    'Site Levelling' => 'Grading the site to establish level construction platforms.',
                    'Drainage Installation' => 'Laying foul water sewers and rainwater drainage channels.',
                    'Utility Installation' => 'Coordinating service duct runs for electric, water, and gas mains.'
                ],
                'faqs' => [
                    [
                        'q' => 'Do you handle hazardous materials like asbestos during demolition?',
                        'a' => 'Yes. We coordinate independent asbestos testing and handle fully certified removal and disposal before structural works begin.'
                    ],
                    [
                        'q' => 'What is a strip-out service?',
                        'a' => 'A strip-out clears all non-structural components (partitions, carpets, wiring, plumbing) back to the masonry shell, preparing it for refurbishment.'
                    ],
                    [
                        'q' => 'How do you protect adjacent buildings during excavation?',
                        'a' => 'We implement vibration sensors, dust sheets, and design temporary structural shoring to ensure complete stability.'
                    ]
                ]
            ];
        }

        // 3. Foundations
        if ($slug === 'foundations' || str_contains($slug, 'foundation') || str_contains($slug, 'piling')) {
            return [
                'title' => 'Foundations',
                'image_url' => 'images/hero_construction.png',
                'about' => 'A build is only as secure as the ground it rests upon. Our foundations team delivers heavy sub-structure concrete engineering for sites with complex structural requirements or challenging ground conditions. We specialize in deep piling systems, reinforced concrete slab foundations, ground beam installation, and waterproof basement constructions built to transfer structural loads safely.',
                'why_choose_us' => [
                    [
                        'title' => 'Engineering Precision',
                        'desc' => 'All foundation pours are executed exactly to structural calculations and inspected by building control.'
                    ],
                    [
                        'title' => 'Piling Capabilities',
                        'desc' => 'Screw, mini, and bored piling options to resolve soft or shrinkable clay soil issues.'
                    ],
                    [
                        'title' => 'Waterproof Basements',
                        'desc' => 'We design and construct below-ground basements with Type A, B, and C waterproofing to BS 8102 standards.'
                    ],
                    [
                        'title' => 'Certified Materials',
                        'desc' => 'We use only high-specification reinforced steel and certified concrete mixes for maximum strength.'
                    ]
                ],
                'services_offered' => [
                    'Foundations' => 'Construction of strip, trench fill, raft, or pad foundations.',
                    'Piling' => 'Bored, driven, or screw piling for low bearing capacity ground.',
                    'Concrete Foundations' => 'Pouring reinforced concrete slabs and ground beams.',
                    'Basement Construction' => 'Sub-ground excavation, retaining walls, and waterproofing.'
                ],
                'faqs' => [
                    [
                        'q' => 'What is piling and when is it required?',
                        'a' => 'Piling involves driving or boring structural columns deep into the ground. It is required when topsoil is soft, clay is shrinkable, or structural loads are too high for standard foundations.'
                    ],
                    [
                        'q' => 'How do you guarantee a dry basement?',
                        'a' => 'We combine waterproof concrete (Type B) with external tanking membranes (Type A) and cavity drain pumps (Type C) to prevent water ingress.'
                    ],
                    [
                        'q' => 'What inspection steps happen during a foundation pour?',
                        'a' => 'Building Control checks excavation depth, reinforcement steel layouts, and tests concrete samples during the pour for quality compliance.'
                    ]
                ]
            ];
        }

        // 4. Structural Works
        if ($slug === 'structural-works' || str_contains($slug, 'structural') || str_contains($slug, 'bricklaying')) {
            return [
                'title' => 'Structural Works',
                'image_url' => 'images/about_engineering.png',
                'about' => 'Erecting the load-bearing frame of a building demands qualified trades and meticulous coordination. Construction 360 Ltd delivers full-scale structural framing and masonry solutions. We construct reinforced concrete (RC) frames, erect multi-storey structural steel portals, lay facing brickwork, and assemble structural timber frame systems built to withstand the test of time.',
                'why_choose_us' => [
                    [
                        'title' => 'Coded Welding',
                        'desc' => 'Our site steelwork is assembled and welded by coded structural fabricators in compliance with building regulations.'
                    ],
                    [
                        'title' => 'RC Frame Expertise',
                        'desc' => 'We build reinforced concrete structures with precision formwork and curing controls.'
                    ],
                    [
                        'title' => 'Premium Masonry',
                        'desc' => 'External brickwork, blockwork, and decorative stonework executed to impeccable aesthetic standards.'
                    ],
                    [
                        'title' => 'Timber Craft',
                        'desc' => 'Structural timber frame erection, joist layouts, and roof truss systems built by master carpenters.'
                    ]
                ],
                'services_offered' => [
                    'Reinforced Concrete' => 'Constructing RC frames, columns, slabs, and retaining walls.',
                    'Concrete Works' => 'Formwork, steel reinforcement installation, and concrete finishing.',
                    'Steel Frame Construction' => 'Erecting structural steel portals and multi-storey frames.',
                    'Structural Steel' => 'Fabrication and installation of steel beams, columns, and splices.',
                    'Bricklaying' => 'High-quality external facing brickwork and load-bearing walls.',
                    'Blockwork' => 'Internal partition load walls using dense or lightweight thermal blocks.',
                    'Stonework' => 'Bespoke stone facades, walling, and decorative masonry arches.',
                    'Timber Frame Construction' => 'Erecting pre-fabricated or site-built timber frames.',
                    'Masonry' => 'Traditional load-bearing block, brick, and stone structures.'
                ],
                'faqs' => [
                    [
                        'q' => 'What is the advantage of an RC (Reinforced Concrete) Frame?',
                        'a' => 'RC frames offer exceptional load capacity, spans, sound insulation, and fire safety, making them ideal for multi-unit and commercial builds.'
                    ],
                    [
                        'q' => 'Do you fabricate your own structural steel beams?',
                        'a' => 'Yes, we supply, fabricate, and install custom steel beams (RSJs), portal frames, and structural connections to detail.'
                    ],
                    [
                        'q' => 'Can you construct architectural timber frame buildings?',
                        'a' => 'Yes. We erect modern timber frame systems that offer rapid construction speed and outstanding energy-efficiency values.'
                    ]
                ]
            ];
        }

        // 5. Roofing & Building Envelope
        if ($slug === 'roofing-and-building-envelope' || str_contains($slug, 'roofing') || str_contains($slug, 'envelope')) {
            return [
                'title' => 'Roofing & Building Envelope',
                'image_url' => 'images/blog_glazing.png',
                'about' => 'A property\'s external shell must provide total weather protection while maintaining high thermal performance. Our roofing and building envelope division specializes in flat and pitched roof installations, using modern slate, clay tiles, GRP fiberglass, and EPDM rubber membranes. We also coordinate insulation upgrades and structural roof timbers to secure a fully watertight, energy-efficient building envelope.',
                'why_choose_us' => [
                    [
                        'title' => 'Watertight Guarantees',
                        'desc' => 'We offer long-term warranties on our EPDM, GRP fiberglass, and pitched roof tiling installations.'
                    ],
                    [
                        'title' => 'Traditional Slating',
                        'desc' => 'Expert tile and slate roofers capable of detailing complex valleys, dormers, and lead flashing.'
                    ],
                    [
                        'title' => 'Part L Compliance',
                        'desc' => 'We integrate warm-roof insulation strategies to satisfy modern energy efficiency building codes.'
                    ],
                    [
                        'title' => 'Envelope Integrity',
                        'desc' => 'We coordinate flashings, gutters, fascia boards, and cladding to protect your walls.'
                    ]
                ],
                'services_offered' => [
                    'Roofing' => 'Complete roof installations for residential and commercial schemes.',
                    'Flat Roofing' => 'EPDM rubber, GRP fiberglass, and torch-on felt installations.',
                    'Pitched Roofing' => 'Slating, tiling, and timber roof truss erection.',
                    'Roof Repairs' => 'Replacing broken slates, repairing lead valleys, and leaks.',
                    'Roof Replacement' => 'Full strip-out and re-roofing including underlay and battens.'
                ],
                'faqs' => [
                    [
                        'q' => 'Which is better for a flat roof: GRP Fiberglass or EPDM Rubber?',
                        'a' => 'GRP is seamless, tough, and ideal for balconies/walkways. EPDM is flexible, synthetic rubber that handles thermal expansion perfectly and has an outstanding lifespan.'
                    ],
                    [
                        'q' => 'Do you install warm-roof or cold-roof insulation systems?',
                        'a' => 'We install both. Warm-roof systems place insulation above the structural timber deck, preventing cold bridging and condensation issues.'
                    ],
                    [
                        'q' => 'What causes roof leaks and how are they repaired?',
                        'a' => 'Cracked lead valleys, loose slates, or deteriorated flat roof joints. We locate the root cause, renew the membrane or tiles, and install code-compliant lead flashings.'
                    ]
                ]
            ];
        }

        // 6. MEP Services
        if ($slug === 'mep-services' || str_contains($slug, 'mep') || str_contains($slug, 'electrical') || str_contains($slug, 'plumbing') || str_contains($slug, 'hvac')) {
            return [
                'title' => 'MEP Services',
                'image_url' => 'images/blog_integrated.png',
                'about' => 'Mechanical, Electrical, and Plumbing (MEP) systems are the vital services that bring buildings to life. At Construction 360 Ltd, our registered NICEIC electrical contractors and Gas Safe engineers deliver integrated MEP solutions. From full property rewires and smart home installations to central heating, HVAC ventilation, and renewable solar systems, we ensure complete compliance with BS regulations.',
                'why_choose_us' => [
                    [
                        'title' => 'NICEIC Approved',
                        'desc' => 'Our electrical division is NICEIC certified, providing full domestic and commercial installation certificates.'
                    ],
                    [
                        'title' => 'Gas Safe Registered',
                        'desc' => 'Our plumbing team is Gas Safe certified, ensuring safe gas, boiler, and central heating installs.'
                    ],
                    [
                        'title' => 'Smart Integrations',
                        'desc' => 'We install EV charge points, solar PV systems, battery banks, and secure CCTV access networks.'
                    ],
                    [
                        'title' => 'Climate Systems',
                        'desc' => 'Integrated comfort cooling (AC), central heating, and mechanical ventilation heat recovery (MVHR).'
                    ]
                ],
                'services_offered' => [
                    'Electrical Installation' => 'NICEIC certified power, sockets, distribution boards, and rewiring.',
                    'Rewiring' => 'Replacing old wiring to comply with 18th Edition regulations.',
                    'Lighting Installation' => 'Energy-efficient LED layouts, architectural lighting, and external setups.',
                    'Fire Alarm Installation' => 'Complying with BS 5839 fire detection requirements.',
                    'CCTV Installation' => 'Digital IP security cameras with remote access monitoring.',
                    'Access Control' => 'Biometric scanners, keypads, and intercom door entry setups.',
                    'Data Cabling' => 'Structured Cat6/Cat6a cabling runs and network setups.',
                    'EV Charger Installation' => 'Certified home and commercial electric vehicle chargers.',
                    'Solar Panel Installation' => 'Roof-mounted solar PV panels and battery storage.',
                    'Plumbing' => 'Water mains connections, piping layout runs, and drainage.',
                    'Heating Installation' => 'Boilers, underfloor heating, and radiator systems.',
                    'Gas Installation' => 'Gas Safe registered pipework, gas fires, and cookers.',
                    'Boiler Installation' => 'Combi, system, and heat-only boiler replacements.',
                    'Bathroom Installation' => 'Sanitaryware connections, waste runs, and tiling.',
                    'Drainage' => 'Internal soil stacks, waste pipes, and external gully traps.',
                    'Water Supply Installation' => 'Boosted cold water systems and hot water cylinders.',
                    'HVAC Installation' => 'Comfort heating, ventilation, and air conditioning runs.',
                    'Air Conditioning' => 'Split, multi-split, and VRF cooling system layouts.',
                    'Ventilation' => 'Extractor fans and Mechanical Ventilation Heat Recovery (MVHR) setups.',
                    'Ductwork' => 'Metal and flexible ventilation duct runs for clean airflow.'
                ],
                'faqs' => [
                    [
                        'q' => 'Do you issue building control certificates for electrical and gas works?',
                        'a' => 'Yes. We issue NICEIC Electrical Installation Certificates and Gas Safe compliance notifications to verify all systems meet legal codes.'
                    ],
                    [
                        'q' => 'Why install an MVHR (Mechanical Ventilation Heat Recovery) system?',
                        'a' => 'MVHR extracts warm damp air from kitchens/bathrooms, runs it through a heat exchanger to warm up incoming fresh outdoor air, improving air quality and cutting heating bills.'
                    ],
                    [
                        'q' => 'What is the benefit of underfloor heating (UFH)?',
                        'a' => 'Wet UFH distributes heat evenly at a lower flow temperature, making it highly efficient when paired with modern boilers or heat pumps, while freeing up wall space.'
                    ]
                ]
            ];
        }

        // 7. Interior Works
        if ($slug === 'interior-works' || str_contains($slug, 'interior') || str_contains($slug, 'fit-out') || str_contains($slug, 'refurbishment')) {
            return [
                'title' => 'Interior Works',
                'image_url' => 'images/blog_fitout.png',
                'about' => 'Executing high-spec interior finishes requires meticulous attention to detail and coordinated trades. Our interior division delivers premium residential refurbishments and commercial fit-outs. We handle drylining, drywall partitioning, Level-5 plaster skimming, suspended ceilings, flooring, bespoke carpentry, and complete kitchen and bathroom installations.',
                'why_choose_us' => [
                    [
                        'title' => 'Office & Retail Fit-Outs',
                        'desc' => 'We create bespoke office, retail, and leisure spaces, managing partitions, lighting, and data layouts.'
                    ],
                    [
                        'title' => 'Impeccable Finishes',
                        'desc' => 'Drylining, taping, jointing, and skimming executed to achieve smooth Level-5 finishes.'
                    ],
                    [
                        'title' => 'Master Carpentry',
                        'desc' => 'Bespoke joinery, custom storage units, staircases, and premium door architraves.'
                    ],
                    [
                        'title' => 'Complete Kitchens',
                        'desc' => 'Turnkey kitchen fit-outs including custom cabinetry, solid worktops, tiling, and appliances.'
                    ]
                ],
                'services_offered' => [
                    'House Refurbishment' => 'Complete stripping, re-plastering, painting, and fitting.',
                    'Commercial Fit Out' => 'Turnkey layouts for commercial, retail, and leisure units.',
                    'Office Fit Out' => 'Modern workspaces, partitions, and technical floor power.',
                    'Shop Fit Out' => 'Retail display systems, counters, lighting, and signage.',
                    'Drylining' => 'Stud wall board framing, taping, and jointing.',
                    'Plastering' => 'Skimming, rendering, plaster boarding, and repairing cracks.',
                    'Suspended Ceilings' => 'Grid ceilings for offices and commercial applications.',
                    'Partition Walls' => 'Metal stud and timber partition layouts for spatial separation.',
                    'Painting & Decorating' => 'Airless spray painting, traditional brushwork, and wallpapers.',
                    'Flooring' => 'Laying solid wood, engineered timber, LVT, and laminates.',
                    'Floor Tiling' => 'Porcelain, ceramic, and natural stone floor tiling.',
                    'Wall Tiling' => 'Kitchen splashbacks, bathrooms, and wet-room wall tiling.',
                    'Joinery' => 'Bespoke storage units, wardrobes, and custom furniture.',
                    'Carpentry' => 'Hanging doors, architraves, skirting boards, and floor joists.',
                    'Kitchen Installation' => 'Fitting kitchen cabinets, worktops, sinks, and appliances.',
                    'Bathroom Installation' => 'Fitting shower enclosures, baths, sinks, toilets, and tiling.',
                    'Staircase Installation' => 'Bespoke oak, timber, or metal staircase fabrication.'
                ],
                'faqs' => [
                    [
                        'q' => 'What is Level-5 plaster finish?',
                        'a' => 'Level 5 is the premium standard of drywall finish. It includes a thin skim coat applied over the entire surface, eliminating any visible joint texture under light.'
                    ],
                    [
                        'q' => 'Do you manage office partitions and data cabling runs?',
                        'a' => 'Yes. We install acoustic metal stud partitioning, glass walls, suspended ceilings, and coordinate structured data cables (Cat6) for office workspaces.'
                    ],
                    [
                        'q' => 'How long does a bathroom installation take?',
                        'a' => 'An average high-spec bathroom fit-out takes 10 to 14 days, including stripping, plumbing adjustments, plastering, tanking, tiling, and fixture installs.'
                    ]
                ]
            ];
        }

        // 8. External Works
        if ($slug === 'external-works' || str_contains($slug, 'external') || str_contains($slug, 'landscaping') || str_contains($slug, 'driveway')) {
            return [
                'title' => 'External Works',
                'image_url' => 'images/about_overlap.png',
                'about' => 'The exterior layout of a property determines its curb appeal and complements its architectural design. Construction 360 Ltd delivers external works, including resin driveways, paved block layouts, natural stone patios, composite decking, boundaries, and full garden landscaping. We design and construct hard-wearing, permeable systems built to last.',
                'why_choose_us' => [
                    [
                        'title' => 'Resin Bound Specialists',
                        'desc' => 'We construct UV-stable, permeable resin-bound driveways that are SUDS compliant.'
                    ],
                    [
                        'title' => 'Sandstone & Porcelain Patios',
                        'desc' => 'We lay natural stone and outdoor porcelain tiles over concrete bases for flat, secure patio layouts.'
                    ],
                    [
                        'title' => 'Soft & Hard Landscaping',
                        'desc' => 'Laying premium turf, synthetic lawns, flower beds, and custom planting schemes.'
                    ],
                    [
                        'title' => 'Boundary Security',
                        'desc' => 'Erecting high-spec timber paneling, composite fencing, automated gates, and brick walls.'
                    ]
                ],
                'services_offered' => [
                    'Landscaping' => 'Soft and hard landscaping design and execution.',
                    'Garden Landscaping' => 'Creating lawns, flower beds, pathways, and water features.',
                    'Block Paving' => 'Block paved driveways, pathways, and commercial parking areas.',
                    'Driveways' => 'Excavation, base preparation, and surfacing for cars.',
                    'Patios' => 'Laying large format outdoor porcelain and sandstone slabs.',
                    'Resin Driveways' => 'Permeable resin-bound aggregate driveway installations.',
                    'Tarmac Surfacing' => 'Hot rolled asphalt and tarmac for roads and driveways.',
                    'Fencing' => 'Close board, panel, trellis, and security fencing.',
                    'Gates' => 'Wooden, metal, or automated security gate installations.',
                    'Decking' => 'Composite, hardwood, and softwood timber decking.',
                    'Turfing' => 'Laying premium cultivated lawn turf over prepared topsoil.',
                    'Artificial Grass' => 'Low-maintenance high-density synthetic grass installations.'
                ],
                'faqs' => [
                    [
                        'q' => 'Is planning permission required for a new driveway?',
                        'a' => 'You do not need planning permission if the driveway is permeable or if water drains to a border area. Non-permeable driveways over 5 sqm require permission.'
                    ],
                    [
                        'q' => 'What is the benefit of a resin-bound driveway?',
                        'a' => 'It is highly permeable, which prevents standing water, resistant to weed growth, slip-resistant, and provides a smooth finish.'
                    ],
                    [
                        'q' => 'Does composite decking require maintenance?',
                        'a' => 'No. Composite decking does not require sanding, staining, or sealing. It is rot-resistant and can be cleaned with simple soapy water.'
                    ]
                ]
            ];
        }

        // 9. Civil Engineering
        if ($slug === 'civil-engineering' || str_contains($slug, 'civil-eng') || str_contains($slug, 'road')) {
            return [
                'title' => 'Civil Engineering',
                'image_url' => 'images/hero_construction.png',
                'about' => 'Infrastructure projects require deep excavation capabilities, structural validation, and highway authority coordination. Our civil engineering team executes road construction, car park surfacing, oil bypass interceptors, utility trenching, sewer main installations, and bridge structures. We coordinate Section 278 and Section 104 adoptions directly on your behalf.',
                'why_choose_us' => [
                    [
                        'title' => 'Highway Approved',
                        'desc' => 'NRSWA qualified operatives and supervisors licensed to execute works on public highways.'
                    ],
                    [
                        'title' => 'Deep Drainage Infrastructure',
                        'desc' => 'Installing storm water retention tanks, concrete headwalls, and main sewer connections.'
                    ],
      [
                        'title' => 'Heavy Car Parks',
                        'desc' => 'Complete ground sub-base excavation, drainage, asphalt paving, and space markings.'
                    ],
                    [
                        'title' => 'Section Agreements',
                        'desc' => 'We manage Section 278, Section 38, and Section 104 adoptions with councils and water boards.'
                    ]
                ],
                'services_offered' => [
                    'Road Construction' => 'Excavating and laying sub-base, base, and hot tarmac for roads.',
                    'Car Park Construction' => 'Full groundworks, paving, drainage, and layout markers.',
                    'Drainage Works' => 'Installing surface water retention systems and oil interceptors.',
                    'Utility Works' => 'Laying deep utility main ducts and connection junctions.',
                    'Bridge Construction' => 'Civil engineering concrete foundations and steel bridge spans.',
                    'Sewer Installation' => 'Laying main trunk sewers and manhole installations.'
                ],
                'faqs' => [
                    [
                        'q' => 'What is an S278 highway agreement?',
                        'a' => 'A Section 278 agreement is a legal contract with the Highway Authority allowing developers to make permanent improvements to public roads.'
                    ],
                    [
                        'q' => 'What is an oil bypass interceptor?',
                        'a' => 'It\'s a system installed in drainage networks for car parks and roads to filter and separate oil/fuel spills from stormwater before it enters rivers.'
                    ],
                    [
                        'q' => 'Are your engineers NRSWA qualified?',
                        'a' => 'Yes. Our street works operatives and supervisors are fully certified under the New Roads and Street Works Act.'
                    ]
                ]
            ];
        }

        // 10. Specialist Services
        if ($slug === 'specialist-services' || str_contains($slug, 'specialist') || str_contains($slug, 'drilling')) {
            return [
                'title' => 'Specialist Services',
                'image_url' => 'images/service_facilities.png',
                'about' => 'High-spec builds often require specialized trade operations that demand certified tooling, rigger licensing, or advanced fabrication. Construction 360 Ltd provides scaffold assemblies, mobile crane lifts, core diamond drilling, concrete repairs, on-site structural welding, and custom metal fabrication.',
                'why_choose_us' => [
                    [
                        'title' => 'Lifting Management',
                        'desc' => 'We manage contract lift calculations, supplying cranes, qualified riggers, and lift plans.'
                    ],
                    [
                        'title' => 'Precision Drilling',
                        'desc' => 'Vibration-free core diamond drilling and floor cutting through reinforced concrete walls.'
                    ],
                    [
                        'title' => 'Structural Welding',
                        'desc' => 'Certified mobile welders for fabricating steel frame connections on site.'
                    ],
                    [
                        'title' => 'TG20 Scaffolding',
                        'desc' => 'Erecting tube and fitting scaffolding under TG20 regulations with weekly safety sign-offs.'
                    ]
                ],
                'services_offered' => [
                    'Scaffolding' => 'Erecting tube and fitting scaffolding, temporary roofs, and towers.',
                    'Crane Hire' => 'Coordinating crane hire and contract lifts with qualified riggers.',
                    'Waterproofing' => 'Structural concrete tanking and joint sealing.',
                    'Concrete Repairs' => 'Remedying spalled concrete, rebar protection, and mortar repairs.',
                    'Concrete Cutting' => 'Precision floor sawing and wall cutting services.',
                    'Diamond Drilling' => 'Precision core drilling through reinforced concrete walls.',
                    'Welding' => 'Structural steel MIG/TIG/ARC welding to code.',
                    'Metal Fabrication' => 'Custom brackets, balustrades, and structural steel connections.'
                ],
                'faqs' => [
                    [
                        'q' => 'What is a Contract Lift in crane operations?',
                        'a' => 'A Contract Lift transfers the legal risk, planning, and lifting calculations to us. We provide the crane supervisor, operator, slinger, and full insurance.'
                    ],
                    [
                        'q' => 'Why use diamond drilling over normal drills?',
                        'a' => 'It cuts cleanly through concrete and steel rebar with no percussion vibration, protecting the surrounding structure from fractures.'
                    ],
                    [
                        'q' => 'How do you check scaffold safety?',
                        'a' => 'Scaffolds are inspected by competent, certified scaffold inspectors before first use, after any alterations or bad weather, and every 7 days.'
                    ]
                ]
            ];
        }

        // 11. Renovation & Property Improvements
        if ($slug === 'renovation-and-property-improvements' || str_contains($slug, 'renovation') || str_contains($slug, 'extension') || str_contains($slug, 'loft')) {
            return [
                'title' => 'Renovation & Property Improvements',
                'image_url' => 'images/service_residential.png',
                'about' => 'Reconfiguring or extending existing buildings requires a developer capable of handling structural complexities. Our renovation and extensions division delivers premium home extensions, loft conversions, structural wall removals with steel insertions, garage conversions, and listed building restorations across Essex and London.',
                'why_choose_us' => [
                    [
                        'title' => 'Structural steelwork',
                        'desc' => 'We insert heavy steel columns and beams (RSJs) to safely remove internal load-bearing walls.'
                    ],
                    [
                        'title' => 'Loft Conversions',
                        'desc' => 'Creating habitable bedrooms with Velux, Dormer, or Hip-to-Gable structural roof conversions.'
                    ],
                    [
                        'title' => 'Sensitive Heritage',
                        'desc' => 'We restore listed and historical buildings using traditional materials like lime mortar.'
                    ],
                    [
                        'title' => 'Extensions Specialists',
                        'desc' => 'Rear, side, and wrap-around extensions managed from structural foundation to completion.'
                    ]
                ],
                'services_offered' => [
                    'Home Extensions' => 'Rear, side-return, and wrap-around multi-storey extensions.',
                    'Loft Conversions' => 'Dormer, hip-to-gable, L-shaped, and Velux loft conversions.',
                    'Garage Conversions' => 'Converting garages into home offices, gyms, or annexes.',
                    'House Renovation' => 'Modernizing layout plans, insulation, plumbing, and finishes.',
                    'Property Refurbishment' => 'Updating structural components, services, and decorations.',
                    'Commercial Refurbishment' => 'Refurbishing commercial interiors, fronts, and building layout services.',
                    'Structural Alterations' => 'Removing load bearing walls and inserting steel support beams.',
                    'Listed Building Restoration' => 'Sensitive repairs using heritage-approved techniques and materials.'
                ],
                'faqs' => [
                    [
                        'q' => 'Can we build an extension under Permitted Development?',
                        'a' => 'Yes. Single-storey rear extensions up to 3m (semi-detached) or 4m (detached) can often be built without planning, subject to height and material rules.'
                    ],
                    [
                        'q' => 'How do you support a floor when removing a load-bearing wall?',
                        'a' => 'We install heavy-duty adjustable steel props (Acrows) and steel support needles (Strongboys) before removing the masonry and installing the new steel beam.'
                    ],
                    [
                        'q' => 'What is a Hip-to-Gable loft conversion?',
                        'a' => 'It converts the sloping side roof (hip) into a vertical flat wall (gable), maximizing internal staircase access and head height.'
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


