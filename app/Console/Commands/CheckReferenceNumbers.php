<?php

namespace App\Console\Commands;

use App\Models\DemandLetter;
use App\Models\Invoice;
use Illuminate\Console\Command;

class CheckReferenceNumbers extends Command
{
    protected $signature = 'check:ref-numbers';
    protected $description = 'Check generated reference numbers';

    public function handle()
    {
        // Clear existing records
        DemandLetter::truncate();
        Invoice::truncate();

        // Reset sequences
        \DB::statement('ALTER SEQUENCE demand_letters_ref_seq RESTART WITH 1');
        \DB::statement('ALTER SEQUENCE invoices_ref_seq RESTART WITH 1');

        // Create test records
        for ($i = 1; $i <= 5; $i++) {
            DemandLetter::create(['letter_date' => now()]);
            Invoice::create([
                'invoice_date' => now(),
                'total_amount' => $i * 100.00
            ]);
        }

        // Display results
        $this->info('Demand Letters:');
        DemandLetter::all()->each(fn($letter) => 
            $this->line("ID: {$letter->id}, Reference: {$letter->reference_number}")
        );

        $this->info('\nInvoices:');
        Invoice::all()->each(fn($invoice) => 
            $this->line("ID: {$invoice->id}, Reference: {$invoice->reference_number}")
        );
    }
}
