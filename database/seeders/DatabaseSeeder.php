<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
use Cviebrock\EloquentSluggable\Services\SlugService;

use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $categories = Category::factory(10)->create();

        $tags = Tag::factory(10)->create();

        User::factory(10)->create()
            ->each(function($user) use($tags, $categories){
            Post::factory()->create([
                'user_id' => $user->id,
                'status'  => 'publish'
            ])->each(function($post) use($tags, $categories){
                $post->categories()->attach($categories->random(1));
                $post->tags()->attach($tags->random(1));
            });
        });

    }
}
