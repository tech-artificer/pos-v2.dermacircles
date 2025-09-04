<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $roles = Role::all();
        // if ($request->hasHeader('X-Inertia-Partial-Data') && $request->header('X-Inertia-Partial-Data') === 'roles') {
        //     return Inertia::render('roles/Index', [
        //         'roles' => $roles,
        //     ]);
        // }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // Validate the incoming request
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles,name'],
        ]);

        // Create a new role
        $role = Role::create(['name' => $request->name]);

        return back()->with('success', 'Role created successfully.');
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
