<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        # Crea la tabla para los roles
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('role', 32);
            $table->timestamps();
        });

        # Crea la tabla intermedia
        Schema::create('role_user', function (Blueprint $table){
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('role_id');
            $table->timestamps();

        # Establece las claves foráneas
            $table->foreign('user_id')->references('id')->on('users')
                    ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                    ->onUpdate('cascade')->onDelete('cascade');
        
        # Establece la clave primaria
        $table->primary(['user_id', 'role_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('role_user', function(Blueprint $table){
            $table->dropForeign('role_user_role_id_foreign');
            $table->dropForeign('role_user_user_id_foreign');
        });

        Schema::dropIfExists('roles');
        Schema::dropIfExists('role_user');
    }
}
