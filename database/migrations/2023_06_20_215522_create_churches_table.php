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
        Schema::create('churches', function (Blueprint $table) {
            $table->id();
            $table->string('name',150)->comment('Razão Social');
            $table->tinyInteger('type')->comment('1-Sede, 2-congregação');
            $table->smallInteger('sector')->comment('Área de atuação da igreja ou congregação');
            $table->string('cnpj',14)->comment('Código naciona de pessoa jurídica');
            $table->string('site');
            $table->string('email');
            $table->string('address')->comment('Endereço - rua, avenida, etc');
            $table->integer('number')->comment('Número do prédio');
            $table->bigInteger('city_id')->comment('ID da Cidade');
            $table->string('cep',20)->comment('Código de endereçamento postal');
            $table->string('slug')->comment('nome para exibir na URL');
            $table->boolean('status');
            $table->bigInteger('user_id')->comment('ID do cadastrador');

            $table->timestamps();
            $table->softDeletes('deleted_at', 0);

            //Chaves de ligação
            $table->foreign('user_id')->references('id')->on('users');
        });

        DB::statement("comment on table churches is 'Igrejas e Congregações'");

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('churches');
    }
};

