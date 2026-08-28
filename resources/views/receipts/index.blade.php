<x-layout title="Receipts - RentReceipt Abuja">  
  <!-- Page Header & Action -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
      <h1 class="text-2xl font-bold text-white tracking-tight">Receipts</h1>
      <p class="text-slate-500 text-xs sm:text-sm mt-0.5">Manage, filter, and track all issued rent receipts and WhatsApp dispatch statuses.</p>
    </div>
    <div class="flex items-center gap-3">
      <a href="{{ url('/receipts/create') }}" class="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs sm:text-sm py-2.5 px-4 rounded-xl shadow-xs transition-all cursor-pointer">
        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
        <span>Issue New Receipt</span>
      </a>
    </div>
  </div>

  <!-- Filter & Search Toolbar -->
  <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-2xs flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4">
    <!-- Status Tabs -->
    <div class="flex items-center gap-1 overflow-x-auto pb-1 md:pb-0 scrollbar-none">
      <button class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-slate-900 text-white transition-colors cursor-pointer whitespace-nowrap">
        All Receipts ({{ $receipts->count() }})
      </button>
      <button class="px-3 py-1.5 rounded-lg text-xs font-semibold text-slate-600 hover:bg-slate-100 transition-colors cursor-pointer whitespace-nowrap">
        Sent ({{ $receipts->count() }})
      </button>
      <button title="Coming Soon" class="px-3 py-1.5 rounded-lg text-xs font-semibold text-slate-600 hover:bg-slate-100 transition-colors cursor-pointer whitespace-nowrap">
        Drafts (0)
      </button>
      <button title="Coming Soon" class="px-3 py-1.5 rounded-lg text-xs font-semibold text-slate-600 hover:bg-slate-100 transition-colors cursor-pointer whitespace-nowrap">
        Failed / Pending (0)
      </button>
    </div>

    <!-- Right Controls: Date Range & Filter Dropdown -->
    <div class="flex items-center gap-2.5 shrink-0">
      <div class="relative flex-1 sm:w-48">
        <input type="date" title="Coming Soon" class="w-full px-3 py-1.5 text-xs bg-slate-50 border border-slate-200 rounded-lg text-slate-600 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500">
      </div>
      <button class="px-3 py-1.5 text-xs font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200/70 rounded-lg transition-colors flex items-center gap-1.5 cursor-pointer" title="Coming Soon">
        <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
        <span>Filter</span>
      </button>
    </div>
  </div>

  <!-- Receipts Table Card -->
  <div class="bg-white rounded-2xl border border-slate-200/80 shadow-2xs overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full text-left border-collapse">
        <thead>
          <tr class="bg-slate-50/50 border-b border-slate-100 text-[10px] font-bold text-slate-400 uppercase tracking-wider">
            <th class="py-3.5 px-6">Receipt Ref</th>
            <th class="py-3.5 px-6">Tenant Info</th>
            <th class="py-3.5 px-6">Property</th>
            <th class="py-3.5 px-6">Period</th>
            <th class="py-3.5 px-6">Amount</th>
            <th class="py-3.5 px-6">Status</th>
            <th class="py-3.5 px-6 text-right">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 text-xs sm:text-sm font-medium">
          <!-- Rows -->
           @forelse($receipts as $receipt)
            <tr class="hover:bg-slate-50/60 transition-colors">
              <td class="py-4 px-6 font-semibold text-slate-900">
                {{ $receipt->receipt_number }}
                <span class="block text-[11px] text-slate-400 font-normal">
                  {{ \Carbon\Carbon::parse($receipt->payment_date)->format('M d, Y') }}
                </span>
              </td>
              <td class="py-4 px-6">
                <div class="text-slate-900 font-semibold">{{ $receipt->tenant->name }}</div>
                <div class="text-[11px] text-slate-400">{{ $receipt->tenant->phone_number }}</div>
              </td>
              <td class="py-4 px-6 text-slate-600">
                {{ $receipt->tenant->property->unit }}
                <span class="block text-[11px] text-slate-400">{{ $receipt->tenant->property->title }}</span>
              </td>
              <td class="py-4 px-6 text-slate-600 text-xs">
                {{ \Carbon\Carbon::parse($receipt->rent_start_date)->format('M d, Y') }} &mdash; 
                {{ \Carbon\Carbon::parse($receipt->rent_end_date)->format('M d, Y') }}
              </td>
              <td class="py-4 px-6 font-semibold text-slate-900">&#8358;{{ number_format($receipt->amount_paid, 2) }}</td>
              <td class="py-4 px-6">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                  <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                  {{ $receipt->status }}
                </span>
              </td>              
              <td class="py-4 px-6 text-right space-x-1">              
                <!-- Re-send WhatsApp button -->
                @php
                  $waMessage = rawurlencode(
                    "Hello {$receipt->tenant->name},\n\n" .
                    "Thank you for your rent payment for *{$receipt->tenant->property->unit}, {$receipt->tenant->property->title}*.\n\n" .
                    "Your official rent receipt *{$receipt->receipt_number}* has been generated and digitally signed.\n\n"
                  );
                  $waLink = "https://wa.me/{$receipt->tenant->phone_number}?text={$waMessage}";
                @endphp 

                <a href="{{ $waLink }}" target="_blank" class="p-1.5 inline-block text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors" title="Send via WhatsApp">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                </a>
                <a href="{{ route('receipts.view_details', $receipt) }}" target="_blank" class="p-1.5 inline-block text-slate-400 hover:text-slate-700 hover:bg-slate-100 rounded-lg transition-colors cursor-pointer" title="View Details">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </a>                    
                <a href="{{ route('pdf.receipt', $receipt) }}" class="p-1.5 inline-block text-slate-400 hover:text-slate-700 hover:bg-slate-100 rounded-lg transition-colors" title="Download PDF">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                </a>
                <a href="" class="p-1.5 inline-block text-red-500 hover:text-red-700 hover:bg-red-400 rounded-lg transition-colors cursor-pointer" title="Delete">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                  </svg>
                </a>  
              </td>
            </tr>
            @empty
              <tr>
                <td colspan="6" class="p-8 text-center text-slate-400">No receipts issued yet.</td>
              </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Pagination Footer -->
    <div class="pagination p-4 border-t border-slate-100 text-slate-500">
      {{ $receipts->links() }}
    </div>

  </div>

</x-layout>