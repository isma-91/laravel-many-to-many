<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePostsAddCategoriesRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            //Colonna chiave esterna, ricordarsi di mettere lo stesso dato utilizzato per l'ID nella tabella di "origine", specificandolo
            $table->unsignedBigInteger('category_id')->after('id')->nullable();

            //chiave esterna sintassi "lunga"
            $table->foreign('category_id') //colonna che rappresenta la Foreign Key
                ->references('id') //dato da prendere dalla tabella di origine da utilizzare come foreign key nella tabella posts
                ->on('categories') //da che tabella stiamo prendendo tale dato
                ->nullOnDelete(); //Per poter cancellare le categorie e settare "null" i posts che avevano quella categoria
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            //Ricordarsi che il down lo dobbiamo fare nell'ordine inverso in cui abbiamo fatto l'up, quindi in questo caso, prima togliere la relazione e poi la colonna.

            //Elimino la relazione
            $table->dropForeign(['category_id']);//Questo è il secondo metodo, gli si passa il nome della foreign e poi sa lui il da farsi

            //Elimino la colonna
            $table->dropColumn('category_id');
        });
    }
}
