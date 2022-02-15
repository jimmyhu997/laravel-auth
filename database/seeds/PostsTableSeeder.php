<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as faker;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 25; $i++){
            $newPost = new Post();
            $newPost->title = $faker->words(9,true);
            $newPost->slug = Str::of($newPost->title)->slug('-');
            $newPost->content = $faker->text();
            $newPost->posted = rand(0,1);
            $newPost->save();
        }
        
    }
}
