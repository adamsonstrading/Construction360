<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ContentController extends Controller
{
    /**
     * Get the defined sections configuration.
     */
    protected function getSections(): array
    {
        return [
            'general' => [
                'name' => 'General & Branding',
                'slug' => 'general',
                'icon' => 'cog-6-tooth',
                'desc' => 'Site logo, company identity, and social media channels'
            ],
            'seo' => [
                'name' => 'SEO & Metadata',
                'slug' => 'seo',
                'icon' => 'magnifying-glass',
                'desc' => 'Meta tags, search descriptions, keywords & OG image'
            ],
            'hero' => [
                'name' => 'Hero & Metrics',
                'slug' => 'hero',
                'icon' => 'sparkles',
                'desc' => 'Hero headline lines, video/image media, and 4 key metric stats'
            ],
            'homepage' => [
                'name' => 'Homepage & Process',
                'slug' => 'homepage',
                'icon' => 'squares-2x2',
                'desc' => 'Interactive Design/Build workflows, sector tags, CTA buttons & ticker'
            ],
            'about' => [
                'name' => 'About Us & Vision',
                'slug' => 'about',
                'icon' => 'information-circle',
                'desc' => 'Company history, mission, vision, core values, and quote'
            ],
            'assurances' => [
                'name' => 'Assurances & Reviews',
                'slug' => 'assurances',
                'icon' => 'shield-check',
                'desc' => 'Why Choose Us cards, ISO/CSCS credentials, and client reviews'
            ],
            'contact' => [
                'name' => 'Contact & Office',
                'slug' => 'contact',
                'icon' => 'phone',
                'desc' => 'Registered address, support emails, phone and Google Map embeds'
            ],
            'team' => [
                'name' => 'Team & Leadership',
                'slug' => 'team',
                'icon' => 'users',
                'desc' => 'Leadership profiles, directors, and professional accreditations'
            ],
            'subpages' => [
                'name' => 'Subpages & Legal',
                'slug' => 'subpages',
                'icon' => 'document-text',
                'desc' => 'Privacy, Terms, Tendering standard, and subpage hero templates'
            ],
        ];
    }

    /**
     * Show the landing page content edit form with tab navigation.
     */
    public function edit(Request $request)
    {
        $sections = $this->getSections();
        $activeSection = $request->query('section', 'general');

        if (!array_key_exists($activeSection, $sections)) {
            $activeSection = 'general';
        }

        $content = SiteContent::pluck('value', 'key')->all();

        return view('admin.content', compact('content', 'sections', 'activeSection'));
    }

    /**
     * Update a specific section's content in the database with strict isolation & transaction.
     */
    public function update(Request $request)
    {
        $sections = $this->getSections();
        $section = $request->input('section', 'general');

        if (!array_key_exists($section, $sections)) {
            return redirect()->route('admin.content.edit', ['section' => 'general'])
                ->with('error', 'Invalid content section specified.');
        }

        $rules = $this->getRulesForSection($section);
        $validated = $request->validate($rules);

        DB::beginTransaction();

        try {
            // Handle section-specific file uploads
            $this->handleSectionUploads($request, $section, $validated);

            // Special handling for Homepage complex structures
            if ($section === 'homepage') {
                $this->handleHomepageStructures($validated);
            }

            // Sync hero composite title
            if ($section === 'hero') {
                $validated['hero_title'] = trim(
                    ($validated['hero_line_1'] ?? '') . ' ' .
                    ($validated['hero_line_2'] ?? '') . ' ' .
                    ($validated['hero_line_3'] ?? '') . ' ' .
                    ($validated['hero_line_4'] ?? '')
                );
            }

            // Save each field in this section
            foreach ($validated as $key => $value) {
                // Ignore nulls for file fields when not re-uploaded
                if ($this->isFileField($key) && empty($value)) {
                    continue;
                }

                SiteContent::updateOrCreate(
                    ['key' => $key],
                    ['value' => is_array($value) ? json_encode($value) : $value]
                );
            }

            DB::commit();

            return redirect()->route('admin.content.edit', ['section' => $section])
                ->with('success', $sections[$section]['name'] . ' updated successfully.');

        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('ContentController update failed in section [' . $section . ']: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => $request->except(['_token'])
            ]);

            return redirect()->route('admin.content.edit', ['section' => $section])
                ->withInput()
                ->with('error', 'An unexpected error occurred while saving: ' . $e->getMessage());
        }
    }

    /**
     * Check if a field name is an uploaded file.
     */
    protected function isFileField(string $key): bool
    {
        return in_array($key, ['site_logo', 'hero_image', 'hero_video', 'seo_og_image'], true);
    }

    /**
     * Process file uploads according to the active section.
     */
    protected function handleSectionUploads(Request $request, string $section, array &$validated): void
    {
        $fileMap = [
            'general' => ['site_logo' => 'uploads'],
            'seo' => ['seo_og_image' => 'uploads'],
            'hero' => ['hero_image' => 'uploads', 'hero_video' => 'uploads'],
        ];

        if (!isset($fileMap[$section])) {
            return;
        }

        foreach ($fileMap[$section] as $field => $dir) {
            if ($request->hasFile($field)) {
                $fileName = time() . '_' . $field . '.' . $request->file($field)->extension();
                $request->file($field)->move(public_path($dir), $fileName);
                $validated[$field] = $dir . '/' . $fileName;
            } else {
                unset($validated[$field]);
            }
        }
    }

    /**
     * Handle homepage complex JSON structures (process steps, sectors list).
     */
    protected function handleHomepageStructures(array &$validated): void
    {
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

        if (isset($validated['sectors_list'])) {
            $sectorsList = [];
            foreach ($validated['sectors_list'] as $item) {
                if (!empty($item['title'])) {
                    $sectorsList[] = [
                        'title' => $item['title'],
                        'icon' => $item['icon'] ?? 'home',
                        'desc' => $item['desc'] ?? '',
                    ];
                }
            }
            SiteContent::updateOrCreate(
                ['key' => 'sectors_list'],
                ['value' => json_encode($sectorsList)]
            );
            unset($validated['sectors_list']);
        }
    }

    /**
     * Return targeted validation rules for each isolated section.
     */
    protected function getRulesForSection(string $section): array
    {
        return match ($section) {
            'general' => [
                'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                'social_facebook' => 'nullable|url|max:255',
                'social_instagram' => 'nullable|url|max:255',
                'social_linkedin' => 'nullable|url|max:255',
                'social_whatsapp' => 'nullable|url|max:255',
            ],

            'seo' => [
                'seo_meta_title' => 'required|string|max:255',
                'seo_meta_description' => 'required|string|max:1000',
                'seo_meta_keywords' => 'required|string|max:1000',
                'google_site_verification' => 'nullable|string|max:255',
                'seo_og_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
            ],

            'hero' => [
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
            ],

            'homepage' => [
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
                'reviews_score' => 'required|string|max:10',
                'reviews_score_sub' => 'required|string|max:255',
                'reviews_link_label' => 'required|string|max:255',
                'process_label' => 'required|string|max:255',
                'process_title' => 'required|string|max:255',
                'process_subtitle' => 'required|string|max:1000',
                'process_caption_design' => 'required|string|max:255',
                'process_caption_build' => 'required|string|max:255',
                'process_cta' => 'required|string|max:255',
                'process_tab_design' => 'required|string|max:255',
                'process_tab_build' => 'required|string|max:255',
                'process_design_steps' => 'nullable|array',
                'process_design_steps.*.step' => 'nullable|string|max:10',
                'process_design_steps.*.title' => 'nullable|string|max:255',
                'process_design_steps.*.duration' => 'nullable|string|max:255',
                'process_design_steps.*.body' => 'nullable|string|max:1000',
                'process_design_steps.*.icon' => 'nullable|string|max:50',
                'process_build_steps' => 'nullable|array',
                'process_build_steps.*.step' => 'nullable|string|max:10',
                'process_build_steps.*.title' => 'nullable|string|max:255',
                'process_build_steps.*.duration' => 'nullable|string|max:255',
                'process_build_steps.*.body' => 'nullable|string|max:1000',
                'process_build_steps.*.icon' => 'nullable|string|max:50',
                'sectors_list' => 'nullable|array',
                'sectors_list.*.title' => 'nullable|string|max:255',
                'sectors_list.*.icon' => 'nullable|string|max:255',
                'sectors_list.*.desc' => 'nullable|string|max:1000',
                'marquee_text' => 'nullable|string|max:2000',
                'filter_all_label' => 'nullable|string|max:255',
                'filter_completed_label' => 'nullable|string|max:255',
                'filter_under_construction_label' => 'nullable|string|max:255',
                'cta_submit_tender_label' => 'nullable|string|max:255',
                'cta_book_consult_label' => 'nullable|string|max:255',
                'cta_explore_services_label' => 'nullable|string|max:255',
                'cta_ask_quote_label' => 'nullable|string|max:255',
                'cta_explore_portfolio_label' => 'nullable|string|max:255',
                'cta_view_all_posts_label' => 'nullable|string|max:255',
                'cta_get_free_quote_label' => 'nullable|string|max:255',
                'popular_paths_label' => 'nullable|string|max:255',
                'popular_paths_title' => 'nullable|string|max:255',
                'popular_paths_link' => 'nullable|string|max:255',
                'projects_subtitle' => 'nullable|string|max:1000',
                'projects_reviews_badge' => 'nullable|string|max:255',
                'client_stories_label' => 'nullable|string|max:255',
                'client_stories_title' => 'nullable|string|max:255',
                'client_stories_link' => 'nullable|string|max:255',
                'about_learn_more_label' => 'nullable|string|max:255',
                'services_title_line1' => 'nullable|string|max:255',
                'services_title_line2' => 'nullable|string|max:255',
                'services_subtitle' => 'nullable|string|max:1000',
                'services_cta_prompt' => 'nullable|string|max:255',
                'services_card_price_label' => 'nullable|string|max:255',
                'partners_title' => 'nullable|string|max:255',
                'partners_subtitle' => 'nullable|string|max:255',
            ],

            'about' => [
                'about_page_label' => 'nullable|string|max:255',
                'about_page_title' => 'nullable|string|max:255',
                'about_page_subtitle' => 'nullable|string|max:2000',
                'who_we_are_label' => 'nullable|string|max:255',
                'who_we_are_heading' => 'nullable|string|max:1000',
                'who_we_are_text' => 'nullable|string|max:2000',
                'about_label' => 'nullable|string|max:255',
                'about_heading' => 'required|string',
                'about_vision_label' => 'nullable|string|max:255',
                'about_vision' => 'required|string',
                'about_mission_label' => 'nullable|string|max:255',
                'about_mission' => 'required|string',
                'about_values_label' => 'nullable|string|max:255',
                'about_values' => 'required|string',
                'about_quote' => 'required|string',
                'about_quote_author' => 'nullable|string|max:255',
            ],

            'assurances' => [
                'why_1_title' => 'required|string|max:255',
                'why_1_text' => 'required|string|max:1000',
                'why_2_title' => 'required|string|max:255',
                'why_2_text' => 'required|string|max:1000',
                'why_3_title' => 'required|string|max:255',
                'why_3_text' => 'required|string|max:1000',
                'why_4_title' => 'required|string|max:255',
                'why_4_text' => 'required|string|max:1000',
                'insurance_title' => 'required|string|max:255',
                'insurance_text' => 'required|string',
                'certificates_title' => 'required|string|max:255',
                'certificates_text' => 'required|string',
                'cscs_title' => 'required|string|max:255',
                'cscs_text' => 'required|string',
                'testimonial_1_quote' => 'required|string',
                'testimonial_1_author' => 'required|string|max:255',
                'testimonial_1_role' => 'required|string|max:255',
                'testimonial_2_quote' => 'required|string',
                'testimonial_2_author' => 'required|string|max:255',
                'testimonial_2_role' => 'required|string|max:255',
                'testimonial_3_quote' => 'required|string',
                'testimonial_3_author' => 'required|string|max:255',
                'testimonial_3_role' => 'required|string|max:255',
            ],

            'contact' => [
                'header_email' => 'required|email|max:255',
                'header_phone' => 'nullable|string|max:255',
                'contact_address' => 'nullable|string|max:500',
                'contact_map_url' => 'nullable|url|max:1000',
                'digital_tenders_only_label' => 'nullable|string|max:255',
                'contact_map_embed_url' => 'nullable|string|max:1000',
                'contact_page_title' => 'required|string|max:255',
                'contact_page_subtitle' => 'required|string|max:1000',
                'contact_page_form_title' => 'required|string|max:255',
                'contact_support_email_label' => 'required|string|max:255',
                'contact_mobile_label' => 'required|string|max:255',
                'contact_location_label' => 'required|string|max:255',
                'pre_footer_cta_title' => 'nullable|string|max:255',
                'pre_footer_cta_subtitle' => 'nullable|string|max:1000',
                'contact_section_label' => 'nullable|string|max:255',
                'contact_section_title' => 'nullable|string|max:255',
                'contact_section_subtitle' => 'nullable|string|max:1000',
            ],

            'team' => [
                'team_section_label' => 'required|string|max:255',
                'team_section_title' => 'required|string|max:255',
                'team_section_subtitle' => 'required|string|max:1000',
                'team_member_1_name' => 'required|string|max:255',
                'team_member_1_role' => 'required|string|max:255',
                'team_member_1_description' => 'required|string|max:1000',
                'team_member_1_accreditations' => 'required|string|max:255',
                'team_member_2_name' => 'required|string|max:255',
                'team_member_2_role' => 'required|string|max:255',
                'team_member_2_description' => 'required|string|max:1000',
                'team_member_2_accreditations' => 'required|string|max:255',
                'team_member_3_name' => 'required|string|max:255',
                'team_member_3_role' => 'required|string|max:255',
                'team_member_3_description' => 'required|string|max:1000',
                'team_member_3_accreditations' => 'required|string|max:255',
            ],

            'subpages' => [
                'privacy_title' => 'required|string|max:255',
                'privacy_notice' => 'required|string',
                'privacy_content' => 'required|string',
                'terms_title' => 'required|string|max:255',
                'terms_notice' => 'required|string',
                'terms_content' => 'required|string',
                'tendering_title' => 'required|string|max:255',
                'tendering_notice' => 'required|string',
                'tendering_content' => 'required|string',
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
                'digital_tenders_only_label' => 'required|string|max:255',
                'pre_footer_cta_title' => 'required|string|max:255',
                'pre_footer_cta_subtitle' => 'required|string|max:1000',
                'footer_company_registration' => 'required|string|max:1000',
                'footer_description' => 'nullable|string|max:1000',
            ],

            default => [],
        };
    }
}
