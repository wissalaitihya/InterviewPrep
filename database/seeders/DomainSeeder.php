<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Domain;
use App\Models\User;

class DomainSeeder extends Seeder
{
    
    public function run(): void
    {
     $user = User::first();

        Domain::create(['user_id' => $user->id, 'name' => 'Laravel',  'color' => '#FF2D20']);
        Domain::create(['user_id' => $user->id, 'name' => 'PHP OOP',  'color' => '#7C3AED']);
        Domain::create(['user_id' => $user->id, 'name' => 'MySQL',    'color' => '#0EA5E9']);
        Domain::create(['user_id' => $user->id, 'name' => 'API REST', 'color' => '#10B981']);
    }
}
