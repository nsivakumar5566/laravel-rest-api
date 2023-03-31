<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Sivakumar',
            'email' => 'sivakumar.n@synamen.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}
