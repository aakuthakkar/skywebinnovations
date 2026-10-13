<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $email = env('ADMIN_EMAIL', 'admin@skywebinnovations.com');
        $password = env('ADMIN_PASSWORD');

        // Never ship a hardcoded credential. If no password is configured,
        // generate a random one and show it once — the operator sets a real
        // password on first login.
        if (empty($password)) {
            $password = \Illuminate\Support\Str::random(16);
            $generated = true;
        }

        $user = User::where('email', $email)->first();

        if ($user) {
            $user->update([
                'name' => 'Admin',
                'password' => Hash::make($password),
                'email_verified_at' => now(),
            ]);
        } else {
            User::create([
                'name' => 'Admin',
                'email' => $email,
                'password' => Hash::make($password),
                'email_verified_at' => now(),
            ]);
        }

        if (! empty($generated)) {
            $this->command?->warn("No ADMIN_PASSWORD set in .env — generated a temporary password for {$email}:");
            $this->command?->warn("  {$password}");
            $this->command?->warn('Log in and change it immediately.');
        } else {
            $this->command?->info("Admin user ready for {$email}.");
        }
    }
}
