<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TenantController extends Controller
{
    // List all tenants with their associated property
    public function index()
    {
        $tenants = Auth::user()->tenants()->with('property')->latest()->paginate(50);

        return view('tenants.index', compact('tenants'));
    }

    // Show form to add a new tenant
    public function create()
    {
        // Fetch only properties owned by this landlord for the selection dropdown
        $properties = Auth::user()->properties()->orderBy('title')->get();

        return view('tenants.create', compact('properties'));
    }

    // Store a new tenant
    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_id'  => ['required', 'exists:properties,id'],
            'name'         => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:20'],
            'email'        => ['nullable', 'email', 'max:255'],
            'unit'         => ['nullable', 'string', 'max:50'],
        ]);

        // Security check: Ensure the selected property belongs to the logged-in landlord
        $propertyBelongsToLandlord = Auth::user()->properties()
            ->where('id', $validated['property_id'])
            ->exists();

        if (! $propertyBelongsToLandlord) {
            return back()->withErrors(['property_id' => 'Invalid property selected.']);
        }

        // Format phone number to international format (234...)
        // $validated['phone_number'] = $this->formatPhoneNumber($validated['phone_number']);

        Auth::user()->tenants()->create($validated);

        return redirect()->route('tenants.index')
            ->with('success', 'Tenant added successfully!');
    }

    public function edit(Tenant $tenant)
    {
        $properties = Auth::user()->properties()->orderBy('title')->get();

        // Enforce ownership check
        $this->authorizeOwner($tenant);

        return view('tenants.edit', compact('tenant', 'properties'));
    }

    public function update(Request $request, Tenant $tenant)
    {
        $this->authorizeOwner($tenant);

        $validated = $request->validate([
            'property_id'  => ['required', 'exists:properties,id'],
            'name'         => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:20'],
            'email'        => ['nullable', 'email', 'max:255'],
            'unit'         => ['nullable', 'string', 'max:50'],
        ]);

        $tenant->update($validated);

        return to_route('tenants.index');
    }

    public function destroy(Tenant $tenant)
    {
        $this->authorizeOwner($tenant);

        $tenant->delete();

        return to_route('tenants.index');
    }

    // Helper method to ensure strict landlord data isolation
    protected function authorizeOwner(Tenant $tenant): void
    {
        if ($tenant->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Normalizes Nigerian phone numbers to international standard format for WhatsApp integration
     * e.g., "08012345678" -> "2348012345678"
     */
    // protected function formatPhoneNumber(string $phone): string
    // {
    //     $cleaned = preg_replace('/\D/', '', $phone);

    //     if (str_starts_with($cleaned, '0')) {
    //         return '234' . substr($cleaned, 1);
    //     }

    //     return $cleaned;
    // }
}