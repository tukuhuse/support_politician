<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateUserGoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_good', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbiginteger('user_id');
            $table->unsignedbiginteger('good_id');
            
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->ondelete('cascade')
                ->onupdate('cascade');
            $table->foreign('good_id')
                ->references('id')
                ->on('good')
                ->ondelete('cascade')
                ->onupdate('cascade');
            
            $table->unique(['user_id','good_id']);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_good', function (Blueprint $table) {
            $table->dropforeign('user_good_user_id_foreign');
            $table->dropforeign('user_good_good_id_foreign');
        });
        Schema::dropIfExists('user_good');
    }
}
