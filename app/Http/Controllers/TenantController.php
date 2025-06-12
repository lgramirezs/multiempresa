<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all tenants
        $tenants = Tenant::all();

        // Return the view with the tenants data
        return view('tenants.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tenants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'id' => ['required', 'string', 'max:255', 'unique:tenants,id'],
        ]);

        $tenant = Tenant::create($request->only('id'));
        $tenant->domains()->create([
            'domain' => $request->input('id') . '.localhost',
        ]);

        // Redirect to the tenants index with a success message
        return redirect()->route('tenants.index')->with('success', 'Tenant created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenant $tenant)
    {
        return view('tenants.edit', compact('tenant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tenant $tenant)
    {
        // Validate the request data
        $request->validate([
            'id' => ['required', 'string', 'max:255', 'unique:tenants,id,' . $tenant->id],
        ]);

        $tenant->update($request->only('id'));
        $tenant->domains()->update([
            'domain' => $request->input('id') . '.localhost',
        ]);

        // Redirect to the tenants index with a success message
        return redirect()->route('tenants.index')->with('success', 'Tenant updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        // Delete the tenant and its associated domains
        $tenant->domains()->delete();
        $tenant->delete();

        // Redirect to the tenants index with a success message
        return redirect()->route('tenants.index')->with('success', 'Tenant deleted successfully.');
    }
}
