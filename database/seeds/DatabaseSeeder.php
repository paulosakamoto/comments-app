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
        // $this->call(UserSeeder::class);
        \App\User::create([
          'name' => 'Paulo',
          'email' => 'paulo.a.a.sakamoto@gmail.com',
          'email_verified_at' => now(),
          'password' => bcrypt(\Illuminate\Support\Str::random(16))
        ]);
    }
}
