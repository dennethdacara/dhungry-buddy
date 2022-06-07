<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        $json = storage_path() . "/json/users.json";
        $data = json_decode(file_get_contents($json, true));
        foreach ($data as $obj) {
            \App\Models\User::create([
                'id' => $obj->id,
                'role_id' => $obj->role_id,
                'firstname' => $obj->firstname,
                'middlename' => $obj->middlename,
                'lastname' => $obj->lastname,
                'thumbnail' => $obj->thumbnail,
                'email' => $obj->email,
                'username' => $obj->username,
                'password' => $obj->password,
            ]);
        }
    }
}
