<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id');
            $table->integer('student_id');
            $table->string('list',500);
            $table->float('f_price');
            $table->date('delivery_date');
            $table->smallInteger('type');
            $table->boolean('delivered');
            $table->timestamps();
            $table->foreign('parent_id')
            ->references('id')
            ->on('parents')
            ->onUpdate('cascade')
            ->onDelete('set null');
            $table->foreign('student_id')
            ->references('id')
            ->on('students')
            ->onUpdate('cascade')
            ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
