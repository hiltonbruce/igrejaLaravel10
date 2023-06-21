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
        Schema::create('secretaries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('church_id')->comment('ID da Igreja ou congregação');
            $table->bigInteger('member_id')->comment('ID do Membro na Igreja');
            $table->tinyInteger('order')->comment('Hierarquia do secretário');
            $table->bigInteger('user_id')->comment('ID do cadastrador');

            // $table->timestamps();
            $table->timestamp('created_at', 0);
            $table->softDeletes('deleted_at', 0);

            //Chaves de ligação
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('church_id')->references('id')->on('churches');
            $table->foreign('member_id')->references('id')->on('members');
        });
        DB::statement("comment on table secretaries is 'Secretários da Igreja'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('secretaries');
    }
};
