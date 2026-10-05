<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

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
            'image_file' => 'nullable|image|max:5120',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:1000',
            'meta_keywords' => 'nullable|string|max:1000',
            'why_choose_us' => 'nullable|array',
            'why_choose_us.*.title' => 'nullable|string|max:255',
            'why_choose_us.*.desc' => 'nullable|string',
            'services_offered' => 'nullable|array',
            'services_offered.*.title' => 'nullable|string|max:255',
            'services_offered.*.desc' => 'nullable|string',
            'services_offered.*.meta_title' => 'nullable|string|max:255',
            'services_offered.*.meta_description' => 'nullable|string|max:1000',
            'services_offered.*.meta_keywords' => 'nullable|string|max:1000',
            'services_offered.*.deliverables' => 'nullable|string|max:1000',
            'faqs' => 'nullable|array',
            'faqs.*.q' => 'nullable|string|max:255',
            'faqs.*.a' => 'nullable|string',
        ]);

        $uploadedPath = null;

        DB::beginTransaction();
        try {
            if ($request->hasFile('image_file')) {
                $image = $request->file('image_file');
                $imageName = 'service_' . time() . '_' . uniqid() . '.' . $image->extension();
                $destination = public_path('uploads');
                if (!file_exists($destination)) {
                    mkdir($destination, 0755, true);
                }
                $image->move($destination, $imageName);
                $uploadedPath = 'uploads/' . $imageName;
                $validated['image_url'] = $uploadedPath;
            }
            unset($validated['image_file']);

            $data = $this->processServiceData($validated);

            $service = Service::create($data);

            DB::commit();

            return redirect()->route('admin.services.index')->with('success', "Service '{$service->title}' created successfully.");
        } catch (Throwable $e) {
            DB::rollBack();

            if ($uploadedPath && file_exists(public_path($uploadedPath))) {
                @unlink(public_path($uploadedPath));
            }

            Log::error('Service creation failed: ' . $e->getMessage(), [
                'exception' => $e,
                'user_id' => auth()->id() ?? null,
            ]);

            return redirect()->back()
                ->withErrors(['error' => 'Failed to create service: ' . $e->getMessage()])
                ->withInput();
        }
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
            'image_file' => 'nullable|image|max:5120',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:1000',
            'meta_keywords' => 'nullable|string|max:1000',
            'why_choose_us' => 'nullable|array',
            'why_choose_us.*.title' => 'nullable|string|max:255',
            'why_choose_us.*.desc' => 'nullable|string',
            'services_offered' => 'nullable|array',
            'services_offered.*.title' => 'nullable|string|max:255',
            'services_offered.*.desc' => 'nullable|string',
            'services_offered.*.meta_title' => 'nullable|string|max:255',
            'services_offered.*.meta_description' => 'nullable|string|max:1000',
            'services_offered.*.meta_keywords' => 'nullable|string|max:1000',
            'services_offered.*.deliverables' => 'nullable|string|max:1000',
            'faqs' => 'nullable|array',
            'faqs.*.q' => 'nullable|string|max:255',
            'faqs.*.a' => 'nullable|string',
        ]);

        $uploadedPath = null;
        $oldImagePath = $service->getRawOriginal('image_url');

        DB::beginTransaction();
        try {
            if ($request->hasFile('image_file')) {
                $image = $request->file('image_file');
                $imageName = 'service_' . time() . '_' . uniqid() . '.' . $image->extension();
                $destination = public_path('uploads');
                if (!file_exists($destination)) {
                    mkdir($destination, 0755, true);
                }
                $image->move($destination, $imageName);
                $uploadedPath = 'uploads/' . $imageName;
                $validated['image_url'] = $uploadedPath;
            }
            unset($validated['image_file']);

            $data = $this->processServiceData($validated);

            $service->update($data);

            DB::commit();

            if ($uploadedPath && $oldImagePath && str_starts_with($oldImagePath, 'uploads/') && file_exists(public_path($oldImagePath))) {
                @unlink(public_path($oldImagePath));
            }

            return redirect()->route('admin.services.index')->with('success', "Service '{$service->title}' updated successfully.");
        } catch (Throwable $e) {
            DB::rollBack();

            if ($uploadedPath && file_exists(public_path($uploadedPath))) {
                @unlink(public_path($uploadedPath));
            }

            Log::error("Failed to update service [ID: {$service->id}]: " . $e->getMessage(), [
                'exception' => $e,
                'service_id' => $service->id,
                'user_id' => auth()->id() ?? null,
            ]);

            return redirect()->back()
                ->withErrors(['error' => 'Failed to update service: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Process and normalize service arrays.
     */
    protected function processServiceData(array $validated): array
    {
        $data = $validated;

        // Process why choose us
        if (isset($data['why_choose_us']) && is_array($data['why_choose_us'])) {
            $whyChooseUs = [];
            foreach ($data['why_choose_us'] as $item) {
                if (is_array($item)) {
                    $t = trim($item['title'] ?? '');
                    $d = trim($item['desc'] ?? '');
                    if ($t !== '' || $d !== '') {
                        $whyChooseUs[] = [
                            'title' => $t,
                            'desc' => $d,
                        ];
                    }
                }
            }
            $data['why_choose_us'] = array_values($whyChooseUs);
        } else {
            $data['why_choose_us'] = [];
        }

        // Process services offered (store as array of objects containing metadata)
        if (isset($data['services_offered']) && is_array($data['services_offered'])) {
            $servicesOffered = [];
            foreach ($data['services_offered'] as $item) {
                if (is_array($item)) {
                    $title = trim($item['title'] ?? '');
                    if ($title !== '') {
                        $servicesOffered[] = [
                            'title' => $title,
                            'desc' => trim($item['desc'] ?? ''),
                            'meta_title' => trim($item['meta_title'] ?? ''),
                            'meta_description' => trim($item['meta_description'] ?? ''),
                            'meta_keywords' => trim($item['meta_keywords'] ?? ''),
                            'deliverables' => trim($item['deliverables'] ?? ''),
                        ];
                    }
                }
            }
            // Ensure sequential 0-indexed array
            $data['services_offered'] = array_values($servicesOffered);
        } else {
            $data['services_offered'] = [];
        }

        // Process FAQs
        if (isset($data['faqs']) && is_array($data['faqs'])) {
            $faqs = [];
            foreach ($data['faqs'] as $item) {
                if (is_array($item)) {
                    $q = trim($item['q'] ?? '');
                    $a = trim($item['a'] ?? '');
                    if ($q !== '' || $a !== '') {
                        $faqs[] = [
                            'q' => $q,
                            'a' => $a,
                        ];
                    }
                }
            }
            $data['faqs'] = array_values($faqs);
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
        DB::beginTransaction();
        try {
            $serviceTitle = $service->title;
            $imageUrl = $service->getRawOriginal('image_url');

            $service->delete();

            DB::commit();

            if ($imageUrl && str_starts_with($imageUrl, 'uploads/') && file_exists(public_path($imageUrl))) {
                @unlink(public_path($imageUrl));
            }

            return redirect()->route('admin.services.index')->with('success', "Service '{$serviceTitle}' deleted successfully.");
        } catch (Throwable $e) {
            DB::rollBack();

            Log::error("Failed to delete service [ID: {$service->id}]: " . $e->getMessage(), [
                'exception' => $e,
                'service_id' => $service->id,
                'user_id' => auth()->id() ?? null,
            ]);

            return redirect()->route('admin.services.index')
                ->withErrors(['error' => 'Failed to delete service: ' . $e->getMessage()]);
        }
    }
}
