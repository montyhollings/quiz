<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert("insert into quizzes (created_at,name,created_by) values (?,?,?)", ["2020-03-13 00:00:00",'Test Quiz 1',1]);
        DB::insert("insert into quizzes (created_at,name,created_by) values (?,?,?)", ["2020-03-13 00:00:00",'Test Quiz 2',1]);
        DB::insert("insert into quizzes (created_at,name,created_by) values (?,?,?)", ["2020-03-13 00:00:00",'Test Quiz 3',1]);
    }
}
