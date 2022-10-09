<?php

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
        DB::table('users')->insert([
            'name' => 'Jane Doe',
            'email' => 'janedoe@gmail.com',
            'user_role' => 'QE',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'password' => Hash::make('password1'),
        ]);
    }
}
