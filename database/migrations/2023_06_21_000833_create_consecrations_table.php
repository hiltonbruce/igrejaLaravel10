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
        Schema::create('consecrations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('member_id')->comment('ID do Membro');
            $table->bigInteger('type_consecration_id')->comment('Tipo de Consagração');
            $table->data('consecration');
            $table->boolean('status')->comment('Situação atual');
            $table->bigInteger('user_id')->comment('ID do cadastrador');

            // $table->timestamps();
            $table->timestamp('created_at', 0);
            $table->softDeletes('deleted_at', 0);
            //Chaves de ligação
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('member_id')->references('id')->on('members');
        });
        DB::statement("comment on table consecrations is 'Consagrações do Membro e situação atual'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consecrations');
    }
};
