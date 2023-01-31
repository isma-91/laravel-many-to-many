<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Slugger {
    public static function getSlug($text) {
        // si genera lo slug di base che ci servirà ogni volta per confrontare lo slug già esistente con uno nuovo
        $slugBase = Str::slug($text);
        //Per parlare col database usiamo il Model, quindi o richiamiamo e gli diciamo di andare a cercare una riga dove lo "slug" è uguale al "slugBase", se esiste ( questo WHERE è true (ricordiamo che se 2 valori sono separati solo da una virgola si sottintende l'guaglianza, quindi è come se fosse scritto: where('slug', '=',  $slugBase))) prendo la prima riga, tanto ne basta una per capire se è uguale, ne basta una uguale per doverla modificare (e comunque abbiamo utilizzato "unique", quindi non ce ne è più di una), e, come abbiamo detto, se ritorna true, mi ritorna un opggetto, vuol dire che è già usata e devo generare un nuovo slug. Se invece non mi ritorna un oggetto, mi ritorna nullo, vuol dire che posso usarlo e non c'è bisogno di generare un nuovo slug.
        $slug = $slugBase;
        $i = 1;
        // Si usa "self" per rendere dinamico il nome della Classe ( è come il this, ma è per la clesse anzichè dell'oggetto)
        while (self::where('slug', $slug)->first()) {
            $slug = $slugBase . '-' . $i;
            $i++;
        }
        //usiamo il while per dire finchè questa istruzione mi ritorna un valore e quindi è true, mi ritorna un oggetto e quindi devo modificare lo slug. Però non possiamo utilizzare lo "slugBase"perchè ci serve per aggiungergli il contatore e generare nuovi slug. Quindi dobbiamo creare un altro slug partendo da quello base alla quale gli concateniamo il trattino e il contatore ($i) che abbiamo dichiarato, come sempre nei cicli while, prima e fuori da ciclo stesso. A questo punto devo cambiare lo "slugBase" nel confronto del cliclo while, perchè altrimenti confronterei sempre lo slug di base (sempre lo stesso), e quindi ci metto solo lo "$slug", che è una "copia" dello "slugBase". Così avrò "$slug" che verrà sempre modificata e gli verrà sempre aggiunto un +1 al "-x" alla fine dello slug, e uno "slugBase" che rimarrà sempre uguale, costante perchè ci serve sempre nel ciclo while così da poterlo usare per generare il nuovo slug, confrontandolo con lo slug "variabile". Poi si ritorna lo slug generato.
        return $slug;

    }
}
