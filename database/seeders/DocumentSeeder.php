<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Document;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    public function run(): void
    {
        Document::factory()->count(20)->create([
            'created_user_id' => User::factory(),
        ]);
    }
}
