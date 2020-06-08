<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateAnnoncesTable 
    extends Migration           // ON HERITE DE LA CLASSE Migration
                                // FOURNIE PAR LARAVEL
                                // GRACE A L'HERITAGE
                                // ON PEUT AJOUTER NOTRE CODE 
                                // ET UTILISER LE CODE DE LARAVEL
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annonces', function (Blueprint $table) {
            $table->bigIncrements('id');    // LAVAREL VA GERER LA COLONNE id

            $table->string('titre');		
            $table->string('photo');	

            $table->string('categorie');

            $table->bigInteger('user_id')->unsigned();

            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('annonces');
    }
}
