<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        
        DB::table('projects')->truncate();

        $data = [
            [
                'id' => '1',
                'title' => 'Haydons road',
                'slug' => 'haydons-road',
                'category' => 'Residential',
                'status' => 'under-construction',
                'description' => 'Ground-up construction of a purpose-built residential block of flats. Features optimized layouts, energy-efficient specifications, and strict compliance with building regulations Part B & L.',
                'image_url' => 'images/project_haydons.png',
                'location' => 'London, Merton',
                'year' => '2026',
                'display_order' => '1',
                'meta_title' => null,
                'meta_description' => null,
                'meta_keywords' => null,
                'created_at' => '2026-06-17 10:24:07',
                'updated_at' => '2026-06-17 10:24:07',
            ],
            [
                'id' => '2',
                'title' => 'Streatham High road',
                'slug' => 'streatham-high-road',
                'category' => 'Residential',
                'status' => 'under-construction',
                'description' => 'Conversion of a commercial retail unit into residential flats. Focuses on structural space planning, soundproofing, and modern interior design suitable for the Lambeth community.',
                'image_url' => 'images/project_streatham.png',
                'location' => 'London, Lambeth',
                'year' => '2026',
                'display_order' => '2',
                'meta_title' => null,
                'meta_description' => null,
                'meta_keywords' => null,
                'created_at' => '2026-06-17 10:24:07',
                'updated_at' => '2026-06-17 10:24:07',
            ],
            [
                'id' => '3',
                'title' => 'Hinton',
                'slug' => 'hinton',
                'category' => 'Residential',
                'status' => 'under-construction',
                'description' => 'Development of boutique residential units with modern steel-frame structure, triple glazing window specifications, and high-spec mechanical installations.',
                'image_url' => 'images/project_hinton.png',
                'location' => 'London, Lambeth',
                'year' => '2026',
                'display_order' => '3',
                'meta_title' => null,
                'meta_description' => null,
                'meta_keywords' => null,
                'created_at' => '2026-06-17 10:24:07',
                'updated_at' => '2026-06-17 10:24:07',
            ],
            [
                'id' => '4',
                'title' => 'Hoxton',
                'slug' => 'hoxton',
                'category' => 'Commercial',
                'status' => 'under-construction',
                'description' => 'CAT A & B office fit-out and commercial workspace conversion. Delivering raised flooring, acoustical partitions, and brand-sensitive interior finishes.',
                'image_url' => 'images/project_hoxton.png',
                'location' => 'London, Hackney',
                'year' => '2025',
                'display_order' => '4',
                'meta_title' => null,
                'meta_description' => null,
                'meta_keywords' => null,
                'created_at' => '2026-06-17 10:24:07',
                'updated_at' => '2026-06-17 10:24:07',
            ],
            [
                'id' => '5',
                'title' => 'Sutherland House',
                'slug' => 'sutherland-house',
                'category' => 'Commercial',
                'status' => 'under-construction',
                'description' => 'High-specification refurbishment of a heritage commercial building. Preserving historical facade while implementing modern interior space planning and mechanical extraction.',
                'image_url' => 'images/project_sutherland.png',
                'location' => 'London, Kensington and Chelsea',
                'year' => '2026',
                'display_order' => '5',
                'meta_title' => null,
                'meta_description' => null,
                'meta_keywords' => null,
                'created_at' => '2026-06-17 10:24:07',
                'updated_at' => '2026-06-17 10:24:07',
            ],
            [
                'id' => '6',
                'title' => 'Gilsland Spa Hotel',
                'slug' => 'gilsland-spa-hotel',
                'category' => 'Commercial',
                'status' => 'completed',
                'description' => 'Complete facilities management and external fabric maintenance for a landmark spa resort. Includes HVAC upgrade, brick pointing, and preventative upkeep cycles.',
                'image_url' => 'images/project_gilsland.png',
                'location' => 'Cumbria',
                'year' => '2024',
                'display_order' => '6',
                'meta_title' => null,
                'meta_description' => null,
                'meta_keywords' => null,
                'created_at' => '2026-06-17 10:24:07',
                'updated_at' => '2026-06-17 10:24:07',
            ],
            [
                'id' => '7',
                'title' => 'Finchley High road',
                'slug' => 'finchley-high-road',
                'category' => 'Residential',
                'status' => 'completed',
                'description' => 'A completed multi-unit residential apartment development. Delivered from ground-up foundations to zero-defect handovers with NHBC structural warranty.',
                'image_url' => 'images/project_finchley.png',
                'location' => 'London, Barnet',
                'year' => '2024',
                'display_order' => '7',
                'meta_title' => null,
                'meta_description' => null,
                'meta_keywords' => null,
                'created_at' => '2026-06-17 10:24:07',
                'updated_at' => '2026-06-17 10:24:07',
            ],
            [
                'id' => '8',
                'title' => 'Belgravia House',
                'slug' => 'belgravia-house',
                'category' => 'Residential',
                'status' => 'completed',
                'description' => 'A high-end residential HMO conversion. Transformed a Victorian building into high-spec flat units with fire compartmentation and integrated smart amenities.',
                'image_url' => 'images/project_belgravia.png',
                'location' => 'London, Wandsworth',
                'year' => '2025',
                'display_order' => '8',
                'meta_title' => null,
                'meta_description' => null,
                'meta_keywords' => null,
                'created_at' => '2026-06-17 10:24:07',
                'updated_at' => '2026-06-17 10:24:07',
            ],
            [
                'id' => '9',
                'title' => 'Balham 176',
                'slug' => 'balham-176',
                'category' => 'Residential',
                'status' => 'completed',
                'description' => 'Bespoke residential block of flats. Features custom-extruded aluminum window frames, double glazing, and high-spec kitchen and bathroom fit-outs.',
                'image_url' => 'images/project_balham.png',
                'location' => 'London, Wandsworth',
                'year' => '2025',
                'display_order' => '9',
                'meta_title' => null,
                'meta_description' => null,
                'meta_keywords' => null,
                'created_at' => '2026-06-17 10:24:07',
                'updated_at' => '2026-06-17 10:24:07',
            ],
        ];

        DB::table('projects')->insert($data);

        DB::table('site_contents')->truncate();

        $data = [
            [
                'id' => '1',
                'key' => 'seo_meta_title',
                'value' => 'Integrated Construction & Premium Architectural Builds',
                'created_at' => '2026-06-15 11:11:24',
                'updated_at' => '2026-06-15 11:11:24',
            ],
            [
                'id' => '2',
                'key' => 'seo_meta_description',
                'value' => 'Construction 360 Ltd delivers 360-degree integration of design, structural planning, and premium quality construction management.',
                'created_at' => '2026-06-15 11:11:24',
                'updated_at' => '2026-06-15 11:11:24',
            ],
            [
                'id' => '3',
                'key' => 'seo_meta_keywords',
                'value' => 'construction, architectural builds, structural engineering, commercial fit-outs, extensions, renovations, glazing, Essex, London',
                'created_at' => '2026-06-15 11:11:24',
                'updated_at' => '2026-06-15 11:11:24',
            ],
            [
                'id' => '4',
                'key' => 'hero_title',
                'value' => 'Integrated Construction & Premium Architectural Builds',
                'created_at' => '2026-06-15 11:11:24',
                'updated_at' => '2026-06-15 11:11:24',
            ],
            [
                'id' => '5',
                'key' => 'hero_subtitle',
                'value' => 'Building your vision with geometric precision. Providing the highest standard of planning, design, and structural construction that stands the test of time.',
                'created_at' => '2026-06-15 11:11:24',
                'updated_at' => '2026-06-15 11:11:24',
            ],
            [
                'id' => '6',
                'key' => 'about_text',
                'value' => 'Construction 360 Ltd (inspired by 360 Developments) is a leading construction specialist firm. We work alongside master architects, structural engineers, surveyors, and local building control officers to deliver premium quality builds across residential extensions, new home developments, and commercial fit-outs.',
                'created_at' => '2026-06-15 11:11:24',
                'updated_at' => '2026-06-15 11:11:24',
            ],
            [
                'id' => '7',
                'key' => 'about_philosophy',
                'value' => 'Our operation is built on digital transparency, CSCS compliance, and zero telephone reliance. By routing all project briefs and engineering specifications electronically, we maintain a flawless audit trail, secure structural guarantees, and deliver project handovers that exceed architectural standards.',
                'created_at' => '2026-06-15 11:11:24',
                'updated_at' => '2026-06-15 11:11:24',
            ],
            [
                'id' => '8',
                'key' => 'insurance_title',
                'value' => 'Comprehensive Insurance',
                'created_at' => '2026-06-15 11:11:24',
                'updated_at' => '2026-06-15 11:11:24',
            ],
            [
                'id' => '9',
                'key' => 'insurance_text',
                'value' => 'Full peace of mind with £10,000,000 Employers Liability, £5,000,000 Public & Products Liability, and £500,000 Contract Works (Contractors All Risk) cover.',
                'created_at' => '2026-06-15 11:11:24',
                'updated_at' => '2026-06-15 11:11:24',
            ],
            [
                'id' => '10',
                'key' => 'certificates_title',
                'value' => 'Building Control & Certificates',
                'created_at' => '2026-06-15 11:11:24',
                'updated_at' => '2026-06-15 11:11:24',
            ],
            [
                'id' => '11',
                'key' => 'certificates_text',
                'value' => 'We issue all appropriate building control certificates on completion (including FENSA, plumbing, and electrical). All structural work is covered by our 10-year guarantee.',
                'created_at' => '2026-06-15 11:11:24',
                'updated_at' => '2026-06-15 11:11:24',
            ],
            [
                'id' => '12',
                'key' => 'cscs_title',
                'value' => 'CSCS Compliance',
                'created_at' => '2026-06-15 11:11:24',
                'updated_at' => '2026-06-15 11:11:24',
            ],
            [
                'id' => '13',
                'key' => 'cscs_text',
                'value' => 'All security surveyors, structural developers, and engineers have completed the Construction Skills Certification Scheme (CSCS) ensuring full safety compliance.',
                'created_at' => '2026-06-15 11:11:24',
                'updated_at' => '2026-06-15 11:11:24',
            ],
            [
                'id' => '14',
                'key' => 'testimonial_1_quote',
                'value' => 'Great company to do business with. Good standard of work and very reliable. Would definitely use again!',
                'created_at' => '2026-06-15 11:11:24',
                'updated_at' => '2026-06-15 11:11:24',
            ],
            [
                'id' => '15',
                'key' => 'testimonial_1_author',
                'value' => 'Colin Ashworth',
                'created_at' => '2026-06-15 11:11:24',
                'updated_at' => '2026-06-15 11:11:24',
            ],
            [
                'id' => '16',
                'key' => 'testimonial_1_role',
                'value' => 'Essex Homeowner',
                'created_at' => '2026-06-15 11:11:24',
                'updated_at' => '2026-06-15 11:11:24',
            ],
            [
                'id' => '17',
                'key' => 'testimonial_2_quote',
                'value' => '360 developments managed our full commercial fit-out from planning drawings to final handover. Completed on time, within budget, and to absolute tolerances.',
                'created_at' => '2026-06-15 11:11:24',
                'updated_at' => '2026-06-15 11:11:24',
            ],
            [
                'id' => '18',
                'key' => 'testimonial_2_author',
                'value' => 'David Vance',
                'created_at' => '2026-06-15 11:11:24',
                'updated_at' => '2026-06-15 11:11:24',
            ],
            [
                'id' => '19',
                'key' => 'testimonial_2_role',
                'value' => 'Director, Vanguard Retail Group',
                'created_at' => '2026-06-15 11:11:24',
                'updated_at' => '2026-06-15 11:11:24',
            ],
            [
                'id' => '20',
                'key' => 'testimonial_3_quote',
                'value' => 'Superb execution on our double-height rear extension. The digital progress logs kept us updated at every stage, and the structural finish is second to none.',
                'created_at' => '2026-06-15 11:11:24',
                'updated_at' => '2026-06-15 11:11:24',
            ],
            [
                'id' => '21',
                'key' => 'testimonial_3_author',
                'value' => 'Eleanor Finch',
                'created_at' => '2026-06-15 11:11:24',
                'updated_at' => '2026-06-15 11:11:24',
            ],
            [
                'id' => '22',
                'key' => 'testimonial_3_role',
                'value' => 'Residential Client, Chelmsford',
                'created_at' => '2026-06-15 11:11:24',
                'updated_at' => '2026-06-15 11:11:24',
            ],
            [
                'id' => '23',
                'key' => 'header_email',
                'value' => 'info@construction360.co',
                'created_at' => '2026-06-16 11:42:20',
                'updated_at' => '2026-06-16 11:42:20',
            ],
            [
                'id' => '24',
                'key' => 'team_section_label',
                'value' => 'Operational Leadership',
                'created_at' => '2026-06-16 11:42:20',
                'updated_at' => '2026-06-16 11:42:20',
            ],
            [
                'id' => '25',
                'key' => 'team_section_title',
                'value' => 'Our Core Project Team',
                'created_at' => '2026-06-16 11:42:20',
                'updated_at' => '2026-06-16 11:42:20',
            ],
            [
                'id' => '26',
                'key' => 'team_section_subtitle',
                'value' => 'A dedicated team of design partners, IStructE engineers, and quantity surveyors coordinating structural execution with digital precision.',
                'created_at' => '2026-06-16 11:42:20',
                'updated_at' => '2026-06-16 11:42:20',
            ],
            [
                'id' => '27',
                'key' => 'team_member_1_name',
                'value' => 'William Vance',
                'created_at' => '2026-06-16 11:42:20',
                'updated_at' => '2026-06-16 11:42:20',
            ],
            [
                'id' => '28',
                'key' => 'team_member_1_role',
                'value' => 'Managing Director & Senior Coordinator',
                'created_at' => '2026-06-16 11:42:20',
                'updated_at' => '2026-06-16 11:42:20',
            ],
            [
                'id' => '29',
                'key' => 'team_member_1_description',
                'value' => 'William oversees all site planning operations and client relationships, enforcing our paperless, digital-first correspondence log standards.',
                'created_at' => '2026-06-16 11:42:20',
                'updated_at' => '2026-06-16 11:42:20',
            ],
            [
                'id' => '30',
                'key' => 'team_member_1_accreditations',
                'value' => 'CSCS Black Card, RICS Affiliate',
                'created_at' => '2026-06-16 11:42:20',
                'updated_at' => '2026-06-16 11:42:20',
            ],
            [
                'id' => '31',
                'key' => 'team_member_2_name',
                'value' => 'Elena Rostova',
                'created_at' => '2026-06-16 11:42:20',
                'updated_at' => '2026-06-16 11:42:20',
            ],
            [
                'id' => '32',
                'key' => 'team_member_2_role',
                'value' => 'Lead Structural Engineer',
                'created_at' => '2026-06-16 11:42:20',
                'updated_at' => '2026-06-16 11:42:20',
            ],
            [
                'id' => '33',
                'key' => 'team_member_2_description',
                'value' => 'Elena leads all wind-load assessments, concrete framing calculations, and structural detailing to guarantee full building control approval.',
                'created_at' => '2026-06-16 11:42:20',
                'updated_at' => '2026-06-16 11:42:20',
            ],
            [
                'id' => '34',
                'key' => 'team_member_2_accreditations',
                'value' => 'IStructE Member, MSc Civil Eng',
                'created_at' => '2026-06-16 11:42:20',
                'updated_at' => '2026-06-16 11:42:20',
            ],
            [
                'id' => '35',
                'key' => 'team_member_3_name',
                'value' => 'Marcus Thorne',
                'created_at' => '2026-06-16 11:42:20',
                'updated_at' => '2026-06-16 11:42:20',
            ],
            [
                'id' => '36',
                'key' => 'team_member_3_role',
                'value' => 'Project Estimator & Quantity Surveyor',
                'created_at' => '2026-06-16 11:42:20',
                'updated_at' => '2026-06-16 11:42:20',
            ],
            [
                'id' => '37',
                'key' => 'team_member_3_description',
                'value' => 'Marcus compiles our Bill of Quantities (BoQ) surveys and coordinates logistics schedules to keep project execution within precise budget limits.',
                'created_at' => '2026-06-16 11:42:20',
                'updated_at' => '2026-06-16 11:42:20',
            ],
            [
                'id' => '38',
                'key' => 'team_member_3_accreditations',
                'value' => 'RICS Certified, CSCS Card',
                'created_at' => '2026-06-16 11:42:20',
                'updated_at' => '2026-06-16 11:42:20',
            ],
            [
                'id' => '39',
                'key' => 'services_section_label',
                'value' => 'Engineering Capabilities',
                'created_at' => '2026-06-16 11:52:50',
                'updated_at' => '2026-06-16 11:52:50',
            ],
            [
                'id' => '40',
                'key' => 'services_section_title',
                'value' => 'Technical Specialties & Solutions',
                'created_at' => '2026-06-16 11:52:50',
                'updated_at' => '2026-06-16 11:52:50',
            ],
            [
                'id' => '41',
                'key' => 'services_section_subtitle',
                'value' => 'Our dynamic capabilities span full-spectrum general contracting and specialized structural analysis, tracked via absolute electronic coordination.',
                'created_at' => '2026-06-16 11:52:50',
                'updated_at' => '2026-06-16 11:52:50',
            ],
            [
                'id' => '42',
                'key' => 'blog_section_label',
                'value' => 'Knowledge Base & Updates',
                'created_at' => '2026-06-16 11:52:50',
                'updated_at' => '2026-06-16 11:52:50',
            ],
            [
                'id' => '43',
                'key' => 'blog_section_title',
                'value' => 'Latest from Construction 360',
                'created_at' => '2026-06-16 11:52:50',
                'updated_at' => '2026-06-16 11:52:50',
            ],
            [
                'id' => '44',
                'key' => 'blog_section_subtitle',
                'value' => 'Explore insights, blueprints, design guidelines, and site developments from our structural and engineering experts.',
                'created_at' => '2026-06-16 11:52:50',
                'updated_at' => '2026-06-16 11:52:50',
            ],
            [
                'id' => '45',
                'key' => 'contact_section_label',
                'value' => 'Tender Submission',
                'created_at' => '2026-06-16 11:52:50',
                'updated_at' => '2026-06-16 11:52:50',
            ],
            [
                'id' => '46',
                'key' => 'contact_section_title',
                'value' => 'Submit Project Specifications',
                'created_at' => '2026-06-16 11:52:50',
                'updated_at' => '2026-06-16 11:52:50',
            ],
            [
                'id' => '47',
                'key' => 'contact_section_subtitle',
                'value' => 'Ready to launch your project? Fill out the architectural brief below. Our structural coordinators compile specs and respond within 24 hours.',
                'created_at' => '2026-06-16 11:52:50',
                'updated_at' => '2026-06-16 11:52:50',
            ],
            [
                'id' => '48',
                'key' => 'privacy_title',
                'value' => 'Privacy Policy & Correspondence Standards',
                'created_at' => '2026-06-16 11:52:50',
                'updated_at' => '2026-06-16 11:52:50',
            ],
            [
                'id' => '49',
                'key' => 'privacy_notice',
                'value' => 'NOTICE: Construction 360 Ltd routes all customer correspondence through electronic mail logs to preserve exact structural requirements and specifications. We do not offer phone numbers or call centers. For direct email queries, reach us at <a href="mailto:info@construction360.co" class="text-[#008080] hover:underline">info@construction360.co</a>.',
                'created_at' => '2026-06-16 11:52:50',
                'updated_at' => '2026-06-16 11:52:50',
            ],
            [
                'id' => '50',
                'key' => 'privacy_content',
                'value' => '1. Information We Collect

When you submit a digital tender brief or contact us via our encrypted webforms, we collect your name, email address, project subject, and any blueprints or architectural specifications provided. This data is logged directly into our secure database to preserve structural requirements.

2. Why We Restrict Voice Calls

To eliminate design discrepancies, wind-load calculation misunderstandings, and scheduling conflicts, Construction 360 Ltd has decommissioned all public telephone lines. Recording all client briefs in digital archives prevents verbal miscommunications and ensures building control documentation aligns perfectly with project instructions.

3. Data Security & Encryption

All client specifications, blueprints, and personal details are encrypted in transit using Secure Sockets Layer (SSL) technology. Data is stored on secure servers with restricted access controls. We do not share your structural files or contact information with third-party marketers.

4. Retention Policy

Because building control certificates (FENSA, gas safety, electrical) and structural works carry 10-year guarantees, we preserve correspondence logs and design calculations for a minimum of 10 years to protect contract warranties.

5. Your Rights

You retain the right to request a copy of your archived project log, check the status of your query, or ask for the deletion of personal details once building control signs off and project warranties expire.',
                'created_at' => '2026-06-16 11:52:50',
                'updated_at' => '2026-06-17 13:26:42',
            ],
            [
                'id' => '51',
                'key' => 'terms_title',
                'value' => 'Terms & Conditions of Service',
                'created_at' => '2026-06-16 11:52:50',
                'updated_at' => '2026-06-16 11:52:50',
            ],
            [
                'id' => '52',
                'key' => 'terms_notice',
                'value' => 'By filing a brief or engaging <strong>Construction 360 Ltd</strong>, clients agree that all communications, modifications, and instructions must be submitted electronically to <a href="mailto:info@construction360.co" class="text-[#008080] hover:underline font-semibold font-sans">info@construction360.co</a>. Verbal discussions, call requests, and telephone negotiations are explicitly excluded from the contract record.',
                'created_at' => '2026-06-16 11:52:50',
                'updated_at' => '2026-06-16 13:29:40',
            ],
            [
                'id' => '53',
                'key' => 'terms_content',
                'value' => '1. Scope & Tendering

All estimates, proposals, and project timelines are compiled based on the digital documents, CAD blueprints, and surveyor surveys submitted via our encrypted forms. Clients must ensure that all plans are correct, complete, and meet planning permission guidelines prior to submission.

2. Milestone Inspections & Sign-offs

We work alongside local building control officers and structural engineers. At completion of each milestone stage (foundations, framing, structural glazing, mechanical fit-out, roofing), the client will receive digital progress summaries. Proceeding to the subsequent stage requires digital confirmation, preserving a transparent audit trail.

3. Warranties & Guarantees

All structural works carry a 10-year guarantee against structural failure, provided no modifications have been made by non-CSCS contractors. FENSA glazing certifications, gas certificates, and electrical certifications are logged digitally and transferred on final handover.

4. Liability & Assurances

Construction 360 Ltd maintains £10,000,000 Employers Liability, £5,000,000 Public Liability, and £500,000 Contractors All Risk coverage. Our liability for delay or design discrepancies is strictly limited to issues documented in the electronic audit logs.

5. Exclusions & Legacy Channels

We enforce a strict paperless and telephone-free standard. Construction 360 Ltd is not liable for structural delays, plan deviations, or additional fees arising from instructions passed through unofficial legacy routes (such as voice calls, SMS, or verbal on-site instructions that were not logged via email).',
                'created_at' => '2026-06-16 11:52:50',
                'updated_at' => '2026-06-17 13:26:42',
            ],
            [
                'id' => '54',
                'key' => 'tendering_title',
                'value' => 'Official Tendering & Procurement Standards',
                'created_at' => '2026-06-16 11:52:50',
                'updated_at' => '2026-06-16 11:52:50',
            ],
            [
                'id' => '55',
                'key' => 'tendering_notice',
                'value' => '<strong>CRITICAL:</strong> Construction 360 Ltd enforces an <strong>electronic-only tendering standard</strong>. We have decommissioned all public telephone lines. All blueprints, specifications, and client inquiries must be submitted digitally via our encrypted forms or emailed to <a href="mailto:info@construction360.co" class="text-teal-300 hover:underline font-bold font-sans">info@construction360.co</a>.',
                'created_at' => '2026-06-16 11:52:50',
                'updated_at' => '2026-06-16 13:29:40',
            ],
            [
                'id' => '56',
                'key' => 'tendering_content',
                'value' => '1. Submission Formats

To facilitate rapid structural engineering assessments and quantity takeoff calculations, all project blueprints and schedules must be submitted in vector PDF format, dwg (AutoCAD), or rvt (Revit). Excel files or structured CSVs are required for complete Bill of Quantities (BoQ) uploads.

2. Review SLA & Turnaround

Once a digital tender brief is logged via our system, a structural coordinator and site developer are assigned to review the specifications. Complete estimates, scheduling milestones, and preliminary structural feedback will be compiled and sent back to your corporate email within 24 business hours.

3. Communication Auditing

Every modification, drawing correction, and schedule revision requested during the tendering phase must be logged electronically. This ensures that our onsite project managers, CSCS carpenters, bricklayers, and glazing engineers operate with the identical version-controlled spec sheet, eliminating costly re-works.

4. Professional Ethics

By maintaining a paperless, digital tendering registry, we reduce project administration overheads by 15%, passing the savings directly back to our commercial and residential clients in competitive pricing schedules.',
                'created_at' => '2026-06-16 11:52:50',
                'updated_at' => '2026-06-17 13:26:42',
            ],
            [
                'id' => '57',
                'key' => 'social_facebook',
                'value' => 'https://www.facebook.com/people/Construction-360/61590797767639/',
                'created_at' => '2026-06-17 13:26:42',
                'updated_at' => '2026-06-17 13:26:42',
            ],
            [
                'id' => '58',
                'key' => 'social_instagram',
                'value' => 'https://www.instagram.com/Construction360.co',
                'created_at' => '2026-06-17 13:26:42',
                'updated_at' => '2026-06-17 13:26:42',
            ],
            [
                'id' => '59',
                'key' => 'social_linkedin',
                'value' => 'https://www.linkedin.com/company/construction-360',
                'created_at' => '2026-06-17 13:26:42',
                'updated_at' => '2026-06-17 13:26:42',
            ],
            [
                'id' => '60',
                'key' => 'site_logo',
                'value' => 'uploads/1781702803.png',
                'created_at' => '2026-06-17 13:26:42',
                'updated_at' => '2026-06-17 13:26:43',
            ],
        ];

        DB::table('site_contents')->insert($data);

    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('projects')->truncate();
        DB::table('site_contents')->truncate();
    }
};
