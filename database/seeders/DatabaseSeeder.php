<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(SiswaSeeder::class);
        $this->call(GuruSeeder::class);
        
        // user 1
        $user1 = User::create([
            'username' => '123456',
            'password' => Hash::make('123456')
        ]);
        $user1->assignRole('admin');
        Guru::where('NIP', $user1->username)
                ->update(['id_user' => $user1->id]);

        // user 2
        $user2 = User::create([
            'username' => '112233',
            'password' => Hash::make('123456')
        ]);
        $user2->assignRole('admin');
        Guru::where('NIP', $user2->username)
                ->update(['id_user' => $user2->id]);

        // user 3      
        $user3 = User::create([
            'username' => '108946',
            'password' => Hash::make('123456')
        ]);
        $user3->assignRole('admin');
        Guru::where('NIP', $user3->username)
                ->update(['id_user' => $user3->id]);

        // user 4
        $user4 = User::create([
            'username' => '719878',
            'password' => Hash::make('123456')
        ]);
        $user4->assignRole('admin');
        Guru::where('NIP', $user4->username)
                ->update(['id_user' => $user4->id]);

        // user 5
        $user5 = User::create([
            'username' => '532432',
            'password' => Hash::make('123456')
        ]);
        $user5->assignRole('admin');
        Guru::where('NIP', $user5->username)
                ->update(['id_user' => $user5->id]);

        // user 6
        $user6 = User::create([
            'username' => '456789',
            'password' => Hash::make('123456')
        ]);
        $user6->assignRole('admin');
        Guru::where('NIP', $user6->username)
                ->update(['id_user' => $user6->id]);
    }
}
