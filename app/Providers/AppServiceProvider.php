<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\Schema::defaultStringLength(191);

        if (\Illuminate\Support\Facades\Schema::hasTable('site_contents')) {
            \Illuminate\Support\Facades\View::composer('*', function ($view) {
                static $content = null;
                static $navServices = null;
                if ($content === null) {
                    $content = \App\Models\SiteContent::pluck('value', 'key')->all();
                }
                if ($navServices === null && \Illuminate\Support\Facades\Schema::hasTable('services')) {
                    $navServices = \App\Models\Service::orderBy('display_order', 'asc')
                        ->get(['id', 'title', 'services_offered'])
                        ->map(function ($service) {
                            $raw = $service->services_offered;
                            if (is_string($raw)) {
                                $raw = json_decode($raw, true) ?: [];
                            }
                            if (!is_array($raw)) {
                                $raw = [];
                            }

                            $subs = [];
                            foreach ($raw as $key => $value) {
                                if (is_array($value)) {
                                    $title = $value['title'] ?? (is_string($key) ? $key : '');
                                } else {
                                    $title = is_string($key) ? $key : (string) $value;
                                }
                                $title = trim((string) $title);
                                if ($title === '') {
                                    continue;
                                }
                                $subs[] = [
                                    'title' => $title,
                                    'slug' => \Illuminate\Support\Str::slug(
                                        is_array($value) ? ($value['slug'] ?? $title) : $title
                                    ),
                                ];
                            }

                            return (object) [
                                'id' => $service->id,
                                'title' => $service->title,
                                'slug' => \Illuminate\Support\Str::slug($service->title),
                                'subs' => $subs,
                            ];
                        });
                }
                $view->with('content', $content);
                $view->with('navServices', $navServices ?? collect());
            });
        }
    }
}
