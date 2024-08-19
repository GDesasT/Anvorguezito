<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHamburguesasTable extends Migration
{
    public function up()
    {
        Schema::create('hamburguesas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->decimal('precio', 8, 2);
            $table->string('imagen_url');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hamburguesas');
    }
}
