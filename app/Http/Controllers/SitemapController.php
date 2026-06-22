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
        $urls = [
            url('/'),
            route('services.index'),
            route('projects.index'),
            route('blog.index'),
            route('contact.index'),
            route('tendering'),
            route('privacy'),
            route('terms'),
        ];

        // Add dynamic routes
        $services = Service::all();
        foreach ($services as $service) {
            $urls[] = route('services.show', Str::slug($service->title));
        }

        $projects = Project::all();
        foreach ($projects as $project) {
            $urls[] = route('projects.show', $project->slug);
        }

        $posts = Blog::where('published_at', '<=', now())->get();
        foreach ($posts as $post) {
            $urls[] = route('blog.show', $post->slug);
        }

        return response()->view('sitemap', compact('urls'))->header('Content-Type', 'text/xml');
    }
}
