<?php

use App\Category;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $categories = [
            'Nessuna Categoria',
            'Sport',
            'Intrattenimento',
            'Videogiochi',
            'News',
            'Film',
            'Serie Tv',
        ];

        foreach ($categories as $category) {
            Category::create([
                'slug'          => Category::getSlug($category),
                'name'          => $category,
                'description'   => $faker->paragraphs(rand(1,6), true),
            ]);
        }
    }
}
