<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of services.
     */
    public function index()
    {
        $services = Service::orderBy('display_order', 'asc')->get();

        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new service.
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created service in database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'required|string|max:255',
            'display_order' => 'required|integer|min:0',
            'about' => 'nullable|string',
            'image_url' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:1000',
            'meta_keywords' => 'nullable|string|max:1000',
            'why_choose_us' => 'nullable|array',
            'why_choose_us.*.title' => 'nullable|string|max:255',
            'why_choose_us.*.desc' => 'nullable|string',
            'services_offered' => 'nullable|array',
            'services_offered.*.title' => 'nullable|string|max:255',
            'services_offered.*.desc' => 'nullable|string',
            'faqs' => 'nullable|array',
            'faqs.*.q' => 'nullable|string|max:255',
            'faqs.*.a' => 'nullable|string',
        ]);

        $data = $this->processServiceData($validated);

        Service::create($data);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    /**
     * Show the form for editing the specified service.
     */
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified service in database.
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'required|string|max:255',
            'display_order' => 'required|integer|min:0',
            'about' => 'nullable|string',
            'image_url' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:1000',
            'meta_keywords' => 'nullable|string|max:1000',
            'why_choose_us' => 'nullable|array',
            'why_choose_us.*.title' => 'nullable|string|max:255',
            'why_choose_us.*.desc' => 'nullable|string',
            'services_offered' => 'nullable|array',
            'services_offered.*.title' => 'nullable|string|max:255',
            'services_offered.*.desc' => 'nullable|string',
            'faqs' => 'nullable|array',
            'faqs.*.q' => 'nullable|string|max:255',
            'faqs.*.a' => 'nullable|string',
        ]);

        $data = $this->processServiceData($validated);

        $service->update($data);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    /**
     * Process and normalize service arrays.
     */
    protected function processServiceData(array $validated)
    {
        $data = $validated;

        // Process why choose us
        if (isset($data['why_choose_us']) && is_array($data['why_choose_us'])) {
            $whyChooseUs = [];
            foreach ($data['why_choose_us'] as $item) {
                if (!empty($item['title']) || !empty($item['desc'])) {
                    $whyChooseUs[] = [
                        'title' => $item['title'] ?? '',
                        'desc' => $item['desc'] ?? '',
                    ];
                }
            }
            $data['why_choose_us'] = $whyChooseUs;
        } else {
            $data['why_choose_us'] = [];
        }

        // Process services offered (convert from list of title/desc to associative array)
        if (isset($data['services_offered']) && is_array($data['services_offered'])) {
            $servicesOffered = [];
            foreach ($data['services_offered'] as $item) {
                if (!empty($item['title']) || !empty($item['desc'])) {
                    $title = $item['title'] ?? '';
                    $servicesOffered[$title] = $item['desc'] ?? '';
                }
            }
            $data['services_offered'] = $servicesOffered;
        } else {
            $data['services_offered'] = [];
        }

        // Process FAQs
        if (isset($data['faqs']) && is_array($data['faqs'])) {
            $faqs = [];
            foreach ($data['faqs'] as $item) {
                if (!empty($item['q']) || !empty($item['a'])) {
                    $faqs[] = [
                        'q' => $item['q'] ?? '',
                        'a' => $item['a'] ?? '',
                    ];
                }
            }
            $data['faqs'] = $faqs;
        } else {
            $data['faqs'] = [];
        }

        return $data;
    }

    /**
     * Remove the specified service from database.
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }
}
