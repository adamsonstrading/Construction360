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
                static $navServiceColumns = null;
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

                    if ($navServices->isNotEmpty()) {
                        $items = $navServices->values()->all();
                        $n = count($items);
                        if ($n <= 4) {
                            $navServiceColumns = array_map(fn($item) => [$item], $items);
                        } else {
                            $scores = array_map(fn($s) => min(count($s->subs ?? []), 5) + 3, $items);
                            $totalScore = array_sum($scores);
                            $avgScore = $totalScore / 4;

                            $bestSplit = [1, 2, 3];
                            $bestVariance = PHP_FLOAT_MAX;

                            for ($i = 1; $i < $n - 2; $i++) {
                                for ($j = $i + 1; $j < $n - 1; $j++) {
                                    for ($k = $j + 1; $k < $n; $k++) {
                                        $c1 = array_sum(array_slice($scores, 0, $i));
                                        $c2 = array_sum(array_slice($scores, $i, $j - $i));
                                        $c3 = array_sum(array_slice($scores, $j, $k - $j));
                                        $c4 = array_sum(array_slice($scores, $k));

                                        $variance = pow($c1 - $avgScore, 2) + pow($c2 - $avgScore, 2) + pow($c3 - $avgScore, 2) + pow($c4 - $avgScore, 2);
                                        if ($variance < $bestVariance) {
                                            $bestVariance = $variance;
                                            $bestSplit = [$i, $j, $k];
                                        }
                                    }
                                }
                            }

                            [$i, $j, $k] = $bestSplit;
                            $navServiceColumns = [
                                array_slice($items, 0, $i),
                                array_slice($items, $i, $j - $i),
                                array_slice($items, $j, $k - $j),
                                array_slice($items, $k),
                            ];
                        }
                    } else {
                        $navServiceColumns = [];
                    }
                }
                $view->with('content', $content);
                $view->with('navServices', $navServices ?? collect());
                $view->with('navServiceColumns', $navServiceColumns ?? []);
            });
        }
    }
}
