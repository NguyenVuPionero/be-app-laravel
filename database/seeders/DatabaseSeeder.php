<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


//        User::factory()->count(10)->create();
//        User::all()->each(function ($user) {
//            Profile::factory()->create(['user_id' => $user->id]);
//        });
//
//        User::all()->each(function ($user) {
//            Post::factory()->count(3)->create(['user_id' => $user->id]);
//        });
//
//        Role::factory()->count(5)->create();
//
//        User::all()->each(function ($user) {
//            $roles = Role::inRandomOrder()->take(rand(1, 3))->pluck('id');
//            $user->roles()->attach($roles);
//        });

//        DB::table('countries')->insert([
//            ['name' => 'United States', 'code' => 'US'],
//            ['name' => 'Canada', 'code' => 'CA'],
//            ['name' => 'United Kingdom', 'code' => 'UK'],
//            // Add more countries as needed
//        ]);

        // Seed images for users
        User::all()->each(function ($user) {
            Image::create([
                'url' => 'https://example.com/user_image.jpg',
                'imageable_id' => $user->id,
                'imageable_type' => User::class,
            ]);
        });

        // Seed images for posts
        Post::all()->each(function ($post) {
            Image::create([
                'url' => 'https://example.com/post_image.jpg',
                'imageable_id' => $post->id,
                'imageable_type' => Post::class,
            ]);
        });
    }
}
