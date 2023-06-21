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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Nome completo do membro');
            $table->string('cpf',11)->unique()->nullable();
            $table->bigInteger('naturalness')->comment('ID Cidade Natal');
            $table->set('sex',['M','F'])->comment('Sexo do membro');
            $table->set('marital',['Solteiro','Casado','Separado','Divorciado','Viúvo'])->comment('Estado Civil');
            $table->string('address')->comment('Endereço - rua, avenida, etc');
            $table->integer('number')->comment('Número do prédio');
            $table->bigInteger('city_id')->comment('ID da Cidade de residência');
            $table->string('complement')->comment('Complemento: Casa, apartamento, etc');
            $table->string('schooling')->comment('Escolaridade');
            $table->string('email');
            $table->string('phones')->comment('Nºs de telefones');
            $table->date('birth')->comment('Data de nascimento');
            $table->string('blood',4)->comment('Tipo de sangue e fator RH');
            $table->boolean('donor')->comment('É doador de Sangue - true');

            $table->bigInteger('user_id')->comment('ID do cadastrador');
            $table->timestamps();

            //Chaves de ligação
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('naturalness')->references('id')->on('cities');
            $table->foreign('city_id')->references('id')->on('cities');
        });
        DB::statement("comment on table members is 'Membros da Igreja'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
