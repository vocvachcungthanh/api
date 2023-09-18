<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert([
            [
                'parent_id'    => 0,
                'name'         => "Cặp đôi",
                'link'         => "#couple",
                'status'       => true,
                'icon'         => '',
                'desc'         => '',
                'created_at'        => now()
            ],

            [
                'parent_id'    => 0,
                'name'         => "Sự kiện",
                'link'         => "#wedding",
                'status'       => true,
                'icon'         => '',
                'desc'         => '',
                'created_at'        => now()

            ],

            [
                'parent_id_menu'    => 0,
                'name_menu'         => "Album cưới",
                'link_menu'         => "#album",
                'status_menu'       => true,
                'icon_menu'         => '',
                'desc_menu'         => '',
                'created_at'        => now()
            ],

            [
                'parent_id_menu'    => 0,
                'name_menu'         => "Lời chúc",
                'link_menu'         => "#congratulation",
                'status_menu'       => true,
                'icon_menu'         => '',
                'desc_menu'         => '',
                'created_at'        => now()
            ]

        ]);
    }
}
