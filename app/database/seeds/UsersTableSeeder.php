<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;


class UsersTableSeeder extends Seeder
{
    public function run()
    {
 
        App\models\User::create(array(
            'username' => 'dannie',
            'password' => Hash::make('123456')
        ));
 
    }
}
