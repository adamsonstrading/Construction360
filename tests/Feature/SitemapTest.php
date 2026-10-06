<?php

namespace Tests\Feature;

use App\Models\Service;
use App\Models\Project;
use App\Models\Blog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SitemapTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test sitemap.xml returns 200 OK with valid application/xml content type and structure.
     */
    public function test_sitemap_returns_successful_xml(): void
    {
        // Seed test records
        Service::create([
            'title' => 'Structural Works',
            'description' => 'Structural engineering and framing',
            'icon' => 'cube',
            'image_url' => 'images/services/structural.jpg',
            'services_offered' => [
                [
                    'title' => 'Steel Frame Fabrication',
                    'slug' => 'steel-frame-fabrication',
                    'desc' => 'High quality structural steel',
                ]
            ],
            'display_order' => 1,
        ]);

        Project::create([
            'title' => 'Mayfair Penthouse',
            'slug' => 'mayfair-penthouse',
            'category' => 'Residential',
            'status' => 'completed',
            'description' => 'Luxury renovation in central London',
            'image_url' => 'images/projects/mayfair.jpg',
            'location' => 'Mayfair, London',
            'year' => '2025',
            'display_order' => 1,
        ]);

        Blog::create([
            'title' => 'Structural Steel Innovation',
            'slug' => 'structural-steel-innovation',
            'excerpt' => 'Modern fabrication methods',
            'category' => 'Engineering',
            'content' => 'Full steel article',
            'image_url' => 'images/blog/steel.jpg',
            'author' => 'Lead Engineer',
            'published_at' => now()->subDay(),
        ]);

        $response = $this->get('/sitemap.xml');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/xml; charset=utf-8');
        $response->assertHeader('Cache-Control', 'max-age=3600, public, s-maxage=3600');

        $content = $response->getContent();
        $this->assertStringContainsString('<?xml version="1.0" encoding="UTF-8"?>', $content);
        $this->assertStringContainsString('<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"', $content);
        $this->assertStringContainsString('xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"', $content);

        // Core Pages
        $this->assertStringContainsString('<loc>https://construction360.co/</loc>', $content);
        $this->assertStringContainsString('<loc>https://construction360.co/services</loc>', $content);
        $this->assertStringContainsString('<loc>https://construction360.co/projects</loc>', $content);
        $this->assertStringContainsString('<loc>https://construction360.co/blog</loc>', $content);
        $this->assertStringContainsString('<loc>https://construction360.co/contact</loc>', $content);
        $this->assertStringContainsString('<loc>https://construction360.co/about-us</loc>', $content);

        // Model Pages
        $this->assertStringContainsString('<loc>https://construction360.co/services/structural-works</loc>', $content);
        $this->assertStringContainsString('<loc>https://construction360.co/services/structural-works/steel-frame-fabrication</loc>', $content);
        $this->assertStringContainsString('<loc>https://construction360.co/projects/mayfair-penthouse</loc>', $content);
        $this->assertStringContainsString('<loc>https://construction360.co/blog/structural-steel-innovation</loc>', $content);

        // Image tags
        $this->assertStringContainsString('<image:loc>https://construction360.co/images/services/structural.jpg</image:loc>', $content);
        $this->assertStringContainsString('<image:title>Structural Works</image:title>', $content);

        // Assert no localhost or 127.0.0.1 leaks
        $this->assertStringNotContainsString('localhost', $content);
        $this->assertStringNotContainsString('127.0.0.1', $content);

        // Verify valid XML parsing
        $xml = simplexml_load_string($content);
        $this->assertNotFalse($xml, 'Sitemap should be valid XML');
        $this->assertGreaterThanOrEqual(13, count($xml->url));
    }
}
