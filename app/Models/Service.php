<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    protected $fillable = [
        'title',
        'description',
        'icon',
        'display_order',
        'about',
        'why_choose_us',
        'services_offered',
        'faqs',
        'image_url',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected $casts = [
        'why_choose_us' => 'array',
        'services_offered' => 'array',
        'faqs' => 'array',
        'display_order' => 'integer',
    ];

    /**
     * Get the dynamic image URL for the service based on its title.
     *
     * @param string|null $value
     * @return string
     */
    public function getImageUrlAttribute($value)
    {
        if (!empty($value)) {
            return $value;
        }

        $title = strtolower($this->title);
        if (str_contains($title, 'planning') || str_contains($title, 'pre-construction')) {
            return 'images/services/pre-construction.jpg';
        } elseif (str_contains($title, 'site prep')) {
            return 'images/services/site-preparation.jpg';
        } elseif (str_contains($title, 'foundation')) {
            return 'images/services/foundations.jpg';
        } elseif (str_contains($title, 'structural')) {
            return 'images/services/structural-works.png';
        } elseif (str_contains($title, 'roof')) {
            return 'images/services/roofing.jpg';
        } elseif (str_contains($title, 'mep')) {
            return 'images/services/mep.jpg';
        } elseif (str_contains($title, 'interior')) {
            return 'images/services/interior.jpg';
        } elseif (str_contains($title, 'external')) {
            return 'images/services/external.jpg';
        } elseif (str_contains($title, 'civil')) {
            return 'images/services/civil.jpg';
        } elseif (str_contains($title, 'specialist')) {
            return 'images/services/specialist.jpg';
        } elseif (str_contains($title, 'renovation') || str_contains($title, 'design and build')) {
            return 'images/services/renovation.jpg';
        } elseif (str_contains($title, 'finance')) {
            return 'images/service_finance.png';
        } elseif (str_contains($title, 'design')) {
            return 'images/about_engineering.png';
        } elseif (str_contains($title, 'construction')) {
            return 'images/hero_construction.png';
        } elseif (str_contains($title, 'support')) {
            return 'images/service_support.png';
        } elseif (str_contains($title, 'building control')) {
            return 'images/service_control.png';
        } elseif (str_contains($title, 'facilities') || str_contains($title, 'maintenance')) {
            return 'images/service_facilities.png';
        }
        return 'images/services/pre-construction.jpg';
    }
}
