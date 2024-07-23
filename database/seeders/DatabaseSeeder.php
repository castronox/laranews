<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Article;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        User::factory(50)->create(); // Crea 50 usuarios
        Article::factory(200)->create(); // Crea 200 Articulos de periódico.
    }
}
