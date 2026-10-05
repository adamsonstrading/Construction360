<?php

namespace Tests\Feature;

use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminServiceSubServicesTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::create([
            'name' => 'Admin Tester',
            'email' => 'admin@construction360.co',
            'password' => Hash::make('secret123'),
        ]);
    }

    /**
     * Test removing a single specific sub-service preserves all other sub-services.
     */
    public function test_deleting_one_specific_sub_service_retains_all_others(): void
    {
        $service = Service::create([
            'title' => 'Structural Works',
            'description' => 'Comprehensive structural and civil works',
            'icon' => 'academic-cap',
            'display_order' => 1,
            'services_offered' => [
                [
                    'title' => 'Sub-Service 1 (Site Survey)',
                    'desc' => 'Survey of site bounds',
                    'meta_title' => 'Site Survey UK',
                    'meta_description' => 'Site survey desc',
                    'meta_keywords' => 'survey, site',
                    'deliverables' => 'Deliverable 1',
                ],
                [
                    'title' => 'Sub-Service 2 (To Be Deleted)',
                    'desc' => 'This one should be removed',
                    'meta_title' => 'Delete Me',
                    'meta_description' => 'Will be deleted',
                    'meta_keywords' => 'delete',
                    'deliverables' => 'Deliverable 2',
                ],
                [
                    'title' => 'Sub-Service 3 (Steel Frame)',
                    'desc' => 'Structural steel frame installation',
                    'meta_title' => 'Steel Frame UK',
                    'meta_description' => 'Steel frame desc',
                    'meta_keywords' => 'steel, frame',
                    'deliverables' => 'Deliverable 3',
                ],
                [
                    'title' => 'Sub-Service 4 (Concrete Pouring)',
                    'desc' => 'Foundation concrete pouring',
                    'meta_title' => 'Concrete Pouring UK',
                    'meta_description' => 'Concrete desc',
                    'meta_keywords' => 'concrete, pouring',
                    'deliverables' => 'Deliverable 4',
                ],
            ],
        ]);

        // Simulate form submission after removing Sub-Service 2 in the UI
        // Notice the re-indexed array (indices 0, 1, 2) keeping 1, 3, and 4
        $reindexedPayload = [
            'title' => 'Structural Works Updated',
            'description' => 'Comprehensive structural and civil works',
            'icon' => 'academic-cap',
            'display_order' => 1,
            'services_offered' => [
                [
                    'title' => 'Sub-Service 1 (Site Survey)',
                    'desc' => 'Survey of site bounds',
                    'meta_title' => 'Site Survey UK',
                    'meta_description' => 'Site survey desc',
                    'meta_keywords' => 'survey, site',
                    'deliverables' => 'Deliverable 1',
                ],
                [
                    'title' => 'Sub-Service 3 (Steel Frame)',
                    'desc' => 'Structural steel frame installation',
                    'meta_title' => 'Steel Frame UK',
                    'meta_description' => 'Steel frame desc',
                    'meta_keywords' => 'steel, frame',
                    'deliverables' => 'Deliverable 3',
                ],
                [
                    'title' => 'Sub-Service 4 (Concrete Pouring)',
                    'desc' => 'Foundation concrete pouring',
                    'meta_title' => 'Concrete Pouring UK',
                    'meta_description' => 'Concrete desc',
                    'meta_keywords' => 'concrete, pouring',
                    'deliverables' => 'Deliverable 4',
                ],
            ],
        ];

        $response = $this->actingAs($this->admin)->put(route('admin.services.update', $service->id), $reindexedPayload);

        $response->assertRedirect(route('admin.services.index'));
        $response->assertSessionHas('success');

        $service->refresh();
        $updatedSubServices = $service->services_offered;

        $this->assertCount(3, $updatedSubServices);
        $this->assertEquals('Sub-Service 1 (Site Survey)', $updatedSubServices[0]['title']);
        $this->assertEquals('Sub-Service 3 (Steel Frame)', $updatedSubServices[1]['title']);
        $this->assertEquals('Sub-Service 4 (Concrete Pouring)', $updatedSubServices[2]['title']);

        // Assert Sub-Service 2 was completely and solely deleted
        $titles = array_column($updatedSubServices, 'title');
        $this->assertNotContains('Sub-Service 2 (To Be Deleted)', $titles);
    }

    /**
     * Test adding and removing multiple sub-services maintains sequential index structure.
     */
    public function test_sub_services_data_processing_handles_empty_and_whitespace_entries(): void
    {
        $service = Service::create([
            'title' => 'Design & Build',
            'description' => 'Complete turnkey service',
            'icon' => 'building-office-2',
            'display_order' => 2,
        ]);

        $payload = [
            'title' => 'Design & Build',
            'description' => 'Complete turnkey service',
            'icon' => 'building-office-2',
            'display_order' => 2,
            'services_offered' => [
                ['title' => 'Valid Sub-Service A', 'desc' => 'Desc A'],
                ['title' => '   ', 'desc' => 'Whitespace title should be filtered out'],
                ['title' => 'Valid Sub-Service B', 'desc' => 'Desc B'],
            ],
        ];

        $response = $this->actingAs($this->admin)->put(route('admin.services.update', $service->id), $payload);
        $response->assertRedirect(route('admin.services.index'));

        $service->refresh();
        $this->assertCount(2, $service->services_offered);
        $this->assertEquals('Valid Sub-Service A', $service->services_offered[0]['title']);
        $this->assertEquals('Valid Sub-Service B', $service->services_offered[1]['title']);
    }
}
