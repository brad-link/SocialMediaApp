<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Post;
use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $u1 = new User;
        $u1->name = "Brad";
        $u1->email = "brad3@email.com";
        $u1->role = "user";
        $u1->password = Hash::make("pass123");
        $u1->save();

        $u1Imagepath = "photos/download.jpeg";
        $u1pp = new Image();
            $u1pp->imgpath = $u1Imagepath;
            $u1pp->imageable_id = $u1->id;
            $u1pp->imageable_type = 'User';
            $u1pp->save();
            $u1->Image()->save($u1pp);


        $adminImage = "photos/admin.jpeg";

        $admin = new User;
        $admin->name = "admin";
        $admin->email = "admin@email.com";
        $admin->role = "admin";
        $admin->password = Hash::make("pass1234");
        $admin->save();

        $adpp = new Image();
            $adpp->imgpath = $adminImage;
            $adpp->imageable_id = $admin->id;
            $adpp->imageable_type = 'User';
            $adpp->save();
            $admin->Image()->save($adpp);

        $u2 = new User;
        $u2->name = "Mattie1";
        $u2->email = "mattie1@email.com";
        $u2->role = "user";
        $u2->password = Hash::make("pass123");
        $u2->save();

        $ppImage = "photos/pp.jpg";

        

        User::factory()->count(50)
        ->has(Post::factory()->count(3))
                ->create();


        $users = User::all();

        foreach($users as $user){
            if($user->role === 'user'){
            $pp = new Image();
            $pp->imgpath = $ppImage;
            $pp->imageable_id = $user->id;
            $pp->imageable_type = 'User';
            $pp->save();
            $user->Image()->save($pp);
            }
        }
    }
}
