<x-layout>
  @vite(['resources/js/apexchats.js'])

  <!-- Dashboard Top Banner -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
      <h1 class="text-2xl font-bold text-white tracking-tight">{{ $greeting }}, {{ $user->first_name }}!</h1>
      <p class="text-slate-500 text-xs sm:text-sm mt-0.5">Overview of property collections and issued receipts.</p>
    </div>

      <!-- Right: Search Bar -->
    <div class="flex items-center gap-2">
      <div class="relative w-full">
        <svg class="w-4 h-4 text-slate-900 absolute left-3.5 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        <input type="text" placeholder="Search Coming Soon..." class="w-full pl-9 pr-4 py-2 text-xs sm:text-sm bg-slate-100/90 border border-slate-200/60 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-900/30 focus:bg-white focus:border-slate-900 transition-all placeholder:text-slate-400">
      </div>
    </div>
  </div>

  <!-- Metric Cards -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-6">
    <!-- Total Rent Revenue -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-2xs">
      <div class="flex items-center justify-between mb-4">
        <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Rent Revenue</span>
        <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
      </div>
      <div class="text-2xl font-extrabold text-slate-900 tracking-tight">₦{{ number_format($totalCollected, 2) }}</div>
      <div class="mt-3 flex items-center text-xs text-emerald-600 font-medium">
        <span>↑ 99.9% Cleared rent payments</span>
      </div>
    </div>

    <!-- Receipts Dispatched -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-2xs">
      <div class="flex items-center justify-between mb-4">
        <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Receipts Issued</span>
        <div class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        </div>
      </div>
      <div class="text-2xl font-extrabold text-slate-900 tracking-tight">{{ $receiptsDispatched }} Generated</div>
      <div class="mt-3 text-xs text-slate-400 font-medium">
        Available for PDF & WhatsApp dispatch
      </div>
    </div>

    <!-- Active Tenants vs Capacity -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-2xs sm:col-span-2 lg:col-span-1">
      <div class="flex items-center justify-between mb-4">
        <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Tenants / Total Units</span>
        <div class="w-8 h-8 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h5m-5 0V11m0 5h5"/></svg>
        </div>
      </div>
      <div class="text-2xl font-extrabold text-slate-900 tracking-tight">{{ $totalTenants }} Tenants / {{ $totalUnits }} Units</div>
      <div class="mt-3 text-xs text-slate-400 font-medium">
        Across registered properties
      </div>
    </div>
  </div>

  <!-- Apexchart Revenue Trend Chart -->
  <div class="bg-blue-900 p-6 rounded-2xl border border-slate-200/80 shadow-2xs mb-6">
    <div class="flex items-center justify-between mb-2">
      <div>
        <h3 class="text-base font-bold text-white">Revenue Collections Overview</h3>
        <p class="text-xs text-slate-400">Monthly breakdown of rent payments for {{ date('Y') }}</p>
      </div>
      <span class="text-xs font-semibold text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-2.5 py-1 rounded-full">
        Live
      </span>
    </div>
    <div id="revenueChart" class="w-full min-h-70"></div>
  </div>

  <!-- Recent Receipts Table -->
  <div class="bg-white rounded-2xl border border-slate-200/80 shadow-2xs overflow-hidden">
    <div class="p-5 border-b border-slate-100 flex items-center justify-between">
      <div>
        <h3 class="text-base font-bold text-slate-900">Recent Receipts</h3>
      </div>
      <a href="{{ route('receipts.index') }}" class="px-3 py-1.5 text-xs font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200/70 rounded-lg transition-colors cursor-pointer">
        View All
      </a>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-left border-collapse">
        <thead>
          <tr class="bg-slate-50/50 border-b border-slate-100 text-[10px] font-bold text-slate-400 uppercase tracking-wider">
            <th class="py-3 px-6">Receipt Ref</th>
            <th class="py-3 px-6">Tenant Info</th>
            <th class="py-3 px-6">Property</th>
            <th class="py-3 px-6">Amount Paid</th>
            <th class="py-3 px-6">Payment Date</th>
            <th class="py-3 px-6 text-right">Payment Method</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 text-xs sm:text-sm font-medium">
          @forelse($recentReceipts as $receipt)
            <tr class="hover:bg-slate-50/60 transition-colors">
              <td class="py-4 px-6 font-semibold text-slate-900">{{ $receipt->receipt_number }}</td>
              <td class="py-4 px-6">
                <div class="text-slate-900 font-semibold">{{ $receipt->tenant->name ?? 'N/A' }}</div>
                <div class="text-[11px] text-slate-400">{{ $receipt->tenant->phone_number ?? '—' }}</div>
              </td>
              <td class="py-4 px-6 text-slate-600">
                {{ $receipt->tenant->property->title ?? 'Unassigned' }} 
              </td>
              <td class="py-4 px-6 font-semibold text-slate-900">₦{{ number_format($receipt->amount_paid, 2) }}</td>
              <td class="py-4 px-6 text-slate-500">
                {{ \Carbon\Carbon::parse($receipt->payment_date)->format('M d, Y') }}
              </td>
              <td class="py-4 px-6 text-right space-x-1">   
                {{ $receipt->payment_method }}         
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="py-8 text-center text-slate-400 text-xs">
                No receipts generated yet.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- ApexCharts Script -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const options = {
        series: [{
          name: 'Rent Collected (₦)',
          data: @json($chartData)
        }],
        chart: {
          type: 'area',
          height: 290,
          toolbar: { show: false },
          animations: { enabled: true, easing: 'easeinout', speed: 800 }
        },
        colors: ['#10b981'],
        fill: {
          type: 'gradient',
          gradient: { shadeIntensity: 1, opacityFrom: 0.4, opacityTo: 0.05, stops: [0, 90, 100] }
        },
        dataLabels: { enabled: false },
        stroke: { curve: 'smooth', width: 2.5 },
        xaxis: {
          categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
          axisBorder: { show: false },
          axisTicks: { show: false },
          labels: { style: { colors: '#94a3b8', fontSize: '12px' } }
        },
        yaxis: {
          labels: {
            style: { colors: '#94a3b8', fontSize: '12px' },
            formatter: (val) => "₦" + val.toLocaleString()
          }
        },
        grid: { borderColor: '#f1f5f9', strokeDashArray: 4 },
        tooltip: {
          y: { formatter: (val) => "₦" + val.toLocaleString() }
        }
      };

      const chart = new ApexCharts(document.querySelector("#revenueChart"), options);
      chart.render();
    });
  </script>
</x-layout>