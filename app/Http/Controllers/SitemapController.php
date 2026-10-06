<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Project;
use App\Models\Service;
use App\Models\SiteContent;
use Carbon\Carbon;
use Illuminate\Support\Str;

class SitemapController extends Controller
{
    public function index()
    {
        $canonicalBase = rtrim(config('app.url', 'https://construction360.co'), '/');

        // Helper to format ISO 8601 (Atom) date string
        $formatDate = function ($date, $fallback = null) {
            if ($date instanceof Carbon) {
                return $date->tz('UTC')->toAtomString();
            }
            if (is_string($date) && !empty($date)) {
                try {
                    return Carbon::parse($date)->tz('UTC')->toAtomString();
                } catch (\Throwable $e) {
                    // Fall back
                }
            }
            if ($fallback instanceof Carbon) {
                return $fallback->tz('UTC')->toAtomString();
            }
            return now()->subDays(3)->tz('UTC')->toAtomString();
        };

        // Determine realistic static lastmod date from latest system content update
        $latestSystemUpdate = null;
        try {
            $maxServiceUpdate = Service::max('updated_at');
            $maxProjectUpdate = Project::max('updated_at');
            $maxBlogUpdate = Blog::max('updated_at');
            $maxSiteContentUpdate = SiteContent::max('updated_at');

            $latestTimestamps = array_filter([$maxServiceUpdate, $maxProjectUpdate, $maxBlogUpdate, $maxSiteContentUpdate]);
            $latestSystemUpdate = !empty($latestTimestamps) ? max($latestTimestamps) : null;
        } catch (\Throwable $e) {
            $latestSystemUpdate = null;
        }

        $staticLastmod = $formatDate($latestSystemUpdate, now()->subDays(1));

        // Canonical URL builder
        $buildUrl = function (string $path) use ($canonicalBase): string {
            return $canonicalBase . '/' . ltrim($path, '/');
        };

        // Helper to convert relative or absolute image path to canonical image URL
        $buildImageUrl = function (?string $path) use ($canonicalBase): ?string {
            if (empty($path)) {
                return null;
            }
            if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
                $parsed = parse_url($path);
                $imagePath = $parsed['path'] ?? '';
                return $canonicalBase . '/' . ltrim($imagePath, '/');
            }
            return $canonicalBase . '/' . ltrim($path, '/');
        };

        $urls = [];
        $seen = [];

        $addUrl = function (string $path, string $lastmod, string $changefreq, string $priority, array $images = []) use (&$urls, &$seen, $buildUrl) {
            $loc = $buildUrl($path);
            if (isset($seen[$loc])) {
                return;
            }
            $seen[$loc] = true;

            $validImages = [];
            foreach ($images as $img) {
                if (!empty($img['loc'])) {
                    $validImages[] = [
                        'loc' => $img['loc'],
                        'title' => $img['title'] ?? '',
                    ];
                }
            }

            $urls[] = [
                'loc' => $loc,
                'lastmod' => $lastmod,
                'changefreq' => $changefreq,
                'priority' => $priority,
                'images' => $validImages,
            ];
        };

        // 1. Core Pages
        $addUrl('/', $staticLastmod, 'daily', '1.0');
        $addUrl('/services', $staticLastmod, 'weekly', '0.9');
        $addUrl('/projects', $staticLastmod, 'weekly', '0.8');
        $addUrl('/blog', $staticLastmod, 'daily', '0.8');
        $addUrl('/about-us', $staticLastmod, 'monthly', '0.7');
        $addUrl('/contact', $staticLastmod, 'monthly', '0.7');
        $addUrl('/tendering-standard', $staticLastmod, 'monthly', '0.6');
        $addUrl('/privacy-policy', $staticLastmod, 'yearly', '0.3');
        $addUrl('/terms-and-conditions', $staticLastmod, 'yearly', '0.3');

        // 2. Services & Sub-Services
        $landingController = new LandingPageController();
        try {
            $services = Service::orderBy('display_order', 'asc')->get();
        } catch (\Throwable $e) {
            $services = collect();
        }

        foreach ($services as $service) {
            $serviceSlug = Str::slug($service->title);
            if (empty($serviceSlug)) {
                continue;
            }

            $serviceLastmod = $formatDate($service->updated_at ?? $service->created_at, $staticLastmod);

            $serviceImages = [];
            if (!empty($service->image_url)) {
                $serviceImages[] = [
                    'loc' => $buildImageUrl($service->image_url),
                    'title' => $service->title,
                ];
            }

            $addUrl('/services/' . $serviceSlug, $serviceLastmod, 'weekly', '0.9', $serviceImages);

            // Sub-Services
            $rawServicesOffered = $service->services_offered;
            if (is_string($rawServicesOffered)) {
                $rawServicesOffered = json_decode($rawServicesOffered, true);
            }

            // Fallback to default sub-services if empty
            if (empty($rawServicesOffered) || !is_array($rawServicesOffered)) {
                $defaults = $landingController->getServiceDetails($serviceSlug);
                if (!empty($defaults['services_offered']) && is_array($defaults['services_offered'])) {
                    $rawServicesOffered = $defaults['services_offered'];
                }
            }

            if (is_array($rawServicesOffered)) {
                foreach ($rawServicesOffered as $key => $val) {
                    $subTitle = is_array($val) ? ($val['title'] ?? (is_string($key) ? $key : '')) : (is_string($val) ? $val : (is_string($key) ? $key : ''));
                    if (empty($subTitle)) {
                        continue;
                    }

                    $subSlug = is_array($val) && !empty($val['slug'])
                        ? $val['slug']
                        : Str::slug($subTitle);

                    if (empty($subSlug)) {
                        continue;
                    }

                    $addUrl('/services/' . $serviceSlug . '/' . $subSlug, $serviceLastmod, 'weekly', '0.8');
                }
            }
        }

        // 3. Projects
        try {
            $projects = Project::orderBy('display_order', 'asc')->get();
        } catch (\Throwable $e) {
            $projects = collect();
        }

        foreach ($projects as $project) {
            if (empty($project->slug)) {
                continue;
            }

            $projectLastmod = $formatDate($project->updated_at ?? $project->created_at, $staticLastmod);
            $projectImages = [];
            if (!empty($project->image_url)) {
                $projectImages[] = [
                    'loc' => $buildImageUrl($project->image_url),
                    'title' => $project->title,
                ];
            }

            $addUrl('/projects/' . $project->slug, $projectLastmod, 'monthly', '0.7', $projectImages);
        }

        // 4. Blog Posts
        try {
            $posts = Blog::whereNotNull('published_at')
                ->where('published_at', '<=', now())
                ->orderBy('published_at', 'desc')
                ->get();
        } catch (\Throwable $e) {
            $posts = collect();
        }

        foreach ($posts as $post) {
            if (empty($post->slug)) {
                continue;
            }

            $postLastmod = $formatDate($post->updated_at ?? $post->published_at ?? $post->created_at, $staticLastmod);
            $postImages = [];
            if (!empty($post->image_url)) {
                $postImages[] = [
                    'loc' => $buildImageUrl($post->image_url),
                    'title' => $post->title,
                ];
            }

            $addUrl('/blog/' . $post->slug, $postLastmod, 'monthly', '0.7', $postImages);
        }

        return response()
            ->view('sitemap', compact('urls'))
            ->header('Content-Type', 'application/xml; charset=utf-8')
            ->header('Cache-Control', 'public, max-age=3600, s-maxage=3600');
    }
}
