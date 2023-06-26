<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Post::factory(2)->create();

        // User::truncate();
        // Post::truncate();
        // Category::truncate();
        // //\App\Models\User::factory(10)->create();

        // $user = User::factory()->create();

        // $personal = Category::create([
        //     'name' => 'Personal',
        //     'slug' => 'personal',
        // ]);

        // $family = Category::create([
        //     'name' => 'Family',
        //     'slug' => 'family',
        // ]);

        // $work = Category::create([
        //     'name' => 'Work',
        //     'slug' => 'work',
        // ]);

        // Post::create([
        //     'user_id' => $user->id,
        //     'category_id' => $family->id,
        //     'title' => 'My Family Post',
        //     'slug' => 'my-family-post',
        //     'excerpt' => 'Lorem ipsum dolor sit amet',
        //     'body' => '<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde alias animi distinctio vel officiis maiores, sed officia sint incidunt, porro eos veniam accusantium aspernatur eius excepturi neque impedit numquam nemo!</p>',
        // ]);

        // Post::create([
        //     'user_id' => $user->id,
        //     'category_id' => $work->id,
        //     'title' => 'My Work Post',
        //     'slug' => 'my-work-post',
        //     'excerpt' => 'Lorem ipsum dolor sit amet',
        //     'body' => '<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde alias animi distinctio vel officiis maiores, sed officia sint incidunt, porro eos veniam accusantium aspernatur eius excepturi neque impedit numquam nemo!</p>',
        // ]);
    }
}
