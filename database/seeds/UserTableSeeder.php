<?php

use Illuminate\Database\Seeder;

use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User();
        $admin->fname = "admin";
        $admin->lname = "admin";
        $admin->username = "admin";
        $admin->password = bcrypt("admin");
        $admin->role = "admin";
        $admin->email = "admin@admin.com";
        $admin->save();

        $reporter = new User();
        $reporter->fname = "reporter";
        $reporter->lname = "reporter";
        $reporter->username = "reporter";
        $reporter->password = bcrypt("reporter");
        $reporter->role = "reporter";
        $reporter->email = "reporter";
        $reporter->save();

        $member = new User();
        $member->fname = "member";
        $member->lname = "member";
        $member->username = "member";
        $member->password = bcrypt("member");
        $member->role = "member";
        $member->email = "member@member.com";
        $member->save();
    }
}
