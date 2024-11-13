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
            'name' => 'Rakib Mahmud',
            'email' => 'rakibas375@gmail.com',
            'username' => 'rakibas375',
            'password' => Hash::make('12345678'),
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
