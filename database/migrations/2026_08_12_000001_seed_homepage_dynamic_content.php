<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\SiteContent;

return new class extends Migration
{
    public function up(): void
    {
        if (! \Illuminate\Support\Facades\Schema::hasTable('site_contents')) {
            return;
        }

        $defaults = [
            'hero_image' => 'images/hero_construction.png',
            'hero_video' => 'con360.mp4',
            'hero_watch_label' => 'Watch Our Intro',
            'hero_watch_sub' => '60 sec overview',
            'reviews_score' => '4.9',
            'reviews_score_sub' => 'from client reviews',
            'popular_paths_label' => 'Start here',
            'popular_paths_title' => 'Popular project paths',
            'popular_paths_link' => 'All services →',
            'projects_reviews_badge' => 'Trusted by homeowners across London & Essex',
            'about_learn_more_label' => 'Learn more about us →',
            'process_tab_design' => 'Design & Build',
            'process_tab_build' => 'Build only',
            'services_subtitle' => 'From pre-construction through structure, interiors and external works — one accountable team across every trade.',
            'services_cta_prompt' => 'Looking for something specific?',
            'services_card_price_label' => 'Enquire for pricing',
        ];

        foreach ($defaults as $key => $value) {
            SiteContent::firstOrCreate(['key' => $key], ['value' => $value]);
        }
    }

    public function down(): void
    {
        // Non-destructive — keep seeded content on rollback
    }
};
