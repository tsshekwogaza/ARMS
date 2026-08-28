<x-layout title="Properties - RentReceipt Abuja">
  
  <!-- Page Header & Main Actions -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
      <h1 class="text-2xl font-bold text-white tracking-tight">Properties & Units</h1>
      <p class="text-slate-500 text-xs sm:text-sm mt-0.5">Manage your real estate portfolio across Abuja, monitor unit occupancy, and adjust rent rates.</p>
    </div>
    <div class="flex items-center gap-3">
      <a href="{{ url('/properties/create') }}" class="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs sm:text-sm py-2.5 px-4 rounded-xl shadow-xs transition-all cursor-pointer">
        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h4m-4 0V11m0 0h4m-4 0H9"/></svg>
        <span>Add Property</span>
      </a>
    </div>
  </div>

  <!-- Portfolio Overview Bar -->
  <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-2xs">
      <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Properties</span>
      <div class="text-2xl font-bold text-slate-900 mt-1">{{ $properties->count() }} Buildings</div>
    </div>
    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-2xs">
      <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Units</span>
      <div class="text-2xl font-bold text-slate-900 mt-1">{{ $properties->count() }} Units</div>
    </div>
    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-2xs">
      <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Units Revenue</span>
      <div class="text-2xl font-extrabold text-slate-900 tracking-tight">₦{{ number_format($properties->sum('rent_rate'), 2) }}</div>
    </div>
  </div>

  <!-- Property Cards Grid -->
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
    <!-- Property Cards -->
    @foreach ($properties as $property)
    <div class="relative rounded-2xl overflow-hidden shadow-lg flex flex-col justify-between min-h-95.5" style="background-image: url('{{ Storage::url($property->image_url) }}'); background-size: cover background-position: center;">
      <!-- Dark Overlay -->
      <div class="absolute inset-0 bg-black/70"></div>
      <!-- Content -->
      <div class="relative z-10 flex flex-col justify-between h-full">
        <div class="p-6 flex items-start justify-between gap-4">
            <div>
              <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] bg-white/20 backdrop-blur text-white mb-2">{{ ucfirst($property->type) }}</span>
              <h3 class="text-xl text-white">{{ $property->title }}</h3>
              <p class="text-sm text-white/80 flex items-center gap-1 mt-1">
                <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>{{ $property->address }}</p>
            </div>
            <button class="p-2 rounded-xl bg-white/20 hover:bg-white/30 text-white backdrop-blur"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10.5L12 3l9 7.5M5 9.5V21h14V9.5M9 21v-6h6v6"/></svg></button>
        </div>

        <div class="p-6 space-y-3">
          <div class="text-xs font-bold uppercase tracking-wider text-white/70">Units Breakdown</div>
          <div class="p-4 rounded-xl bg-white/15 backdrop-blur-md border border-white/20">
            <span class="text-white mr-0">{{ $property->unit }}</span>
            <span class="px-2 py-0.5 rounded-md font-semibold bg-emerald-100 text-emerald-800 ml-2">&#8358;{{ number_format($property->rent_rate) }}/yr</span>
          </div>
        </div>

        <div class="relative z-10 px-6 py-4 bg-black/30 backdrop-blur border-t border-white/10 flex justify-between">
          <form action="{{ route('properties.delete', $property) }}" method="POST">
            @csrf
            @method('DELETE')

            <button type="submit" class="text-white hover:text-red-600 shrink-0">Delete</button>
          </form>
          
          <a href="{{ route('properties.edit', $property) }}" class="text-emerald-300 hover:text-emerald-100 shrink-0">Edit property          
          </a>
        </div>
      </div>
    </div>
    @endforeach

    <!-- Table Pagination Footer -->
    <div class="pagination p-4 text-slate-500">
      {{ $properties->links() }}
    </div>
  </div>
</x-layout>
