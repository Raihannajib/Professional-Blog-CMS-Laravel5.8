<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use Carbon\Carbon;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset the posts table
        DB::table('posts')->truncate();

        // generate 10 dummy posts data
        $posts = [];
        $faker = Factory::create();
        $date = Carbon::create(2019, 7, 18, 9);

        for ($i = 1; $i <= 10; $i++)
        {
            $image = "Post_Image_" . rand(1, 5) . ".jpg";
            $date->addDays(1);
            $publishedDate = clone($date);
            $createdDate   = clone($date);

            $posts[] = [
                'author_id'    => rand(1, 3),
                'title'        => $faker->sentence(rand(8, 12)),
                'excerpt'      => $faker->text(rand(100, 200)),
                'body'         => $faker->text(rand(100, 200)),
                'slug'         => $faker->slug(),
                'image'        => rand(0, 1) == 1 ? $image : NULL,
                'created_at'   => $createdDate,
                'updated_at'   => $createdDate,
                'published_at' => $i < 5 ? $publishedDate : ( rand(0, 1) == 0 ? NULL : $publishedDate->addDays(4) )
            ];
        }

        DB::table('posts')->insert($posts);
    }}
