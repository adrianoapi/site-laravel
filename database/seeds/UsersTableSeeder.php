<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = $this->makeRandomString(rand(5,10));
        User::create([
            'name'      => $name,
            'email'     => $name.'@hotmail.com',
            'password'  =>  Hash::make('123'),
        ]);
    }

    private function makeRandomString($max=6) {
        $i = 0; //Reset the counter.
        $possible_keys = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $keys_length = strlen($possible_keys);
        $str = ""; //Let's declare the string, to add later.
        while($i<$max) {
            $rand = mt_rand(1,$keys_length-1);
            $str.= $possible_keys[$rand];
            $i++;
        }
        return $str;
    }
}
