<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'email' => 'notification@muquiranasbar.com.br',
            'name' => 'Notification API',
            'password'  => Hash::make('#API@2022#'),
            'device' => 'WEB',
        ]);
    }
}
