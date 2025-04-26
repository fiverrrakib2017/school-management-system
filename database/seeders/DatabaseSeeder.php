<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call([
        //     StudentSeeder::class
        // ]);
        \App\Models\Admin::create([
            'name' => 'Masud Rana',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'password' => Hash::make('adm12345'),
        ]);
        \App\Models\Admin::create([
            'name' => 'Shafiul Bashar Sumon',
            'email' => 'admin@futureictbd.com',
            'username' => 'futureictbd',
            'password' => Hash::make('futureictbd'),
        ]);
        $master_ledger_name = ['Income', 'Expense', 'Asset', 'Liabilities'];

        foreach ($master_ledger_name as $name) {
            \App\Models\Master_ledger::create([
                'name' => $name,
                'status' => 1,
            ]);
        }
    }
}
