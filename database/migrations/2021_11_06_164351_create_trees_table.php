<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trees', function (Blueprint $table) {
            $table->id();
            $table->integer('id_padre')->nullable();
            $table->integer('id_madre')->nullable();
            $table->string('nombres');
            $table->string('apellido_padre')->nullable();
            $table->string('apellido_madre')->nullable();
            $table->string('sexo')->nullable();
            $table->integer('dia_nac')->nullable();
            $table->integer('mes_nac')->nullable();
            $table->integer('anho_nac')->nullable();
            $table->string('lugar_nac')->nullable();
            $table->integer('dia_matr')->nullable();
            $table->integer('mes_matr')->nullable();
            $table->integer('anho_matr')->nullable();
            $table->string('lugar_matr')->nullable();
            $table->integer('dia_def')->nullable();
            $table->integer('mes_def')->nullable();
            $table->integer('anho_def')->nullable();
            $table->string('lugar_def')->nullable();
            $table->text('observaciones')->nullable();
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
        Schema::dropIfExists('trees');
    }
}
