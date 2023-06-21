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
        Schema::create('graduations', function (Blueprint $table) {
            $table->id();
            $table->string('course')->comment('Cursos do Membro');
            $table->string('type')->comment('Tipo de graduação: superior,Licenciatura,Tecnólogo,EAD,Título,Bacharelado,Habilidades');
            $table->bigInteger('user_id')->comment('ID do cadastrador');

            // $table->timestamps();
            $table->timestamp('created_at', 0);
            $table->softDeletes('deleted_at', 0);
            //Chaves de ligação
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('member_id')->references('id')->on('members');
        });
        DB::statement("comment on table professions is 'Profissão do Membro'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('graduations');
    }
};