<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class OrderStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_statuses')->truncate();
        $json = storage_path() . "/json/order_statuses.json";
        $data = json_decode(file_get_contents($json, true));
        foreach ($data as $obj) {
            \App\Models\OrderStatus::create([
                'id'   => $obj->id,
                'name' => $obj->name
            ]);
        }
    }
}
