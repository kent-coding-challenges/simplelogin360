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
        DB::table('users')->insert([
            'first_name' => 'Kevin',
            'last_name' => 'Kane',
            'email' => 'kevin.kane@tunaiku.com',
            'password' => bcrypt('tunaiku_admin'),
        ]);
    }
}
