<?php

namespace App\Providers;

use App\Contracts\ReportsRepositoryInterface;
use App\GraphReport;
use App\Repositories\ReportsRepository;
use Illuminate\Support\ServiceProvider;

/**
 * Registers an implementation for the ReportsRepositoryInterface
 */
class ReportsRepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $reports = [];

        $test = new GraphReport('test');
        $test->labels = ['Sleeping', 'Designing'];
        $test->options = ['responsive' => false];
        $test->datasets = [
            [
                'data'            => [20, 40],
                'backgroundColor' => ['red', 'blue'],
            ],
        ];

        $reports[] = $test;

        $test = new GraphReport('test1');
        $test->labels = ['Sleeping', 'Designing'];
        $test->options = ['responsive' => false];
        $test->datasets = [
            [
                'data'            => [20, 40],
                'backgroundColor' => ['red', 'blue'],
            ],
        ];

        $reports[] = $test;

        $test = new GraphReport('test2');
        $test->labels = ['Sleeping', 'Designing'];
        $test->options = ['responsive' => false];
        $test->datasets = [
            [
                'data'            => [20, 40],
                'backgroundColor' => ['red', 'blue'],
            ],
        ];

        $reports[] = $test;

        $this->app->bind(ReportsRepositoryInterface::class, function ($app) use ($reports) {
            return new ReportsRepository($reports);
        });
    }
}
