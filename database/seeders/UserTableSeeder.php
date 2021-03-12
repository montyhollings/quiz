<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Monty',
            'surname' => 'Hollings',
            'email' => 'monty@bespokeit.software',
            'password' => '$2y$10$KcDadQfDIYyiHQdf0AKbMOiBjPEYhWkXv1WiZoAjoeE.hHNskM6c2',
        ]);
    }
}
