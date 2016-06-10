<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTicket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ticket', function (Blueprint $table) {
            $table->date('due_date');

            $table->integer('sla_id')->unsigned();
            $table->foreign('sla_id')->references('id')->on('sla');

            $table->integer('mitra_id')->unsigned();
            $table->foreign('mitra_id')->references('id')->on('mitra');
            $table->string('full_name')->nullable();
            $table->string('email')->nullable();
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
    }
}
