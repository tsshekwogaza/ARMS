<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent Receipt</title>
    @vite(['resources/css/app.css'])
    <style>
      @media print {
        body {
            background: white !important;
        }

        .no-print {
            display: none !important;
        }

        .receipt-container {
            box-shadow: none !important;
            border: 1px solid #e2e8f0 !important;
            margin: 0 auto !important;
        }

        @page {
            size: A4;
            margin: 15mm;
        }
      }
    </style>
</head>

<body class="bg-slate-100 min-h-screen p-6">

    <!-- Print / Actions -->
    <div class="no-print max-w-xl mx-auto mb-4 flex justify-end gap-2">
        <button type="button" onclick="window.print()" class="bg-blue-900 hover:bg-slate-800 text-white font-semibold text-sm px-4 py-2 rounded-lg shadow-sm transition">
          🖨️ Print
        </button>
    </div>

    <!-- Receipt -->
    <div class="receipt-container max-w-xl mx-auto bg-white p-6 rounded-2xl border border-slate-200/90 shadow-md space-y-6 relative overflow-hidden">

        <!-- Top Watermark / Brand Header -->
        <div class="flex items-start justify-between border-b border-slate-100 pb-4">
            <div>
                <h3 class="font-extrabold text-slate-900 uppercase text-sm tracking-tight">
                    Rent Receipt
                </h3>

                <p class="text-[10px] text-slate-400 mt-0.5">
                    {{ $receipt->tenant->property->title }}
                </p>

                <p class="text-[10px] text-slate-400">
                    Tel: {{ Auth::user()->phone_number }}
                </p>
            </div>

            <div class="text-right">

                <span class="block bg-emerald-100 text-emerald-800 font-bold text-[10px] px-2 py-0.5 rounded font-mono">
                  {{ $receipt->receipt_number }}
                </span>

                <span class="text-[10px] text-slate-400">
                    Date:
                    <span id="preview-date">{{ \Carbon\Carbon::parse($receipt->payment_date)->format('M d, Y') }}</span>
                </span>

            </div>
        </div>


        <!-- Live Dynamic Content Block -->
        <div class="space-y-4">

            <!-- Tenant -->
            <div>
                <span class="text-[10px] text-slate-400 uppercase tracking-widest font-semibold block">
                    Received From
                </span>

                <p id="preview-tenant" class="text-sm font-bold text-slate-900 mt-0.5">
                  {{ $receipt->tenant->name }}
                </p>
            </div>

            <!-- Property -->
            <div>
                <span class="text-[10px] text-slate-400 uppercase tracking-widest font-semibold block">
                  Property / Unit
                </span>

                <p id="preview-property" class="text-xs font-medium text-slate-700 mt-0.5">
                    {{ $receipt->tenant->property->address }} &mdash; {{ $receipt->tenant->property->unit }}
                </p>
            </div>

            <!-- Tenancy / Payment -->
            <div class="grid grid-cols-2 gap-5 pt-2 border-t border-dashed border-slate-200">

                <div>
                    <span class="text-[10px] text-slate-400 uppercase tracking-widest font-semibold block">
                        Tenancy Period
                    </span>

                    <p id="preview-period" class="text-xs font-semibold text-slate-800 mt-0.5">
                      {{ \Carbon\Carbon::parse($receipt->rent_start_date)->format('M d, Y') }} &mdash; 
                      {{ \Carbon\Carbon::parse($receipt->rent_end_date)->format('M d, Y') }}
                    </p>
                </div>


                <div>
                  <span class="text-[10px] text-slate-400 uppercase tracking-widest font-semibold block">
                    Payment Method
                  </span>

                  <p id="preview-method" class="text-xs font-semibold text-slate-800 mt-0.5">
                    {{ $receipt->payment_method }}
                  </p>
                </div>

            </div>


          <!-- Highlighted Amount Banner -->
          <div class="bg-slate-900 text-white rounded-xl p-4 flex items-center justify-between mt-2">
            <div>
              <span class="text-[10px] text-emerald-400 font-semibold uppercase tracking-wider block">
                Total Paid
              </span>

              <span id="preview-amount" class="text-xl font-extrabold text-white tracking-tight">
                &#8358;{{ number_format($receipt->amount_paid, 2) }}
              </span>
            </div>

            <div class="w-8 h-8 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
              </svg>
            </div>
          </div>
        </div>

        <!-- Footer Signature -->
        <div class="pt-4 border-t border-slate-200 flex items-center justify-between text-[10px] text-slate-400">
          <!-- Status -->
          <div>
            <div class="text-[8px] text-slate-400 uppercase tracking-wider mb-1">
              Status
            </div>

            <span class="text-emerald-600 font-bold text-[9px] flex items-center gap-1">
              <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>Payment Confirmed
            </span>
          </div>

          <!-- Signature -->
          <div class="text-center">
            <img src="{{ Storage::url(Auth::user()->signature_path) }}" alt="Authorized Signature" class="px-3 max-h-5">
            <div class="text-[9px] text-slate-400 mt-1">Authorized Signature</div>
          </div>
        </div>
    </div>

    <script>
        /*
         * Opens the browser's native print preview.
         *
         * The browser will automatically apply the
         * @media print styles defined above.
         */
        function printPreview() {
            window.print();
        }
    </script>

</body>
</html>
