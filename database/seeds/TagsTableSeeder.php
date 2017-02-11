<?php

use Illuminate\Database\Seeder;
use MyBlog\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::truncate();

        /*
         * Creating fake tags
         */
        factory(Tag::class, 10)->create();
    }
}
