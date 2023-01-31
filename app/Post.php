<?php

namespace App;

use App\Traits\Slugger;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Slugger;

    // Per la relazione si fa una public function il quale nome sarà il nome della tabella con cui va messa in relazione e si dovrà scegliere tra plurale o singolare in base se questa tabella, questo model, può avere più elementi dell'altra tabella con cui entra in relazione oppure no. Ad esempio, in questo caso, abbiamo detto che un post non può avere più di una categoria, quindi potendo avere una sola categoria per post usiamo il nome al singolare "category".
    public function category() {
        //Anche il metodo da usare qui lo decidiamo in base alla cardinalità. Nel nostro caso un post APPARTIENE ad UNA categoria. Sia può anche pensare che il belongsTo va messo al model della tabella che ha l'ID esterno (foreign key).
        return $this->belongsTo('App\Category'); //Esprimere il nome del model completo col namespace.
    }

    public function tags(){
        return $this->belongsToMany('App\Tag'); // Relazione molti a molti
    }

    //funzione per usare lo slug anzichè l'id nel link
    public function getRouteKeyName() {
        return 'slug';
    }
}
