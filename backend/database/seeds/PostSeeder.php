<?php

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create([
            'title' => "Yoga",
            'description' => "This is good for health and beauty",
            'public_flag' => 1,
            'created_by' => 1,
            'updated_by' => 1
        ]);
    }
}
