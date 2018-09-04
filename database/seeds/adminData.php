<?php

use Illuminate\Database\Seeder;
use \App\User;

class adminData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.ru',
            'password' => Hash::make('admin'),
        ]);
    }
}
