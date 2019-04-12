<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'name' => 'Thiago Zaranza',
            'email' => 'thiagozaranza@gmail.com',
            'password' => bcrypt('1qw23e'),
        ]);
    }
}
