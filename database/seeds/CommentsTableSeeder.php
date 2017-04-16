<?php

use Illuminate\Database\Seeder;
use MyBlog\Comment;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::truncate();

        /*
         * Creating fake posts
         */
        factory(Comment::class, 30)->create();
    }
}
