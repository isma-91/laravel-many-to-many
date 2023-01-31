<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Per svuotare la cartella dove vengono salvate le immagini, cancelliamo e ricreiamo lo storage, in modo che se non ci sono immagini associate, vengono eliminate ogni volta che facciamo i seeds.
        Storage::deleteDirectory('uploads');
        Storage::makeDirectory('uploads');
        //Se le tabelle dei seeder qui sotto elencate sono collegate tra loro, mettere queste righe di seeder nell'ordine corretto così che venga popolata prima la tabella, che per esempio, deve fornire una chiave esterna ad un altra tabella, altrimenti quest'ultima verrebbe creata prima che sia presente la tabella che gli deve passare la chiave esterna e darebbe errore. Difatti abbiamo messo il "CategorySeeder" prima del "PostSeeder" per far si che venga prima popolata la tabella delle categories che po deve fornire la foreign key per la tabella dei posts. Se avessimo messo nell'ornine prima il "PostSeeder" avrebbe dato errore perchè nons arebbe stato possibile avere la foreign key per la tabella dato che la tabella delle categories non sarebbe stata ancora popolata.
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(TagSeeder::class); // Prima dei posts altrimenti non possiamo dare i tags ai posts
        $this->call(PostSeeder::class);
    }
}
