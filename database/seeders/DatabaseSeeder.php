<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;
use App\Models\Service;
use App\Models\Project;
use App\Models\WhyUsItem;
use App\Models\ProcessStep;
use App\Models\EngagementModel;
use App\Models\FaqItem;
use App\Models\TechStackItem;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            ContentSeeder::class,
        ]);
    }
}
