<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate existing users cleanly
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        User::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        $users = [
            [
                'name' => 'Admin BPS',
                'username' => 'admin_bps',
                'nip' => '199001012024011001',
                'email' => 'admin@bps.go.id',
                'password' => Hash::make('password123'),
                'jabatan' => 'Pranata Komputer',
                'role' => 'admin',
                'tanda_tangan' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Wishnu Eka Saputra',
                'username' => 'wishnu',
                'nip' => '197205181999031001',
                'email' => 'wishnu_eka@bps.go.id',
                'password' => Hash::make('password123'),
                'jabatan' => 'Kepala Sub Bagian Umum',
                'role' => 'pegawai',
                'tanda_tangan' => 'signatures/sample_wishnu.svg',
                'is_active' => true,
            ],
            [
                'name' => 'Taufik Januar',
                'username' => 'taufik',
                'nip' => '198101232001121002',
                'email' => 'taufikjanuar@bps.go.id',
                'password' => Hash::make('password123'),
                'jabatan' => 'Asisten Statistisi Terampil',
                'role' => 'pegawai',
                'tanda_tangan' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Dani Jaelani',
                'username' => 'dani',
                'nip' => '196912101991121001',
                'email' => 'dani@bps.go.id',
                'password' => Hash::make('password123'),
                'jabatan' => 'Kepala Kantor',
                'role' => 'pegawai',
                'tanda_tangan' => 'signatures/sample_dani.svg',
                'is_active' => true,
            ],
            [
                'name' => 'Anita Rahminingrum',
                'username' => 'anita',
                'nip' => '197806041999122002',
                'email' => 'anita@bps.go.id',
                'password' => Hash::make('password123'),
                'jabatan' => 'Statistisi Ahli Muda',
                'role' => 'pegawai',
                'tanda_tangan' => null,
                'is_active' => true,
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}
