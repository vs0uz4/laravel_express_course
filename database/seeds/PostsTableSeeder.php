<?php

use Illuminate\Database\Seeder;
use MyBlog\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::truncate();

        /*
         * Creating fake posts
         */
        factory(Post::class, 6)->create();
    }
}
