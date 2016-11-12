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
        $user = new \App\User;
        $user->firstname = 'm7md';
        $user->lastname = 'abdallah';
        $user->email = 'm7md@yahoo.com';
        $user->firstname = 'm7md';
        $user->password = Hash::make('m7md');
        $user->telephone = '01121179371';
        $user->admin = 1;
        $user->save();

        echo "test";
    }
}
