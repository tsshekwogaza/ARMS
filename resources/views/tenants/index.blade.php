<x-layout title="Tenants - RentReceipt Abuja">
    
  <!-- Page Header & Action -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
      <h1 class="text-2xl font-bold text-white tracking-tight">Tenants</h1>
      <p class="text-slate-500 text-xs sm:text-sm mt-0.5">Manage occupant details, track active lease status, and send instant WhatsApp receipts.</p>
    </div>
    <div class="flex items-center gap-3">
      <a href="{{ url('/tenants/create') }}" class="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs sm:text-sm py-2.5 px-4 rounded-xl shadow-xs transition-all cursor-pointer">
        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
        <span>Add New Tenant</span>
      </a>
    </div>
  </div>

  <!-- Filter & Search Bar -->
  <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-2xs flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4">
    <!-- Search Box -->
    <div class="relative flex-1 max-w-md">
      <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
      <input type="text" placeholder="Search Coming Soon" class="w-full pl-10 pr-4 py-2 text-xs sm:text-sm bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all">
    </div>

    <!-- Status Tabs -->
    <div class="flex items-center gap-1 overflow-x-auto pb-1 md:pb-0 scrollbar-none">
      <button class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-slate-900 text-white transition-colors cursor-pointer whitespace-nowrap">
        All Tenants ({{ $tenants->count() }})
      </button>
      <button class="px-3 py-1.5 rounded-lg text-xs font-semibold text-slate-600 hover:bg-slate-100 transition-colors cursor-pointer whitespace-nowrap">
        Active ({{ $tenants->count() }})
      </button>
      <button title="Coming Soon" class="px-3 py-1.5 rounded-lg text-xs font-semibold text-slate-600 hover:bg-slate-100 transition-colors cursor-pointer whitespace-nowrap">
        Upcoming Renewal (0)
      </button>
      <button title="Coming Soon" class="px-3 py-1.5 rounded-lg text-xs font-semibold text-slate-600 hover:bg-slate-100 transition-colors cursor-pointer whitespace-nowrap">
        Expired (0)
      </button>
    </div>

  </div>

  <!-- Tenants Table Card -->
  <div class="bg-white rounded-2xl border border-slate-200/80 shadow-2xs overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full text-left border-collapse">
        <thead>
          <tr class="bg-slate-50/50 border-b border-slate-100 text-[10px] font-bold text-slate-400 uppercase tracking-wider">
            <th class="py-3.5 px-6">Tenant Name</th>
            <th class="py-3.5 px-6">WhatsApp Contact</th>
            <th class="py-3.5 px-6">Assigned Unit</th>
            <th class="py-3.5 px-6">Current Rent</th>
            <th class="py-3.5 px-6">Lease Type</th>
            <th class="py-3.5 px-6">Status</th>
            <th class="py-3.5 px-6 text-right">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 text-xs sm:text-sm font-medium">
          <!-- Tenants -->
          @forelse ($tenants as $tenant)         
          <tr class="hover:bg-slate-50/60 transition-colors">
            <td class="py-4 px-6">
              <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-blue-100 text-blue-800 font-bold flex items-center justify-center text-xs shrink-0">
                  <p>{{ Str::substr($tenant->name, 0, 1) . Str::substr(Str::after($tenant->name, ' '), 0, 1) }}</p>
                </div>
                <div>
                  <div class="text-slate-900 font-semibold">{{ $tenant->name }}</div>
                  <div class="text-[11px] text-slate-400 font-normal">Added {{ $tenant->created_at->format('M d Y') }}</div>
                </div>
              </div>
            </td>
            <td class="py-4 px-6 text-slate-700">
              <span class="inline-flex items-center gap-1 font-mono text-xs">
                <svg class="w-3.5 h-3.5 text-emerald-600" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                {{ $tenant->phone_number }}
              </span>
            </td>
            <td class="py-4 px-6 text-slate-600">
              {{ $tenant->property->unit }}
              <span class="block text-[11px] text-slate-400">{{ $tenant->property->title }}</span>
            </td>
            <td class="py-4 px-6 font-semibold text-slate-900">&#8358;{{ number_format($tenant->property->rent_rate) }} /yr</td>
            <td class="py-4 px-6 text-slate-600 text-xs">{{ $tenant->property->type }}</td>
            <td class="py-4 px-6">
              <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                Active
              </span>
            </td>
                           
            <form action="{{ route('tenants.delete', $tenant) }}" id="delete-tenant" method="POST">
              @csrf
              @method('DELETE')
            </form>

            <td class="py-4 px-6 text-right space-x-1">    
              <a href="{{ url('/receipts/create') }}" class="p-1.5 inline-block text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors cursor-pointer" title="Issue Receipt">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
              </a>
              <a href="{{ route('tenants.edit', $tenant) }}" class="p-1.5 inline-block text-slate-400 hover:text-slate-700 hover:bg-slate-100 rounded-lg transition-colors cursor-pointer" title="Edit Tenant">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
              </a>
              <button type="submit" form="delete-tenant" class="p-1.5 inline-block text-red-400 hover:text-red-700 hover:bg-red-100 rounded-lg transition-colors cursor-pointer" title="Delete">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>
              </button>             
            </td>
          </tr>
          @empty
            <tr>
              <td colspan="6" class="p-8 text-center text-slate-400">No tenants added yet.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Table Pagination Footer -->
    <div class="pagination p-4 border-t border-slate-100 text-slate-500">
      {{ $tenants->links() }}
    </div>

  </div>

</x-layout>