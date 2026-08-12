<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteContent;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    /**
     * Show the landing page content edit form.
     */
    public function edit()
    {
        $content = SiteContent::pluck('value', 'key')->all();

        return view('admin.content', compact('content'));
    }

    /**
     * Update the landing page content values in the database.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'seo_meta_title' => 'required|string|max:255',
            'seo_meta_description' => 'required|string|max:1000',
            'seo_meta_keywords' => 'required|string|max:1000',
            'google_site_verification' => 'nullable|string|max:255',
            
            'hero_line_1' => 'required|string|max:255',
            'hero_line_2' => 'nullable|string|max:255',
            'hero_line_3' => 'nullable|string|max:255',
            'hero_line_4' => 'nullable|string|max:255',
            'hero_badge' => 'nullable|string|max:255',
            'hero_subtitle' => 'required|string|max:1000',
            'hero_watch_label' => 'nullable|string|max:255',
            'hero_watch_sub' => 'nullable|string|max:255',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
            'hero_video' => 'nullable|mimes:mp4,webm|max:51200',

            'stat_1_value' => 'required|string|max:50',
            'stat_1_label' => 'required|string|max:255',
            'stat_2_value' => 'required|string|max:50',
            'stat_2_label' => 'required|string|max:255',
            'stat_3_value' => 'required|string|max:50',
            'stat_3_label' => 'required|string|max:255',
            'stat_4_value' => 'required|string|max:50',
            'stat_4_label' => 'required|string|max:255',

            'reviews_score' => 'required|string|max:10',
            'reviews_score_sub' => 'required|string|max:255',
            'reviews_link_label' => 'required|string|max:255',
            'cta_book_consult_label' => 'required|string|max:255',

            'popular_paths_label' => 'required|string|max:255',
            'popular_paths_title' => 'required|string|max:255',
            'popular_paths_link' => 'required|string|max:255',
            'projects_subtitle' => 'required|string|max:1000',
            'projects_reviews_badge' => 'required|string|max:255',
            'client_stories_label' => 'required|string|max:255',
            'client_stories_title' => 'required|string|max:255',
            'client_stories_link' => 'required|string|max:255',
            'about_learn_more_label' => 'required|string|max:255',

            'process_label' => 'required|string|max:255',
            'process_title' => 'required|string|max:255',
            'process_subtitle' => 'required|string|max:1000',
            'process_caption_design' => 'required|string|max:255',
            'process_caption_build' => 'required|string|max:255',
            'process_cta' => 'required|string|max:255',
            'process_tab_design' => 'required|string|max:255',
            'process_tab_build' => 'required|string|max:255',
            'process_design_steps' => 'nullable|array',
            'process_design_steps.*.step' => 'required|string|max:10',
            'process_design_steps.*.title' => 'required|string|max:255',
            'process_design_steps.*.duration' => 'required|string|max:255',
            'process_design_steps.*.body' => 'required|string|max:1000',
            'process_design_steps.*.icon' => 'required|string|max:50',
            'process_build_steps' => 'nullable|array',
            'process_build_steps.*.step' => 'required|string|max:10',
            'process_build_steps.*.title' => 'required|string|max:255',
            'process_build_steps.*.duration' => 'required|string|max:255',
            'process_build_steps.*.body' => 'required|string|max:1000',
            'process_build_steps.*.icon' => 'required|string|max:50',

            'services_title_line1' => 'required|string|max:255',
            'services_title_line2' => 'required|string|max:255',
            'services_subtitle' => 'required|string|max:1000',
            'services_cta_prompt' => 'required|string|max:255',
            'services_card_price_label' => 'required|string|max:255',
            'partners_title' => 'required|string|max:255',
            'partners_subtitle' => 'required|string|max:255',
            'seo_og_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',

            'hero_title' => 'nullable|string|max:255',
            'about_heading' => 'required|string',
            'about_vision' => 'required|string',
            'about_mission' => 'required|string',
            'about_values' => 'required|string',
            'about_quote' => 'required|string',
            
            // Operational Assurances
            'insurance_title' => 'required|string|max:255',
            'insurance_text' => 'required|string',
            'certificates_title' => 'required|string|max:255',
            'certificates_text' => 'required|string',
            'cscs_title' => 'required|string|max:255',
            'cscs_text' => 'required|string',

            // Testimonials
            'testimonial_1_quote' => 'required|string',
            'testimonial_1_author' => 'required|string|max:255',
            'testimonial_1_role' => 'required|string|max:255',
            
            'testimonial_2_quote' => 'required|string',
            'testimonial_2_author' => 'required|string|max:255',
            'testimonial_2_role' => 'required|string|max:255',

            'testimonial_3_quote' => 'required|string',
            'testimonial_3_author' => 'required|string|max:255',
            'testimonial_3_role' => 'required|string|max:255',

            // Header Top Bar & Corporate Contact
            'header_email' => 'required|email|max:255',
            'header_phone' => 'nullable|string|max:255',
            'contact_address' => 'nullable|string|max:500',
            'contact_map_url' => 'nullable|url|max:1000',

            // Section Headers
            'services_label' => 'required|string|max:255',
            'services_title' => 'required|string|max:255',
            'projects_label' => 'required|string|max:255',
            'projects_title' => 'required|string|max:255',
            'assurances_label' => 'required|string|max:255',
            'assurances_title' => 'required|string|max:255',
            'testimonials_label' => 'required|string|max:255',
            'testimonials_title' => 'required|string|max:255',
            'blog_label' => 'required|string|max:255',
            'blog_title' => 'required|string|max:255',
            'sectors_label' => 'required|string|max:255',
            'sectors_title' => 'required|string|max:255',
            'sectors_description' => 'required|string|max:1000',
            'sectors_list' => 'nullable|array',
            'sectors_list.*.title' => 'required|string|max:255',
            'sectors_list.*.icon' => 'required|string|max:255',
            'sectors_list.*.desc' => 'required|string|max:1000',

            // Team Section Headers
            'team_section_label' => 'required|string|max:255',
            'team_section_title' => 'required|string|max:255',
            'team_section_subtitle' => 'required|string|max:1000',

            // Team Member 1
            'team_member_1_name' => 'required|string|max:255',
            'team_member_1_role' => 'required|string|max:255',
            'team_member_1_description' => 'required|string|max:1000',
            'team_member_1_accreditations' => 'required|string|max:255',

            // Team Member 2
            'team_member_2_name' => 'required|string|max:255',
            'team_member_2_role' => 'required|string|max:255',
            'team_member_2_description' => 'required|string|max:1000',
            'team_member_2_accreditations' => 'required|string|max:255',

            // Team Member 3
            'team_member_3_name' => 'required|string|max:255',
            'team_member_3_role' => 'required|string|max:255',
            'team_member_3_description' => 'required|string|max:1000',
            'team_member_3_accreditations' => 'required|string|max:255',

            // Homepage Section Headers
            'services_section_label' => 'required|string|max:255',
            'services_section_title' => 'required|string|max:255',
            'services_section_subtitle' => 'required|string|max:1000',
            
            'blog_section_label' => 'required|string|max:255',
            'blog_section_title' => 'required|string|max:255',
            'blog_section_subtitle' => 'required|string|max:1000',
            
            'contact_section_label' => 'required|string|max:255',
            'contact_section_title' => 'required|string|max:255',
            'contact_section_subtitle' => 'required|string|max:1000',

            // Subpages Contents
            'privacy_title' => 'required|string|max:255',
            'privacy_notice' => 'required|string',
            'privacy_content' => 'required|string',
            
            'terms_title' => 'required|string|max:255',
            'terms_notice' => 'required|string',
            'terms_content' => 'required|string',
            
            'tendering_title' => 'required|string|max:255',
            'tendering_notice' => 'required|string',
            'tendering_content' => 'required|string',

            // Social Media
            'social_facebook' => 'nullable|url|max:255',
            'social_instagram' => 'nullable|url|max:255',
            'social_linkedin' => 'nullable|url|max:255',
            'social_whatsapp' => 'nullable|url|max:255',

            // Site Logo
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',

            // Footer Description
            'footer_description' => 'required|string|max:1000',

            // New Dynamic Fields
            'about_vision_label' => 'required|string|max:255',
            'about_mission_label' => 'required|string|max:255',
            'about_values_label' => 'required|string|max:255',
            'why_1_title' => 'required|string|max:255',
            'why_1_text' => 'required|string|max:1000',
            'why_2_title' => 'required|string|max:255',
            'why_2_text' => 'required|string|max:1000',
            'why_3_title' => 'required|string|max:255',
            'why_3_text' => 'required|string|max:1000',
            'why_4_title' => 'required|string|max:255',
            'why_4_text' => 'required|string|max:1000',
            'marquee_text' => 'required|string|max:2000',
            'filter_all_label' => 'required|string|max:255',
            'filter_completed_label' => 'required|string|max:255',
            'filter_under_construction_label' => 'required|string|max:255',
            'cta_submit_tender_label' => 'required|string|max:255',
            'cta_explore_services_label' => 'required|string|max:255',
            'cta_ask_quote_label' => 'required|string|max:255',
            'cta_explore_portfolio_label' => 'required|string|max:255',
            'cta_view_all_posts_label' => 'required|string|max:255',
            'cta_get_free_quote_label' => 'required|string|max:255',
            'contact_page_title' => 'required|string|max:255',
            'contact_page_subtitle' => 'required|string|max:1000',
            'contact_page_form_title' => 'required|string|max:255',
            'contact_support_email_label' => 'required|string|max:255',
            'contact_mobile_label' => 'required|string|max:255',
            'contact_location_label' => 'required|string|max:255',
            'about_page_label' => 'nullable|string|max:255',
            'about_page_title' => 'nullable|string|max:255',
            'about_page_subtitle' => 'nullable|string|max:1000',
            'about_label' => 'nullable|string|max:255',
            'about_quote_author' => 'nullable|string|max:255',
            'leadership_section_title' => 'nullable|string|max:255',
            'digital_tenders_only_label' => 'required|string|max:255',
            'contact_map_embed_url' => 'required|string|max:1000',
            'pre_footer_cta_title' => 'required|string|max:255',
            'pre_footer_cta_subtitle' => 'required|string|max:1000',
            'footer_company_registration' => 'required|string|max:1000',

            // Subpages Headings
            'services_page_label' => 'required|string|max:255',
            'services_page_title' => 'required|string|max:255',
            'services_page_subtitle' => 'required|string|max:1000',
            'service_about_label' => 'required|string|max:255',
            'service_scopes_label' => 'required|string|max:255',
            'service_scopes_title' => 'required|string|max:255',
            'service_why_choose_us_label' => 'required|string|max:255',
            'service_why_choose_us_title' => 'required|string|max:255',
            'service_faqs_label' => 'required|string|max:255',
            'service_faqs_title' => 'required|string|max:255',
            'projects_page_label' => 'required|string|max:255',
            'projects_page_title' => 'required|string|max:255',
            'projects_page_subtitle' => 'required|string|max:1000',
            'project_overview_title' => 'required|string|max:255',
            'project_scopes_title' => 'required|string|max:255',
            'project_specifications_title' => 'required|string|max:255',
            'project_related_label' => 'required|string|max:255',
            'project_related_title' => 'required|string|max:255',
        ]);

        // Handle process steps serialization
        foreach (['process_design_steps', 'process_build_steps'] as $stepsKey) {
            if (isset($validated[$stepsKey])) {
                $steps = [];
                foreach ($validated[$stepsKey] as $item) {
                    if (!empty($item['title'])) {
                        $steps[] = [
                            'step' => $item['step'] ?? '',
                            'title' => $item['title'],
                            'duration' => $item['duration'] ?? '',
                            'body' => $item['body'] ?? '',
                            'icon' => $item['icon'] ?? 'check',
                        ];
                    }
                }
                SiteContent::updateOrCreate(
                    ['key' => $stepsKey],
                    ['value' => json_encode($steps)]
                );
                unset($validated[$stepsKey]);
            }
        }

        // Handle Sectors List Serialization
        if (isset($validated['sectors_list'])) {
            $sectorsList = [];
            foreach ($validated['sectors_list'] as $item) {
                if (!empty($item['title'])) {
                    $sectorsList[] = [
                        'title' => $item['title'],
                        'icon' => $item['icon'],
                        'desc' => $item['desc'] ?? '',
                    ];
                }
            }
            SiteContent::updateOrCreate(
                ['key' => 'sectors_list'],
                ['value' => json_encode($sectorsList)]
            );
            unset($validated['sectors_list']);
        } else {
            SiteContent::updateOrCreate(
                ['key' => 'sectors_list'],
                ['value' => json_encode([])]
            );
        }

        // Handle file uploads
        $fileFields = [
            'site_logo' => 'uploads',
            'hero_image' => 'uploads',
            'hero_video' => 'uploads',
            'seo_og_image' => 'uploads',
        ];

        foreach ($fileFields as $field => $dir) {
            if ($request->hasFile($field)) {
                $fileName = time() . '_' . $field . '.' . $request->file($field)->extension();
                $request->file($field)->move(public_path($dir), $fileName);
                $validated[$field] = $dir . '/' . $fileName;
            }
        }

        // Sync legacy hero_title from headline lines
        $validated['hero_title'] = trim(
            ($validated['hero_line_1'] ?? '') . ' ' .
            ($validated['hero_line_2'] ?? '') . ' ' .
            ($validated['hero_line_3'] ?? '') . ' ' .
            ($validated['hero_line_4'] ?? '')
        );

        foreach ($validated as $key => $value) {
            if (in_array($key, array_keys($fileFields), true) && !$request->hasFile($key)) {
                continue;
            }

            SiteContent::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->route('admin.content.edit')->with('success', 'Landing page content updated successfully.');
    }
}
