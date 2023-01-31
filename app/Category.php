<?php

namespace App;

use App\Traits\Slugger;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Slugger;

    public $timestamps = false;

        // Per la relazione si fa una public function il quale nome sarà il nome della tabella con cui va messa in relazione e si dovrà scegliere tra plurale o singolare in base se questa tabella, questo model, può avere più elementi dell'altra tabella con cui entra in relazione oppure no. Ad esempio, in questo caso, una categoria può essere assegnata a più post, quindi potendo avere più posts per categoria, in questo caso, mettiamo il nome al plurale "posts".
        public function posts() {
        //Anche il metodo da usare qui lo decidiamo in base alla cardinalità. Nel nostro caso una categoria può avere molti posts associati quindi usiamo "hasMany". Si può anche pensare al fatto che non è la tabella con la foreign key).
        return $this->hasMany('App\Post'); //Esprimere il nome del model completo col namespace.
    }
}
