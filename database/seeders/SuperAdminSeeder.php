<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use DB;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = 'admin@urlshortner.com';
        if (User::where('email', $email)->exists()) {
            return;
        }

        User::create([
            'name' => 'Super Admin',
            'company_id' => null,
            'email' => $email,
            'password' => Hash::make('Admin@123456'),
            'email_verified_at' => now(),
        ]);

        $user = User::where('email', $email)->first();
        $user->assignRole('super_admin');
    }
}
