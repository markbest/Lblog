<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(array(
            'id' => '1',
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => '$2y$10$4KmP.c8fdclNfk8c2m8MWeYjyRCcs0TSQlnshq6hZjCCWOZUhSdzy',
            'remember_token' => '',
            'created_at' => date('Y-m-d h:i:s',time()),
            'updated_at' => date('Y-m-d h:i:s',time()),
        ));
    }
}
