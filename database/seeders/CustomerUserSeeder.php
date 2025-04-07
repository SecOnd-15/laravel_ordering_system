<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Customer',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('1234'), // Hash the password
            'role' => 'customer', // Set role 
        ]);

        User::create([
            'name' => 'Dexter Mamaw',
            'email' => 'dexter@example.com',
            'password' => Hash::make('1234'),
            'role' => 'customer',
        ]);


        // Add more users as needed
        $this->command->info('Customer user created successfully!');
    }
}
