<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = [
          ['name' => 'superadmin','guard_name'=>'web'],
          ['name' => 'admin','guard_name'=>'web'],
          ['name' => 'writer','guard_name'=>'web'],
          ['name' => 'user','guard_name'=>'web'],

        ];

        DB::table('roles')->insert($role);
    }
}
