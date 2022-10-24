<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('setting')->insert([
            'id_setting' => 1,
            'nama_perusahaan' =>'Toko SAYAH',
            'alamat' =>'Bandung',
            'telepon' => '023113131',
            'tipe_nota' =>1,
            'diskon' =>5,
            'path_logo' =>'card.jpeg',
            'path_kartu_member' =>'card.jpeg',
        ]);
    }
}
