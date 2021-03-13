<?php

namespace Database\Seeders;

use App\Models\User;
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
        DB::insert("insert into users (first_name, surname, email, password,role,super_admin) values ('Monty', 'Hollings', 'monty@bespokeit.software', '$2y$10\$KcDadQfDIYyiHQdf0AKbMOiBjPEYhWkXv1WiZoAjoeE.hHNskM6c2',1,1)");
        DB::insert("insert into users (first_name, surname, email, password,role,super_admin) values ('John', 'Bishop', 'jbishop@gmail.com', '$2y$10\$KcDadQfDIYyiHQdf0AKbMOiBjPEYhWkXv1WiZoAjoeE.hHNskM6c2',2,0)");
        DB::insert("insert into users (first_name, surname, email, password,role,super_admin) values ('Jane', 'Weathers', 'jw@gmail.com', '$2y$10\$KcDadQfDIYyiHQdf0AKbMOiBjPEYhWkXv1WiZoAjoeE.hHNskM6c2',3,0)");





    }
}
