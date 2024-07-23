<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('titulo',255);
            $table->string('tema',255)->nullable();
            $table->string('texto', 5000)->nullable();
            $table->string('imagen',255)->nullable();
            $table->integer('visitas')->nullable();
            $table->timestamp('published_at');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            #$table->dropForeign('articles_user_id_foreign');
            $table->dropColumn('user_id');
            
        });
    }
}
