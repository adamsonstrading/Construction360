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
        
        if ($slug === 'designing-planning' || $slug === 'designing-and-planning') {
            return [
                'title' => 'Designing & Planning',
                'image_url' => 'images/service_design_planning.png',
                'about' => 'Design without delivery is just a drawing. At Construction 360 Ltd, we combine creative design capability with proven construction expertise—a combination that transforms ambitious concepts into buildable, practical, stunning spaces. Our designers work alongside our construction team from day one, ensuring every design decision is both aesthetically excellent and technically sound. For clients across London and Essex, this means designs that don’t just look good on screen, but work brilliantly in reality—on budget, on programme, and exactly as visualised.',
                'why_choose_us' => [
                    [
                        'title' => 'Visual Clarity',
                        'desc' => 'Photorealistic 3D renders and detailed 2D drawings let you experience your project before construction begins. No guesswork, no surprises—just clear, confident decision-making.'
                    ],
                    [
                        'title' => 'Design-Led Delivery',
                        'desc' => 'From first sketch to final handover, design intent is protected throughout. The team that designs your project delivers it, ensuring nothing is compromised in execution.'
                    ],
                    [
                        'title' => 'Integrated Planning',
                        'desc' => 'Our dedicated planning partners handle all applications, consultations, and approvals.'
                    ],
                    [
                        'title' => 'RIBA Framework',
                        'desc' => 'We follow the RIBA Plan of Work from Stage 0 to Stage 7—a structured, proven methodology that ensures quality outcomes at every phase of your project.'
                    ]
                ],
                'services_offered' => [
                    '2D Architectural Drawings' => 'Comprehensive technical drawings that form the foundation of your project. Our 2D documentation includes site plans, floor plans, elevations, sections, and detailed construction drawings. Every drawing is prepared to professional standards suitable for planning submissions, building control applications, and construction purposes. We work in industry-standard CAD software ensuring compatibility with all stakeholders and easy future modifications.',
                    '3D Visualisation & Rendering' => 'Bring your project to life before construction begins with our photorealistic 3D visualisation services. We create detailed 3D models of your development—interior and exterior—allowing you to explore spaces, assess proportions, evaluate material choices, and visualise natural light at different times of day. Our renders are presentation-quality, suitable for planning applications, investor presentations, and marketing materials. See exactly how your finished project will look and feel, and make informed decisions with complete confidence.',
                    'Interior Design & Space Planning' => 'Strategic space planning and interior design that maximises functionality and aesthetic appeal. We analyse how spaces will be used and design layouts that optimise flow, natural light, and spatial efficiency. Services include furniture layouts, material and finish specifications, kitchen and bathroom design, lighting design, and detailed finish schedules. Whether you\'re developing for sale, rent, or personal occupation, we create interiors that enhance value and liveability.',
                    'Planning Applications & Approvals' => 'Full planning application management through our dedicated planning partners, operating seamlessly as an extension of our team. Services include pre-application advice, planning strategy development, preparation and submission of applications (householder, full, outline, and prior approval), design and access statements, heritage statements where required, and liaison with local planning authorities. We handle everything from straightforward permitted development confirmations to complex applications requiring negotiation and committee presentation.',
                    'Building Regulations & Technical Design' => 'Detailed technical design that translates approved concepts into construction-ready documentation. We develop specifications, structural coordination, M&E strategies, and building regulations submissions. Our technical designs anticipate construction challenges and resolve them on paper—before they become expensive problems on site. Full building control coordination through to final sign-off and completion certificates.',
                    'Feasibility Studies & Site Appraisals' => 'Before you commit to a project or purchase, understand what\'s achievable. Our feasibility studies assess planning potential, development constraints, and indicative costs. We provide realistic appraisals of what can be built, what it might cost, and what returns you might expect. For investors and developers, this due diligence is invaluable in de-risking acquisitions and validating project viability.'
                ],
                'faqs' => [
                    [
                        'q' => 'How realistic are your 3D visualisations?',
                        'a' => 'Our 3D visualisations are photorealistic renders generated from actual architectural plans. They accurately represent materials, textures, colors, and lighting conditions, allowing you to see exactly how your finished project will look.'
                    ],
                    [
                        'q' => 'What\'s included in your design service?',
                        'a' => 'Our design service encompasses the full journey from initial concepts through to construction-ready documentation. This includes measured surveys, 2D technical drawings (plans, elevations, sections), 3D visualisations, planning application preparation, building regulations submissions, and detailed construction specifications. We tailor packages to project requirements—whether you need just visualisations to support your existing team, or complete design-through-construction delivery.'
                    ],
                    [
                        'q' => 'Do you handle planning applications?',
                        'a' => 'Yes. We manage the entire planning application process on your behalf, including preparing drawings, design and access statements, submitting applications to the local authority, and liaising with planners throughout the determination period.'
                    ],
                    [
                        'q' => 'How long does the design phase typically take?',
                        'a' => 'The duration of the design phase varies based on project complexity. Generally, it takes between 4 to 8 weeks to develop concepts, finalize drawings, and prepare submissions, plus the standard local authority determination period (usually 8 weeks for planning decisions).'
                    ],
                    [
                        'q' => 'What is the RIBA Plan of Work?',
                        'a' => 'The RIBA Plan of Work is the definitive UK model for the design and construction process. It structures projects into 8 stages (0 to 7), providing a clear framework for planning, design, construction, and operation of buildings.'
                    ]
                ]
            ];
        }
        
        if ($slug === 'commercial-development') {
            return [
                'title' => 'Commercial Development',
                'image_url' => 'images/service_commercial.png',
                'about' => 'London and Essex’s commercial landscape is constantly evolving, and businesses need construction partners who understand the pace of commerce. At Construction 360 Ltd, we deliver commercial developments that minimise downtime and maximise operational efficiency—whether you’re launching a flagship retail store, transforming office space, or creating an exceptional hospitality venue. Our portfolio spans diverse commercial sectors, from high-end gyms to professional office fit-outs in the City, each delivered with the precision and professionalism that London’s business community demands.',
                'why_choose_us' => [
                    [
                        'title' => 'Minimal Disruption',
                        'desc' => 'We coordinate site schedules, night shifts, and dust barriers to ensure your current business operations face zero downtime.'
                    ],
                    [
                        'title' => 'Speed to Market',
                        'desc' => 'We understand that empty commercial spaces represent lost revenue. We operate to tight, guaranteed timelines.'
                    ],
                    [
                        'title' => 'Brand-Sensitive',
                        'desc' => 'Every design detail and material choice is aligned with your corporate identity and brand guidelines.'
                    ],
                    [
                        'title' => 'Compliance & Certification',
                        'desc' => 'We handle full building regulations compliance, fire compartmentation, and electrical safety certifications.'
                    ]
                ],
                'services_offered' => [
                    'Office Fit-Out & Refurbishment' => 'Comprehensive CAT A and CAT B office fit-out services for workspaces of all sizes. We deliver everything from shell-and-core preparation to fully finished, furniture-ready environments—including raised access flooring, suspended ceilings, partitioning systems, M&E infrastructure, and bespoke joinery. Whether you\'re a startup taking your first office or a corporate occupier refreshing existing space, we create productive environments that reflect your company culture.',
                    'Retail Construction & Shop Fitting' => 'End-to-end retail construction for high street stores, shopping centre units, and flagship locations. We understand the retail calendar and work to align project completion with trading deadlines—seasonal launches, grand openings, and promotional periods. Our services include structural modifications, shopfront installation, point-of-sale integration, back-of-house facilities, and all finishes to brand specifications.',
                    'Restaurant & Hospitality Fit-Out' => 'Specialist construction for restaurants, bars, cafés, and hotels across London. We coordinate complex M&E requirements including commercial kitchen extraction, grease traps, refrigeration systems, and front-of-house aesthetics. Our experience spans quick-service restaurants to fine dining establishments, and we\'re well-versed in the licensing, health & safety, and environmental health requirements specific to hospitality venues.',
                    'Educational & Institutional Projects' => 'Refurbishment and fit-out of educational spaces including private schools, training centres, and corporate learning environments. We work within term-time constraints and deliver safe, compliant spaces that support modern educational delivery—from traditional classrooms to technology-enabled learning environments.',
                    'Industrial & Warehouse Fit-Out' => 'Fit-out and adaptation of industrial units, warehouses, and logistics facilities. Services include mezzanine floor installation, office accommodation within industrial shells, welfare facility provision, loading bay modifications, and temperature-controlled environment creation.'
                ],
                'faqs' => [
                    [
                        'q' => 'What types of commercial projects do you undertake?',
                        'a' => 'We deliver a diverse range of commercial projects across London and Essex including office fit-outs, retail construction and shop fitting, restaurant and bar fit-outs, educational spaces, and industrial unit adaptations.'
                    ],
                    [
                        'q' => 'Can you work while our business remains operational?',
                        'a' => 'Absolutely. Working in occupied commercial environments is one of our core competencies. We implement comprehensive disruption management including phased construction programmes, out-of-hours and weekend working, dust containment systems, noise management protocols, and dedicated access routes that separate construction activity from your operations.'
                    ],
                    [
                        'q' => 'How quickly can you complete a commercial fit-out?',
                        'a' => 'Fit-out timelines depend heavily on the project size and scope. Simple office updates can take 2-4 weeks, while complex multi-floor fit-outs can take 8-12 weeks. We will provide a detailed programme during consultation.'
                    ],
                    [
                        'q' => 'Do you handle the design as well as construction?',
                        'a' => 'Yes. Through our Designing & Planning service, we offer full design and build capability for commercial projects. This includes space planning, interior design, M&E design, and all statutory applications.'
                    ]
                ]
            ];
        }
        
        if ($slug === 'residential-development') {
            return [
                'title' => 'Residential Development',
                'image_url' => 'images/service_residential.png',
                'about' => 'London and Essex’s housing landscape demands precision, compliance, and an unwavering commitment to quality. At Construction 360 Ltd, we specialise in delivering exceptional residential developments across the capital and home counties—from purpose-built blocks of flats to comprehensive HMO conversions and multi-unit housing schemes. With over 30 successfully completed projects, we bring proven expertise to every development, whether you’re an investor seeking reliable returns or a developer pursuing your next landmark project.',
                'why_choose_us' => [
                    [
                        'title' => 'Proven Expertise',
                        'desc' => 'With 30+ residential projects delivered, we understand the complexities of multi-unit developments—from structural considerations to building control sign-offs.'
                    ],
                    [
                        'title' => 'Transparent Progress',
                        'desc' => 'Real-time project updates, clear cost breakdowns, and proactive communication. You\'ll always know exactly where your development stands.'
                    ],
                    [
                        'title' => 'Regulatory Navigation',
                        'desc' => 'From planning permissions to Building Regulations Part B, L, and M compliance, we navigate the regulatory landscape so you don\'t have to.'
                    ],
                    [
                        'title' => 'Quality Backed',
                        'desc' => 'Every project is backed by comprehensive warranties, building control certifications, and our commitment to zero-defect handovers.'
                    ]
                ],
                'services_offered' => [
                    'New Build Residential Developments' => 'Ground-up construction of purpose-built residential blocks, from boutique 4-unit schemes to larger apartment developments. We handle site preparation, foundations, superstructure, M&E installations, and all finishes to create move-in ready homes that meet modern living standards and energy efficiency requirements.',
                    'Block of Flats Construction' => 'Specialist construction and refurbishment of blocks of flats. Whether you\'re developing a new block or converting an existing building, we deliver high-specification units with optimised layouts, compliant fire safety systems, and durable communal areas designed for long-term value retention.',
                    'HMO Conversions & Developments' => 'Transform existing properties into fully compliant Houses in Multiple Occupation. We manage the entire conversion process including structural modifications, fire compartmentation, means of escape provisions, and the installation of individual amenities to meet HMO licensing requirements and Article 4 regulations.',
                    'Residential Refurbishment & Renovation' => 'Comprehensive refurbishment services for existing residential buildings and individual units. From complete strip-outs to targeted upgrades, we modernise properties to contemporary standards while maximising rental yields and capital appreciation.',
                    'Mixed-Use Residential Schemes' => 'Development of properties combining residential units with ground-floor commercial or retail spaces. We understand the unique structural, acoustic, and access requirements of mixed-use buildings, delivering integrated developments that work for all occupants.'
                ],
                'faqs' => [
                    [
                        'q' => 'What areas do you cover?',
                        'a' => 'We cover the entire Greater London area, as well as Essex, Hertfordshire, and Kent.'
                    ],
                    [
                        'q' => 'What types of residential projects do you specialise in?',
                        'a' => 'We specialise in multi-unit residential blocks, HMO conversions, ground-up new builds, commercial-to-residential conversions, and high-end home extensions.'
                    ],
                    [
                        'q' => 'How do you ensure quality on residential projects?',
                        'a' => 'We employ dedicated site managers, coordinate regular building control inspections, utilize CSCS-certified tradespeople, and follow a strict pre-handover snagging protocol to ensure zero-defect delivery.'
                    ]
                ]
            ];
        }
        
        if ($slug === 'facilities-management') {
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
                    'Reactive Maintenance & Repairs' => 'Rapid response to tenant-reported issues and property emergencies. Our team handles everything from leaking taps and faulty electrics to boiler breakdowns and security concerns. We operate a tiered response system: emergencies within 4 hours, urgent issues within 24 hours, and routine repairs within 48-72 hours. All works are logged, photographed, and reported back with full transparency.',
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
                    ]
                ]
            ];
        }
        
        return null;
    }
}


