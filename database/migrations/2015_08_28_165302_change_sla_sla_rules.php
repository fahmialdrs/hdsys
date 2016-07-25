<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeSlaSlaRules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sla', function (Blueprint $table) {
            $table->text('description')->nullable();
            //$table->dropColumn('tenant_id');
            //$table->integer('tenant_id')->unsigned();

            $table->foreign('tenant_id')->references('id')->on('tenant')
                ->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('sla_rules', function (Blueprint $table) {
            $table->string('type');
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
