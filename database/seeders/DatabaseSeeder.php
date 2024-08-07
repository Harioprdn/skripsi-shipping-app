<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),

        ]);

        DB::table('cities')->insert([
            'name' => 'Bandung',

        ]);

        DB::table('items')->insert([
            'name' => 'Pakaian',

        ]);

        DB::table('costs')->insert([
            'cities_id' => '1',
            'price' => '50000',

        ]);

        DB::table('drivers')->insert([
            'name' => 'Budi',
            'address' => 'Jalan Ahmad Yani No.10',
            'phone' => '081234567891'

        ]);

        DB::table('vehicles')->insert([
            'type' => 'Truk Pick Up',
            'brand' => 'Toyota',
            'number' => 'D1234XXX',
            'production_year' => '2010',
            'tax_date' => '2026-06-01',
            'tax_price' => '1000000',
            'oil_date' => '2024-06-01',
            'machine_number' => '1',
            'chassis_number' => '1',
            'color' => 'Hitam',
            'fuel' => 'Diesel',

        ]);

        DB::table('shippings')->insert([
            'number' => 'MC123456789012',
            'sender_name' => 'Hario',
            'sender_address' => 'Semarang',
            'sender_phone' => '081226215811',
            'receiver_name' => 'Budi',
            'receiver_address' => 'Jalan Wulan No.10',
            'receiver_phone' => '081234567890',
            'items_id' => '1',
            'quantity' => '20',
            'item_weight' => '10',
            'payment' => 'Penerima',
            'date' => '2024-03-19',
            'description' => 'XXXXX',
            'costs_id' => '1',
            'price' => '50000'
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
