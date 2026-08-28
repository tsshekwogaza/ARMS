<x-layout title="Issue Rent Receipt">

    <!-- Header / Breadcrumb -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
      <div>
        <h1 class="text-2xl font-bold text-white tracking-tight">Issue New Receipt</h1>
        <p class="text-slate-500 text-xs sm:text-sm mt-0.5">Generate a digital receipt and dispatch a WhatsApp copy to the tenant.</p>
      </div>

      <div class="flex items-center gap-3">
        <button type="button" class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-700 hover:bg-slate-50 font-semibold text-xs sm:text-sm transition-all cursor-pointer">
          Save Draft
        </button>
        <button form="receipt-form" type="submit" class="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs sm:text-sm py-2.5 px-5 rounded-xl shadow-xs transition-all cursor-pointer">
          <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
            <span>Generate</span>
        </button>
      </div>
    </div>

    <!-- Main Grid: Form Left (3 cols), Preview Right (2 cols) -->
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 items-start">

      <!-- FORM SECTION (3 Columns) -->
      <form action="/receipts" method="POST" id="receipt-form" class="lg:col-span-3 space-y-6">
        @csrf
        <!-- 1. Tenant Details Card -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-2xs space-y-4">
          <div class="flex items-center justify-between border-b border-slate-100 pb-3">
            <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider flex items-center gap-2">
              <span class="w-6 h-6 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-xs">1</span>
              Tenant Information
            </h2>
            <!-- Select Tenant -->
              <div class="mb-3">
                <select id="tenant_id" name="tenant_id" required class="w-full px-3.5 py-2 text-xs sm:text-sm bg-slate-50 border border-slate-200 rounded-xl text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all cursor-pointer">
                  <option value="">Select Existing Tenant...</option>
                  @foreach($tenants as $tenant)
                    <option value="{{ $tenant->id }}">
                      {{ $tenant->name }}
                    </option>
                  @endforeach
                </select>
              </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- Full Name -->
            <div class="sm:col-span-2 space-y-1.5">
              <label for="tenant_name" class="block text-xs font-semibold text-slate-700">Full Name <span class="text-emerald-600">*</span></label>
              <input type="text" name="tenant_name" id="tenant_name" value="{{ old('tenant_name') }}" placeholder="e.g. Chidi Okonkwo" required class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:bg-white focus:border-emerald-500 transition-all placeholder:text-slate-400">
                                    
              <x-forms.error name="tenant_name" />
            </div>

            <!-- Phone Number (WhatsApp) -->
            <div class="space-y-1.5">
              <label for="tenant_phone" class="block text-xs font-semibold text-slate-700">WhatsApp Phone Number <span class="text-emerald-600">*</span></label>
              <div class="relative">
                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-xs text-slate-400 font-semibold">+234</span>
                <input type="tel" name="tenant_phone" id="tenant_phone" value="{{ old('tenant_phone') }}" placeholder="803 123 4567" required class="w-full pl-14 pr-3.5 py-2.5 text-xs sm:text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:bg-white focus:border-emerald-500 transition-all placeholder:text-slate-400">
              </div>
            </div>

            <!-- Email (Optional) -->
            <div class="space-y-1.5">
              <label for="tenant_email" class="block text-xs font-semibold text-slate-700">Email Address <span class="text-slate-400 font-normal">(Optional)</span></label>
              <input type="email" name="tenant_email" id="tenant_email" value="{{ old('tenant_email') }}" placeholder="chidi@example.com" class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:bg-white focus:border-emerald-500 transition-all placeholder:text-slate-400">
            </div>
          </div>
        </div>

        <!-- 2. Property & Payment Details -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-2xs space-y-4">
          <div class="flex items-center justify-between border-b border-slate-100 pb-3">
            <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider flex items-center gap-2">
              <span class="w-6 h-6 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-xs">2</span>
              Property & Payment
            </h2>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            
            <!-- Property / Unit -->
            <div class="sm:col-span-2 space-y-1.5">
              <label for="property_address" class="block text-xs font-semibold text-slate-700">Property Address<span class="text-emerald-600">*</span></label>
              <input type="text" name="property_address" id="property_address" value="{{ old('property_address') }}" placeholder="e.g. Flat 3B, Block C, Gwarinpa Estate, Abuja" required class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:bg-white focus:border-emerald-500 transition-all placeholder:text-slate-400">
            </div>

            <!-- Amount Paid (Naira) -->
            <div class="space-y-1.5">
              <label for="amount_paid" class="block text-xs font-semibold text-slate-700">Amount Paid (₦) <span class="text-emerald-600">*</span></label>
              <div class="relative">
                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-sm font-bold text-slate-500">₦</span>
                <input type="number" name="amount_paid" id="amount_paid" placeholder="2,500,000" required class="w-full pl-8 pr-3.5 py-2.5 text-xs sm:text-sm font-bold text-slate-900 bg-slate-50/50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:bg-white focus:border-emerald-500 transition-all placeholder:font-normal placeholder:text-slate-400">
              </div>
            </div>

            <!-- Payment Method -->
            <div class="space-y-1.5">
              <label for="payment_method" class="block text-xs font-semibold text-slate-700">Payment Method <span class="text-emerald-600">*</span></label>
              <select id="payment_method" name="payment_method" required class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:bg-white focus:border-emerald-500 transition-all text-slate-800">
                <option value="Bank Transfer">Bank Transfer</option>
                <option value="Cash">Cash</option>
                <option value="Cheque">Cheque</option>
                <option value="POS">POS Transfer</option>
              </select>
            </div>

          </div>
        </div>

        <!-- 3. Rent Period & Dates -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-2xs space-y-4">
          <div class="flex items-center justify-between border-b border-slate-100 pb-3">
            <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider flex items-center gap-2">
              <span class="w-6 h-6 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-xs">3</span>
              Tenancy Duration
            </h2>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- Start Date -->
            <div class="space-y-1.5">
              <label for="rent_start_date" class="block text-xs font-semibold text-slate-700">Start Date <span class="text-emerald-600">*</span></label>
              <input type="date" name="rent_start_date" id="rent_start_date" required class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:bg-white focus:border-emerald-500 transition-all text-slate-800">
            </div>

            <!-- Expiry Date -->
            <div class="space-y-1.5">
              <label for="rent_end_date" class="block text-xs font-semibold text-slate-700">Expiry Date <span class="text-emerald-600">*</span></label>
              <input type="date" name="rent_end_date" id="rent_end_date" required class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:bg-white focus:border-emerald-500 transition-all text-slate-800">
            </div>

            <!-- Payment Date -->
            <div class="sm:col-span-2 space-y-1.5">
              <label for="payment_date" class="block text-xs font-semibold text-slate-700">Date Payment Received <span class="text-emerald-600">*</span></label>
              <input type="date" name="payment_date" id="payment_date" required class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:bg-white focus:border-emerald-500 transition-all text-slate-800">
            </div>
          </div>
        </div>
      </form>

      <!-- LIVE PREVIEW CARD (2 Columns Sticky)       -->
      <div class="lg:col-span-2 lg:sticky lg:top-8 space-y-4">
        <div class="flex items-center justify-between">
          <div class="bg-slate-900 rounded-t-2xl flex items-center justify-between text-xs text-slate-300 font-medium">
            <span class="flex items-center gap-1.5">
              <span class="w-2 h-2 rounded-full bg-emerald-300 animate-pulse"></span>
              Live Preview
            </span>
          </div>       
        </div>

        <!-- Simulated Document Card -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200/90 shadow-md space-y-6 relative overflow-hidden">
          
          <!-- Top Watermark / Brand Header -->
          <div class="flex items-start justify-between border-b border-slate-100 pb-4">
            <div>
              <h3 class="font-extrabold text-slate-900 uppercase text-sm tracking-tight">Rent Receipt</h3>
              <p class="text-[10px] text-slate-400 mt-0.5">Landlord: {{ Auth::user()->name }}</p>
              <p class="text-[10px] text-slate-400">Tel: {{ Auth::user()->phone_number }}</p>
            </div>
            <div class="text-right">
              <span class="block bg-emerald-100 text-emerald-800 font-bold text-[10px] px-2 py-0.5 rounded font-mono">{{ $nextReceiptNumber }}</span>
              <span class="text-[10px] text-slate-400">Date: <span id="preview-date">30 Jan, 2069</span></span>
            </div>
          </div>

          <!-- Live Dynamic Content Block -->
          <div class="space-y-4">
            
            <div>
              <span class="text-[10px] text-slate-400 uppercase tracking-widest font-semibold block">Received From</span>
              <p id="preview-tenant" class="text-sm font-bold text-slate-900 mt-0.5">Chidi Okonkwo</p>
            </div>

            <div>
              <span class="text-[10px] text-slate-400 uppercase tracking-widest font-semibold block">Property Address / Unit</span>
              <p id="preview-property" class="text-xs font-medium text-slate-700 mt-0.5">Flat 3B, Block C, Gwarinpa Estate, Abuja</p>
            </div>

            <div class="grid grid-cols-2 gap-5 pt-2 border-t border-dashed border-slate-200">
              <div>
                <span class="text-[10px] text-slate-400 uppercase tracking-widest font-semibold block">Tenancy Period</span>
                <p id="preview-period" class="text-xs font-semibold text-slate-800 mt-0.5">Aug 01, 2027 — Aug 01, 2028</p>
              </div>
              <div>
                <span class="text-[10px] text-slate-400 uppercase tracking-widest font-semibold block">Payment Method</span>
                <p id="preview-method" class="text-xs font-semibold text-slate-800 mt-0.5">Bank Transfer</p>
              </div>
            </div>

            <!-- Highlighted Amount Banner -->
            <div class="bg-slate-900 text-white rounded-xl p-4 flex items-center justify-between mt-2">
              <div>
                <span class="text-[10px] text-emerald-400 font-semibold uppercase tracking-wider block">Total Paid</span>
                <span id="preview-amount" class="text-xl font-extrabold text-white tracking-tight">₦2,500,000</span>
              </div>
              <div class="w-8 h-8 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
              </div>
            </div>

          </div>

          <!-- Footer Signature Placeholder -->
          <div class="pt-4 border-t border-slate-200 flex items-center justify-between text-[10px] text-slate-400">
            <div>
              <div class="text-[8px] text-slate-400 uppercase tracking-wider mb-1">Status</div>
              <span class="text-emerald-600 font-bold text-[9px] flex items-center gap-1">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                Payment Confirmed
              </span>
            </div>

            <div class="text-center">
              <!-- Signature -->
              <img src="{{ Storage::url(Auth::user()->signature_path) }}" class="px-3 max-h-5">
              <div class="text-[9px] text-slate-400 mt-1">Authorized Signature</div>
            </div>
          </div>
        </div>

        <!-- WhatsApp Delivery Note -->
        <div class="bg-emerald-50/70 border border-emerald-200/60 rounded-xl p-3.5 flex items-start gap-3">
          <svg class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
          <div class="text-xs text-emerald-900">
            <span class="font-bold">Automated WhatsApp Delivery:</span> Submitting this form will generate the PDF link and immediately prompt WhatsApp redirection.
          </div>
        </div>
      </div>
    </div>

  <!-- Minimal Live-Sync Script -->
<script>

document.addEventListener('DOMContentLoaded', () => {

    // All tenants from Laravel
    const tenants = @json($tenants);

    // FORM FIELDS
    const tenantSelect = document.getElementById('tenant_id');

    const tenantInput = document.getElementById('tenant_name');
    const phoneInput = document.getElementById('tenant_phone');
    const emailInput = document.getElementById('tenant_email');
    const propertyInput = document.getElementById('property_address');

    const amountInput = document.getElementById('amount_paid');
    const methodInput = document.getElementById('payment_method');
    const startInput = document.getElementById('rent_start_date');
    const endInput = document.getElementById('rent_end_date');
    const paymentDateInput = document.getElementById('payment_date');

    // PREVIEW
    const previewTenant = document.getElementById('preview-tenant');
    const previewProperty = document.getElementById('preview-property');
    const previewAmount = document.getElementById('preview-amount');
    const previewMethod = document.getElementById('preview-method');
    const previewPeriod = document.getElementById('preview-period');
    const previewDate = document.getElementById('preview-date');

    // Helpers
    function updatePreview() {

        previewTenant.textContent =
            tenantInput.value || "Chidi Okonkwo";

        previewProperty.textContent =
            propertyInput.value || "Flat 3B, Block C, Gwarinpa Estate, Abuja";

        if (amountInput.value) {

            previewAmount.textContent =
                "₦" + Number(amountInput.value).toLocaleString('en-NG');

        } else {

            previewAmount.textContent = "₦2,500,000";

        }

        previewMethod.textContent =
            methodInput.value || "Bank Transfer";

        if (startInput.value && endInput.value) {

            previewPeriod.textContent =
                `${startInput.value} — ${endInput.value}`;

        } else {

            previewPeriod.textContent =
                "Aug 01, 2027 — Aug 01, 2028";

        }

        if (paymentDateInput.value) {

            previewDate.textContent = paymentDateInput.value;

        }
    }

    // TENANT SELECT
    tenantSelect.addEventListener('change', function () {

        const tenant = tenants.find(t => t.id == this.value);

        if (!tenant) {

            tenantInput.value = "";
            phoneInput.value = "";
            emailInput.value = "";
            propertyInput.value = "";

            updatePreview();

            return;
        }

        tenantInput.value = tenant.name ?? "";
        phoneInput.value = tenant.phone_number ?? "";
        emailInput.value = tenant.email ?? "";
        propertyInput.value = tenant.property?.address ?? "";

        updatePreview();

    });

    // LIVE UPDATE
    tenantInput.addEventListener('input', updatePreview);

    propertyInput.addEventListener('input', updatePreview);

    amountInput.addEventListener('input', updatePreview);

    methodInput.addEventListener('change', updatePreview);

    startInput.addEventListener('change', updatePreview);

    endInput.addEventListener('change', updatePreview);

    paymentDateInput.addEventListener('change', updatePreview);

    updatePreview();

});

</script>
</x-layout>