<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\StoreUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = User::where("id", "!=", 1)
            ->orderBy('id', 'DESC');

        if ($request->filled('status')) {
            if ($request->status == 1) {
                $query->where('is_active', 1);
            } else {
                $query->where('is_active', 0);
            }
        }

        $users = $query->paginate(5)->withQueryString();

        return view('main.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('main.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        User::create($request->validated());

        return redirect()->back()->with('success', 'User Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);

        return view("main.users.show", compact("user"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $user = User::findOrFail($id);

        return view("main.users.edit", compact("user"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        $user->update($request->validated());

        return redirect()->back()->with('success', 'User Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->back()->with('success', 'User Deleted Successfully');
    }

    /**
     * For Update User Status
     */
    public function updateStatus(string $id)
    {
        $user = User::findOrFail($id);

        $newsStatus = $user->is_active == 1 ? 0 : 1;

        $user->update(['is_active' => $newsStatus]);

        return redirect()->back()->with('success', 'User Status Updated Successfully');
    }
}
