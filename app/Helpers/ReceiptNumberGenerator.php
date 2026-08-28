<?php

namespace App\Helpers;

use App\Models\Receipt;

class ReceiptNumberGenerator
{
    /**
     * Generate a unique, sequential receipt number for a landlord/workspace. Example output: RCT-ABJ-2026-001
     */
    public static function generate(string $prefix = 'RCT-ABJ'): string
    {
        $latestReceipt = Receipt::where('receipt_number', 'LIKE', "{$prefix}-%")
            ->latest('id')
            ->first();

        if (! $latestReceipt) {
            $number = 1;
        } else {
            $lastNumber = (int) substr($latestReceipt->receipt_number, strrpos($latestReceipt->receipt_number, '-') + 1);
            $number = $lastNumber + 1;
        }

        return sprintf('%s-%03d', $prefix, $number);
    }
}
