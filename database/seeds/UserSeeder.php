<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users =
        [
            [
                'name'      => 'asdf',
                'email'     => 'asdf@asdf.asdf',
                'password'  => Hash::make('asdf'),
            ],
            [
                'name'      => 'qwert',
                'email'     => 'qwert@qwert.qwert',
                'password'  => Hash::make('qwert'),
            ],
            [
                'name'      => 'zxcv',
                'email'     => 'zxcv@zxcv.zxcv',
                'password'  => Hash::make('zxcv'),
            ],
        ];

        // Qui possiamo usare questo metodo invece di elencare tutte le voci e senza andare a "dare i permessi per il fill" dal model perchè siamo nei seed, quindi ci mettiamo le mani noi developer e dovremmo sapere quello che stiamo facendo e quindi che tipo di dato stiamo inserendo senza inguaiare il DB, mentre nel controller meglio usare la notazione lunga campo per campo, perchè li vengono passati i dati che ci da l'utente e quindi meglio controllare precisamente cosa ci sta passando, altrimenti ci potrebbe passare dati che non vanno bene/che non rispettano le regole stabilite dal DB e inguaiare tutto.
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
