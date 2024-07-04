<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Guru::factory()->count(10)->create();
        Guru::create([
            'id_user' => null,
            'NIP' => '123456',
            'name' => 'Rafi Faridz Utomo',
            'email' => 'rafi@gmail.com',
            'gender' => 'male',
            'address' => 'Tabanan - Bali',
            'phone' => '081338194427',
        ]);

        Guru::create([
            'id_user' => null,
            'NIP' => '112233',
            'name' => 'Bagus Hernadi',
            'email' => 'bagus@gmail.com',
            'gender' => 'male',
            'address' => 'Jakarta Pusat',
            'phone' => '081223344563',
        ]);

        Guru::create([
            'id_user' => null,
            'NIP' => '108946',
            'name' => 'Muhammad Villa Arifviando',
            'email' => 'villa@gmail.com',
            'gender' => 'male',
            'address' => 'Surabaya - Jatim',
            'phone' => '081882973298',
        ]);

        Guru::create([
            'id_user' => null,
            'NIP' => '719878',
            'name' => 'Wildan Prima Ifadah',
            'email' => 'wildan@gmail.com',
            'gender' => 'male',
            'address' => 'Bandung - Jawa Barat',
            'phone' => '081997357482',
        ]);

        Guru::create([
            'id_user' => null,
            'NIP' => '532432',
            'name' => 'M. Toyyibal Ardani',
            'email' => 'Toyyibal@gmail.com',
            'gender' => 'male',
            'address' => 'Yogyakarta - Jawa Tengah',
            'phone' => '081632483249',
        ]);
    }
}
