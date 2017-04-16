<?php

use Illuminate\Database\Seeder;
use MyBlog\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        /*
         * Creating default users
         */
        factory(User::class)->create([
            'name'      => 'Vitor Rodrigues',
            'nickname'  => 'vS0uz4',
            'email'     => 'vs0uz4@gmail.com',
            'password'  => bcrypt('v1t0r')
        ]);

        /*
         * Creating fake users
         */
        factory(User::class, 9)->create();
    }
}
