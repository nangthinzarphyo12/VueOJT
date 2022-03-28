<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            PostSeeder::class,
        ]);
        
        factory(User::class, 5)->create()->each(function ($user) {
            (factory(Post::class,2)->create());
        });
    }
}
