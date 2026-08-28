<x-layout>

<div class="space-y-8">
  <!-- Header -->
  <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
    <div>
      <h1 class="text-2xl font-bold text-white tracking-tight">Edit Property</h1>
      <p class="mt-1 text-sm text-slate-500">Update the details of this property.</p>
    </div>

    <a href="{{ route('properties.index') }}" class="flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white font-semibold text-xs sm:text-sm py-2.5 px-4 rounded-xl shadow-xs transition-all cursor-pointer">
      <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" /></svg>
      <span>Back to Properties</span>
    </a>
  </div>

  <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
    <form action="{{ route('properties.update', $property) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="p-8 space-y-6">
        <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">                  
          <div class="grid gap-6 md:grid-cols-2">
            <div>
              <label class="block text-sm font-semibold text-slate-700 mb-2">Property Title</label>
              <input type="text" name="title" value="{{ old('title', $property->title) }}" placeholder="Sunrise Apartments" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">

              <x-forms.error name="title" />
            </div>

            <div>
              <label class="block text-sm font-semibold text-slate-700 mb-2">Address</label>
              <textarea rows="1" name="address" placeholder="House 12, Aminu Kano Crescent, Wuse II" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm resize-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">{{ old('address', $property->address) }}</textarea>

              <x-forms.error name="address" />
            </div>

            <div>
              <label class="block text-sm font-semibold text-slate-700 mb-2">City</label>
              <input type="text" name="city" value="{{ old('city', $property->city) }}" placeholder="Abuja" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">

              <x-forms.error name="city" />
            </div>

            <div>
              <label class="block text-sm font-semibold text-slate-700 mb-2">Type</label>
              <input type="text" name="type" value="{{ old('type', $property->type) }}" placeholder="Residential" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">

              <x-forms.error name="type" />
            </div>

            <div>
              <label class="block text-sm font-semibold text-slate-700 mb-2">Unit</label>
              <input type="text" name="unit" value="{{ old('unit', $property->unit) }}" placeholder="Flat AA3" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">

              <x-forms.error name="unit" />
            </div>

            <div>
              <label class="block text-sm font-semibold text-slate-700 mb-2">Rent Rate</label>
              <input type="text" name="rent_rate" value="{{ old('rent_rate', $property->rent_rate) }}" placeholder="₦2,500,000" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">

              <x-forms.error name="rent_rate" />
            </div>
  
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-xs">
              <h2 class="mb-2 block text-sm font-medium">Property Image</h2>
              <div class="group relative flex flex-col items-center justify-center rounded-lg border-2 border-dashed border-slate-300 p-6 text-center hover:border-slate-400 transition-colors bg-slate-50/50">
                <div class="relative mb-4 h-40 w-full overflow-hidden rounded-md bg-slate-100 border border-slate-200">
                  <img src="{{ Storage::url($property->image_url) }}" alt="Current image" class="h-full w-full object-cover">
                  <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity">
                    <span class="text-xs font-medium text-white rounded-sm">
                      <input type="file" name="image_url" value="{{ $property->image_url }}" class="p-16">
                    </span>
                  </div>
                </div>
                <div class="flex text-sm text-slate-600">
                  <p class="pl-1">Click  to upload or drag and drop</p>
                </div>
                <p class="text-xs text-slate-500 mt-1">PNG, JPG, WEBP up to 5MB</p>
              </div>
              <x-forms.error name="image_url" />
            </div>

          </div>
        </div>               
      </div>

      <!-- Footer -->
      <div class="flex justify-end gap-3 px-8 py-5 bg-slate-50 border-t border-slate-200 rounded-b-2xl">               
        <a href="{{ route('properties.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-300 bg-white hover:bg-slate-100 text-sm font-medium">Cancel
        </a>

        <button type="submit" class="px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold transition">Save Changes
        </button>
      </div>

    </form>
  </div>

</div>
</x-layout>