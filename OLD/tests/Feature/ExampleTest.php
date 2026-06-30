<?php

namespace Tests\Feature;

use App\Models\SiteContent;
use App\Models\Service;
use App\Models\ContactQuery;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the landing page renders successfully with dynamic database content.
     */
    public function test_the_landing_page_renders_with_database_content(): void
    {
        // Seed temporary content for testing
        SiteContent::create([
            'key' => 'hero_title',
            'value' => 'Dynamic Construction Title',
        ]);
        
        Service::create([
            'title' => 'Civil Construction Test',
            'description' => 'Test description',
            'icon' => 'globe-alt',
            'display_order' => 1,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Dynamic Construction Title');
        $response->assertSee('Civil Construction Test');
    }

    /**
     * Test that the contact form submission successfully saves a query.
     */
    public function test_contact_form_submission(): void
    {
        $response = $this->post('/contact', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'subject' => 'Tender Proposal',
            'message' => 'I would like to request a tender for a structural build.',
        ]);

        $response->assertStatus(302); // Redirect back
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('contact_queries', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'subject' => 'Tender Proposal',
            'status' => 'new',
        ]);
    }

    /**
     * Test that the contact page renders successfully.
     */
    public function test_contact_page_renders_successfully(): void
    {
        $response = $this->get('/contact');
        $response->assertStatus(200);
        $response->assertSee('Get in touch');
        $response->assertSee('Support email');
        $response->assertSee('Leave a message');
    }

    /**
     * Test that guest users are redirected to the admin login page when trying to access the dashboard.
     */
    public function test_guest_is_redirected_to_admin_login(): void
    {
        $response = $this->get('/admin/dashboard');

        $response->assertStatus(302);
        $response->assertRedirect('/admin/login');
    }

    /**
     * Test that an admin can log in with correct credentials.
     */
    public function test_admin_can_login_with_correct_credentials(): void
    {
        $user = User::create([
            'name' => 'Admin Test',
            'email' => 'admin@construction360.co',
            'password' => Hash::make('password'),
        ]);

        $response = $this->post('/admin/login', [
            'email' => 'admin@construction360.co',
            'password' => 'password',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/admin/dashboard');
        $this->assertAuthenticatedAs($user);
    }

    /**
     * Test that an admin cannot log in with incorrect credentials.
     */
    public function test_admin_cannot_login_with_incorrect_credentials(): void
    {
        User::create([
            'name' => 'Admin Test',
            'email' => 'admin@construction360.co',
            'password' => Hash::make('password'),
        ]);

        $response = $this->post('/admin/login', [
            'email' => 'admin@construction360.co',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    /**
     * Test that an authenticated admin can view the dashboard.
     */
    public function test_authenticated_admin_can_view_dashboard(): void
    {
        $user = User::create([
            'name' => 'Admin Test',
            'email' => 'admin@construction360.co',
            'password' => Hash::make('password'),
        ]);

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertStatus(200);
        $response->assertSee('System Overview');
        $response->assertSee('Total Inquiries Received');
    }

    /**
     * Test that the landing page lists blogs.
     */
    public function test_landing_page_lists_blogs(): void
    {
        \App\Models\Blog::create([
            'title' => 'Structural Framing Best Practices',
            'slug' => 'structural-framing-best-practices',
            'excerpt' => 'This is the excerpt.',
            'content' => 'Full article content.',
            'author' => 'Test Author',
            'published_at' => now(),
        ]);

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Structural Framing Best Practices');
        $response->assertSee('Test Author');
    }

    /**
     * Test that guest users cannot access blog manager.
     */
    public function test_guest_cannot_access_blog_manager(): void
    {
        $response = $this->get('/admin/blogs');
        $response->assertStatus(302);
        $response->assertRedirect('/admin/login');
    }

    /**
     * Test that authenticated admin can perform CRUD operations on blogs.
     */
    public function test_authenticated_admin_can_crud_blogs(): void
    {
        $user = User::create([
            'name' => 'Admin Test',
            'email' => 'admin@construction360.co',
            'password' => Hash::make('password'),
        ]);

        // 1. View Index
        $response = $this->actingAs($user)->get('/admin/blogs');
        $response->assertStatus(200);

        // 2. Create Blog
        $response = $this->actingAs($user)->post('/admin/blogs', [
            'title' => 'New Construction Innovation',
            'excerpt' => 'A short summary of innovation.',
            'category' => 'Uncategorized',
            'content' => '<p>Modern building technologies are expanding.</p>',
            'author' => 'Innovation Team',
            'meta_title' => 'Innovation Meta Title',
            'meta_description' => 'Innovation Meta Desc',
            'meta_keywords' => 'innovation, tags',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/admin/blogs');
        
        $this->assertDatabaseHas('blogs', [
            'title' => 'New Construction Innovation',
            'slug' => 'new-construction-innovation',
            'category' => 'Uncategorized',
            'author' => 'Innovation Team',
            'meta_title' => 'Innovation Meta Title',
            'meta_description' => 'Innovation Meta Desc',
            'meta_keywords' => 'innovation, tags',
        ]);

        $blog = \App\Models\Blog::where('slug', 'new-construction-innovation')->first();

        // 3. Edit Blog Form
        $response = $this->actingAs($user)->get("/admin/blogs/{$blog->id}/edit");
        $response->assertStatus(200);
        $response->assertSee('New Construction Innovation');
        $response->assertSee('Innovation Meta Title');

        // 4. Update Blog
        $response = $this->actingAs($user)->put("/admin/blogs/{$blog->id}", [
            'title' => 'Updated Construction Innovation',
            'excerpt' => 'An updated summary.',
            'category' => 'Company',
            'content' => '<p>Updated building tech.</p>',
            'author' => 'Updated Team',
            'meta_title' => 'Updated Meta Title',
            'meta_description' => 'Updated Meta Desc',
            'meta_keywords' => 'updated, tags',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/admin/blogs');

        $this->assertDatabaseHas('blogs', [
            'id' => $blog->id,
            'title' => 'Updated Construction Innovation',
            'category' => 'Company',
            'author' => 'Updated Team',
            'meta_title' => 'Updated Meta Title',
            'meta_description' => 'Updated Meta Desc',
            'meta_keywords' => 'updated, tags',
        ]);

        // 5. Delete Blog
        $response = $this->actingAs($user)->delete("/admin/blogs/{$blog->id}");
        $response->assertStatus(302);
        $response->assertRedirect('/admin/blogs');

        $this->assertDatabaseMissing('blogs', [
            'id' => $blog->id,
        ]);
    }

    /**
     * Test public Services index and show views.
     */
    public function test_services_index_and_show(): void
    {
        // 1. Create a service
        $service = Service::create([
            'title' => 'Designing & Planning',
            'description' => 'We engage as early as possible...',
            'icon' => 'academic-cap',
            'display_order' => 1,
        ]);

        // 2. Access services index
        $response = $this->get('/services');
        $response->assertStatus(200);
        $response->assertSee('Designing & Planning');
        $response->assertSee('Design to Delivery');

        // 3. Access service details
        $response = $this->get('/services/designing-planning');
        $response->assertStatus(200);
        $response->assertSee('Designing & Planning');
        $response->assertSee('Visual Clarity');
        $response->assertSee('RIBA Framework');
    }

    /**
     * Test public Projects index and show views.
     */
    public function test_projects_index_and_show(): void
    {
        // 1. Create a project
        $project = \App\Models\Project::create([
            'title' => 'Haydons road',
            'slug' => 'haydons-road',
            'category' => 'Residential',
            'status' => 'under-construction',
            'description' => 'Ground-up construction of a residential block.',
            'image_url' => 'images/project_haydons.png',
            'location' => 'London, Merton',
            'year' => '2026',
            'display_order' => 1,
        ]);

        // 2. Access projects index
        $response = $this->get('/projects');
        $response->assertStatus(200);
        $response->assertSee('Haydons road');
        $response->assertSee('under-construction');

        // 3. Access projects index with filter
        $response = $this->get('/projects?status=under-construction&type=Residential');
        $response->assertStatus(200);
        $response->assertSee('Haydons road');

        // 4. Access projects index with mismatching filter
        $response = $this->get('/projects?status=completed');
        $response->assertStatus(200);
        $response->assertDontSee('Haydons road');

        // 5. Access project details
        $response = $this->get('/projects/haydons-road');
        $response->assertStatus(200);
        $response->assertSee('Haydons road');
        $response->assertSee('London, Merton');
        $response->assertSee('Residential');
    }

    /**
     * Test admin Projects CRUD with status field.
     */
    public function test_admin_projects_crud(): void
    {
        $user = User::create([
            'name' => 'Admin Test',
            'email' => 'admin@construction360.co',
            'password' => Hash::make('password'),
        ]);

        // 1. Create project via admin dashboard
        $response = $this->actingAs($user)->post('/admin/projects', [
            'title' => 'New Admin Build',
            'slug' => 'new-admin-build',
            'category' => 'Commercial',
            'status' => 'under-construction',
            'description' => 'A test project created by admin.',
            'location' => 'Chelmsford, Essex',
            'year' => '2026',
            'display_order' => 1,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/admin/projects');

        $this->assertDatabaseHas('projects', [
            'title' => 'New Admin Build',
            'status' => 'under-construction',
            'category' => 'Commercial',
        ]);

        $project = \App\Models\Project::where('slug', 'new-admin-build')->first();

        // 2. Update project status via admin
        $response = $this->actingAs($user)->put("/admin/projects/{$project->id}", [
            'title' => 'Updated Admin Build',
            'category' => 'Commercial',
            'status' => 'completed',
            'description' => 'A test project updated by admin.',
            'location' => 'Chelmsford, Essex',
            'year' => '2026',
            'display_order' => 1,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/admin/projects');

        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'title' => 'Updated Admin Build',
            'status' => 'completed',
        ]);
    }
}
