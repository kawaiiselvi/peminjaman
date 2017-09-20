<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   //admin role
        $adminRole = new Role();
        $adminRole->name="admin";
        $adminRole->display_name="Admin";
        $adminRole->save();

        //member role
        $memberRole = new Role();
        $memberRole->name="member";
        $memberRole->display_name="Member";
        $memberRole->save();

        //user admin
        $admin = new User();
        $admin->name="Admin Perang.com";
        $admin->email="admin@gmail.com";
        $admin->password=bcrypt('rahasia');
        $admin->is_verified=1;
        $admin->save();
        $admin->attachRole($adminRole);

        //user member
        $member = new User();
        $member->name="Member 1";
        $member->email="member@gmail.com";
        $member->password=bcrypt('rahasia');
        $member->is_verified=1;
        $member->save();
        $member->attachRole($memberRole);
    }
}