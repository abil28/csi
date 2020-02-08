<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThesisTrialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thesis_trials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('thesis_seminar_id');
            $table->string('file_report');
            $table->integer('status')->default(0);
            $table->timestamp('registered_at');
            $table->date('trial_at')->nullable();
            $table->time('start_at')->nullable();
            $table->time('end_at')->nullable();
            $table->unsignedBigInteger('room_id')->nullable();
            $table->double('score')->nullable();
            $table->string('grade')->nullable();
            $table->timestamps();

            $table->foreign('thesis_seminar_id')->references('id')->on('thesis_seminars');
            $table->foreign('room_id')->references('id')->on('rooms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thesis_trials');
    }
}
