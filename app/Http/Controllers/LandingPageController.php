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
    public function getServiceDetails($slug)
    {
        $slug = strtolower($slug);
        
        // 1. Design & Build (must be matched before Design to avoid incorrect matching)
        if ($slug === 'design-and-build' || str_contains($slug, 'design-and-build') || (str_contains($slug, 'design') && str_contains($slug, 'build'))) {
            return [
                'title' => 'Design & Build',
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
                        'q' => 'What are the benefits of a Turnkey Design & Build solution?',
                        'a' => 'Turnkey Design & Build unifies architectural drawings, structural engineering, and site execution under a single contractor. This eliminates communication gaps, keeps designs aligned with budgets, and accelerates delivery.'
                    ],
                    [
                        'q' => 'Do you handle conversions (loft, garage, basement) as well as new builds?',
                        'a' => 'Yes. Our capabilities range from custom-built new homes and residential developments to complex loft, basement, and garage conversions.'
                    ],
                    [
                        'q' => 'Can you handle listed building restorations and commercial fit-outs?',
                        'a' => 'Yes. We have specialist divisions for sensitive restorations of heritage structures and complete turnkey office and commercial space fit-outs.'
                    ],
                    [
                        'q' => 'How do you manage budgets and prevent cost overruns during the build?',
                        'a' => 'By integrating our quantity surveyors and builders directly with the design team, we estimate costs in real-time, ensuring specifications remain within budget from day one.'
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
                        'q' => 'What is the difference between a Pre-Application and a Full Planning Application?',
                        'a' => 'A pre-application is an informal consultation with the council to assess policy alignment and identify potential constraints before committing to a full submission. A full planning application is the formal package submitted for official council review and determination.'
                    ],
                    [
                        'q' => 'How long does it take to secure planning permission?',
                        'a' => 'Council determination periods are typically 8 weeks for householder/minor applications and 13 weeks for major or complex commercial schemes from the validation date.'
                    ],
                    [
                        'q' => 'What are planning conditions, and how are they discharged?',
                        'a' => 'Planning approvals are often granted subject to conditions (e.g., matching materials, ecological protection). "Discharging" conditions is the formal process of submitting details, plans, or surveys to prove compliance before starting on site.'
                    ],
                    [
                        'q' => 'Do you conduct feasibility studies before drawing up planning packages?',
                        'a' => 'Yes. We conduct detailed site layout analysis, policy checks, and feasibility appraisals to ensure your proposals are both planning-compliant and buildable.'
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
                        'q' => 'How do you assist developers in sourcing construction finance?',
                        'a' => 'We prepare robust financial feasibility models, detailed cash flow appraisals, and cost plans to present your scheme in the strongest terms to institutional lenders and specialist joint-venture partners.'
                    ],
                    [
                        'q' => 'What is a Gross Development Value (GDV) appraisal?',
                        'a' => 'GDV is the projected market value of the completed scheme. Lenders use this to calculate loan-to-value (LTV) or loan-to-cost (LTC) ratios to structure your funding.'
                    ],
                    [
                        'q' => 'How are drawdowns managed during the construction phase?',
                        'a' => 'We compile monthly valuations, cash-flow updates, and cost-control reports, coordinating directly with the lender\'s monitoring surveyors to ensure funds are released promptly.'
                    ],
                    [
                        'q' => 'What is the benefit of Quantity Surveying in project finance?',
                        'a' => 'Quantity surveyors compile Bills of Quantities and track variances, providing institutional grade reports that mitigate risks for both the developer and the financier.'
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
                        'q' => 'What design disciplines do you coordinate under Engineering & Technical Design?',
                        'a' => 'We provide fully integrated architectural plans, structural engineering calculations, civil infrastructure design, below-ground drainage layouts, MEP services, and fire safety strategies.'
                    ],
                    [
                        'q' => 'Why is clash detection important in technical design?',
                        'a' => 'By coordinating structural frames (e.g. steel columns) with MEP ductwork and drainage runs in 3D, we detect and resolve spatial clashes prior to starting site works, preventing costly site delays.'
                    ],
                    [
                        'q' => 'What does MEP (Mechanical, Electrical, & Plumbing) design cover?',
                        'a' => 'It covers detailed specifications for power distribution, energy-efficient lighting, heating systems, comfort cooling (AC), mechanical ventilation (MVHR), and fire detection.'
                    ],
                    [
                        'q' => 'Do you act as the CDM Principal Designer?',
                        'a' => 'Yes. We coordinate and manage health and safety risks during the pre-construction phase to ensure compliance with CDM 2015 regulations.'
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
                        'q' => 'What civil and substructure works do you execute?',
                        'a' => 'We handle site clearances, demolition, deep excavations, groundworks, screw/bored piling, reinforced concrete (RC) foundations, and ground beams.'
                    ],
                    [
                        'q' => 'What superstructures and building envelopes do you build?',
                        'a' => 'We construct multi-storey reinforced concrete frames, structural steelwork, brick/block superstructures, cladding, glazing, and complete roofing systems.'
                    ],
                    [
                        'q' => 'Do you install advanced renewable energy and smart services?',
                        'a' => 'Yes. Our MEP teams install solar PV systems, EV charging points, heat pumps, fire alarm systems, and CCTV/access control infrastructure.'
                    ],
                    [
                        'q' => 'What interior, external, and specialist services do you provide?',
                        'a' => 'We deliver drylining, plastering, custom joinery, flooring, landscaping, paving, private road construction, scaffolding, and structural welding.'
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
                        'q' => 'What regulatory and environmental reports do you coordinate?',
                        'a' => 'We coordinate planning condition clearances, Section 106 agreements, CIL assessments, SAP calculations, energy reports, heritage statements, and archaeological briefs.'
                    ],
                    [
                        'q' => 'What is a SAP calculation and why is it required?',
                        'a' => 'A Standard Assessment Procedure (SAP) calculation is the UK government\'s system for assessing the energy rating of dwellings to demonstrate compliance with Part L Building Regulations.'
                    ],
                    [
                        'q' => 'How do you assist with tender and procurement management?',
                        'a' => 'We compile comprehensive packages, issue pricing surveys, manage sub-contractor bids, and advise on material procurement strategies to optimize cost and lead times.'
                    ],
                    [
                        'q' => 'What does Section 106 and CIL management involve?',
                        'a' => 'We review, appeal, or negotiate local planning obligations and Community Infrastructure Levy (CIL) liabilities to minimize unnecessary developer contributions.'
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
                        'q' => 'How do you manage the Building Regulations approval process?',
                        'a' => 'We prepare and submit technical drawing packages for plan checks, schedule site inspections at key stages (excavations, structure, fire, DPC), and address inspector queries.'
                    ],
                    [
                        'q' => 'What certificates are required to secure a final Completion Certificate?',
                        'a' => 'You need gas safety, electrical installation (EICR), air pressure, acoustic performance, energy (SAP), and commissioning certificates for fire systems and technical plant.'
                    ],
                    [
                        'q' => 'Can you submit Building Notice applications?',
                        'a' => 'Yes, we can compile and submit building notices for minor residential extensions and structural works to expedite initial site start dates.'
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
                        'q' => 'What is the difference between Reactive and Planned Preventative Maintenance (PPM)?',
                        'a' => 'Reactive maintenance addresses immediate failures (e.g. leaks, power cuts) on an emergency basis. PPM involves scheduled servicing of boilers, ACs, gutters, and pumps to prevent issues.'
                    ],
                    [
                        'q' => 'What emergency coverage do you provide?',
                        'a' => 'We provide a 24/7 emergency service to handle immediate health, safety, and security issues across all residential and commercial properties under our management.'
                    ],
                    [
                        'q' => 'What building services do you manage and maintain?',
                        'a' => 'We manage electrical testing, boiler/gas servicing, HVAC filter/pressure checks, communal area cleaning, landscape upkeep, and roofing repairs.'
                    ],
                    [
                        'q' => 'Do you manage entire residential blocks and commercial developments?',
                        'a' => 'Yes. We handle asset tracking, communal utility management, health and safety compliance, and tenant repair requests for single assets and multi-unit portfolios.'
                    ]
                ]
            ];
        }
        
        return null;
    }
}


