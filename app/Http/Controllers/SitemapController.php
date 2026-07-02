<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Service;
use App\Models\Blog;
use Illuminate\Support\Str;

class SitemapController extends Controller
{
    public function index()
    {
        $now = now()->tz('UTC')->toAtomString();

        $urls = [
            ['loc' => url('/'),                      'lastmod' => $now, 'changefreq' => 'daily',   'priority' => '1.0'],
            ['loc' => route('services.index'),        'lastmod' => $now, 'changefreq' => 'weekly',  'priority' => '0.9'],
            ['loc' => route('projects.index'),        'lastmod' => $now, 'changefreq' => 'weekly',  'priority' => '0.8'],
            ['loc' => route('blog.index'),            'lastmod' => $now, 'changefreq' => 'daily',   'priority' => '0.8'],
            ['loc' => route('contact.index'),         'lastmod' => $now, 'changefreq' => 'monthly', 'priority' => '0.6'],
            ['loc' => route('tendering'),             'lastmod' => $now, 'changefreq' => 'monthly', 'priority' => '0.5'],
            ['loc' => route('privacy'),              'lastmod' => $now, 'changefreq' => 'yearly',  'priority' => '0.3'],
            ['loc' => route('terms'),                 'lastmod' => $now, 'changefreq' => 'yearly',  'priority' => '0.3'],
        ];

        // Service parent pages (high priority)
        $services = Service::all();
        foreach ($services as $service) {
            $serviceSlug = Str::slug($service->title);
            $serviceLastmod = $service->updated_at ? $service->updated_at->tz('UTC')->toAtomString() : $now;
            $urls[] = ['loc' => route('services.show', $serviceSlug), 'lastmod' => $serviceLastmod, 'changefreq' => 'weekly', 'priority' => '0.9'];

            $rawServicesOffered = $service->services_offered;
            if (is_string($rawServicesOffered)) {
                $rawServicesOffered = json_decode($rawServicesOffered, true);
            }
            if (is_array($rawServicesOffered)) {
                foreach ($rawServicesOffered as $key => $val) {
                    $subTitle = is_array($val) ? ($val['title'] ?? $key) : $key;
                    if (!empty($subTitle)) {
                        $urls[] = ['loc' => route('subservices.show', [$serviceSlug, Str::slug($subTitle)]), 'lastmod' => $serviceLastmod, 'changefreq' => 'weekly', 'priority' => '0.8'];
                    }
                }
            }
        }

        // Project pages
        $projects = Project::all();
        foreach ($projects as $project) {
            $projectLastmod = $project->updated_at ? $project->updated_at->tz('UTC')->toAtomString() : $now;
            $urls[] = ['loc' => route('projects.show', $project->slug), 'lastmod' => $projectLastmod, 'changefreq' => 'monthly', 'priority' => '0.7'];
        }

        // Blog posts
        $posts = Blog::where('published_at', '<=', now())->get();
        foreach ($posts as $post) {
            $postLastmod = $post->updated_at ? $post->updated_at->tz('UTC')->toAtomString() : $now;
            $urls[] = ['loc' => route('blog.show', $post->slug), 'lastmod' => $postLastmod, 'changefreq' => 'monthly', 'priority' => '0.7'];
        }

        return response()->view('sitemap', compact('urls'))->header('Content-Type', 'text/xml');
    }
}
