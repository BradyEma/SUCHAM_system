<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Faq::insert([
            ['question' => 'How do I track my order?', 'answer' => 'Go to your dashboard > Orders > Track'],
            ['question' => 'How can I become a supplier?', 'answer' => 'Register and complete the supplier verification.'],
            ['question' => 'How do I reset my password?', 'answer' => 'Click "Forgot Password" on the login screen.'],
        ]);

    }
}
