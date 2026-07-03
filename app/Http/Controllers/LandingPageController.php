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
                'meta_title' => 'Pre-Construction Services UK | Expert Planning & Design',
                'meta_description' => 'Professional pre-construction services in the UK including planning, design, engineering, surveying and project consultancy for successful developments.',
                'meta_keywords' => 'preconstructionuk, constructionplanninguk, propertydevelopmentuk, constructionconsultancyuk, preconstructionservicesuk',
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
                    [
                        'title' => 'Architectural Services',
                        'desc' => 'Bespoke design concepts, floor plans, and layout elevations.',
                        'meta_title' => 'Architectural Services UK | Expert Building Design',
                        'meta_description' => 'Professional architectural services for residential and commercial developments across the UK, from concept design to construction-ready plans.',
                        'meta_keywords' => 'architecturalservicesuk, architectsuk, buildingdesignuk, propertydesignuk, constructiondesignuk'
                    ],
                    [
                        'title' => 'Architectural Design',
                        'desc' => 'Detailed interior and exterior spatial architectural designs.',
                        'meta_title' => 'Architectural Design UK | Innovative Design Solutions',
                        'meta_description' => 'Creative architectural design services delivering functional, compliant and sustainable buildings throughout the UK.',
                        'meta_keywords' => 'architecturaldesignuk, buildingdesignuk, modernarchitectureuk, architecturalplansuk, designservicesuk'
                    ],
                    [
                        'title' => 'Planning Permission',
                        'desc' => 'Preparing and submitting full planning applications for local authority approval.',
                        'meta_title' => 'Planning Permission UK | Planning Experts',
                        'meta_description' => 'Expert planning permission services helping homeowners and developers secure approvals quickly across the UK.',
                        'meta_keywords' => 'planningpermissionuk, planningconsultancyuk, planningapprovaluk, planningservicesuk, planningapplicationsuk'
                    ],
                    [
                        'title' => 'Building Regulations',
                        'desc' => 'Technical drawings and specification packages complying with building codes.',
                        'meta_title' => 'Building Regulations UK | Compliance Experts',
                        'meta_description' => 'Ensure your project complies with UK Building Regulations through professional design reviews and approvals.',
                        'meta_keywords' => 'buildingregulationsuk, buildingcontroluk, constructioncomplianceuk, regulationsuk, buildingconsultancyuk'
                    ],
                    [
                        'title' => 'Structural Engineering',
                        'desc' => 'Calculation packages and steelwork connection details for structural safety.',
                        'meta_title' => 'Structural Engineering UK | Structural Design Experts',
                        'meta_description' => 'Reliable structural engineering services for residential, commercial and industrial construction projects.',
                        'meta_keywords' => 'structuralengineeringuk, structuraldesignuk, buildingengineersuk, constructionengineeringuk, engineeringservicesuk'
                    ],
                    [
                        'title' => 'Civil Engineering',
                        'desc' => 'Below-ground drainage layouts, site levels, and structural calculations.',
                        'meta_title' => 'Civil Engineering UK | Infrastructure Solutions',
                        'meta_description' => 'Professional civil engineering services including drainage, highways and infrastructure design across the UK.',
                        'meta_keywords' => 'civilengineeringuk, drainagedesignuk, infrastructureengineeringuk, siteengineeringuk, highwaysdesignuk'
                    ],
                    [
                        'title' => 'Quantity Surveying',
                        'desc' => 'Bills of Quantities, tender packages, and cost planning.',
                        'meta_title' => 'Quantity Surveying UK | Cost Management Experts',
                        'meta_description' => 'Expert quantity surveying services providing academic planning, budgeting and commercial advice.',
                        'meta_keywords' => 'quantitysurveyinguk, costmanagementuk, constructioncostsuk, quantitysurveyorsuk, costplanninguk'
                    ],
                    [
                        'title' => 'Project Management',
                        'desc' => 'Liaising with surveyors, design teams, and local authorities.',
                        'meta_title' => 'Construction Project Management UK',
                        'meta_description' => 'End-to-end construction project management delivering projects on time, within budget and to the highest standards.',
                        'meta_keywords' => 'projectmanagementuk, constructionmanagementuk, buildingprojectsuk, projectconsultancyuk, constructionservicesuk'
                    ],
                    [
                        'title' => 'Construction Management',
                        'desc' => 'Detailed schedules and construction execution planning.',
                        'meta_title' => 'Construction Management UK | Build Specialists',
                        'meta_description' => 'Professional construction management services ensuring efficient planning, coordination and successful project delivery.',
                        'meta_keywords' => 'constructionmanagementuk, constructionprojectsuk, buildingmanagementuk, sitemanagementuk, constructionconsultantsuk'
                    ],
                    [
                        'title' => 'Building Consultancy',
                        'desc' => 'Expert advice on structural design and site viability.',
                        'meta_title' => 'Building Consultancy UK | Expert Property Advice',
                        'meta_description' => 'Trusted building consultancy services offering technical advice, compliance support and construction expertise.',
                        'meta_keywords' => 'buildingconsultancyuk, propertyconsultancyuk, constructionconsultancyuk, buildingexpertsuk, propertyadviceuk'
                    ],
                    [
                        'title' => 'Site Surveys',
                        'desc' => 'Comprehensive measured surveys of existing properties.',
                        'meta_title' => 'Site Surveys UK | Professional Survey Services',
                        'meta_description' => 'Accurate site surveys supporting planning, design and successful construction projects across the UK.',
                        'meta_keywords' => 'sitesurveysuk, landsurveyuk, sitesurveyinguk, constructionsurveyuk, propertysurveyuk'
                    ],
                    [
                        'title' => 'Land Surveying',
                        'desc' => 'Determining boundary lines and site layouts for construction.',
                        'meta_title' => 'Land Surveying UK | Accurate Survey Solutions',
                        'meta_description' => 'Professional land surveying services providing precise measurements for planning and development projects.',
                        'meta_keywords' => 'landsurveyinguk, landsurveyuk, propertysurveyuk, surveyingservicesuk, siteplanninguk'
                    ],
                    [
                        'title' => 'Topographical Surveys',
                        'desc' => 'Mapping site terrain levels, contours, and physical features.',
                        'meta_title' => 'Topographical Surveys UK | Expert Mapping',
                        'meta_description' => 'Detailed topographical surveys for residential, commercial and infrastructure developments.',
                        'meta_keywords' => 'topographicalsurveysuk, topographicalsurveyuk, landsurveyuk, mappingservicesuk, sitesurveysuk'
                    ],
                    [
                        'title' => 'Ground Investigation',
                        'desc' => 'Assessing geological soil profiles and load bearing capacity.',
                        'meta_title' => 'Ground Investigation UK | Site Investigation Experts',
                        'meta_description' => 'Comprehensive ground investigation services assessing soil and site conditions before construction begins.',
                        'meta_keywords' => 'groundinvestigationuk, siteinvestigationuk, geotechnicaluk, constructionsiteuk, soilinvestigationuk'
                    ],
                    [
                        'title' => 'Soil Testing',
                        'desc' => 'Chemical and structural soil testing for foundations and piling.',
                        'meta_title' => 'Soil Testing UK | Geotechnical Testing Services',
                        'meta_description' => 'Professional soil testing services supporting safe foundations and compliant construction projects.',
                        'meta_keywords' => 'soiltestinguk, geotechnicaltestinguk, groundtestinguk, constructiontestinguk, soilanalysisuk'
                    ],
                    [
                        'title' => 'Cost Estimation',
                        'desc' => 'Compiling accurate itemized estimates of building costs.',
                        'meta_title' => 'Construction Cost Estimation UK',
                        'meta_description' => 'Accurate construction cost estimation services for residential and commercial developments.',
                        'meta_keywords' => 'costestimationuk, constructioncostsuk, buildingestimatesuk, projectbudgetuk, costconsultancyuk'
                    ],
                    [
                        'title' => 'Cost Planning',
                        'desc' => 'Developing budget limits and financial controls for development schemes.',
                        'meta_title' => 'Cost Planning UK | Construction Budget Experts',
                        'meta_description' => 'Strategic cost planning services helping developers maximise value while controlling project budgets.',
                        'meta_keywords' => 'costplanninguk, constructionbudgetuk, quantitysurveyinguk, projectcostsuk, costmanagementuk'
                    ],
                    [
                        'title' => 'Feasibility Studies',
                        'desc' => 'Analyzing site constraints, policy limits, and development yields.',
                        'meta_title' => 'Feasibility Studies UK | Development Analysis',
                        'meta_description' => 'Professional feasibility studies evaluating technical, financial and planning viability of developments.',
                        'meta_keywords' => 'feasibilitystudiesuk, developmentfeasibilityuk, propertyanalysisuk, siteappraisaluk, planningfeasibilityuk'
                    ],
                    [
                        'title' => 'Planning Consultancy',
                        'desc' => 'Strategic advice on planning regulations and permitted developments.',
                        'meta_title' => 'Planning Consultancy UK | Planning Specialists',
                        'meta_description' => 'Expert planning consultancy helping clients navigate planning policies and secure successful approvals.',
                        'meta_keywords' => 'planningconsultancyuk, planningconsultantsuk, planningpermissionuk, planningadviceuk, developmentplanninguk'
                    ],
                    [
                        'title' => 'Building Control Consultancy',
                        'desc' => 'Advising on accessibility, fire safety, and code compliance.',
                        'meta_title' => 'Building Control Consultancy UK',
                        'meta_description' => 'Building control consultancy ensuring compliance with UK Building Regulations from design to completion.',
                        'meta_keywords' => 'buildingcontrolconsultancyuk, buildingcontroluk, buildingregulationsuk, constructioncomplianceuk, buildingconsultantsuk'
                    ],
                    [
                        'title' => 'Principal Designer (CDM)',
                        'desc' => 'Coordinating health and safety risks during design stages.',
                        'meta_title' => 'CDM Principal Designer UK | Construction Safety',
                        'meta_description' => 'Professional CDM Principal Designer services ensuring health and safety compliance throughout your project.',
                        'meta_keywords' => 'principaldesigneruk, cdmuk, constructionhealthandsafetyuk, constructiondesignuk, cdmprincipaldesigneruk'
                    ],
                    [
                        'title' => 'Tender Management',
                        'desc' => 'Drafting contract packages, managing builder bids, and contract award.',
                        'meta_title' => 'Tender Management UK | Construction Procurement',
                        'meta_description' => 'Professional tender management services helping clients achieve competitive pricing and quality contractors.',
                        'meta_keywords' => 'tendermanagementuk, constructiontendersuk, procurementuk, constructionprocurementuk, tenderconsultancyuk'
                    ]
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
                'meta_title' => 'Site Preparation Services UK | Groundworks & Clearance',
                'meta_description' => 'Professional site preparation services across the UK including site clearance, excavation, drainage, utilities and groundworks for residential and commercial projects.',
                'meta_keywords' => 'sitepreparationuk, groundworksuk, constructionsiteuk, siteclearanceuk, buildingpreparationuk',
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
                    [
                        'title' => 'Site Clearance',
                        'desc' => 'Removing obstacles, debris, and vegetative growth from the site.',
                        'meta_title' => 'Site Clearance Services UK | Expert Site Clearing',
                        'meta_description' => 'Reliable site clearance services across the UK, removing vegetation, waste and obstacles to prepare land for safe construction and development.',
                        'meta_keywords' => 'siteclearanceuk, siteclearinguk, constructionclearanceuk, landpreparationuk, groundclearanceuk'
                    ],
                    [
                        'title' => 'Land Clearance',
                        'desc' => 'Clearing larger plots and greenfield/brownfield sites.',
                        'meta_title' => 'Land Clearance Services UK | Professional Land Clearing',
                        'meta_description' => 'Expert land clearance services for residential, commercial and industrial developments, preparing sites efficiently and safely.',
                        'meta_keywords' => 'landclearanceuk, landclearinguk, sitepreparationuk, propertydevelopmentuk, constructionservicesuk'
                    ],
                    [
                        'title' => 'Demolition',
                        'desc' => 'Controlled structural demolition of residential and commercial units.',
                        'meta_title' => 'Demolition Services UK | Safe Building Demolition',
                        'meta_description' => 'Professional demolition services across the UK for residential, commercial and industrial properties with safe and compliant project delivery.',
                        'meta_keywords' => 'demolitionuk, buildingdemolitionuk, demolitioncontractorsuk, constructiondemolitionuk, siteclearanceuk'
                    ],
                    [
                        'title' => 'Strip Out',
                        'desc' => 'Removing internal partitions, finishes, and services prior to refurbishment.',
                        'meta_title' => 'Strip Out Contractors UK | Internal Demolition Experts',
                        'meta_description' => 'Specialist strip out services removing internal fixtures, fittings and finishes for refurbishment, renovation and redevelopment projects.',
                        'meta_keywords' => 'stripoutuk, internaldemolitionuk, stripoutcontractorsuk, commercialstripoutuk, buildingrefurbishmentuk'
                    ],
                    [
                        'title' => 'Excavation',
                        'desc' => 'Deep digging for foundations, drainage, and basements.',
                        'meta_title' => 'Excavation Services UK | Ground Excavation Experts',
                        'meta_description' => 'Professional excavation services for foundations, basements, drainage and infrastructure projects throughout the UK.',
                        'meta_keywords' => 'excavationuk, groundexcavationuk, excavationservicesuk, constructionexcavationuk, foundationexcavationuk'
                    ],
                    [
                        'title' => 'Groundworks',
                        'desc' => 'Initial sub-structural works including earth moving and pipe laying.',
                        'meta_title' => 'Groundworks Contractors UK | Expert Groundworks',
                        'meta_description' => 'Comprehensive groundworks services including foundations, drainage, excavation and site preparation across the UK.',
                        'meta_keywords' => 'groundworksuk, groundworkcontractorsuk, constructiongroundworksuk, foundationsuk, sitepreparationuk'
                    ],
                    [
                        'title' => 'Earthworks',
                        'desc' => 'Moving and reshaping soil levels to specification.',
                        'meta_title' => 'Earthworks Services UK | Bulk Earthmoving Experts',
                        'meta_description' => 'Professional earthworks services for site grading, excavation, embankments and large-scale construction developments.',
                        'meta_keywords' => 'earthworksuk, earthmovinguk, sitegradinguk, constructionearthworksuk, groundengineeringuk'
                    ],
                    [
                        'title' => 'Site Levelling',
                        'desc' => 'Grading the site to establish level construction platforms.',
                        'meta_title' => 'Site Levelling Services UK | Ground Levelling Experts',
                        'meta_description' => 'Accurate site levelling services creating stable, level ground ready for residential, commercial and infrastructure construction.',
                        'meta_keywords' => 'sitelevellinguk, groundlevellinguk, sitegradinguk, constructionsiteuk, earthworksuk'
                    ],
                    [
                        'title' => 'Drainage Installation',
                        'desc' => 'Laying foul water sewers and rainwater drainage channels.',
                        'meta_title' => 'Drainage Installation UK | Drainage Solutions',
                        'meta_description' => 'Professional drainage installation services including surface water, foul drainage and sustainable drainage systems across the UK.',
                        'meta_keywords' => 'drainageinstallationuk, drainageservicesuk, drainagedesignuk, surfacedrainageuk, groundworksuk'
                    ],
                    [
                        'title' => 'Utility Installation',
                        'desc' => 'Coordinating service duct runs for electric, water, and gas mains.',
                        'meta_title' => 'Utility Installation Services UK | Infrastructure Experts',
                        'meta_description' => 'Expert utility installation services including water, gas, electricity and telecom infrastructure for construction projects.',
                        'meta_keywords' => 'utilityinstallationuk, utilitiesuk, infrastructureuk, constructionutilitiesuk, siteinfrastructureuk'
                    ]
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
                'meta_title' => 'Foundations Services UK | Foundation Construction Experts',
                'meta_description' => 'Discover comprehensive foundation services in the UK, including piling, concrete foundations and basement construction for residential, commercial and industrial developments.',
                'meta_keywords' => 'foundationsuk, foundationservicesuk, foundationconstructionuk, constructionfoundationsuk, buildingfoundationsuk',
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
                    [
                        'title' => 'Foundations',
                        'desc' => 'Construction of strip, trench fill, raft, or pad foundations.',
                        'meta_title' => 'Foundation Construction UK | Strong Building Foundations',
                        'meta_description' => 'Expert foundation construction services delivering safe, durable and engineered foundations tailored to residential, commercial and industrial building projects.',
                        'meta_keywords' => 'foundationconstructionuk, buildingfoundationsuk, foundationcontractorsuk, structuralfoundationsuk, constructionservicesuk'
                    ],
                    [
                        'title' => 'Piling',
                        'desc' => 'Bored, driven, or screw piling for low bearing capacity ground.',
                        'meta_title' => 'Piling Contractors UK | Professional Piling Services',
                        'meta_description' => 'Expert piling services across the UK providing reliable deep foundation solutions for residential, commercial and large-scale construction developments.',
                        'meta_keywords' => 'pilinguk, pilingcontractorsuk, deepfoundationsuk, foundationengineeringuk, constructionpilinguk'
                    ],
                    [
                        'title' => 'Concrete Foundations',
                        'desc' => 'Pouring reinforced concrete slabs and ground beams.',
                        'meta_title' => 'Concrete Foundations UK | Strong Foundation Solutions',
                        'meta_description' => 'High-quality concrete foundation services designed for long-lasting structural stability in residential, commercial and industrial construction projects.',
                        'meta_keywords' => 'concretefoundationsuk, concreteconstructionuk, foundationbuildersuk, reinforcedconcreteuk, buildingfoundationsuk'
                    ],
                    [
                        'title' => 'Basement Construction',
                        'desc' => 'Sub-ground excavation, retaining walls, and waterproofing.',
                        'meta_title' => 'Basement Construction UK | Expert Basement Builders',
                        'meta_description' => 'Professional basement construction services across the UK, creating durable, waterproof and structurally sound underground spaces for residential and commercial properties.',
                        'meta_keywords' => 'basementconstructionuk, basementbuildersuk, undergroundconstructionuk, basementdevelopmentuk, propertyextensionsuk'
                    ]
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
                'meta_title' => 'Structural Works UK | Expert Construction Services',
                'meta_description' => 'Professional structural works services across the UK including concrete, steel, masonry, brickwork and timber frame construction for residential and commercial projects.',
                'meta_keywords' => 'structuralworksuk, constructionservicesuk, buildingstructureuk, structuralconstructionuk, commercialconstructionuk',
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
                    [
                        'title' => 'Reinforced Concrete',
                        'desc' => 'Constructing RC frames, columns, slabs, and retaining walls.',
                        'meta_title' => 'Reinforced Concrete UK | Concrete Structure Experts',
                        'meta_description' => 'Expert reinforced concrete services delivering strong, durable and compliant structural solutions for residential, commercial and industrial developments.',
                        'meta_keywords' => 'reinforcedconcreteuk, concretestructuresuk, concreteconstructionuk, structuralconcreteuk, constructionservicesuk'
                    ],
                    [
                        'title' => 'Concrete Works',
                        'desc' => 'Formwork, steel reinforcement installation, and concrete finishing.',
                        'meta_title' => 'Concrete Works UK | Professional Concrete Contractors',
                        'meta_description' => 'Comprehensive concrete works including slabs, columns, beams, foundations and structural concrete for construction projects across the UK.',
                        'meta_keywords' => 'concreteworksuk, concretecontractorsuk, concreteconstructionuk, structuralconcreteuk, buildingcontractorsuk'
                    ],
                    [
                        'title' => 'Steel Frame Construction',
                        'desc' => 'Erecting structural steel portals and multi-storey frames.',
                        'meta_title' => 'Steel Frame Construction UK | Steel Building Experts',
                        'meta_description' => 'Professional steel frame construction services providing durable, efficient and cost-effective structural solutions for commercial and residential buildings.',
                        'meta_keywords' => 'steelframeconstructionuk, steelbuildingsuk, steelstructuresuk, constructionuk, commercialconstructionuk'
                    ],
                    [
                        'title' => 'Structural Steel',
                        'desc' => 'Fabrication and installation of steel beams, columns, and splices.',
                        'meta_title' => 'Structural Steel UK | Steel Fabrication & Installation',
                        'meta_description' => 'Expert structural steel fabrication and installation services for commercial, industrial and residential construction projects across the UK.',
                        'meta_keywords' => 'structuralsteeluk, steelfabricationuk, steelinstallationuk, steelconstructionuk, constructionengineeringuk'
                    ],
                    [
                        'title' => 'Bricklaying',
                        'desc' => 'High-quality external facing brickwork and load-bearing walls.',
                        'meta_title' => 'Bricklaying Services UK | Professional Bricklayers',
                        'meta_description' => 'Skilled bricklaying services delivering high-quality walls, facades and structural brickwork for residential and commercial developments.',
                        'meta_keywords' => 'bricklayinguk, bricklayersuk, brickworkuk, buildingconstructionuk, masonryservicesuk'
                    ],
                    [
                        'title' => 'Blockwork',
                        'desc' => 'Internal partition load walls using dense or lightweight thermal blocks.',
                        'meta_title' => 'Blockwork Services UK | Expert Blockwork Contractors',
                        'meta_description' => 'Professional blockwork services providing durable structural walls and partitions for residential, commercial and industrial construction projects.',
                        'meta_keywords' => 'blockworkuk, blockworkcontractorsuk, constructionblockworkuk, buildingservicesuk, masonryconstructionuk'
                    ],
                    [
                        'title' => 'Stonework',
                        'desc' => 'Bespoke stone facades, walling, and decorative masonry arches.',
                        'meta_title' => 'Stonework Services UK | Stone Masonry Specialists',
                        'meta_description' => 'Expert stonework services delivering high-quality natural and engineered stone construction, restoration and architectural masonry across the UK.',
                        'meta_keywords' => 'stoneworkuk, stonemasonryuk, stonemasonsuk, buildingstoneuk, constructionservicesuk'
                    ],
                    [
                        'title' => 'Timber Frame Construction',
                        'desc' => 'Erecting pre-fabricated or site-built timber frames.',
                        'meta_title' => 'Timber Frame Construction UK | Timber Building Experts',
                        'meta_description' => 'Professional timber frame construction services creating sustainable, energy-efficient residential and commercial buildings across the UK.',
                        'meta_keywords' => 'timberframeconstructionuk, timberbuildingsuk, timberconstructionuk, sustainableconstructionuk, woodframeuk'
                    ],
                    [
                        'title' => 'Masonry',
                        'desc' => 'Traditional load-bearing block, brick, and stone structures.',
                        'meta_title' => 'Masonry Services UK | Professional Masonry Contractors',
                        'meta_description' => 'Comprehensive masonry services including brick, block and stone construction for durable residential and commercial building projects.',
                        'meta_keywords' => 'masonryuk, masonryservicesuk, brickandblockuk, constructionmasonryuk, buildingcontractorsuk'
                    ]
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
                'meta_title' => 'Roofing & Building Envelope UK | Expert Roofing Services',
                'meta_description' => 'Professional roofing and building envelope services across the UK, including roof installation, repairs, replacements and weatherproof building solutions.',
                'meta_keywords' => 'roofinguk, buildingenvelopeuk, roofingservicesuk, constructionroofinguk, weatherproofinguk',
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
                    [
                        'title' => 'Roofing',
                        'desc' => 'Complete roof installations for residential and commercial schemes.',
                        'meta_title' => 'Roofing Services UK | Professional Roofing Contractors',
                        'meta_description' => 'Expert roofing services for residential, commercial and industrial properties, delivering durable, weather-resistant roofing solutions across the UK.',
                        'meta_keywords' => 'roofinguk, roofingcontractorsuk, roofinstallationuk, commercialroofinguk, buildingroofinguk'
                    ],
                    [
                        'title' => 'Flat Roofing',
                        'desc' => 'EPDM rubber, GRP fiberglass, and torch-on felt installations.',
                        'meta_title' => 'Flat Roofing UK | Flat Roof Installation & Repairs',
                        'meta_description' => 'Professional flat roofing services including installation, maintenance and repairs for residential and commercial buildings throughout the UK.',
                        'meta_keywords' => 'flatroofinguk, flatroofinstallationuk, flatroofrepairsuk, roofingcontractorsuk, commercialflatroofinguk'
                    ],
                    [
                        'title' => 'Pitched Roofing',
                        'desc' => 'Slating, tiling, and timber roof truss erection.',
                        'meta_title' => 'Pitched Roofing UK | Roof Installation Specialists',
                        'meta_description' => 'Expert pitched roofing services providing durable tiled and slate roof installations, repairs and replacements across the UK.',
                        'meta_keywords' => 'pitchedroofinguk, roofinstallationuk, tileroofinguk, slateroofinguk, pitchedroofrepairsuk'
                    ],
                    [
                        'title' => 'Roof Repairs',
                        'desc' => 'Replacing broken slates, repairing lead valleys, and leaks.',
                        'meta_title' => 'Roof Repairs UK | Fast & Reliable Roofing Repairs',
                        'meta_description' => 'Professional roof repair services fixing leaks, storm damage and structural roofing issues for residential and commercial properties across the UK.',
                        'meta_keywords' => 'roofrepairsuk, leakrepairsuk, stormdamageuk, structuralroofrepairsuk, fastroofrepairsuk'
                    ],
                    [
                        'title' => 'Roof Replacement',
                        'desc' => 'Full strip-out and re-roofing including underlay and battens.',
                        'meta_title' => 'Roof Replacement UK | New Roof Installation Experts',
                        'meta_description' => 'Complete roof replacement services delivering durable, energy-efficient roofing systems for homes, commercial buildings and industrial properties.',
                        'meta_keywords' => 'roofreplacementuk, newroofinstallationuk, roofreplacementservicesuk, residentialroofreplacementuk, commercialroofreplacementuk'
                    ]
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
                'meta_title' => 'MEP Services UK | Mechanical, Electrical & Plumbing Experts',
                'meta_description' => 'Comprehensive MEP services across the UK, including HVAC, air conditioning, ventilation and ductwork solutions for residential and commercial projects.',
                'meta_keywords' => 'mepservicesuk, mechanicalelectricalplumbinguk, buildingservicesuk, constructionservicesuk, mepcontractorsuk',
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
                    [
                        'title' => 'Electrical Installation',
                        'desc' => 'NICEIC certified power, sockets, distribution boards, and rewiring.',
                        'meta_title' => 'Electrical Installation UK | Certified Electricians',
                        'meta_description' => 'Professional electrical installation services for residential, commercial and industrial properties, delivering safe, reliable and compliant electrical systems.',
                        'meta_keywords' => 'electricalinstallationuk, electricalservicesuk, electriciansuk, buildingelectricaluk, electricalcontractorsuk'
                    ],
                    [
                        'title' => 'Rewiring',
                        'desc' => 'Replacing old wiring to comply with 18th Edition regulations.',
                        'meta_title' => 'House Rewiring UK | Professional Rewiring Services',
                        'meta_description' => 'Expert rewiring services upgrading outdated electrical systems to improve safety, efficiency and compliance for homes and commercial buildings.',
                        'meta_keywords' => 'rewiringuk, houserewiringuk, electricalrewiringuk, electriciansuk, electricalupgradesuk'
                    ],
                    [
                        'title' => 'Lighting Installation',
                        'desc' => 'Energy-efficient LED layouts, architectural lighting, and external setups.',
                        'meta_title' => 'Lighting Installation UK | Indoor & Outdoor Lighting',
                        'meta_description' => 'Professional lighting installation services providing energy-efficient indoor, outdoor and commercial lighting solutions across the UK.',
                        'meta_keywords' => 'lightinginstallationuk, lightingservicesuk, ledlightinguk, commerciallightinguk, electricalservicesuk'
                    ],
                    [
                        'title' => 'Fire Alarm Installation',
                        'desc' => 'Complying with BS 5839 fire detection requirements.',
                        'meta_title' => 'Fire Alarm Installation UK | Fire Safety Systems',
                        'meta_description' => 'Certified fire alarm installation services providing reliable fire detection and safety systems for residential and commercial properties.',
                        'meta_keywords' => 'firealarminstallationuk, firesafetyuk, firealarmsystemsuk, buildingsafetyuk, electricalservicesuk'
                    ],
                    [
                        'title' => 'CCTV Installation',
                        'desc' => 'Digital IP security cameras with remote access monitoring.',
                        'meta_title' => 'CCTV Installation UK | Security Camera Systems',
                        'meta_description' => 'Professional CCTV installation services delivering advanced surveillance and security solutions for homes, businesses and commercial premises.',
                        'meta_keywords' => 'cctvinstallationuk, securitysystemsuk, cctvuk, commercialsecurityuk, homesecurityuk'
                    ],
                    [
                        'title' => 'Access Control',
                        'desc' => 'Biometric scanners, keypads, and intercom door entry setups.',
                        'meta_title' => 'Access Control Systems UK | Secure Entry Solutions',
                        'meta_description' => 'Expert access control installation services providing secure entry systems for residential, commercial and industrial buildings across the UK.',
                        'meta_keywords' => 'accesscontroluk, securityaccessuk, dooraccesssystemsuk, buildingsecurityuk, smartsecurityuk'
                    ],
                    [
                        'title' => 'Data Cabling',
                        'desc' => 'Structured Cat6/Cat6a cabling runs and network setups.',
                        'meta_title' => 'Data Cabling UK | Network Cabling Specialists',
                        'meta_description' => 'Professional data cabling services delivering reliable structured cabling and network infrastructure for businesses and commercial buildings.',
                        'meta_keywords' => 'datacablinguk, structuredcablinguk, networkcablinguk, itinfrastructureuk, commercialelectricaluk'
                    ],
                    [
                        'title' => 'EV Charger Installation',
                        'desc' => 'Certified home and commercial electric vehicle chargers.',
                        'meta_title' => 'EV Charger Installation UK | Home & Commercial EV Charging',
                        'meta_description' => 'Certified EV charger installation services for homes, workplaces and commercial properties, supporting fast and efficient electric vehicle charging.',
                        'meta_keywords' => 'evchargerinstallationuk, evcharginguk, electricvehiclecharginguk, homeevchargeruk, commercialevcharginguk'
                    ],
                    [
                        'title' => 'Solar Panel Installation',
                        'desc' => 'Roof-mounted solar PV panels and battery storage.',
                        'meta_title' => 'Solar Panel Installation UK | Renewable Energy Experts',
                        'meta_description' => 'Professional solar panel installation services helping homes and businesses reduce energy costs with efficient renewable energy systems.',
                        'meta_keywords' => 'solarpanelinstallationuk, solarenergyuk, renewableenergyuk, solarpoweruk, greensolutionsuk'
                    ],
                    [
                        'title' => 'Plumbing',
                        'desc' => 'Water mains connections, piping layout runs, and drainage.',
                        'meta_title' => 'Plumbing Services UK | Professional Plumbers',
                        'meta_description' => 'Expert plumbing services for residential, commercial and industrial properties, delivering reliable installations, repairs and maintenance across the UK.',
                        'meta_keywords' => 'plumbinguk, plumbingservicesuk, plumbersuk, commercialplumbinguk, buildingservicesuk'
                    ],
                    [
                        'title' => 'Heating Installation',
                        'desc' => 'Boilers, underfloor heating, and radiator systems.',
                        'meta_title' => 'Heating Installation UK | Energy-Efficient Heating Systems',
                        'meta_description' => 'Professional heating installation services providing reliable, energy-efficient heating solutions for homes, businesses and commercial properties.',
                        'meta_keywords' => 'heatinginstallationuk, heatingservicesuk, centralheatinguk, heatingengineersuk, buildingservicesuk'
                    ],
                    [
                        'title' => 'Gas Installation',
                        'desc' => 'Gas Safe registered pipework, gas fires, and cookers.',
                        'meta_title' => 'Gas Installation UK | Certified Gas Engineers',
                        'meta_description' => 'Safe and compliant gas installation services delivered by qualified engineers for residential and commercial developments across the UK.',
                        'meta_keywords' => 'gasinstallationuk, gasengineersuk, gasservicesuk, commercialgasuk, heatingservicesuk'
                    ],
                    [
                        'title' => 'Boiler Installation',
                        'desc' => 'Combi, system, and heat-only boiler replacements.',
                        'meta_title' => 'Boiler Installation UK | Expert Boiler Installers',
                        'meta_description' => 'Professional boiler installation services supplying energy-efficient heating systems for homes, offices and commercial buildings throughout the UK.',
                        'meta_keywords' => 'boilerinstallationuk, boilerservicesuk, gasboilersuk, heatingsystemsuk, boilerengineersuk'
                    ],
                    [
                        'title' => 'Bathroom Installation',
                        'desc' => 'Sanitaryware connections, waste runs, and tiling.',
                        'meta_title' => 'Bathroom Installation UK | Complete Bathroom Solutions',
                        'meta_description' => 'Expert bathroom installation services delivering high-quality plumbing, fittings and modern bathroom renovations for homes and commercial properties.',
                        'meta_keywords' => 'bathroominstallationuk, bathroomfittersuk, bathroomrenovationuk, plumbingservicesuk, homeimprovementuk'
                    ],
                    [
                        'title' => 'Drainage',
                        'desc' => 'Internal soil stacks, waste pipes, and external gully traps.',
                        'meta_title' => 'Drainage Services UK | Drainage Installation & Repairs',
                        'meta_description' => 'Professional drainage services including installation, repairs and maintenance for residential, commercial and industrial construction projects.',
                        'meta_keywords' => 'drainageuk, drainageservicesuk, drainageinstallationuk, drainagerepairsuk, groundworksuk'
                    ],
                    [
                        'title' => 'Water Supply Installation',
                        'desc' => 'Boosted cold water systems and hot water cylinders.',
                        'meta_title' => 'Water Supply Installation UK | Water Systems Experts',
                        'meta_description' => 'Professional water supply installation services providing reliable pipework and water distribution systems for residential and commercial developments.',
                        'meta_keywords' => 'watersupplyinstallationuk, waterservicesuk, waterpipeworkuk, plumbinginstallationuk, buildingservicesuk'
                    ],
                    [
                        'title' => 'HVAC Installation',
                        'desc' => 'Comfort heating, ventilation, and air conditioning runs.',
                        'meta_title' => 'HVAC Installation UK | Heating & Cooling Solutions',
                        'meta_description' => 'Professional HVAC installation services delivering efficient heating, cooling and ventilation systems for residential, commercial and industrial buildings.',
                        'meta_keywords' => 'hvacinstallationuk, hvacservicesuk, heatingandcoolinguk, buildingservicesuk, mechanicalservicesuk'
                    ],
                    [
                        'title' => 'Air Conditioning',
                        'desc' => 'Split, multi-split, and VRF cooling system layouts.',
                        'meta_title' => 'Air Conditioning Services UK | AC Installation Experts',
                        'meta_description' => 'Expert air conditioning installation, maintenance and repair services providing energy-efficient climate control solutions across the UK.',
                        'meta_keywords' => 'airconditioninguk, acinstallationuk, airconditioningservicesuk, coolingsystemsuk, hvacuk'
                    ],
                    [
                        'title' => 'Ventilation',
                        'desc' => 'Extractor fans and Mechanical Ventilation Heat Recovery (MVHR) setups.',
                        'meta_title' => 'Ventilation Services UK | Commercial & Residential Systems',
                        'meta_description' => 'Professional ventilation services delivering fresh air, improved indoor air quality and compliant ventilation systems for all building types.',
                        'meta_keywords' => 'ventilationuk, ventilationsystemsuk, indoorairqualityuk, buildingventilationuk, hvacservicesuk'
                    ],
                    [
                        'title' => 'Ductwork',
                        'desc' => 'Metal and flexible ventilation duct runs for clean airflow.',
                        'meta_title' => 'Ductwork Installation UK | Ventilation Duct Specialists',
                        'meta_description' => 'Specialist ductwork installation services providing efficient air distribution systems for residential, commercial and industrial buildings.',
                        'meta_keywords' => 'ductworkuk, ductworkinstallationuk, ventilationductworkuk, hvacductworkuk, mechanicalservicesuk'
                    ]
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
                'meta_title' => 'Interior Works UK | Professional Fit Out & Finishing Services',
                'meta_description' => 'Expert interior works across the UK, including refurbishment, fit outs, flooring, tiling, carpentry, decorating and bespoke interior finishing solutions.',
                'meta_keywords' => 'interiorworksuk, interiorfitoutuk, buildinginteriorsuk, constructionservicesuk, refurbishmentuk',
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
                    [
                        'title' => 'House Refurbishment',
                        'desc' => 'Complete stripping, re-plastering, painting, and fitting.',
                        'meta_title' => 'House Refurbishment UK | Home Renovation Specialists',
                        'meta_description' => 'Professional house refurbishment services transforming homes with high-quality renovations, upgrades and modern interior improvements across the UK.',
                        'meta_keywords' => 'houserefurbishmentuk, homerenovationuk, propertyrefurbishmentuk, homeimprovementuk, renovationservicesuk'
                    ],
                    [
                        'title' => 'Commercial Fit Out',
                        'desc' => 'Turnkey layouts for commercial, retail, and leisure units.',
                        'meta_title' => 'Commercial Fit Out UK | Business Interior Solutions',
                        'meta_description' => 'Professional commercial fit out services creating functional, modern and tailored interiors for offices, retail spaces and commercial properties.',
                        'meta_keywords' => 'commercialfitoutuk, commercialinteriorsuk, fitoutcontractorsuk, officefitoutuk, businessfitoutuk'
                    ],
                    [
                        'title' => 'Office Fit Out',
                        'desc' => 'Modern workspaces, partitions, and technical floor power.',
                        'meta_title' => 'Office Fit Out UK | Modern Workplace Solutions',
                        'meta_description' => 'Expert office fit out services delivering productive, stylish and efficient workplace interiors tailored to your business needs.',
                        'meta_keywords' => 'officefitoutuk, officeinteriorsuk, workplacedesignuk, officeconstructionuk, commercialfitoutuk'
                    ],
                    [
                        'title' => 'Shop Fit Out',
                        'desc' => 'Retail display systems, counters, lighting, and signage.',
                        'meta_title' => 'Shop Fit Out UK | Retail Interior Specialists',
                        'meta_description' => 'Professional shop fit out services creating attractive, functional and customer-focused retail environments across the UK.',
                        'meta_keywords' => 'shopfitoutuk, retailfitoutuk, shopinteriorsuk, retailconstructionuk, commercialinteriorsuk'
                    ],
                    [
                        'title' => 'Drylining',
                        'desc' => 'Stud wall board framing, taping, and jointing.',
                        'meta_title' => 'Drylining Services UK | Professional Drylining Contractors',
                        'meta_description' => 'Expert drylining services delivering smooth wall systems, partitions and ceilings for residential and commercial construction projects.',
                        'meta_keywords' => 'drylininguk, dryliningservicesuk, partitionsystemsuk, interiorconstructionuk, buildingservicesuk'
                    ],
                    [
                        'title' => 'Plastering',
                        'desc' => 'Skimming, rendering, plaster boarding, and repairing cracks.',
                        'meta_title' => 'Plastering Services UK | Professional Plasterers',
                        'meta_description' => 'High-quality plastering services providing smooth, durable wall and ceiling finishes for homes, offices and commercial buildings.',
                        'meta_keywords' => 'plasteringuk, plasterersuk, wallplasteringuk, ceilingplasteringuk, buildingfinishesuk'
                    ],
                    [
                        'title' => 'Suspended Ceilings',
                        'desc' => 'Grid ceilings for offices and commercial applications.',
                        'meta_title' => 'Suspended Ceilings UK | Ceiling Installation Experts',
                        'meta_description' => 'Professional suspended ceiling installation services enhancing acoustics, lighting integration and interior aesthetics for commercial and residential spaces.',
                        'meta_keywords' => 'suspendedceilingsuk, ceilinginstallationuk, commercialceilingsuk, interiorfitoutuk, ceilingsystemsuk'
                    ],
                    [
                        'title' => 'Partition Walls',
                        'desc' => 'Metal stud and timber partition layouts for spatial separation.',
                        'meta_title' => 'Partition Wall Installation UK | Interior Partition Systems',
                        'meta_description' => 'Expert partition wall installation creating flexible, efficient and modern internal layouts for commercial and residential buildings.',
                        'meta_keywords' => 'partitionwallsuk, partitioninstallationuk, officepartitionsuk, drylininguk, interiorworksuk'
                    ],
                    [
                        'title' => 'Painting & Decorating',
                        'desc' => 'Airless spray painting, traditional brushwork, and wallpapers.',
                        'meta_title' => 'Painting & Decorating UK | Professional Decorators',
                        'meta_description' => 'Professional painting and decorating services delivering flawless interior and exterior finishes for homes, offices and commercial properties.',
                        'meta_keywords' => 'paintinganddecoratinguk, decoratorsuk, paintingservicesuk, propertydecorationuk, interiorfinishesuk'
                    ],
                    [
                        'title' => 'Flooring',
                        'desc' => 'Laying solid wood, engineered timber, LVT, and laminates.',
                        'meta_title' => 'Flooring Services UK | Professional Floor Installation',
                        'meta_description' => 'Comprehensive flooring services including hardwood, laminate, vinyl and commercial flooring installations across the UK.',
                        'meta_keywords' => 'flooringuk, flooringservicesuk, floorinstallationuk, commercialflooringuk, residentialflooringuk'
                    ],
                    [
                        'title' => 'Floor Tiling',
                        'desc' => 'Porcelain, ceramic, and natural stone floor tiling.',
                        'meta_title' => 'Floor Tiling UK | Expert Tile Installation Services',
                        'meta_description' => 'Professional floor tiling services providing durable and stylish tiled floors for kitchens, bathrooms and commercial properties.',
                        'meta_keywords' => 'floortilinguk, tileinstallationuk, tilingservicesuk, floortilesuk, interiorflooringuk'
                    ],
                    [
                        'title' => 'Wall Tiling',
                        'desc' => 'Kitchen splashbacks, bathrooms, and wet-room wall tiling.',
                        'meta_title' => 'Wall Tiling UK | Professional Wall Tile Installers',
                        'meta_description' => 'High-quality wall tiling services creating elegant and durable finishes for bathrooms, kitchens and commercial interiors.',
                        'meta_keywords' => 'walltilinguk, walltilesuk, tilingservicesuk, bathroomtilinguk, kitchentilinguk'
                    ],
                    [
                        'title' => 'Joinery',
                        'desc' => 'Bespoke storage units, wardrobes, and custom furniture.',
                        'meta_title' => 'Joinery Services UK | Bespoke Woodwork Specialists',
                        'meta_description' => 'Expert joinery services delivering bespoke doors, windows, cabinetry and custom woodwork for residential and commercial projects.',
                        'meta_keywords' => 'joineryuk, joineryservicesuk, bespokejoineryuk, woodworkuk, customjoineryuk'
                    ],
                    [
                        'title' => 'Carpentry',
                        'desc' => 'Hanging doors, architraves, skirting boards, and floor joists.',
                        'meta_title' => 'Carpentry Services UK | Skilled Carpenters',
                        'meta_description' => 'Professional carpentry services providing structural timber work, bespoke installations and interior wood finishing across the UK.',
                        'meta_keywords' => 'carpentryuk, carpentersuk, woodworkinguk, timberconstructionuk, carpentryservicesuk'
                    ],
                    [
                        'title' => 'Kitchen Installation',
                        'desc' => 'Fitting kitchen cabinets, worktops, sinks, and appliances.',
                        'meta_title' => 'Kitchen Installation UK | Bespoke Kitchen Fitters',
                        'meta_description' => 'Professional kitchen installation services delivering stylish, functional and high-quality fitted kitchens for homes and commercial spaces.',
                        'meta_keywords' => 'kitcheninstallationuk, kitchenfittersuk, fittedkitchensuk, kitchenrenovationuk, homeimprovementuk'
                    ],
                    [
                        'title' => 'Bathroom Installation',
                        'desc' => 'Fitting shower enclosures, baths, sinks, toilets, and tiling.',
                        'meta_title' => 'Bathroom Installation UK | Expert Bathroom Fitters',
                        'meta_description' => 'Complete bathroom installation services including plumbing, tiling and modern bathroom design for residential and commercial properties.',
                        'meta_keywords' => 'bathroominstallationuk, bathroomfittersuk, bathroomrenovationuk, plumbingservicesuk, bathroomdesignuk'
                    ],
                    [
                        'title' => 'Staircase Installation',
                        'desc' => 'Bespoke oak, timber, or metal staircase fabrication.',
                        'meta_title' => 'Staircase Installation UK | Custom Staircase Solutions',
                        'meta_description' => 'Professional staircase installation services creating durable, stylish and bespoke staircases for residential and commercial developments.',
                        'meta_keywords' => 'staircaseinstallationuk, stairbuildersuk, bespokestaircasesuk, joineryuk, carpentryservicesuk'
                    ]
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
                'meta_title' => 'External Works UK | Landscaping & Outdoor Construction',
                'meta_description' => 'Professional external works services across the UK, including landscaping, paving, driveways, fencing, decking and outdoor construction for residential and commercial projects.',
                'meta_keywords' => 'externalworksuk, landscapinguk, outdoorconstructionuk, propertyimprovementuk, constructionservicesuk',
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
                    [
                        'title' => 'Landscaping',
                        'desc' => 'Soft and hard landscaping design and execution.',
                        'meta_title' => 'Landscaping Services UK | Professional Landscape Contractors',
                        'meta_description' => 'Expert landscaping services creating attractive, functional and sustainable outdoor spaces for residential, commercial and public developments.',
                        'meta_keywords' => 'landscapinguk, landscapingservicesuk, landscapecontractorsuk, gardenlandscapinguk, outdoordesignuk'
                    ],
                    [
                        'title' => 'Garden Landscaping',
                        'desc' => 'Creating lawns, flower beds, pathways, and water features.',
                        'meta_title' => 'Garden Landscaping UK | Bespoke Garden Design',
                        'meta_description' => 'Professional garden landscaping services transforming outdoor spaces with tailored planting, paving and garden design solutions across the UK.',
                        'meta_keywords' => 'gardenlandscapinguk, gardendesignuk, landscapinguk, outdoorlivinguk, gardenconstructionuk'
                    ],
                    [
                        'title' => 'Block Paving',
                        'desc' => 'Block paved driveways, pathways, and commercial parking areas.',
                        'meta_title' => 'Block Paving UK | Driveways & Patio Specialists',
                        'meta_description' => 'High-quality block paving services for driveways, patios and pathways, delivering durable and attractive outdoor surfaces throughout the UK.',
                        'meta_keywords' => 'blockpavinguk, pavingcontractorsuk, drivewaypavinguk, patiopavinguk, landscapinguk'
                    ],
                    [
                        'title' => 'Driveways',
                        'desc' => 'Excavation, base preparation, and surfacing for cars.',
                        'meta_title' => 'Driveway Installation UK | Professional Driveway Contractors',
                        'meta_description' => 'Expert driveway installation services providing block paving, resin, tarmac and bespoke driveway solutions for homes and businesses.',
                        'meta_keywords' => 'drivewaysuk, drivewayinstallationuk, drivewaycontractorsuk, resindrivewaysuk, blockpavinguk'
                    ],
                    [
                        'title' => 'Patios',
                        'desc' => 'Laying large format outdoor porcelain and sandstone slabs.',
                        'meta_title' => 'Patio Installation UK | Garden Patio Specialists',
                        'meta_description' => 'Professional patio installation services creating stylish and durable outdoor living spaces for residential and commercial properties.',
                        'meta_keywords' => 'patiosuk, patioinstallationuk, gardenpatiosuk, outdoorlivinguk, landscapingservicesuk'
                    ],
                    [
                        'title' => 'Resin Driveways',
                        'desc' => 'Permeable resin-bound aggregate driveway installations.',
                        'meta_title' => 'Resin Driveways UK | Resin Bound Driveway Experts',
                        'meta_description' => 'Premium resin driveway installation services delivering durable, low-maintenance and visually appealing surfaces across the UK.',
                        'meta_keywords' => 'resindrivewaysuk, resinbounddrivewaysuk, drivewayinstallationuk, resinpavinguk, drivewaysuk'
                    ],
                    [
                        'title' => 'Tarmac Surfacing',
                        'desc' => 'Hot rolled asphalt and tarmac for roads and driveways.',
                        'meta_title' => 'Tarmac Surfacing UK | Tarmac Driveway Contractors',
                        'meta_description' => 'Professional tarmac surfacing services for driveways, roads, car parks and commercial developments across the UK.',
                        'meta_keywords' => 'tarmacsurfacinguk, tarmacdrivewaysuk, roadsurfacinguk, commercialsurfacinguk, drivewaycontractorsuk'
                    ],
                    [
                        'title' => 'Fencing',
                        'desc' => 'Close board, panel, trellis, and security fencing.',
                        'meta_title' => 'Fencing Services UK | Professional Fence Installation',
                        'meta_description' => 'Reliable fencing installation services providing secure, durable and attractive boundary solutions for residential and commercial properties.',
                        'meta_keywords' => 'fencinguk, fencingservicesuk, fenceinstallationuk, gardenfencinguk, propertyboundariesuk'
                    ],
                    [
                        'title' => 'Gates',
                        'desc' => 'Wooden, metal, or automated security gate installations.',
                        'meta_title' => 'Gate Installation UK | Residential & Commercial Gates',
                        'meta_description' => 'Professional gate installation services offering secure and stylish entrance solutions for homes, businesses and industrial properties.',
                        'meta_keywords' => 'gatesuk, gateinstallationuk, securitygatesuk, electricgatesuk, propertysecurityuk'
                    ],
                    [
                        'title' => 'Decking',
                        'desc' => 'Composite, hardwood, and softwood timber decking.',
                        'meta_title' => 'Decking Installation UK | Timber & Composite Decking',
                        'meta_description' => 'Expert decking installation services creating beautiful outdoor living spaces with timber and composite decking solutions.',
                        'meta_keywords' => 'deckinguk, deckinginstallationuk, compositedeckinguk, timberdeckinguk, gardenimprovementuk'
                    ],
                    [
                        'title' => 'Turfing',
                        'desc' => 'Laying premium cultivated lawn turf over prepared topsoil.',
                        'meta_title' => 'Turfing Services UK | Natural Lawn Installation',
                        'meta_description' => 'Professional turfing services supplying and installing premium natural lawns for gardens, parks and commercial landscapes.',
                        'meta_keywords' => 'turfinguk, lawninstallationuk, naturalturfuk, gardenservicesuk, landscapinguk'
                    ],
                    [
                        'title' => 'Artificial Grass',
                        'desc' => 'Low-maintenance high-density synthetic grass installations.',
                        'meta_title' => 'Artificial Grass Installation UK | Synthetic Turf Experts',
                        'meta_description' => 'High-quality artificial grass installation services providing low-maintenance, realistic lawns for homes, schools and commercial spaces.',
                        'meta_keywords' => 'artificialgrassuk, syntheticturfuk, artificialgrassinstallationuk, lowmaintenancegardensuk, landscapinguk'
                    ]
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
                'meta_title' => 'Civil Engineering Services UK | Infrastructure & Groundworks Experts',
                'meta_description' => 'Professional civil engineering services across the UK, delivering roads, drainage, utilities, bridges and infrastructure solutions for residential, commercial and public sector projects.',
                'meta_keywords' => 'civilengineeringuk, infrastructureuk, constructionservicesuk, groundworksuk, civilcontractorsuk',
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
                    [
                        'title' => 'Road Construction',
                        'desc' => 'Excavating and laying sub-base, base, and hot tarmac for roads.',
                        'meta_title' => 'Road Construction UK | Highway & Road Building Experts',
                        'meta_description' => 'Expert road construction services delivering durable highways, access roads and infrastructure projects for residential, commercial and public developments across the UK.',
                        'meta_keywords' => 'roadconstructionuk, highwayconstructionuk, roadbuildinguk, civilengineeringuk, infrastructureconstructionuk'
                    ],
                    [
                        'title' => 'Car Park Construction',
                        'desc' => 'Full groundworks, paving, drainage, and layout markers.',
                        'meta_title' => 'Car Park Construction UK | Commercial Parking Solutions',
                        'meta_description' => 'Professional car park construction services including design, surfacing, drainage and line marking for commercial, residential and public sector developments.',
                        'meta_keywords' => 'carparkconstructionuk, parkingconstructionuk, commercialconstructionuk, tarmacsurfacinguk, civilengineeringuk'
                    ],
                    [
                        'title' => 'Drainage Works',
                        'desc' => 'Installing surface water retention systems and oil interceptors.',
                        'meta_title' => 'Drainage Works UK | Professional Drainage Contractors',
                        'meta_description' => 'Comprehensive drainage works including surface water, foul drainage and stormwater systems for residential, commercial and infrastructure projects.',
                        'meta_keywords' => 'drainageworksuk, drainageservicesuk, stormwaterdrainageuk, civilengineeringuk, drainageinstallationuk'
                    ],
                    [
                        'title' => 'Utility Works',
                        'desc' => 'Laying deep utility main ducts and connection junctions.',
                        'meta_title' => 'Utility Works UK | Underground Utility Installation',
                        'meta_description' => 'Professional utility works including water, gas, electricity and telecommunications infrastructure installation across the UK.',
                        'meta_keywords' => 'utilityworksuk, utilityinstallationuk, undergroundutilitiesuk, infrastructureuk, civilengineeringuk'
                    ],
                    [
                        'title' => 'Bridge Construction',
                        'desc' => 'Civil engineering concrete foundations and steel bridge spans.',
                        'meta_title' => 'Bridge Construction UK | Structural Infrastructure Experts',
                        'meta_description' => 'Expert bridge construction services delivering safe, durable and engineered bridge solutions for transport and infrastructure projects across the UK.',
                        'meta_keywords' => 'bridgeconstructionuk, bridgeengineeringuk, civilengineeringuk, infrastructureprojectsuk, structuralengineeringuk'
                    ],
                    [
                        'title' => 'Sewer Installation',
                        'desc' => 'Laying main trunk sewers and manhole installations.',
                        'meta_title' => 'Sewer Installation UK | Sewer & Drainage Specialists',
                        'meta_description' => 'Professional sewer installation services providing reliable foul water and drainage infrastructure for residential, commercial and industrial developments.',
                        'meta_keywords' => 'sewerinstallationuk, sewerconstructionuk, drainageworksuk, utilityworksuk, civilengineeringuk'
                    ]
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
                'meta_title' => 'Specialist Construction Services UK | Expert Building Solutions',
                'meta_description' => 'Professional specialist construction services across the UK, including scaffolding, crane hire, waterproofing, concrete repairs, welding and metal fabrication.',
                'meta_keywords' => 'specialistservicesuk, constructionservicesuk, specialistcontractorsuk, buildingservicesuk, constructionexpertsuk',
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
                    [
                        'title' => 'Scaffolding',
                        'desc' => 'Erecting tube and fitting scaffolding, temporary roofs, and towers.',
                        'meta_title' => 'Scaffolding Services UK | Safe Access Solutions',
                        'meta_description' => 'Professional scaffolding services providing safe, reliable and fully compliant access systems for residential, commercial and industrial construction projects.',
                        'meta_keywords' => 'scaffoldinguk, scaffoldingservicesuk, accesssolutionsuk, constructionscaffoldinguk, scaffoldingcontractorsuk'
                    ],
                    [
                        'title' => 'Crane Hire',
                        'desc' => 'Coordinating crane hire and contract lifts with qualified riggers.',
                        'meta_title' => 'Crane Hire UK | Lifting & Heavy Equipment Services',
                        'meta_description' => 'Reliable crane hire services with certified operators for safe lifting, heavy construction and infrastructure projects throughout the UK.',
                        'meta_keywords' => 'cranehireuk, liftingservicesuk, constructioncranesuk, heavyliftinguk, cranecontractorsuk'
                    ],
                    [
                        'title' => 'Waterproofing',
                        'desc' => 'Structural concrete tanking and joint sealing.',
                        'meta_title' => 'Waterproofing Services UK | Building Protection Experts',
                        'meta_description' => 'Expert waterproofing solutions protecting basements, roofs, walls and structures from water ingress and moisture damage across the UK.',
                        'meta_keywords' => 'waterproofinguk, buildingwaterproofinguk, basementwaterproofinguk, roofwaterproofinguk, constructionservicesuk'
                    ],
                    [
                        'title' => 'Concrete Repairs',
                        'desc' => 'Remedying spalled concrete, rebar protection, and mortar repairs.',
                        'meta_title' => 'Concrete Repairs UK | Structural Repair Specialists',
                        'meta_description' => 'Professional concrete repair services restoring damaged concrete structures, improving durability and extending the lifespan of buildings and infrastructure.',
                        'meta_keywords' => 'concreterepairsuk, structuralrepairsuk, concreterestorationuk, buildingrepairsuk, constructionmaintenanceuk'
                    ],
                    [
                        'title' => 'Concrete Cutting',
                        'desc' => 'Precision floor sawing and wall cutting services.',
                        'meta_title' => 'Concrete Cutting UK | Precision Concrete Cutting',
                        'meta_description' => 'Specialist concrete cutting services using advanced equipment for accurate, safe and efficient cutting on construction and renovation projects.',
                        'meta_keywords' => 'concretecuttinguk, diamondcuttinguk, constructioncuttinguk, structuralalterationsuk, buildingservicesuk'
                    ],
                    [
                        'title' => 'Diamond Drilling',
                        'desc' => 'Precision core drilling through reinforced concrete walls.',
                        'meta_title' => 'Diamond Drilling UK | Precision Core Drilling Experts',
                        'meta_description' => 'Professional diamond drilling services providing precise openings for utilities, structural modifications and construction projects across the UK.',
                        'meta_keywords' => 'diamonddrillinguk, coredrillinguk, constructiondrillinguk, concretecuttinguk, buildingservicesuk'
                    ],
                    [
                        'title' => 'Welding',
                        'desc' => 'Structural steel MIG/TIG/ARC welding to code.',
                        'meta_title' => 'Welding Services UK | Structural & Metal Welding Experts',
                        'meta_description' => 'Expert welding services delivering high-quality structural, fabrication and repair solutions for residential, commercial and industrial projects.',
                        'meta_keywords' => 'weldinguk, weldingservicesuk, structuralweldinguk, metalfabricationuk, construction'
                    ],
                    [
                        'title' => 'Metal Fabrication',
                        'desc' => 'Custom brackets, balustrades, and structural steel connections.',
                        'meta_title' => 'Metal Fabrication UK | Custom Metal Fabrication',
                        'meta_description' => 'Professional metal fabrication services delivering custom steelwork, balustrades, brackets and structural metal connections across the UK.',
                        'meta_keywords' => 'metalfabricationuk, steelworkuk, customfabricationuk, structuralmetaluk, weldinguk'
                    ]
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
                'meta_title' => 'Renovation & Property Improvements UK | Expert Building Solutions',
                'meta_description' => 'Professional renovation and property improvement services across the UK, including extensions, conversions, refurbishments and structural alterations for homes and businesses.',
                'meta_keywords' => 'renovationuk, propertyimprovementsuk, buildingrenovationuk, constructionservicesuk, propertyrefurbishmentuk',
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
                    [
                        'title' => 'Home Extensions',
                        'desc' => 'Rear, side-return, and wrap-around multi-storey extensions.',
                        'meta_title' => 'Home Extensions UK | House Extension Specialists',
                        'meta_description' => 'Expert home extension services creating additional living space with bespoke designs and high-quality construction for properties across the UK.',
                        'meta_keywords' => 'homeextensionsuk, houseextensionsuk, extensionbuildersuk, propertyextensionsuk, homeimprovementuk'
                    ],
                    [
                        'title' => 'Loft Conversions',
                        'desc' => 'Dormer, hip-to-gable, L-shaped, and Velux loft conversions.',
                        'meta_title' => 'Loft Conversions UK | Loft Conversion Experts',
                        'meta_description' => 'Professional loft conversion services transforming unused attic space into stylish, functional rooms that add value to your property.',
                        'meta_keywords' => 'loftconversionsuk, loftconversionuk, atticconversionuk, homeextensionsuk, propertyimprovementuk'
                    ],
                    [
                        'title' => 'Garage Conversions',
                        'desc' => 'Converting garages into home offices, gyms, or annexes.',
                        'meta_title' => 'Garage Conversions UK | Garage Conversion Specialists',
                        'meta_description' => 'Transform your garage into a practical living space with expert garage conversion services for homes across the UK.',
                        'meta_keywords' => 'garageconversionsuk, garageconversionuk, homeconversionuk, propertyrenovationuk, homeimprovementuk'
                    ],
                    [
                        'title' => 'House Renovation',
                        'desc' => 'Modernizing layout plans, insulation, plumbing, and finishes.',
                        'meta_title' => 'House Renovation UK | Complete Home Renovation Services',
                        'meta_description' => 'Professional house renovation services delivering modern upgrades, structural improvements and bespoke interior transformations across the UK.',
                        'meta_keywords' => 'houserenovationuk, homerenovationuk, propertyrenovationuk, buildingrenovationuk, homeimprovementuk'
                    ],
                    [
                        'title' => 'Property Refurbishment',
                        'desc' => 'Updating structural components, services, and decorations.',
                        'meta_title' => 'Property Refurbishment UK | Refurbishment Specialists',
                        'meta_description' => 'Comprehensive property refurbishment services restoring and modernising residential and commercial properties throughout the UK.',
                        'meta_keywords' => 'propertyrefurbishmentuk, buildingrefurbishmentuk, propertyrenovationuk, renovationservicesuk, constructionuk'
                    ],
                    [
                        'title' => 'Commercial Refurbishment',
                        'desc' => 'Refurbishing commercial interiors, fronts, and building layout services.',
                        'meta_title' => 'Commercial Refurbishment UK | Business Renovation Experts',
                        'meta_description' => 'Professional commercial refurbishment services creating modern, functional and efficient business environments across the UK.',
                        'meta_keywords' => 'commercialrefurbishmentuk, officerefurbishmentuk, commercialrenovationuk, fitoutuk, businessinteriorsuk'
                    ],
                    [
                        'title' => 'Structural Alterations',
                        'desc' => 'Removing load bearing walls and inserting steel support beams.',
                        'meta_title' => 'Structural Alterations UK | Building Modification Experts',
                        'meta_description' => 'Expert structural alteration services including wall removals, reinforcements and layout modifications for residential and commercial properties.',
                        'meta_keywords' => 'structuralalterationsuk, buildingalterationsuk, loadbearingwallremovaluk, structuralworksuk, constructionservicesuk'
                    ],
                    [
                        'title' => 'Listed Building Restoration',
                        'desc' => 'Sensitive repairs using heritage-approved techniques and materials.',
                        'meta_title' => 'Listed Building Restoration UK | Heritage Restoration Experts',
                        'meta_description' => 'Specialist listed building restoration services preserving historic properties while meeting conservation standards and modern building requirements.',
                        'meta_keywords' => 'listedbuildingrestorationuk, heritagerestorationuk, historicbuildingrepairsuk, conservationbuildinguk, listedpropertyrenovationuk'
                    ]
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


