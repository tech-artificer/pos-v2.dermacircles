<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

/**
 * UserController handles user management functionalities.
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        Role::createMany([
            ['name' => 'Admin'],
            ['name' => 'MD'],
            ['name' => 'Cashier'],
            ['name' => 'Inventory Manager'],
            ['name' => 'Inventory Staff'],
            ['name' => 'Secretary'],
        ]);

        Permission::createMany([
            ['name' => 'edit articles'],
            ['name' => 'delete articles'],
            ['name' => 'publish articles'],
        ]);

        $users = User::active()->with('roles')->get();


        return Inertia::render('users/Index', [
            'title' => 'Users',
            'description' => 'Manage users of the application.',
            'users' => $users,
        ]);
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
