<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert("insert into roles (id,description) values (?,?)", [1,'Administrator']);
        DB::insert("insert into roles (id,description) values (?,?)", [2,'User']);
        DB::insert("insert into roles (id,description) values (?,?)", [3,'Restricted User']);

    }
}
