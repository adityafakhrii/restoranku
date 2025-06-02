<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereHas('role', function($query) {
            $query->where('role_name', '!=', 'guest');
        })->orderBy('fullname')->get();
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::where('role_name', '!=', 'guest')->get();
        return view('admin.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:15',
            'role_id' => 'required|integer|exists:roles,id',
        ], [
            'username.required' => 'Username field is required.',
            'username.unique' => 'Username has already been taken.',
            'password.required' => 'Password field is required.',
            'password.confirmed' => 'Password confirmation does not match.',
            'fullname.required' => 'Fullname field is required.',
            'email.required' => 'Email field is required.',
            'email.email' => 'Email must be a valid email address.',
            'email.unique' => 'Email has already been taken.',
            'phone.required' => 'Phone field is required.',
            'role_id.required' => 'Role field is required.',
            'role_id.exists' => 'Selected role does not exist.',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::where('role_name', '!=', 'guest')->get();
        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
                function ($attribute, $value, $fail) use  ($user) {
                    if (Hash::check($value, $user->password)) {
                        $fail('The new password cannot be the same as the old password.');
                    }
                },
            ],
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:15',
            'role_id' => 'required|integer|exists:roles,id',
        ], [
            'username.required' => 'Username field is required.',
            'username.unique' => 'Username has already been taken.',
            'password.required' => 'Password field is required.',
            'password.confirmed' => 'Password confirmation does not match.',
            'fullname.required' => 'Fullname field is required.',
            'email.required' => 'Email field is required.',
            'email.email' => 'Email must be a valid email address.',
            'email.unique' => 'Email has already been taken.',
            'phone.required' => 'Phone field is required.',
            'role_id.required' => 'Role field is required.',
            'role_id.exists' => 'Selected role does not exist.',
        ]);

        if ($request->filled('password')) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        $user->update($validatedData);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
