<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Ethnicity;
use App\Models\Organization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Mail;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (app()->isProduction()) {
            return;
        }

        Mail::fake();

        Country::factory()
            ->count(195)
            ->create();

        Ethnicity::factory()
            ->count(10)
            ->create();

        Organization::factory()
            ->count(10)
            ->create();
    }
}