<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Models\Project;
use App\Models\WhyUsItem;
use App\Models\ProcessStep;
use App\Models\EngagementModel;
use App\Models\FaqItem;
use App\Models\TechStackItem;
use App\Models\Setting;
use App\Models\ContactInquiry;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class DashboardController
{
    public function index(): View
    {
        $inquiryCount = ContactInquiry::count();
        $newInquiries = ContactInquiry::new()->limit(5)->get();
        $statusCounts = ContactInquiry::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status');

        return view('admin.dashboard', compact('inquiryCount', 'newInquiries', 'statusCounts'));
    }
}
