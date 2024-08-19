<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHamburguesaIngredienteTable extends Migration
{
    public function up()
    {
        Schema::create('hamburguesa_ingrediente', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hamburguesa_id');
            $table->unsignedBigInteger('ingrediente_id');
            $table->timestamps();

            $table->foreign('hamburguesa_id')->references('id')->on('hamburguesas')->onDelete('cascade');
            $table->foreign('ingrediente_id')->references('id')->on('ingredientes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('hamburguesa_ingrediente');
    }
}
