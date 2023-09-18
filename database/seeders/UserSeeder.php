<?php


namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
              'username'     => 'vvct',
              'name'         => 'admin',
              'email'        => 'vvctn@gmail.com',
              'password'     => Hash::make('admin123'),
              'created_at'         => now()
            ],

            [
                'username'     => 'NguyenThuyTien',
                'name'         => 'thuytien',
                'email'        => 'thuytien@gmail.com',
                'password'     => Hash::make('tien123'),
                'created_at'         => now()
            ]
        ]);
    }
}