<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // This checks if the email exists; if not, it creates the admin.
        // If it does exist, it updates the password and name.
        Admin::updateOrCreate(
            ['email' => 'admin@birthday.com'],
            [
                'name'     => 'Administrator',
                'password' => Hash::make('Admin@2026'),
            ]
        );

        $this->command->info('Admin account ready: admin@birthday.com');
    }
}
