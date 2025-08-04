<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

use Illuminate\Http\Request;
use App\Models\Branch;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $branches = Branch::active()->get();

        return Inertia::render('Reports', [
            'title' => 'Reports',
            'description' => 'Reports',
            'branches' => $branches
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function sales()
    {
        return Inertia::render('reports/sales', [
            'title' => 'Reports | Sales',
            'reports' => []
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
