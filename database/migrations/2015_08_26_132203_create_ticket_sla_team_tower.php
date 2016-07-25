<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketSlaTeamTower extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('team_user', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('team_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('team_id')->references('id')->on('team')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'team_id']);
        });

        Schema::create('sla', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('tenant_id')->unsigned();
        });

        Schema::create('sla_rules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('min_time');
            $table->integer('sla_id')->unsigned();

            $table->foreign('sla_id')->references('id')->on('sla')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('tower', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('state');
            $table->string('city');
            $table->text('address');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->text('description')->nullable();
            $table->boolean('active')->nullable();
            $table->timestamps();

            
        });

        Schema::create('tower_tenant', function (Blueprint $table) {
            $table->integer('tower_id')->unsigned();
            $table->integer('tenant_id')->unsigned();

            $table->foreign('tower_id')->references('id')->on('tower')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tenant_id')->references('id')->on('tenant')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['tower_id', 'tenant_id']);
        });

        Schema::create('ticket', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('status');
            $table->string('priority');
            $table->string('severity');
            $table->integer('assign_id');
            $table->string('assign_type');
            $table->timestamps();
            $table->timestamp('respond_at')->nullable();
            $table->timestamp('recover_at')->nullable();
            $table->timestamp('resolve_at')->nullable();
            $table->timestamp('close_at')->nullable();

            $table->integer('category_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('tower_id')->unsigned();

            $table->foreign('category_id')->references('id')->on('category');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('tower_id')->references('id')->on('tower');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('team_user');
        Schema::dropIfExists('team');
        Schema::dropIfExists('category');
        Schema::dropIfExists('tower_tenant');
        Schema::dropIfExists('tower');
        Schema::dropIfExists('sla_rules');
        Schema::dropIfExists('sla');
        Schema::dropIfExists('tenant');
        Schema::dropIfExists('ticket');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
