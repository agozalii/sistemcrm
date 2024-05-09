<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'username'=>'admin',
                'password'=>bcrypt('123456'),
                'role'=> 'admin',
                'nama'=>'eirina',
                'alamat'=>'trini',
                'tgl_lahir'=>'2001-03-05',
                'jenis_kelamin'=>'P',
                'email'=>'eirina@gmail.com',
                'nomor_telpon'=>'089767776543'
            ],
            [
                'username'=>'kasir',
                'password'=>bcrypt('123456'),
                'role'=> 'kasir',
                'nama'=>'kumala',
                'alamat'=>'sleman',
                'tgl_lahir'=>'2001-03-05',
                'jenis_kelamin'=>'P',
                'email'=>'kumala@gmail.com',
                'nomor_telpon'=>'08182666651'
            ],
            [
                'username'=>'manajer',
                'password'=>bcrypt('123456'),
                'role'=> 'manajer',
                'nama'=>'laeina',
                'alamat'=>'gamping',
                'tgl_lahir'=>'2001-03-05',
                'jenis_kelamin'=>'P',
                'email'=>'laeina@gmail.com',
                'nomor_telpon'=>'08138825093'
            ],
            [
                'username'=>'member',
                'password'=>bcrypt('123456'),
                'role'=> 'member',
                'nama'=>'reirin',
                'alamat'=>'trini',
                'tgl_lahir'=>'2001-03-05',
                'jenis_kelamin'=>'P',
                'email'=>'reirin@gmail.com',
                'nomor_telpon'=>'08576234654'
            ],
            [
                'username'=>'member2',
                'password'=>bcrypt('123456'),
                'role'=> 'member',
                'nama'=>'reirin',
                'alamat'=>'trini',
                'tgl_lahir'=>'2001-03-05',
                'jenis_kelamin'=>'P',
                'email'=>'reirin@gmail.com',
                'nomor_telpon'=>'08576234654'
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
    }
    }
}
