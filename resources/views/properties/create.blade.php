<x-layout>
  @vite(['resources/js/image_preview.js'])

  <div class="space-y-8">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
      <div>
        <h1 class="text-2xl font-bold text-white tracking-tight">Add Property</h1>
        <p class="mt-1 text-sm text-slate-500">Register a new property that you manage.</p>
      </div>

      <a href="{{ route('properties.index') }}" class="flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white font-semibold text-xs sm:text-sm py-2.5 px-4 rounded-xl shadow-xs transition-all cursor-pointer">
        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" /></svg>
        <span>Back to Properties</span>
      </a>
    </div>

    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm">
      <form action="/properties" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="p-8 space-y-6">
          <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">                  
            <div class="grid gap-6 md:grid-cols-2">
              <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Property Title</label>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="Sunrise Apartments" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">

                <x-forms.error name="title" />
              </div>

              <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Address</label>
                <textarea rows="1" name="address" placeholder="House 12, Aminu Kano Crescent, Wuse II" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm resize-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">{{ old('address') }}</textarea>

                <x-forms.error name="address" />
              </div>

              <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">City</label>
                <input type="text" name="city" value="{{ old('city') }}" placeholder="Abuja" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">

                <x-forms.error name="city" />
              </div>

              <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Type</label>
                <input type="text" name="type" value="{{ old('type') }}" placeholder="Residential" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">

                <x-forms.error name="type" />
              </div>

              <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Unit</label>
                <input type="text" name="unit" value="{{ old('unit') }}" placeholder="Flat AA3" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">

                <x-forms.error name="unit" />
              </div>

              <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Rent Rate</label>
                <input type="text" name="rent_rate" value="{{ old('rent_rate') }}" placeholder="₦2,500,000" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">

                <x-forms.error name="rent_rate" />
              </div>
                    
              <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-xs">
                <label class="block text-sm font-medium mb-2">Property Image</label>
                <div onclick="document.getElementById('image-input').click()" 
                  class="relative border-2 border-dashed border-slate-200 rounded-lg min-h-50 flex flex-col items-center justify-center bg-slate-50/50 hover:bg-slate-50 transition cursor-pointer group overflow-hidden">
                  <div id="preview-container" class="absolute inset-0 hidden w-full h-full z-10 bg-white">
                    <img id="image-preview" src="#" alt="Banner preview" class="w-full h-full object-cover">                    
                  </div>
                  <div id="upload-ui" class="flex flex-col items-center justify-center p-8 text-center">
                    <svg class="w-8 h-8 text-slate-400 group-hover:text-indigo-500 transition mb-3" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.183 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.183 0L21.75 16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                    </svg>
                    <p class="text-sm font-medium text-slate-700">Click to upload or drag and drop</p>
                    <p class="text-xs text-slate-400 mt-1">PNG, JPG, or WEBP up to 2MB</p>
                  </div>
                  <input type="file" name="image_url" id="image_url" class="absolute inset-0 opacity-0 cursor-pointer z-20">
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
          
          <button type="submit" class="px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold transition">Save Property
          </button>
        </div>
      </form>
    </div>
  </div>

</x-layout>
