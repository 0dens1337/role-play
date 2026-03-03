<?php

namespace Database\Seeders;

use App\Models\InviteCode;
use App\Models\Level;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'login' => 'intelligentpunk',
            'email' => 'test@test.com',
            'password' => 'rootroot',
            'role' => 3,
        ]);

        InviteCode::factory()->create([
            'code' => 'Rabbitrun',
            'num_of_symbols' => 9,
            'max_uses' => 10,
            'uses' => 0,
            'expires_at' => now()->addDays(10),
        ]);

        $titles = [
            'Тень',
            'Призрак',
            'Безликий',
            'Уличный лис',
            'Серый ворон',
            'Ловчий эха',
            'Ходящий в тумане',
            'Ночной глаз',
            'Хозяин переулков',
            'Имя в камне',
            'Имя в камне',
        ];

        for ($n = 0; $n <= 50; $n++) {
            $titleIndex = intdiv($n, 5);
            $exp = 10 * $n * $n;

            Level::query()->create([
                'title' => $titles[$titleIndex],
                'required_exp' => $exp,
                'level' => $n,
            ]);
        }
    }
}
