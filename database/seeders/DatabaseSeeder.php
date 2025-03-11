<?php

namespace Database\Seeders;

use App\Models\CallJournal;
use App\Models\Message;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
        ]);

        CallJournal::factory()->count(10)->create();
        Message::factory()->count(4)->create();

    }
}
