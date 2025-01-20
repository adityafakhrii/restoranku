<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'role_name' => 'admin',
                'description' => 'Administrator dengan akses penuh',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_name' => 'cashier',
                'description' => 'Menangani pembayaran dan pemesanan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_name' => 'chef',
                'description' => 'Bertanggung jawab untuk memberitahu status pesanan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_name' => 'guest',
                'description' => 'Akses terbatas hanya untuk pemesanan dan pembayaran',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('roles')->insert($roles);
    }
}
