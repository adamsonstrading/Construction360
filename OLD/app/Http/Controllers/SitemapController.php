<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Service;
use App\Models\BlogPost;

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
            $urls[] = route('services.show', $service->slug);
        }

        $projects = Project::all();
        foreach ($projects as $project) {
            $urls[] = route('projects.show', $project->slug);
        }

        $posts = BlogPost::where('is_published', true)->get();
        foreach ($posts as $post) {
            $urls[] = route('blog.show', $post->slug);
        }

        return response()->view('sitemap', compact('urls'))->header('Content-Type', 'text/xml');
    }
}
