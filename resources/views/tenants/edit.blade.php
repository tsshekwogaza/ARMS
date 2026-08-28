<x-layout>
  <!-- Page Header -->
  <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
      <h1 class="text-2xl font-bold text-white tracking-tight">Edit Tenant</h1>
      <p class="text-sm text-slate-500 mt-1">
        Update the details of this tenant and re-assign them to one of your properties.
      </p>
    </div>

    <a href="{{ route('tenants.index') }}" class="flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white font-semibold text-xs sm:text-sm py-2.5 px-4 rounded-xl shadow-xs transition-all cursor-pointer">
      <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" /></svg>
      <span>Back to Tenants</span>
    </a>
  </div>

  <!-- Form Card -->
  <div class="bg-white rounded-2xl border border-slate-200 shadow-sm">
    <form action="{{ route('tenants.update', $tenant) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="p-8 space-y-6">
        <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm"> 
          <div class="grid gap-6 md:grid-cols-2"">
            <div>
              <label class="block text-sm font-semibold text-slate-700 mb-2">Property</label>
              <select name="property_id" class="w-full rounded-xl border text-slate-700 border-slate-300 bg-white px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                <option value="">Re-assign Property</option>
                @foreach($properties as $property)
                <option value="{{ $property->id }}">
                    {{ $property->title }}
                    @if($property->address)
                        — {{ $property->unit }}
                    @endif
                </option>
                @endforeach
              </select>

              <x-forms.error name="property_id" />
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Full Name</label>
                <input type="text" name="name" value="{{ old('type', $tenant->name) }}" placeholder="John Doe" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">

                <x-forms.error name="name" />
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Phone Number</label>
                <input type="text" name="phone_number" value="{{ old('type', $tenant->phone_number) }}" placeholder="08031234567" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">

                <x-forms.error name="phone_number" />
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                <input type="email" name="email" value="{{ old('type', $tenant->email) }}" placeholder="tenant@email.com" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">

                <x-forms.error name="email" />
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Unit</label>
                <select name="property_id" class="w-full rounded-xl border text-slate-700 border-slate-300 bg-white px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    <option value="">Re-assign Unit</option>
                    @foreach($properties as $property)
                    <option value="{{ $property->id }}">
                        {{ $property->unit }}                            
                    </option>
                    @endforeach
                </select>

                <x-forms.error name="property_id" />
            </div>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <div class="flex items-center justify-end gap-3 border-t border-slate-200 px-8 py-5 bg-slate-50 rounded-b-2xl">
        <a href="{{ route('tenants.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-300 bg-white hover:bg-slate-100 text-sm font-medium">
          Cancel
        </a>

        <button type="submit" class="px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold transition">
          Save Changes
        </button>
      </div>
    </form>
  </div>
</x-layout>