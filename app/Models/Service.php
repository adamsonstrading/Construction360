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
        if (str_contains($title, 'planning')) {
            return 'images/service_design_planning.png';
        } elseif (str_contains($title, 'design and build')) {
            return 'images/service_residential.png';
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
        return 'images/service_design_planning.png';
    }
}
