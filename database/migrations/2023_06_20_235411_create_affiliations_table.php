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
        Schema::create('affiliations', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('member_id')->comment('ID do Membro');
            $table->string('name')->comment('Nome da Mãe');
            $table->set('affiliation',['Mãe','Pai']);
            $table->bigInteger('affiliation_id')->nullable()->comment('Id quando membro da igreja');
            $table->bigInteger('user_id')->comment('ID do cadastrador');

            $table->timestamps();

            //Chaves de ligação
            $table->foreign('member_id')->references('id')->on('members');
            $table->foreign('affiliation_id')->references('id')->on('members');
            $table->foreign('user_id')->references('id')->on('users');
        });
        DB::statement("comment on table affiliations is 'Pais do Membro'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliations');
    }
};
