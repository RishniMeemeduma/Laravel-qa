<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavouritesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('favourites')->delete();

        $users = User::pluck('id')->all();
        $number_of_users = count($users);

        foreach(Question::all() as $question){
            for($i=0;$i<rand(0,$number_of_users);$i++){

                $user = $users[$i];

                $question->favourites()->attach($user);
            }
        }
    }
}
