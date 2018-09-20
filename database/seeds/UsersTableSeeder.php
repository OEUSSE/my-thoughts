<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Oscar',
            'email' => 'oeusse@mail.com',
            'password' => bcryt('oscareusse')
        ]);
    }
}
