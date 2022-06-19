<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [

            //role
            ['name'=>'role_view','guard_name'=>'web'],
            ['name'=>'role_create','guard_name'=>'web'],
            ['name'=>'role_edit','guard_name'=>'web'],
            ['name'=>'role_update','guard_name'=>'web'],
            ['name'=>'role_delete','guard_name'=>'web'],

            //dashboard
            ['name'=>'dashboard_view','guard_name'=>'web'],

            //blog
            ['name'=>'blog_view','guard_name'=>'web'],
            ['name'=>'blog_create','guard_name'=>'web'],
            ['name'=>'blog_edit','guard_name'=>'web'],
            ['name'=>'blog_update','guard_name'=>'web'],
            ['name'=>'blog_delete','guard_name'=>'web'],

        ];

        DB::table('permissions')->insert($permissions);
    }
}
