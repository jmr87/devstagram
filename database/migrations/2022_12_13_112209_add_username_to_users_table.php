<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Las migraciones son ordenes con las que podemos modificar la base de datos
// Como agregar tablas y columnas o eliminarlas.
// Siempre tienen que tener un métodod up y down. En este caso up para agregar columna de username
// y down para revertir la migración. Si uno la pone el otro la quita.

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            
        });
    }
};
