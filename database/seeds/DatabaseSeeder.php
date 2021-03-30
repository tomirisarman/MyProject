<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $t = [
            ['id'=>1, 'name'=>'Mr. Collins', 'email'=>'collins@123.com', 'password'=>Hash::make('qwerty123')],
            ['id'=>2, 'name'=>'Mr. Brown', 'email'=>'brown@123.com', 'password'=>Hash::make('qwerty123')],
            ['id'=>3, 'name'=>'Mr. Davidson', 'email'=>'davidson@123.com', 'password'=>Hash::make('qwerty123')],
        ];
        DB::table('teachers')->insert($t);
        $c = [
            ['name'=>'Python', 'teacher_id'=>1],
            ['name'=>'Java', 'teacher_id'=>2],
            ['name'=>'C++', 'teacher_id'=>3],
        ];
        DB::table('courses')->insert($c);
        $a = [
            ['id'=>1, 'name'=>'Admin', 'email'=>'admin@123.com', 'password'=>Hash::make('qwerty123')],
        ];
        DB::table('admins')->insert($a);
        // if (!file_exists(public_path('/materials'))) {
        //     mkdir(public_path('/materials'), 0777, true);
        // }


    }
}
