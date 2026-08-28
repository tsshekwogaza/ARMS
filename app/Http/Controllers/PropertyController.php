<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Auth::user()->properties()->withCount('tenants')->latest()->paginate(50);

        return view('properties.index', compact('properties'));
    }

    public function create()
    {
        return view('properties.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'     => ['required', 'string', 'max:255'],
            'address'   => ['required', 'string', 'max:500'],
            'city'      => ['required', 'string', 'max:100'],
            'type'      => ['required', 'string', 'max:100'], 
            'rent_rate' => ['required', 'string', 'max:100'], 
            'unit'      => ['required', 'string', 'max:100'],
            'image_url' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'], 
        ]);

        if ($request->hasFile('image_url')) {
            $path = $request->file('image_url')->store('properties', 'public');
            
            $validated['image_url'] = $path;
        }

        // Scoped to authenticated user
        Auth::user()->properties()->create($validated);

         return redirect()->route('properties.index');
    }

    public function edit(Property $property)
    {
        // Enforce ownership check
        $this->authorizeOwner($property);

        return view('properties.edit', compact('property'));
    }

    public function update(Request $request, Property $property)
    {
        $this->authorizeOwner($property);

        $validated = $request->validate([
            'title'     => ['required', 'string', 'max:255'],
            'address'   => ['required', 'string', 'max:500'],
            'city'      => ['required', 'string', 'max:100'],
            'type'      => ['nullable', 'string', 'max:100'], 
            'rent_rate' => ['nullable', 'string', 'max:100'], 
            'unit'      => ['nullable', 'string', 'max:100'],
            'image_url' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'], 
        ]);

        if ($request->hasFile('image_url')) {
            if ($property->image_url) {
                // Storage::disk('public')->delete($property->image_url);
                Storage::delete($property->image_url);
            }
                    
            $path = $request->file('image_url')->store('properties', 'public');
            
            $validated['image_url'] = $path;
        }

        $property->update($validated);

        return to_route('properties.index');
    }

    public function destroy(Property $property)
    {
        $this->authorizeOwner($property);

        // if ($property->image_url !== 'properties/home.jpg' && Storage::disk('public')->exists($property->image_url)) {
        //     Storage::disk('public')->delete($property->image_url);
        // }
        if ($property->image_url !== 'properties/home.jpg' && Storage::exists($property->image_url)) {
            Storage::delete($property->image_url);
        }

        $property->delete();

        return to_route('properties.index');
    }

    // Helper method to ensure strict landlord data isolation
    protected function authorizeOwner(Property $property): void
    {
        if ($property->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}
