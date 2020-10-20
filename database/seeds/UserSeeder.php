<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User();
        $admin->name = "admin";
        $admin->email = "admin@gmail.com";
        $admin->password = bcrypt("password");
        $admin->visible_password = "password";
        $admin->email_verified_at = NOW();
        $admin->occupation = "CEO";
        $admin->address = "Indonesia";
        $admin->phone = "123456789";
        $admin->is_admin = 1;
        $admin->save();
        
        $student = new User();
        $student->name = "student";
        $student->email = "student@gmail.com";
        $student->password = bcrypt("password");
        $student->visible_password = "password";
        $student->email_verified_at = NOW();
        $student->occupation = "Student";
        $student->address = "Indonesia";
        $student->phone = "123456789";
        $student->is_admin = 0;
        $student->save();
    }
}
