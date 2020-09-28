<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSegmentLogicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('segment_logics', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('segments_id');
            $table->string('action_column');
            $table->string('logic_type');
            $table->string('logic_value');
            $table->string('logic_operator');
            $table->string('action_type');
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
        Schema::dropIfExists('segment_logics');
    }
}
