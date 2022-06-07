<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->truncate();
        $json = storage_path() . "/json/roles.json";
        $data = json_decode(file_get_contents($json, true));
        foreach ($data as $obj) {
            \App\Models\Role::create([
                'id'   => $obj->id,
                'name' => $obj->name
            ]);
        }
    }
}
