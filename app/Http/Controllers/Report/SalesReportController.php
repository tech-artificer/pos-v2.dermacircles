<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Sales;
use Carbon\Carbon;
use App\Models\Branch;

class SalesReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $sales = [];

        return Inertia::render('reports/sales/Index', [
            'title' => 'Reports | Sales',
            'description' => 'Sales Report',
            'sales' => $sales
        ]);
        // $this->summary($request);
    }

    public function summary(Request $request)
    {
        $salesReports = [
            'sales' => [],
            'totalSalesAmount' => 0,
            'totalItemsSold' => 0,

        ];
        $userBranch = $request->user()->branches()->get();
        // $request->validate([
        //    'report' => ['required', 'string']
        // ]);

        // // Default date range: today
        $startDate = $request->input('start_date', Carbon::today()->format('Y-m-d'));//Carbon::today()->toDateString());
        $endDate = $request->input('end_date', Carbon::today()->format('Y-m-d'));//Carbon::today()->toDateString());

        // Validate dates (basic)
        if (!Carbon::parse($startDate)->isValid() || !Carbon::parse($endDate)->isValid()) {
            // Handle invalid dates, e.g., redirect back with error
            return back()->withErrors(['dates' => 'Invalid date range provided.']);
        }

        $sales = Sales::betweenDates($startDate, $endDate) // Using our scope
            ->when($request->filled('branch_id'), function ($query) use ($request) {
                $query->where('branch_id', $request->branch_id);
            })
            ->orderBy('date_created', 'desc')
            ->get(); // Paginate for large results

        // Calculate totals for the entire filtered set (not just current page)
        $totalSalesAmount = Sales::betweenDates($startDate, $endDate)
            ->when($request->filled('branch_id'), function ($query) use ($request) {
                $query->where('branch_id', $request->branch_id);
            })
            ->sum('total');

        $totalItemsSold = Sales::betweenDates($startDate, $endDate)
            ->when($request->filled('branch_id'), function ($query) use ($request) {
                $query->where('branch_id', $request->branch_id);
            })
            ->join('sales_line_items', 'sales.sales_id', '=', 'sales_line_items.sales_id')
            ->sum('sales_line_items.quantity');

        // Get branches for filter dropdown (if needed)
        // $branches = Branch::select('branch_id', 'branch_name')->get();

        return Inertia::render('reports/sales/Summary', [
            // 'startDate' => $startDate,
            // 'endDate' => $endDate,
            'salesReports' => $salesReports,
            'sales' => $sales,
            'filters' => [
                'start_date' => $startDate,
                'end_date' => $endDate,
                'userBranch' => $userBranch, // Pass branches to frontend
            ],
            'totalSalesAmount' => number_format($totalSalesAmount, 2),
            'totalItemsSold' => $totalItemsSold,
            
        ]);
    }

    public function generateReport(Request $request)
{
    $request->validate([
        'startDate' => 'required|date',
        'endDate' => 'required|date|after_or_equal:startDate',
    ]);

        // Your sales report logic here
        $reportData = [
            'totalSales' => 125420.50,
            'totalOrders' => 342,
            'averageOrderValue' => 366.73,
            'topProducts' => [
                ['name' => 'Product A', 'sales' => 45200],
                ['name' => 'Product B', 'sales' => 32100],
            ]
        ];

        return back()->with(['reportData' => $reportData]);
    }
}
