<?php


class UserTableSeeder extends Seeder
{
    public function run(){
        $user = new User();
        $user->username = "asd";
        $user->password = Hash::make("123");
        $user->save();
    }
}