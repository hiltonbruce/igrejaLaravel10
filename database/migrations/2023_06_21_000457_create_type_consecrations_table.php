<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('type_consecrations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment('Auxiliar, Diácono, Presbítero, Evangelista, Pastor');
            $table->bigInteger('user_id')->comment('ID do cadastrador');

            $table->timestamps();
            //Chaves de ligação
            $table->foreign('user_id')->references('id')->on('users');
        });
        DB::statement("comment on table type_consecrations is 'Tipos de consagrações da Igreja'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_consecrations');
    }
};
