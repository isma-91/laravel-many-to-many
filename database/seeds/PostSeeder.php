<?php

use App\Tag;
use App\Post;
use App\Category;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $categories = Category::all('id')->all(); // il secondo metodo all ci restituisce un array
        $tags = Tag::all()->pluck('id');//Estraggo tutti i tags che ho nel database, usando pluck (si può usare sulle collection) per prendere solo l'array di id invece dell'oggetto intero.
        $tagsCount = count($tags);

        for ($i=0; $i < 100; $i++) {
            $title = $faker->words(rand(3, 7), true);
            // $title = 'Bella'; // Solo per provare
            // $casualImgs = Storage::files('imgs');
            // $img_path = Storage::put('uploads', $faker->randomElement($casualImgs));

            $post = Post::create([
                //Per far funzionare bene lo slug dobbiamo implementare una funzione nel Model perchè abbiamo detto che lo slug deve essere univoco, quindi non ce ne deve essere più di uno con lo stesso nome, però lo slug viene creato dal "title" che non deve e non può essere sempre univoco, così si creerebbero più slug uguali perchè ci saranno più titoli uguali, quindi ci serve la funzione per far cambiare il nome dello slu ogni volta che ne trova uno uguale
                'category_id' => $faker->randomElement($categories)->id,
                'slug'        => Post::getSlug($title),
                'title'       => $title,
                'image'       => 'https://picsum.photos/id/'. rand(0, 1000) .'/500/400',
                // 'uploaded_img'=> $img_path,
                'content'     => $faker->paragraphs(rand(1, 10), true),
                'excerpt'     => $faker->paragraph(),
            ]);

            //vado ad attaccare al post creato in ogni ciclo un numero random di tags randomici, questa riga scrive nella tabella ponte.
            $post->tags()->attach($faker->randomElements($tags, rand(0, ($tagsCount > 5) ? 5 : $tagsCount)));

        }
    }

}
