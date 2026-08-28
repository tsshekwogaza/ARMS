<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class GeneratePdf extends Controller
{    
    /**
     * Generate PDF for a receipt, save to storage, and return download response.
     */
    public function generatePdf(Receipt $receipt)
    {
        // 1. Eager load all required relationships
        $receipt->load(['landlord', 'tenant.property']);

        $landlord = $receipt->landlord;
        $tenant = $receipt->tenant;
        $property = $tenant->property;

        // 2. Convert landlord signature image to Base64 (for DomPDF rendering safety)
        $signatureBase64 = null;
        if ($landlord->signature_path && Storage::exists($landlord->signature_path)) {
            $imagePath = Storage::path($landlord->signature_path);
            $imageData = base64_encode(file_get_contents($imagePath));
            $imageType = pathinfo($imagePath, PATHINFO_EXTENSION);
            $signatureBase64 = 'data:image/' . $imageType . ';base64,' . $imageData;
        }
        
        // 3. Render PDF View
        $pdf = Pdf::loadView('pdf.receipt', [
            'receipt' => $receipt,
            'landlord' => $landlord,
            'tenant' => $tenant,
            'property' => $property,
            'signatureBase64' => $signatureBase64,
        ])->setPaper('a4', 'portrait');

        // 4. Define Storage Path
        $filename = 'receipts/' . $receipt->receipt_number . '.pdf';

        // 5. Save generated PDF file into storage
        Storage::put($filename, $pdf->output());

        // 6. Update receipt record with PDF file path
        $receipt->update([
            'pdf_path' => $filename,
        ]);

        return $pdf->download($receipt->receipt_number . '.pdf');
    }

    /**
     * Download an existing PDF or re-generate if missing.
     */
    public function download(Receipt $receipt)
    {
        if ($receipt->pdf_path && Storage::exists($receipt->pdf_path)) {
            return Storage::download($receipt->pdf_path, $receipt->receipt_number . '.pdf');
        }

        return $this->generatePdf($receipt);
    }
}
