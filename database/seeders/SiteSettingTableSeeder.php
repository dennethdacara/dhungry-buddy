<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class SiteSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('site_settings')->truncate();
        $json = storage_path() . "/json/site_settings.json";
        $data = json_decode(file_get_contents($json, true));
        foreach ($data as $obj) {
            \App\Models\SiteSetting::create([
                'id'          => $obj->id,
                'title'       => $obj->title,
                'logo'        => $obj->logo,
                'description' => $obj->description,
                'address'     => $obj->address,
                'contact_no'  => $obj->contact_no,
                'copyright'   => $obj->copyright
            ]);
        }
    }
}
