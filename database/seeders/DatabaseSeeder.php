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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('staffs')->insert([
            'fullname' => 'Nguyễn Minh Đức',
            'birthday' => '1998-05-03',
            'sex' => 'Nam',
            'address' => '135 Nguyễn Sinh Sắc, khóm Hoà Khánh, Phường 2, TP Sa Đéc, Đồng Tháp',
            'workingday' => '2024-04-09',
            'phone' => '0945579649',
            'password' => Hash::make('password'),
        ]);
    }
}
