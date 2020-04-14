<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LegislatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        //
        Schema::create('legislators', function(Blueprint $table) {
            $table->bigIncrements('Id');
            $table->string('name');                 //議員名を保存
            $table->string('birthday');             //生年月日を保存
            $table->integer('gikai_id');            //1なら衆議院、2なら参議院
            $table->integer('speaker_group_id');    //所属政党idを保存
            $table->integer('constituency_id');     //選挙区idを保存
            $table->string('url')->nullable();      //SNSのURL
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropifexists('legislators');
    }
}
