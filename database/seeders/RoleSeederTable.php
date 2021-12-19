<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $roleModel = new \App\Models\Role;

        $roleData = [
            'name' => 'admin',
        ];

        $adminRole = $roleModel->create($roleData);

        $admin = \App\Models\User::where('email','admin@admin.com')->first();

        $admin->roles()->attach($adminRole->id);
         
        $roleData = [
            'name' => 'teacher',
        ];

        $teacher = $roleModel->create($roleData);

        $userModel = new \App\Models\User;
        
        $userData = [
            'name' => 'teacher',
            'email' => 'teacher@teacher.com',
            'password' => bcrypt('teacher'),
            'username' => 'teacher',
        ];

        $teacherModel = $userModel->create($userData);

        $teacherModel->roles()->attach($teacher->id);
    }
}
