<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactQuery;
use App\Models\Service;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        $totalLeads = ContactQuery::count();
        $pendingLeads = ContactQuery::where('status', 'new')->count();
        $totalServices = Service::count();

        // Retrieve latest 5 leads for recent activity listing
        $recentQueries = ContactQuery::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact(
            'totalLeads',
            'pendingLeads',
            'totalServices',
            'recentQueries'
        ));
    }
}
