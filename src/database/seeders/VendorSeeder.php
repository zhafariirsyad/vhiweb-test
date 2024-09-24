<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Vendor::create([
                'company_name' => 'Company ' . $i,
                'contact_name' => 'Contact Person ' . $i,
                'email' => 'vendor' . $i . '@example.com',
                'phone_number' => '08123456789' . $i,
                'address' => 'Address ' . $i,
                'service_offered_description' => 'Description of services offered by Company ' . $i,
                'website' => 'https://www.company' . $i . '.com',
                'password' => Hash::make('password123'),
                'agreement' => true,
                'status' => collect(['pending', 'approved', 'rejected', 'under_review', 'suspended', 'inactive'])->random(),
            ]);
        }
    }
}
