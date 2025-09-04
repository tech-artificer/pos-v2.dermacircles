<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;

use App\Models\Branch;
use Illuminate\Support\Facades\Hash;
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
        $users = User::with('branches', 'roles')->get();

        return Inertia::render('Users', [
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
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'branches' => ['required', 'array', 'exists:branches,id'],
            'role' => ['required', 'string', 'exists:roles,name'],
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $user->branches()->sync($validatedData['branches']);
        $user->assignRole($validatedData['role']);
        return redirect()->route('users.index')->with('success', 'User created successfully.');
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
    public function edit(User $user)
    {
        $branches = Branch::all();
        $roles = Role::all();
        $userBranches = $user->branches->pluck('id')->toArray();
        $userRole = $user->roles->first();

        return view('users.edit', compact('user', 'branches', 'roles', 'userBranches', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            'branches' => ['required', 'array', 'exists:branches,id'],
            'role_name' => ['required', 'string', 'exists:roles,name'],
        ]);

        if ($user->hasRole('owner') && $validatedData['role_name'] != 'Owner') {
            return back()->withErrors('Cannot update roles for Owner/Admin accounts.');
        }

        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
            $user->save();
        }

        $user->branches()->sync($validatedData['branches']);
        $user->syncRoles($validatedData['role_name']);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {  
        if ($user->hasRole('admin')) {
            return back()->withErrors('Admin accounts cannot be deleted.');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
