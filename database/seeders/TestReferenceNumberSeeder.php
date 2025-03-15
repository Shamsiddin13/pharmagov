<?php

namespace Database\Seeders;

use App\Models\DemandLetter;
use App\Models\Invoice;
use Illuminate\Database\Seeder;

class TestReferenceNumberSeeder extends Seeder
{
    public function run(): void
    {
        // Create some demand letters
        for ($i = 1; $i <= 3; $i++) {
            DemandLetter::create([
                'letter_date' => now()
            ]);
        }

        // Create some invoices
        for ($i = 1; $i <= 3; $i++) {
            Invoice::create([
                'invoice_date' => now(),
                'total_amount' => $i * 100.00
            ]);
        }
    }
}
