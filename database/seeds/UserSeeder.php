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
        $admin->user_name = "admin";
        $admin->user_email = "admin@gmail.com";
        $admin->user_password = bcrypt("password");
        $admin->user_visible_password = "password";
        $admin->user_email_verified_at = NOW();
        $admin->user_occupation = "CEO";
        $admin->user_address = "Indonesia";
        $admin->user_phone = "123456789";
        $admin->user_is_admin = 1;
        $admin->save();
        
        $student = new User();
        $student->user_name = "student";
        $student->user_email = "student@gmail.com";
        $student->user_password = bcrypt("password");
        $student->user_visible_password = "password";
        $student->user_email_verified_at = NOW();
        $student->user_occupation = "Student";
        $student->user_address = "Indonesia";
        $student->user_phone = "123456789";
        $student->user_is_admin = 0;
        $student->save();
    }
}
