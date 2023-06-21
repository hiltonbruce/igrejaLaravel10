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
        Schema::create('cults', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('church_id')->comment('ID da Igreja ou congregação');
            $table->string('cults',5)->comment('Dias de Culto');
            $table->tinyInteger('prayer')->comment('Dia do Circulo de Oração');
            $table->tinyInteger('week')->comment('Semana da Ceia nas congregações em relação a Sede: 0 antes, 1 igual , 2 depois');
            $table->tinyInteger('supper')->comment('Dia da Santa Ceia, 1º digito semana, 2º dia da semana');
            $table->bigInteger('user_id')->comment('ID do cadastrador');

            $table->timestamps();
            $table->softDeletes('deleted_at', 0);

            //Chaves de ligação
            $table->foreign('church_id')->references('id')->on('churches');
            $table->foreign('user_id')->references('id')->on('users');
        });
        DB::statement("comment on table cults is 'Cultos, Ceia, circulo de orações da Igreja'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cults');
    }
};
