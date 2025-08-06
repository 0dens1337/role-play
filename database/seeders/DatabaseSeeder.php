<?php

namespace Database\Seeders;

use App\Models\InviteCode;
use App\Models\Section;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'login' => 'intelligentpunk',
            'email' => 'arinashalkevish@gmail.com',
            'password' => '94Vumana',
            'role' => 3,
        ]);

        InviteCode::factory()->create([
            'code' => 'Rabbitrun',
            'num_of_symbols' => 9,
            'max_uses' => 10,
            'uses' => 0,
            'expires_at' => now()->addDays(10),
        ]);
    }
}
