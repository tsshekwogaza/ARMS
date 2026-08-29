<?php

namespace App\Http\Controllers;

use App\Helpers\ReceiptNumberGenerator;
use App\Models\Receipt;
use App\Models\User;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceiptController extends Controller
{
    public function index()
    {
        $receipts = Auth::user()->receipts()->with(['tenant.property'])->latest()->paginate(100);

        return view('receipts.index', compact('receipts'));
    }

    public function create()
    {
        // Load landlord's tenants alongside their linked property
        $tenants = Auth::user()->tenants()->with('property')->get();
        
        // Preview next receipt number
        $nextReceiptNumber = ReceiptNumberGenerator::generate('RCT-ABJ-' . date('Y'));

        return view('receipts.create', compact('tenants', 'nextReceiptNumber'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tenant_id'        => ['required', 'exists:tenants,id'],
            'tenant_name'      => ['required', 'string', 'max:255'],
            'tenant_phone'     => ['required', 'string', 'max:20'],
            'tenant_email'     => ['nullable', 'email', 'max:255'],
            'property_address' => ['required', 'string', 'max:500'],
            'amount_paid'      => ['required', 'numeric', 'min:1'],
            'payment_method'   => ['required', 'string', 'in:Bank Transfer,Cash,Cheque,POS'],
            'rent_start_date'  => ['required', 'date'],
            'rent_end_date'    => ['required', 'date', 'after:start_date'],
            'payment_date'     => ['required', 'date'],
        ]);

        // Verify tenant belongs to this landlord
        $tenant = Auth::user()->tenants()->with('property')->find($validated['tenant_id']);

        if (! $tenant) {
            return back()->withErrors(['tenant_id' => 'Invalid tenant selected.']);
        }

        // Auto-generate official receipt number
        $validated['receipt_number'] = ReceiptNumberGenerator::generate('RCT-ABJ-' . date('Y'));
        $validated['status']         = 'Issued';

        $receipt = Auth::user()->receipts()->create($validated);

        // Optional: Build WhatsApp share URL
        $whatsappUrl = $this->buildWhatsAppUrl($receipt, $tenant);

        // return redirect()->route('receipts.index', compact('whatsappUrl'));

        return redirect()->route('receipts.index')->with([
            'success'      => "Receipt {$receipt->receipt_number} created successfully!",
            'whatsapp_url' => $whatsappUrl,
        ]);
    }

    /**
     * Constructs pre-filled WhatsApp web link with formatted receipt details
     */
    protected function buildWhatsAppUrl(Receipt $receipt, Tenant $tenant): string
    {
        $formattedAmount = number_format($receipt->amount_paid, 2);
        
        // Format phone to international standard (remove leading 0 if needed)
        preg_replace('/^0/', '234', preg_replace('/\D/', '', $receipt->tenant_phone));
        
        $message = rawurlencode(
            "Hello {$tenant->name},\n\n" .
            "Here is your official rent receipt *{$receipt->receipt_number}*.\n\n" .
            "📍 *Property:* {$tenant->property->title} ({$tenant->unit_number})\n" .
            "💰 *Amount Paid:* ₦{$formattedAmount}\n" .
            "💳 *Method:* {$receipt->payment_method}\n" .
            "📅 *Period:* {$receipt->rent_start_date} to {$receipt->rent_end_date}\n\n" .
            "Thank you!"
        );

        return "https://wa.me/{$tenant->phone_number}?text={$message}";
    }

    public function viewDetails(Receipt $receipt)
    {
        if ($receipt->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this receipt.');
        }
        
        $receipt->load([
            'tenant.property'
        ]);

        return view('receipts.view', compact('receipt'));
    }
}
